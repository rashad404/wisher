<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\{DB,Http};
use App\Models\{User,Product,Company};
use App\Services\CatalogImport;
class GiftsAndCompaniesTest extends TestCase {
 use RefreshDatabase;
 private function login(string $email='owner@example.com'):User{auth()->forgetGuards();$u=User::firstOrCreate(['email'=>$email],['name'=>'Test owner']);$this->withToken($u->createToken('test')->plainTextToken);return $u;}
 private function product(array $extra=[]):Product{return Product::create(array_replace(['title'=>'Test gift','store'=>'Example store','source_url'=>'https://example.com/product/gift','source_hash'=>hash('sha256',uniqid()),'category'=>'books','occasions'=>['birthday'],'recipients'=>['friend'],'price_minor'=>1200,'availability'=>'unknown'],$extra));}
 public function test_catalog_filters_pagination_and_inactive_products():void{
  $p=$this->product();$hidden=$this->product(['active'=>false]);for($i=0;$i<15;$i++)$this->product(['category'=>'home','price_minor'=>2500]);
  $this->getJson('/api/catalog?category=books&max=15&occasion=birthday&recipient=friend')->assertOk()->assertJsonCount(1,'data')->assertJsonPath('data.0.id',$p->id)->assertJsonPath('data.0.stale',true);
  $this->getJson('/api/catalog')->assertJsonCount(12,'data')->assertJsonPath('total',16);$this->getJson('/api/catalog/'.$hidden->id)->assertNotFound();$this->getJson('/api/catalog?max=-1')->assertUnprocessable();
 }
 public function test_catalog_budget_range_and_rejected_feature():void{
  $this->product(['price_minor'=>4999]);$in=$this->product(['price_minor'=>9900]);$this->product(['price_minor'=>15001]);
  $this->product(['title'=>'LEGO Creator Flowers in Watering Can','price_minor'=>9900]);
  $this->getJson('/api/catalog?min=50&max=150')->assertOk()->assertJsonPath('total',1)->assertJsonPath('data.0.id',$in->id);
  $this->getJson('/api/catalog?min=-1')->assertUnprocessable();
 }
 public function test_wishlist_is_private_and_idempotent():void{
  $p=$this->product();$this->getJson('/api/wishlist')->assertUnauthorized();$this->login();$this->putJson('/api/wishlist/'.$p->id)->assertOk();$this->putJson('/api/wishlist/'.$p->id)->assertOk();$this->getJson('/api/wishlist')->assertJsonPath('total',1);$this->login('other@example.com');$this->getJson('/api/wishlist')->assertJsonCount(0,'data');$this->deleteJson('/api/wishlist/'.$p->id)->assertNoContent();$this->assertDatabaseCount('wishlist_items',1);
 }
 public function test_company_ownership_and_recipient_validation():void{
  $this->login();$this->putJson('/api/company',['name'=>'Example team','signature'=>'Our team','color'=>'#562841'])->assertOk();
  $person=$this->postJson('/api/company/people',['name'=>'Reader','kind'=>'employee','email'=>'reader@example.com'])->assertCreated()->json('id');
  $draft=['title'=>'Birthday plan','date'=>'2027-01-01','occasion'=>'birthday','budget_minor'=>5000,'message'=>'A personal message','status'=>'draft','people'=>[$person]];
  $id=$this->postJson('/api/company/campaigns',$draft)->assertCreated()->assertJsonCount(1,'people')->json('id');
  $this->login('other@example.com');$this->putJson('/api/company',['name'=>'Other team','color'=>'#123456'])->assertOk();
  $this->getJson('/api/company/campaigns/'.$id)->assertNotFound();$this->putJson('/api/company/campaigns/'.$id,$draft)->assertUnprocessable();$this->deleteJson('/api/company/people/'.$person)->assertNotFound();$this->postJson('/api/company/campaigns',$draft)->assertUnprocessable();
  $draft['people']=[];$this->putJson('/api/company/campaigns/'.$id,$draft)->assertNotFound();$draft['status']='sent';$this->postJson('/api/company/campaigns',$draft)->assertUnprocessable();
  $this->login();$this->deleteJson('/api/company/people/'.$person)->assertNoContent();$this->getJson('/api/company/campaigns/'.$id)->assertJsonCount(0,'people');$this->assertDatabaseCount('campaign_person',0);
 }
 public function test_brand_cannot_change_owner_or_execute_markup():void{
  $u=$this->login();$this->putJson('/api/company',['name'=>'Example','color'=>'javascript:alert(1)','user_id'=>999])->assertUnprocessable();$this->putJson('/api/company',['name'=>'Example','color'=>'#AABBCC','user_id'=>999])->assertOk();$this->assertDatabaseHas('companies',['user_id'=>$u->id]);
 }
 public function test_reminders_roll_forward_and_do_not_duplicate():void{
  $this->travelTo(\Carbon\Carbon::parse('2026-11-12 12:00:00','Asia/Baku'));$u=$this->login();$o=$u->occasions()->create(['title'=>'Birthday','occasion'=>'birthday','date'=>'2020-11-15','next_date'=>'2020-11-15','recurrence'=>'yearly']);
  $id=$this->getJson('/api/reminders')->assertOk()->assertJsonPath('data.0.occurrence_date','2026-11-15')->json('data.0.id');$this->getJson('/api/reminders')->assertJsonPath('total',1);$this->assertDatabaseCount('reminders',1);$this->putJson('/api/reminders/'.$id)->assertOk();$this->assertNotNull(DB::table('reminders')->value('read_at'));
  $this->login('other@example.com');$this->getJson('/api/reminders')->assertJsonCount(0,'data');$this->putJson('/api/reminders/'.$id)->assertNotFound();$this->assertSame('2026-11-15',$o->fresh()->next_date);
 }
 public function test_import_parses_structured_data_and_rejects_unsafe_urls():void{
  config(['catalog.stores'=>['example.com'=>'Example store'],'catalog.image_hosts'=>['example.com']]);$service=new CatalogImport();
  $html='<script type="application/ld+json">'.json_encode(['@graph'=>[['@type'=>'Product','name'=>'Gift book','description'=>'<b>A book</b>','image'=>'https://example.com/book.jpg','offers'=>['price'=>'12.45','priceCurrency'=>'AZN','availability'=>'https://schema.org/InStock']]]]).'</script>';
  $d=$service->parse($html,'https://example.com/product/book',['category'=>'books','occasions'=>['birthday'],'recipients'=>['friend']]);$p=$service->save($d,true);$this->assertSame(1245,$p->price_minor);$this->assertFalse($p->stale);$this->assertSame('A book',$p->description);$service->save($d,true);$this->assertDatabaseCount('products',1);
  foreach(['http://example.com/x','https://example.com@127.0.0.1/x','https://example.com:443/x','https://127.0.0.1/x','javascript:alert(1)'] as $url)$this->assertFalse($service->validUrl($url,['example.com']));
  $d['image_url']='https://127.0.0.1/image';$this->expectException(\InvalidArgumentException::class);$service->save($d);
 }
 public function test_import_manifest_is_atomic():void{
  config(['catalog.stores'=>['example.com'=>'Example store'],'catalog.image_hosts'=>['example.com']]);$file=tempnam(sys_get_temp_dir(),'wisher-test');$rows=[['title'=>'Book','source_url'=>'https://example.com/book','category'=>'books','occasions'=>['birthday'],'recipients'=>['friend'],'availability'=>'unknown'],['title'=>'Bad','source_url'=>'https://127.0.0.1','category'=>'books','occasions'=>[],'recipients'=>[],'availability'=>'unknown']];file_put_contents($file,json_encode($rows));try{$this->artisan('catalog:import',['file'=>$file])->assertFailed();$this->assertDatabaseCount('products',0);}finally{unlink($file);}
 }
 public function test_calendar_expands_recurrences_and_excludes_other_owners():void {
  $u=$this->login();$u->occasions()->create(['title'=>'Leap birthday','occasion'=>'birthday','date'=>'2024-02-29','next_date'=>'2027-02-28','recurrence'=>'yearly']);
  $u->occasions()->create(['title'=>'Monthly','occasion'=>'thanks','date'=>'2024-01-31','next_date'=>'2026-11-30','recurrence'=>'monthly']);
  $u->occasions()->create(['title'=>'Future start','occasion'=>'birthday','date'=>'2028-02-01','next_date'=>'2028-02-01','recurrence'=>'yearly']);
  $this->getJson('/api/calendar?month=2027-02')->assertOk()->assertJsonCount(2,'events')->assertJsonPath('events.0.date','2027-02-28');
  $this->getJson('/api/calendar?month=invalid')->assertUnprocessable();$this->login('other@example.com');$this->getJson('/api/calendar?month=2027-02')->assertJsonCount(0,'events');
 }
}
