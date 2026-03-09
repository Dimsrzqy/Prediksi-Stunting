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
        'nik',
        'nama_anak',
        'tgl_lahir',
        'jenis_kelamin',
        'nama_ortu',
        'bb_lahir',
        'tb_lahir',
        'berat_badan',
        'tinggi_badan'
    ];
}