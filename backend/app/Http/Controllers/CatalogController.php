<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CatalogController {
 public function index(Request $r){
  $d=$r->validate(['q'=>'nullable|string|max:100','category'=>'nullable|string|max:30','occasion'=>'nullable|string|max:40','recipient'=>'nullable|string|max:30','min'=>'nullable|integer|min:0|max:100000','max'=>'nullable|integer|min:0|max:100000','sort'=>'nullable|in:newest,price_asc,price_desc','page'=>'nullable|integer|min:1|max:10000']);
  $q=Product::where('active',true)->where('title','not like','%Flowers in Watering Can%');
  if(!empty($d['q']))$q->where('title','like','%'.str_replace(['%','_'],['\%','\_'],$d['q']).'%');
  foreach(['category'] as $key)if(!empty($d[$key]))$q->where($key,$d[$key]);
  foreach(['occasion'=>'occasions','recipient'=>'recipients'] as $key=>$column)if(!empty($d[$key]))$q->whereJsonContains($column,$d[$key]);
  if(isset($d['min']))$q->where('price_minor','>=',$d['min']*100);
  if(isset($d['max']))$q->where('price_minor','<=',$d['max']*100);
  if(in_array($d['sort']??'',['price_asc','price_desc']))$q->orderByRaw('price_minor IS NULL')->orderBy('price_minor',$d['sort']==='price_asc'?'asc':'desc');
  return $q->orderByDesc('id')->paginate(12);
 }
 public function show(int $id){return Product::where('active',true)->findOrFail($id);}
 public function wishlist(Request $r){return Product::join('wishlist_items','products.id','=','wishlist_items.product_id')->where('wishlist_items.user_id',$r->user()->id)->select('products.*')->orderByDesc('wishlist_items.id')->paginate(12);}
 public function save(Request $r,int $id){Product::where('active',true)->findOrFail($id);DB::table('wishlist_items')->insertOrIgnore(['user_id'=>$r->user()->id,'product_id'=>$id,'created_at'=>now(),'updated_at'=>now()]);return ['saved'=>true];}
 public function remove(Request $r,int $id){DB::table('wishlist_items')->where('user_id',$r->user()->id)->where('product_id',$id)->delete();return response()->noContent();}
}
