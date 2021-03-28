<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRekapDistribusisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_rekap_distribusi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rekap_distribusi');
            $table->unsignedBigInteger('id_alternatif');
            $table->bigInteger('jumlah');
            $table->timestamps();

            $table->foreign('id_rekap_distribusi')->references('id')->on('rekap_distribusi');
            $table->foreign('id_alternatif')->references('id')->on('alternatif');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_rekap_distribusis');
    }
}