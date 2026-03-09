<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class HistoriPrediksi extends Model
{
    use HasFactory;

    protected $collection = 'histori_prediksi';

    protected $fillable = [
        'id_anak',
        'hasil_prediksi',
        'probabilitas',
        'tanggal_prediksi',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak');
    }
}
