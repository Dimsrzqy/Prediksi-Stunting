<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $mlData = ['nama' => 'Gilang Pratama Putra', 'jenis_kelamin' => 'Laki-laki', 'umur_bulan' => 24, 'berat_badan' => 15, 'tinggi_badan' => 100];
    $apiUrl = env('ML_API_URL', 'http://127.0.0.1:8001') . '/predict';
    echo 'URL: ' . $apiUrl . PHP_EOL;
    $response = \Illuminate\Support\Facades\Http::timeout(30)->post($apiUrl, $mlData);
    
    if ($response->failed()) {
        echo 'Failed: ' . $response->body() . PHP_EOL;
    } else {
        echo 'Success: ' . $response->body() . PHP_EOL;
    }

    $prediksiData = $response->json()['prediksi'];
    $hasilPrediksi = $prediksiData['keterangan'];
    $probabilitas = $prediksiData['probabilitas'];

    $prediksi = App\Models\Prediksi::create([
        'id_anak'          => '69ee53c6476800d46e044504',
        'hasil_prediksi'   => $hasilPrediksi,
        'probabilitas'     => $probabilitas,
        'tanggal_prediksi' => now()->toDateString(),
    ]);
    echo "Created: " . $prediksi->id . PHP_EOL;

} catch (\Exception $e) {
    echo 'Exception: ' . $e->getMessage() . PHP_EOL;
}
