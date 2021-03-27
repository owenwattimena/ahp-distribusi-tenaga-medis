<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPuskesmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_puskesmas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_puskesmas');
            $table->unsignedBigInteger('id_subkriteria');
            $table->bigInteger('nilai');
            
            $table->timestamps();

            $table->foreign('id_puskesmas')->references('id')->on('users');
            $table->foreign('id_subkriteria')->references('id')->on('subkriteria');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_puskesmas');
    }
}