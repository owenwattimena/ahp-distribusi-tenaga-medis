<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapDistribusisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_distribusi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_puskesmas');
            $table->integer('tahun');
            $table->timestamps();

            $table->foreign('id_puskesmas')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekap_distribusis');
    }
}