<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('mongodb')->create('rekomendasi', function (Blueprint $collection) {
            $collection->index('id_nutrisi');
            $collection->index('kategori_risiko');
        });
    }

    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('rekomendasi');
    }
};