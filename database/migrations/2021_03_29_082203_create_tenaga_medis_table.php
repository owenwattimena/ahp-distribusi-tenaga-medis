<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenagaMedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenaga_medis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_puskesmas');
            $table->char('nik', 16)->unique();
            $table->string('nama');
            $table->string('nip', 30)->unique();
            $table->date('tanggal_lahir');
            $table->string('status');
            $table->char('jenis_kelamin', 1)->default('l');
            $table->unsignedBigInteger('jenis_tenaga');
            $table->string('nomor_str', 100);
            $table->date('tanggal_awal_str');
            $table->date('tanggal_akhir_str');
            $table->string('sip', 100);
            $table->date('tanggal_sip');
            $table->timestamps();

            $table->foreign('id_puskesmas')->references('id')->on('users');
            $table->foreign('jenis_tenaga')->references('id')->on('alternatif');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenaga_medis');
    }
}