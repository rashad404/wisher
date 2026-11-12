<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\WishProvider;
class WishController {
 public function index(Request $r) { return $r->user()->wishes()->where('saved',true)->latest()->paginate(20); }
 public function generate(Request $r, WishProvider $provider) {
  $d=$r->validate(['request_key'=>'required|uuid','recipient'=>'required|string|max:100','relationship'=>'required|string|max:60','occasion'=>'required|in:birthday,anniversary,wedding,novruz,newyear,graduation,thanks,support','tone'=>'required|in:warm,funny,formal,heartfelt','language'=>'required|in:az,en,ru','format'=>'required|in:message,sms,speech','details'=>'nullable|string|max:500','sample'=>'sometimes|boolean']);
  $sample=(bool)($d['sample']??false);unset($d['sample']);
  abort_if($sample && (!app()->environment('local') || !$r->user()->is_demo),403);
  $key=$d['request_key'];unset($d['request_key']);$hash=hash('sha256',json_encode([$d,$sample]));
  $wish=DB::transaction(function()use($r,$d,$key,$hash,$sample) {
   // One global row serializes quota reservation, not provider work.
   $scope='global:'.now()->toDateString();
   DB::table('generation_budgets')->insertOrIgnore(['scope'=>$scope,'used'=>0]);
   $budget=DB::table('generation_budgets')->where('scope',$scope)->lockForUpdate()->first();
   if($existing=$r->user()->wishes()->where('request_key',$key)->first()) { abort_unless(hash_equals($existing->input_hash,$hash),409);return $existing; }
   abort_if($budget->used>=config('wisher.global_daily_limit'),429);
   abort_if($r->user()->wishes()->where('created_at','>=',now()->startOfDay())->count()>=config('wisher.daily_limit'),429);
   DB::table('generation_budgets')->where('scope',$scope)->increment('used');
   return $r->user()->wishes()->create(['request_key'=>$key,'input_hash'=>$hash,'brief'=>$d,'provider'=>$sample?'fake':config('wisher.provider')]);
  },3);
  if(!$wish->wasRecentlyCreated) return response()->json($wish,$wish->status==='pending'?202:($wish->status==='failed'?503:200));
  try { $wish->update(['variants'=>($sample ? new \App\Services\FakeWishProvider : $provider)->generate($d),'status'=>'ready']); }
  catch(\Throwable) { $wish->update(['status'=>'failed']);return response()->json(['error'=>'generation_failed'],503); }
  return $wish;
 }
 public function save(Request $r,int $id) { $w=$r->user()->wishes()->findOrFail($id);abort_unless($w->status==='ready',409);$d=$r->validate(['text'=>'required|string|max:2000']);$w->update(['selected_text'=>$d['text'],'saved'=>true]);return $w; }
 public function delete(Request $r,int $id) { $r->user()->wishes()->findOrFail($id)->update(['saved'=>false,'selected_text'=>null]);return response()->noContent(); }
}
