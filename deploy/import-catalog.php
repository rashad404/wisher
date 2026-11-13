<?php
// Fresh v2 database only. Keep reviewed IDs used by the approved product imagery.
chdir(__DIR__.'/../backend');
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
if (!app()->environment('production') || App\Models\Product::count() !== 0) {
    throw new RuntimeException('Import requires an empty production catalog');
}
$rows = json_decode(file_get_contents(__DIR__.'/catalog.json'), true, 32, JSON_THROW_ON_ERROR);
Illuminate\Support\Facades\DB::transaction(function () use ($rows) {
    foreach ($rows as $row) {
        $product = app(App\Services\CatalogImport::class)->save($row);
        $product->id = $row['id'];
        $product->save();
    }
});
echo count($rows)." reviewed listings imported. No users imported.\n";
