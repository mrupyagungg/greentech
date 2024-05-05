<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetursTable extends Migration
{
    public function up()
    {
        Schema::create('returs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_faktur');
            $table->string('nama_barang');
            $table->string('nama_supplier');
            $table->date('tanggal_retur');
            $table->integer('jumlah');
            $table->text('ket')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('returs');
    }
}


