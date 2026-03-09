<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('mongodb')->create('makanan', function (Blueprint $collection) {
            // Index foreign key ke tabel nutrisi
            $collection->index('id_nutrisi');
            $collection->string('nama_makanan');
        });
    }

    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('makanan');
    }
};