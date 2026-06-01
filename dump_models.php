<?php
$models = [
    \App\Models\Anak::class,
    \App\Models\ArtikelInspirasi::class,
    \App\Models\HistoriPrediksi::class,
    \App\Models\Makanan::class,
    \App\Models\Nutrisi::class,
    \App\Models\Pengukuran::class,
    \App\Models\Prediksi::class,
    \App\Models\ProfilIbu::class,
    \App\Models\RekomendasiNutrisi::class,
    \App\Models\User::class,
];

$output = [];
foreach ($models as $model) {
    $instance = new $model;
    $output[class_basename($model)] = [
        'collection' => $instance->getTable(),
        'fields' => $instance->getFillable()
    ];
}
echo json_encode($output, JSON_PRETTY_PRINT);
