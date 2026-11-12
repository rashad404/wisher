<?php
namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class CompanyController {
 private function company(Request $r):Company{return Company::where('user_id',$r->user()->id)->firstOrFail();}
 public function show(Request $r){return ['company'=>Company::where('user_id',$r->user()->id)->withCount(['people','campaigns'])->first()];}
 public function save(Request $r){$d=$r->validate(['name'=>'required|string|max:120','signature'=>'nullable|string|max:200','color'=>['required','regex:/^#[0-9a-fA-F]{6}$/']]);$d['signature']=$d['signature']??'';$c=Company::firstOrNew(['user_id'=>$r->user()->id]);$c->fill($d);$c->user_id=$r->user()->id;$c->save();return ['company'=>$c];}
 public function people(Request $r){$d=$r->validate(['q'=>'nullable|string|max:100']);return $this->company($r)->people()->when($d['q']??null,fn($q,$s)=>$q->where('name','like',str_replace(['%','_'],['\%','\_'],$s).'%'))->orderBy('name')->paginate(20);}
 public function savePerson(Request $r,?int $id=null){$c=$this->company($r);$d=$r->validate(['name'=>'required|string|max:100','email'=>'nullable|email|max:255','kind'=>'required|in:employee,customer','birthday'=>'nullable|date_format:Y-m-d','department'=>'nullable|string|max:80']);$d['department']=$d['department']??'';$p=$id?$c->people()->findOrFail($id):$c->people()->make();$p->fill($d)->save();return $p;}
 public function deletePerson(Request $r,int $id){$this->company($r)->people()->findOrFail($id)->delete();return response()->noContent();}
 public function campaigns(Request $r){return $this->company($r)->campaigns()->withCount('people')->with('product')->orderBy('date')->paginate(12);}
 public function campaign(Request $r,int $id){return $this->company($r)->campaigns()->with(['people','product'])->findOrFail($id);}
 public function saveCampaign(Request $r,?int $id=null){
  $c=$this->company($r);$d=$r->validate(['title'=>'required|string|max:120','date'=>'required|date_format:Y-m-d','occasion'=>'required|in:birthday,anniversary,wedding,novruz,newyear,graduation,thanks,support','budget_minor'=>'required|integer|min:0|max:100000000','message'=>'nullable|string|max:2000','status'=>'required|in:draft,planned,archived','product_id'=>['nullable','integer',Rule::exists('products','id')->where('active',true)],'people'=>'present|array|max:200','people.*'=>'integer|distinct']);
  $ids=$d['people'];unset($d['people']);abort_unless($c->people()->whereIn('id',$ids)->count()===count($ids),422);
  return DB::transaction(function()use($c,$d,$ids,$id){$item=$id?$c->campaigns()->findOrFail($id):$c->campaigns()->make();$item->fill($d)->save();$item->people()->sync($ids);return $item->load('people','product');});
 }
 public function deleteCampaign(Request $r,int $id){$this->company($r)->campaigns()->findOrFail($id)->delete();return response()->noContent();}
}
