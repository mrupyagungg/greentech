<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->integer('no_transaksi');
            $table->integer('kode_supplier');
            $table->string('nama_barang');
            $table->decimal('harga_beli', 10);
            $table->integer('stok_tersedia');
            $table->date('tgl_transaksi');
            $table->date('tgl_expired');
            $table->integer('jumlah');
            $table->timestamps(); // untuk mencatat waktu pembelian
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelians');
    }
}
