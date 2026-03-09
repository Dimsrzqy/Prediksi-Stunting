<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Nutrisi extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'nutrisi';

    protected $fillable = [
        'nama_nutrisi',
    ];

    public function makanan()
    {
        return $this->hasMany(Makanan::class, 'id_nutrisi');
    }

    public function rekomendasi()
    {
        return $this->hasMany(RekomendasiNutrisi::class, 'id_nutrisi');
    }
}
