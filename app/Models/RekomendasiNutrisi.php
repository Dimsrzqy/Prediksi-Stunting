<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class RekomendasiNutrisi extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'rekomendasi';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kategori_risiko',
        'id_nutrisi',
    ];

    /**
     * Get the nutrisi that owns the recommendation.
     */
    public function nutrisi()
    {
        return $this->belongsTo(Nutrisi::class, 'id_nutrisi');
    }
}
