<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Services\CatalogImport;
use Illuminate\Support\Facades\DB;
class ImportCatalog extends Command {
 protected $signature='catalog:import {file : Reviewed JSON manifest}';protected $description='Import reviewed retailer listings without fetching websites';
 public function handle(CatalogImport $service):int{try{$file=$this->argument('file');if(!is_file($file)||filesize($file)>2000000)throw new \RuntimeException('Invalid manifest');$rows=json_decode(file_get_contents($file),true,32,JSON_THROW_ON_ERROR);if(!is_array($rows)||count($rows)>500)throw new \RuntimeException('Maximum 500 listings');DB::transaction(function()use($rows,$service){foreach($rows as $r)$service->save($r);});$this->info(count($rows).' listings imported as unverified snapshots. Run catalog:refresh for live verification.');return self::SUCCESS;}catch(\Throwable $e){$this->error('Import rejected: '.$e->getMessage());return self::FAILURE;}}
}
