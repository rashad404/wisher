<?php
namespace Tests\Feature;
use App\Models\{User,Contact,Occasion,Wish};
use App\Services\{DeepSeekWishProvider,NextOccasion};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\{DB,Http,Log};
use Illuminate\Support\Str;
use Tests\TestCase;
class WorkspaceTest extends TestCase {
 use RefreshDatabase;
 protected function setUp():void {parent::setUp();Http::preventStrayRequests();}
 private function user(string $name='Reader'):User {return User::create(['name'=>$name,'email'=>Str::uuid().'@example.com']);}
 private function sign(User $user):void {$this->withToken($user->createToken('test')->plainTextToken);}
 private function brief():array {return ['request_key'=>(string)Str::uuid(),'recipient'=>'Aysel','relationship'=>'Dost','occasion'=>'birthday','tone'=>'warm','language'=>'az','format'=>'message','details'=>'Birlikdə kitab oxuyuruq.'];}
 public function test_guests_cannot_read_or_write_private_data():void {foreach(['dashboard','contacts','occasions','wishes'] as $path)$this->getJson('/api/'.$path)->assertUnauthorized();$this->postJson('/api/wishes/generate',$this->brief())->assertUnauthorized();$this->getJson('/api/check-twilio-credentials')->assertNotFound();}
 public function test_contacts_are_owned_and_search_is_scoped():void {
  $a=$this->user();$b=$this->user();$other=$b->contacts()->create(['name'=>'Private','relationship'=>'Dost']);$this->sign($a);
  $this->getJson('/api/contacts')->assertJsonCount(0,'data');
  $this->putJson('/api/contacts/'.$other->id,['name'=>'Changed','relationship'=>'Dost'])->assertNotFound();
  $this->deleteJson('/api/contacts/'.$other->id)->assertNotFound();
  $r=$this->postJson('/api/contacts',['name'=>'Aysel','relationship'=>'Dost','email'=>'aysel@example.com','group'=>'Dostlar','notes'=>'Kitab oxumağı sevir.'])->assertCreated();
  $this->getJson('/api/contacts?q=Ay')->assertJsonCount(1,'data');
  $this->putJson('/api/contacts/'.$r->json('id'),['name'=>'Aysel A','relationship'=>'Dost'])->assertOk();
  $this->deleteJson('/api/contacts/'.$r->json('id'))->assertNoContent();
  $this->assertSame('Private',$other->fresh()->name);
 }
 public function test_occasion_rejects_foreign_contacts_and_cross_owner_edits():void {
  $a=$this->user();$b=$this->user();$c=$b->contacts()->create(['name'=>'Other','relationship'=>'Dost']);$o=$b->occasions()->create(['title'=>'Other day','occasion'=>'birthday','date'=>'2027-01-01','next_date'=>'2027-01-01']);$this->sign($a);
  $d=['title'=>'Ad günü','occasion'=>'birthday','date'=>'2027-02-01','recurrence'=>'yearly','contact_id'=>$c->id];
  $this->postJson('/api/occasions',$d)->assertNotFound();unset($d['contact_id']);$this->putJson('/api/occasions/'.$o->id,$d)->assertNotFound();$this->deleteJson('/api/occasions/'.$o->id)->assertNotFound();$this->postJson('/api/occasions',$d)->assertCreated();$this->getJson('/api/occasions')->assertJsonCount(1,'data');
 }
 public function test_recurrence_clamps_leap_days_and_month_ends():void {
  $this->travelTo(\Carbon\Carbon::parse('2026-02-01 12:00:00','Asia/Baku'));
  $this->assertSame('2026-02-28',NextOccasion::date('2024-02-29','yearly','Asia/Baku'));
  $this->assertSame('2026-02-28',NextOccasion::date('2024-01-31','monthly','Asia/Baku'));
  $this->assertSame('2027-01-31',NextOccasion::date('2024-01-31','yearly','Asia/Baku'));
  $this->assertSame('2024-02-29',NextOccasion::date('2024-02-29','none','Asia/Baku'));
 }
 public function test_generation_is_idempotent_and_saved_wishes_are_owned():void {
  $a=$this->user();$this->sign($a);$brief=$this->brief();$r=$this->postJson('/api/wishes/generate',$brief)->assertCreated()->assertJsonPath('provider','fake')->assertJsonCount(3,'variants');
  $this->postJson('/api/wishes/generate',$brief)->assertOk()->assertJsonPath('id',$r->json('id'));
  $this->assertDatabaseCount('wishes',1);$this->assertSame(1,DB::table('generation_budgets')->value('used'));
  $this->postJson('/api/wishes/generate',array_replace($brief,['recipient'=>'Other']))->assertConflict();
  $this->putJson('/api/wishes/'.$r->json('id'),['text'=>'Sənə gözəl günlər arzulayıram!'])->assertOk();$this->getJson('/api/wishes')->assertJsonCount(1,'data');
  // Change identity on a fresh request guard.
  auth()->forgetGuards();$this->sign($this->user());
  $this->getJson('/api/wishes')->assertJsonCount(0,'data');$this->putJson('/api/wishes/'.$r->json('id'),['text'=>'Other'])->assertNotFound();$this->deleteJson('/api/wishes/'.$r->json('id'))->assertNotFound();
 }
 public function test_quota_is_reserved_before_provider_work():void {
  config(['wisher.daily_limit'=>1]);$this->sign($this->user());$this->postJson('/api/wishes/generate',$this->brief())->assertCreated();$this->postJson('/api/wishes/generate',$this->brief())->assertStatus(429);$this->assertDatabaseCount('wishes',1);
 }
 public function test_sample_cannot_be_enabled_by_regular_users():void {
  $this->sign($this->user());$this->postJson('/api/wishes/generate',$this->brief()+['sample'=>true])->assertForbidden();Http::assertNothingSent();
 }
 public function test_local_demo_sample_is_explicit_and_labeled():void {
  $this->app->instance('env','local');config(['wisher.provider'=>'deepseek']);$u=$this->user();$u->update(['is_demo'=>true]);$this->sign($u);$this->postJson('/api/wishes/generate',$this->brief()+['sample'=>true])->assertCreated()->assertJsonPath('provider','fake');Http::assertNothingSent();
 }
 public function test_global_budget_blocks_new_users():void {
  config(['wisher.global_daily_limit'=>0]);$this->sign($this->user());$this->postJson('/api/wishes/generate',$this->brief())->assertStatus(429);$this->assertDatabaseCount('wishes',0);Http::assertNothingSent();
 }
 public function test_provider_failure_is_visible_and_does_not_fall_back():void {
  config(['wisher.provider'=>'deepseek','wisher.deepseek_key'=>'test-key']);Http::fake(['*'=>Http::response([],503)]);$this->sign($this->user());$this->postJson('/api/wishes/generate',$this->brief())->assertStatus(503)->assertJsonPath('error','generation_failed');$this->assertDatabaseHas('wishes',['status'=>'failed','provider'=>'deepseek']);
 }
 public function test_deepseek_validates_output_and_records_cost_without_content():void {
  config(['wisher.deepseek_key'=>'test-key','wisher.price_in'=>0.3,'wisher.price_out'=>1]);Log::spy();
  Http::fake(['*'=>Http::sequence()->push(['choices'=>[['message'=>['content'=>json_encode(['variants'=>['Happy birthday, friend!','Wishing you a wonderful day!','May this year bring you joy!']])]]],'usage'=>['prompt_tokens'=>100,'completion_tokens'=>50]])->push(['choices'=>[['message'=>['content'=>'{"variants":["bad"]}']]]])]);
  $v=(new DeepSeekWishProvider)->generate($this->brief());$this->assertCount(3,$v);
  Http::assertSent(fn($r)=>$r['response_format']['type']==='json_object' && $r['thinking']['type']==='disabled' && !str_contains($r->url(),'test-key'));
  Log::shouldHaveReceived('info')->withArgs(fn($message,$data)=>$message==='Wish generation usage' && $data['input_tokens']===100 && !isset($data['prompt']) && $data['estimated_usd']>0)->once();
  $this->expectException(\RuntimeException::class);(new DeepSeekWishProvider)->generate($this->brief());
 }
 public function test_settings_cannot_modify_identity():void {
  $u=$this->user();$this->sign($u);$this->putJson('/api/settings',['name'=>'Reader A','timezone'=>'Europe/London','language'=>'en','kimlik_id'=>'attack','is_demo'=>true])->assertOk();$this->assertNull($u->fresh()->kimlik_id);$this->assertFalse($u->fresh()->is_demo);$this->putJson('/api/settings',['name'=>'Reader','timezone'=>'bad','language'=>'az'])->assertUnprocessable();
 }
 public function test_demo_is_disabled_outside_local():void {$this->postJson('/api/auth/demo')->assertNotFound();config(['wisher.demo'=>true]);$this->postJson('/api/auth/demo')->assertNotFound();}
 public function test_indexed_dashboard_with_one_hundred_thousand_users():void {
  $u=$this->user();$now=now()->toDateTimeString();$batch=[];
  for($i=0;$i<100000;$i++) { $batch[]=['name'=>'Synthetic','email'=>"reader$i@example.com",'created_at'=>$now,'updated_at'=>$now];if(count($batch)===500){DB::table('users')->insert($batch);$batch=[];} }
  $u->contacts()->create(['name'=>'Local person','relationship'=>'Dost']);$this->sign($u);DB::enableQueryLog();
  $this->getJson('/api/dashboard')->assertOk()->assertJsonPath('counts.contacts',1);$queries=DB::getQueryLog();DB::disableQueryLog();$this->assertLessThanOrEqual(12,count($queries));
  $plan=DB::select('EXPLAIN QUERY PLAN SELECT * FROM occasions WHERE user_id = ? AND next_date >= ? ORDER BY next_date LIMIT 5',[$u->id,'2026-01-01']);$this->assertStringContainsString('occasions_user_id_next_date_index',json_encode($plan));
 }
}
