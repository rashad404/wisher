<?php
namespace App\Services;
use Illuminate\Support\Facades\{Http,Cache};
class CatalogFetch {
 public function get(string $url):array {
  if(!(new CatalogImport)->validUrl($url,array_keys(config('catalog.stores'))))throw new \RuntimeException('Retailer not allowlisted');
  $host=parse_url($url,PHP_URL_HOST);$addresses=gethostbynamel($host)?:[];
  if(!$addresses || collect($addresses)->contains(fn($ip)=>!filter_var($ip,FILTER_VALIDATE_IP,FILTER_FLAG_NO_PRIV_RANGE|FILTER_FLAG_NO_RES_RANGE)))throw new \RuntimeException('Unsafe or unresolved host');
  $request=fn()=>Http::timeout(15)->connectTimeout(5)->withHeaders(['User-Agent'=>'WisherCatalog/1.0'])->withOptions(['allow_redirects'=>false,'curl'=>[CURLOPT_RESOLVE=>[$host.':443:'.$addresses[0]]],'progress'=>function($total,$downloaded){if($downloaded>3000000)throw new \RuntimeException('Response too large');},'on_headers'=>function($response){if((int)$response->getHeaderLine('Content-Length')>3000000)throw new \RuntimeException('Response too large');}]);
  $robots=Cache::remember('catalog-robots:'.$host,3600,function()use($request,$host){$r=$request()->get('https://'.$host.'/robots.txt');if($r->status()===404)return '';if($r->status()!==200)throw new \RuntimeException('Robots unavailable');return $r->body();});
  foreach(preg_split('/\R/',$robots) as $line)if(preg_match('/^Disallow:\s*(\S+)/i',trim($line),$m)){$rule=explode('#',$m[1])[0];$pattern='~^'.str_replace(['\\*','\\$'],['.*','$'],preg_quote($rule,'~')).'~';if(preg_match($pattern,parse_url($url,PHP_URL_PATH)))throw new \RuntimeException('Path disallowed');}
  $r=$request()->get($url);return ['status'=>$r->status(),'html'=>$r->body()];
 }
}
