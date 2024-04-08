<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualans extends Model
{
    use HasFactory;
    protected $table = 'penjualans';
    protected $fillable = ['no_transaksi', 'id_customer', 'tgl_transaksi', 'tgl_expired', 'total_harga','status'];
}
