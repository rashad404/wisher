<?php
namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
class KimlikTest extends TestCase {
 use RefreshDatabase;
 protected function setUp():void {parent::setUp();Http::preventStrayRequests();config(['kimlik.client_id'=>'test-client','kimlik.client_secret'=>'test-secret','kimlik.api_url'=>'https://example.com/api','kimlik.origins'=>['https://example.com']]);}
 private function transaction():array {
  $verifier=str_repeat('v',43);$state=str_repeat('s',43);$redirect='https://example.com/az/auth/kimlik/callback';
  $r=$this->postJson('/api/auth/kimlik/start',['state'=>$state,'code_challenge'=>rtrim(strtr(base64_encode(hash('sha256',$verifier,true)),'+/','-_'),'='),'redirect_uri'=>$redirect])->assertOk();
  return ['transaction'=>$r->json('transaction'),'state'=>$state,'code_verifier'=>$verifier,'code'=>'test-code','redirect_uri'=>$redirect];
 }
 private function fake(bool $verified=true):void {Http::fake(['example.com/api/oauth/token'=>Http::response(['access_token'=>'provider-token']),'example.com/api/oauth/user'=>Http::response(['data'=>['id'=>'subject-1','name'=>'Reader','email'=>'reader@example.com','verification'=>['email_verified'=>$verified]]])]);}
 public function test_exchange_and_replay():void {
  $this->fake();$d=$this->transaction();$r=$this->postJson('/api/auth/kimlik/callback',$d)->assertOk();$this->assertDatabaseCount('users',1);$this->assertSame('subject-1',User::first()->kimlik_id);$this->postJson('/api/auth/kimlik/callback',$d)->assertUnprocessable();$this->withToken($r->json('token'))->getJson('/api/auth/me')->assertOk();$this->postJson('/api/auth/logout')->assertNoContent();$this->assertDatabaseCount('personal_access_tokens',0);
 }
 public function test_state_pkce_and_expiry_rejected_before_external_calls():void {
  $d=$this->transaction();$d['state']='wrong';$this->postJson('/api/auth/kimlik/callback',$d)->assertUnprocessable();
  $d=$this->transaction();$d['code_verifier']=str_repeat('x',43);$this->postJson('/api/auth/kimlik/callback',$d)->assertUnprocessable();
  $d=$this->transaction();$this->travel(11)->minutes();$this->postJson('/api/auth/kimlik/callback',$d)->assertUnprocessable();Http::assertNothingSent();
 }
 public function test_redirect_allowlist_and_unverified_linking():void {
  $this->postJson('/api/auth/kimlik/start',['state'=>str_repeat('s',43),'code_challenge'=>str_repeat('c',43),'redirect_uri'=>'https://example.com/other'])->assertUnprocessable();
  User::create(['name'=>'Existing','email'=>'reader@example.com']);$this->fake(false);$this->postJson('/api/auth/kimlik/callback',$this->transaction())->assertStatus(409);$this->assertNull(User::first()->kimlik_id);
 }
 public function test_failed_exchange_does_not_create_user():void {Http::fake(['*'=>Http::response([],500)]);$this->postJson('/api/auth/kimlik/callback',$this->transaction())->assertUnauthorized();$this->assertDatabaseCount('users',0);}
}
