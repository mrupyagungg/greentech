<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'Pembelians';

    protected $fillable = [
        'no_transaksi',
        'kode_supplier',
        'nama_barang',
        'harga_beli',
        'stok_tersedia',
        'tgl_transaksi',
        'tgl_expired',
        'jumlah',
    ];
}
