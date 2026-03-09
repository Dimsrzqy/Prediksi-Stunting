<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Lingkungan extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'lingkungan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_anak',
        'sanitasi',
        'sumber_air',
        'pendapatan_keluarga',
        'jumlah_anggota_keluarga',
    ];

    /**
     * Get the anak that owns the lingkungan.
     */
    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak');
    }
}
