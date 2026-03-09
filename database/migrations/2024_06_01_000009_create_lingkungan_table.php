<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('mongodb')->create('lingkungan', function (Blueprint $collection) {
            // Unique index karena 1 anak hanya punya 1 data lingkungan
            $collection->unique('id_anak');
            $collection->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('lingkungan');
    }
};