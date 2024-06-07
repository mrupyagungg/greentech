<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_transaksi', 7);
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();

            // Assuming 'no_transaksi' is a foreign key referencing 'penjualan'
            $table->foreign('no_transaksi')->references('no_transaksi')->on('penjualan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan_detail');
    }
}
