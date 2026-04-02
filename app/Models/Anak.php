<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anak extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'anak';

    protected $fillable = [
        'user_id',
        'nik',
        'nama_anak',
        'tgl_lahir',
        'jenis_kelamin',
        'id_ibu',
        'bb_lahir',
        'tb_lahir',
        'berat_badan',
        'tinggi_badan',
        'tgl_pemeriksaan'
    ];

    public function ibu()
    {
        return $this->belongsTo(ProfilIbu::class, 'id_ibu');
    }
}
