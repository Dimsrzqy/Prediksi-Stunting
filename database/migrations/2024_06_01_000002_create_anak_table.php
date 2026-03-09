<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('mongodb')->create('anak', function (Blueprint $collection) {
            // Index untuk mempercepat pencarian berdasarkan user_id (Parent)
            $collection->index('user_id');
            
            // Index Unique untuk NIK agar tidak ada data ganda
            $collection->unique('nik');
            
            $collection->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('anak');
    }
};