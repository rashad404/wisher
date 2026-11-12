<?php
namespace App\Services;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class CatalogImport {
 public function validUrl(string $url,array $hosts):bool{$p=parse_url($url);return $p && ($p['scheme']??'')==='https' && in_array($p['host']??'', $hosts,true) && !isset($p['user']) && !isset($p['pass']) && !isset($p['port']);}
 public function save(array $data,bool $checked=false):Product{
  $d=Validator::make($data,['source_url'=>'required|string|max:1000','title'=>'required|string|max:200','description'=>'nullable|string|max:600','image_url'=>'nullable|string|max:1000','category'=>['required',Rule::in(config('catalog.categories'))],'occasions'=>'required|array|max:12','occasions.*'=>'string|in:birthday,anniversary,wedding,novruz,newyear,graduation,thanks,support','recipients'=>'required|array|max:8','recipients.*'=>'string|in:friend,family,colleague,child','price_minor'=>'nullable|integer|min:0|max:100000000','availability'=>'required|in:unknown,in_stock,out_of_stock','active'=>'sometimes|boolean'])->validate();
  if(!$this->validUrl($d['source_url'],array_keys(config('catalog.stores'))))throw new \InvalidArgumentException('Retailer URL is not allowlisted');
  if(!empty($d['image_url']) && !$this->validUrl($d['image_url'],config('catalog.image_hosts')))throw new \InvalidArgumentException('Image URL is not allowlisted');
  $d['description']=strip_tags($d['description']??'');$d['title']=strip_tags($d['title']);$d['source_url']=strtok($d['source_url'],'?');$d['source_url']=explode('#',$d['source_url'])[0];
  $d['store']=config('catalog.stores')[parse_url($d['source_url'],PHP_URL_HOST)];$hash=hash('sha256',$d['source_url']);
  $d['checked_at']=$checked?now():null;$d['discovered_at']=now();$d['currency']='AZN';
  return Product::updateOrCreate(['source_hash'=>$hash],$d);
 }
 public function parse(string $html,string $url,array $labels):array{
  if(strlen($html)>3000000)throw new \RuntimeException('Page too large');
  $dom=new \DOMDocument();$previous=libxml_use_internal_errors(true);$dom->loadHTML('<?xml encoding="UTF-8">'.$html,LIBXML_NONET|LIBXML_NOERROR|LIBXML_NOWARNING);libxml_clear_errors();libxml_use_internal_errors($previous);
  $nodes=(new \DOMXPath($dom))->query('//script[@type="application/ld+json"]');$products=[];
  $walk=function($value,$depth=0)use(&$walk,&$products){if(!is_array($value)||$depth>12)return;if(in_array('Product',(array)($value['@type']??[])))$products[]=$value;foreach($value as $v)if(is_array($v))$walk($v,$depth+1);};
  foreach($nodes as $node){$walk(json_decode($node->textContent,true));}
  if(!$products)throw new \RuntimeException('No product structured data');
  $p=$products[0];$o=$p['offers']??[];if(isset($o[0]))$o=$o[0];
  if(($o['priceCurrency']??'AZN')!=='AZN')throw new \RuntimeException('Unsupported currency');
  $price=$o['price']??null;$image=$p['image']??null;if(is_array($image))$image=$image['url']??($image[0]??null);if(is_array($image))$image=$image['url']??null;
  return $labels+['source_url'=>$url,'title'=>mb_substr(strip_tags($p['name']??''),0,200),'description'=>mb_substr(trim(strip_tags(html_entity_decode($p['description']??''))),0,600),'image_url'=>$image,'price_minor'=>is_numeric($price)?(int)round((float)$price*100):null,'availability'=>match(basename($o['availability']??'')){'InStock'=>'in_stock','OutOfStock','Discontinued'=>'out_of_stock',default=>'unknown'}];
 }
}
