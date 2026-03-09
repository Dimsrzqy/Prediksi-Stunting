<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class ProfilIbu extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'ibu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_anak',
        'usia_ibu',
        'tinggi_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
    ];

    /**
     * Get the anak that owns the profile.
     */
    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak');
    }
}
