<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class ArtikelInspirasi extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'artikel_inspirasis';

    protected $fillable = [
        'judul',
        'deskripsi_singkat',
        'konten_lengkap',
        'kategori',
        'url_gambar',
        'url_sumber',
        'tanggal_publikasi',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
    ];
}
