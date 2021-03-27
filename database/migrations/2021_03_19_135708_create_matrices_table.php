<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrix', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kriteria');
            $table->unsignedBigInteger('baris');
            $table->unsignedBigInteger('kolom');
            $table->double('bobot');
            $table->timestamps();

            $table->foreign('id_kriteria')->references('id')->on('kriteria');
            $table->foreign('baris')->references('id')->on('subkriteria');
            $table->foreign('kolom')->references('id')->on('subkriteria');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matrices');
    }
}