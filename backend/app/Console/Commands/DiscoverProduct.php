<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Services\{CatalogImport,CatalogFetch};
class DiscoverProduct extends Command {
 protected $signature='catalog:add {url} {--category=technology} {--occasions=birthday,thanks,newyear} {--recipients=friend,family,colleague}';protected $description='Fetch and import a single reviewed, allowlisted product URL';
 public function handle(CatalogImport $import,CatalogFetch $fetch):int{try{$url=$this->argument('url');$r=$fetch->get($url);if($r['status']!==200)throw new \RuntimeException('Retailer unavailable');$d=$import->parse($r['html'],$url,['category'=>$this->option('category'),'occasions'=>explode(',',$this->option('occasions')),'recipients'=>explode(',',$this->option('recipients'))]);$p=$import->save($d,true);$this->info('Imported product '.$p->id.': '.$p->title);return self::SUCCESS;}catch(\Throwable $e){$this->error('Product not imported: '.$e->getMessage());return self::FAILURE;}}
}
