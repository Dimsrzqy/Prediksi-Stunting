<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Anak;
use App\Models\Prediksi;

$anak = Anak::first();
echo "Sample Anak ID: " . $anak->_id . " (Type: " . gettype($anak->_id) . ")\n";

$prediksi = Prediksi::first();
if ($prediksi) {
    echo "Sample Prediksi id_anak: " . $prediksi->id_anak . " (Type: " . gettype($prediksi->id_anak) . ")\n";
} else {
    echo "No Prediksi data found.\n";
}

$anakIds4 = Anak::pluck('id')->toArray();
echo "pluck('id') directly: "; var_dump($anakIds4);



$data = Prediksi::whereIn('id_anak', $anakIds)->get();
echo "Count matched: " . $data->count() . "\n";

