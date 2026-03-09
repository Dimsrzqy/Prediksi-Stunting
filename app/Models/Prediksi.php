<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Prediksi extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'prediksi_stunting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_anak',
        'hasil_prediksi',
        'probabilitas',
        'tanggal_prediksi',
    ];

    /**
     * Get the anak that owns the prediction.
     */
    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak', 'id_anak');
    }
}
