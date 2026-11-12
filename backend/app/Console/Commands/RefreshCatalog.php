<?php
namespace App\Console\Commands;
use App\Models\Product;
use App\Services\{CatalogImport,CatalogFetch};
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
class RefreshCatalog extends Command {
 protected $signature='catalog:refresh {--limit=20}';protected $description='Refresh bounded, allowlisted product URLs from JSON-LD';
 public function handle(CatalogImport $service,CatalogFetch $fetch):int{
  $lock=Cache::lock('catalog-refresh',1800);if(!$lock->get()){$this->error('Refresh already running');return self::FAILURE;}$failures=0;
  try{foreach(Product::where('active',true)->orderBy('checked_at')->limit(max(1,min(100,(int)$this->option('limit'))))->get() as $p){try{
   $r=$fetch->get($p->source_url);if(in_array($r['status'],[404,410])){$p->update(['availability'=>'out_of_stock','checked_at'=>now()]);continue;}if($r['status']!==200)throw new \RuntimeException('Unexpected response');
   $data=$service->parse($r['html'],$p->source_url,['category'=>$p->category,'occasions'=>$p->occasions,'recipients'=>$p->recipients]);$service->save($data,true);$this->line('Updated product '.$p->id);
  }catch(\Throwable){$failures++;$this->warn('Product '.$p->id.' not refreshed; previous snapshot retained.');}usleep(500000);}}finally{$lock->release();}
  return $failures?self::FAILURE:self::SUCCESS;
 }
}
