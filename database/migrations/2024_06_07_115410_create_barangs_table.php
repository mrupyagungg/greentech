<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('kategori');
            $table->decimal('harga_beli', 10);
            $table->decimal('harga_jual', 10);
            $table->integer('stok_tersedia');
            $table->string('satuan');
            $table->string('supplier')->nullable();
            $table->date('tanggal_pembelian_terakhir');
            $table->text('deskripsi')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('barangs');
}
}
