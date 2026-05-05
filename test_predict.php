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

    $result = $response->json();
    $prediksiData = $result['prediksi'];
    $zScores = $result['z_score_who'];

    $hasilPrediksi = $prediksiData['stunting_ha']['keterangan'];
    $probabilitas = $prediksiData['stunting_ha']['probabilitas'];

    echo "Status H/A: " . $hasilPrediksi . " (Z: " . $zScores['z_ha'] . ")" . PHP_EOL;
    echo "Status W/A: " . $prediksiData['berat_badan_wa']['keterangan'] . " (Z: " . $zScores['z_wa'] . ")" . PHP_EOL;
    echo "Status W/H: " . $prediksiData['gizi_wh']['keterangan'] . " (Z: " . $zScores['z_wh'] . ")" . PHP_EOL;
    echo "Status HFA: " . $prediksiData['height_for_age']['keterangan'] . PHP_EOL;

    $prediksi = App\Models\Prediksi::create([
        'id_anak'          => '663673756c6c61685f313233', // Use a valid-looking ID or existing one
        'hasil_prediksi'   => $hasilPrediksi,
        'hasil_wa'         => $prediksiData['berat_badan_wa']['keterangan'],
        'hasil_wh'         => $prediksiData['gizi_wh']['keterangan'],
        'hasil_hfa'        => $prediksiData['height_for_age']['keterangan'],
        'probabilitas'     => $probabilitas,
        'z_scores'         => $zScores,
        'tanggal_prediksi' => now()->toDateString(),
    ]);
    echo "Created Prediction ID: " . $prediksi->id . PHP_EOL;

} catch (\Exception $e) {
    echo 'Exception: ' . $e->getMessage() . PHP_EOL;
}
