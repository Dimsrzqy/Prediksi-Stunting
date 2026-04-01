<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Pengukuran extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'pengukurans';

    protected $fillable = [
        'id_anak',
        'umur_bulan',
        'tinggi_badan',
        'berat_badan',
        'tanggal_ukur',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak');
    }
}
