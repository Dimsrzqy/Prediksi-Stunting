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
        'user_id',
        'nama_ibu',
        'usia_ibu',
        'tinggi_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
    ];

    /**
     * Get the anak associated with this profile.
     */
    public function anak()
    {
        return $this->hasMany(Anak::class, 'id_ibu');
    }
}
