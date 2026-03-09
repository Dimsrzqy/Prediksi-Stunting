<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Makanan extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'makanan';

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
        'nama_makanan',
        'id_nutrisi',
        'deskripsi',
    ];

    /**
     * Get the nutrisi that the food has.
     */
    public function nutrisi()
    {
        return $this->belongsTo(Nutrisi::class, 'id_nutrisi', 'id_nutrisi');
    }
}
