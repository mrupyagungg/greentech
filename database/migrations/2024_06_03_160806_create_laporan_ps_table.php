<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_transaksi');
            $table->integer('id_perusahaan');
            $table->string('kode_akun');
            $table->dateTime('tgl_jurnal');
            $table->string('posisi_d_c');
            $table->integer('nominal');
            $table->string('kelompok');
            $table->string('transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnal');
    }
}