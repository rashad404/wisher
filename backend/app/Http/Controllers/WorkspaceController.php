<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Services\NextOccasion;
class WorkspaceController {
 public function configuration() { return ['kimlik_ready'=>(bool)(config('kimlik.client_id') && config('kimlik.client_secret')), 'demo'=>app()->environment('local') && config('wisher.demo'), 'provider'=>config('wisher.provider')]; }
 public function demo() {
  abort_unless(app()->environment('local') && config('wisher.demo'),404);
  $u=User::create(['name'=>'Nümunə hesab','email'=>Str::uuid().'@example.com','is_demo'=>true]);
  foreach([['Aysel','Dost','Dostlar',3],['Ana','Ailə','Ailə',12],['Murad','İş yoldaşı','İş',21]] as [$name,$relation,$group,$days]) {
   $c=$u->contacts()->create(['name'=>$name,'relationship'=>$relation,'group'=>$group]);
   $date=now('Asia/Baku')->addDays($days)->toDateString();
   $u->occasions()->create(['contact_id'=>$c->id,'title'=>$name.' - ad günü','occasion'=>'birthday','date'=>$date,'next_date'=>$date,'recurrence'=>'yearly']);
  }
  return ['user'=>$u,'token'=>$u->createToken('local-preview',['*'],now()->addDay())->plainTextToken];
 }
 public function dashboard(Request $r) {
  $u=$r->user();
  (new \App\Services\OccasionReminders)->refresh($u);
  return ['user'=>$u,'counts'=>['contacts'=>$u->contacts()->count(),'occasions'=>$u->occasions()->count(),'saved'=>$u->wishes()->where('saved',true)->count()], 'upcoming'=>$u->occasions()->where('next_date','>=',now($u->timezone)->toDateString())->orderBy('next_date')->limit(5)->get(), 'recent'=>$u->wishes()->where('status','ready')->latest()->limit(3)->get()];
 }
 public function contacts(Request $r) { $d=$r->validate(['q'=>'nullable|string|max:100']); return $r->user()->contacts()->when($d['q']??null,fn($q,$v)=>$q->where('name','like',str_replace(['%','_'],['\%','\_'],$v).'%'))->orderBy('name')->paginate(20); }
 public function saveContact(Request $r, ?int $id=null) {
  $d=$r->validate(['name'=>'required|string|max:100','relationship'=>'required|string|max:60','group'=>'nullable|string|max:60','email'=>'nullable|email|max:255','birthday'=>'nullable|date_format:Y-m-d','notes'=>'nullable|string|max:500']);
  $d['group']=$d['group']??'';
  $c=$id ? $r->user()->contacts()->findOrFail($id) : $r->user()->contacts()->make();$c->fill($d)->save();return $c;
 }
 public function deleteContact(Request $r,int $id) { $r->user()->contacts()->findOrFail($id)->delete();return response()->noContent(); }
 public function occasions(Request $r) { return $r->user()->occasions()->orderBy('next_date')->paginate(20); }
 public function saveOccasion(Request $r,?int $id=null) {
  if(!$id)abort_if($r->user()->occasions()->count()>=1000,422);
  $d=$r->validate(['title'=>'required|string|max:120','occasion'=>'required|in:birthday,anniversary,wedding,novruz,newyear,graduation,thanks,support','date'=>'required|date_format:Y-m-d','recurrence'=>'required|in:none,yearly,monthly','contact_id'=>'nullable|integer']);
  if(!empty($d['contact_id'])) $r->user()->contacts()->findOrFail($d['contact_id']);
  $d['next_date']=NextOccasion::date($d['date'],$d['recurrence'],$r->user()->timezone);
  $o=$id ? $r->user()->occasions()->findOrFail($id) : $r->user()->occasions()->make();$o->fill($d)->save();return $o;
 }
 public function deleteOccasion(Request $r,int $id) { $r->user()->occasions()->findOrFail($id)->delete();return response()->noContent(); }
 public function settings(Request $r) { $d=$r->validate(['name'=>'required|string|max:100','timezone'=>'required|timezone','language'=>'required|in:az,en,ru']);$r->user()->update($d);return ['user'=>$r->user()]; }
}
