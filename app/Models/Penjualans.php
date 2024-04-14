<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// jika ingin menggunakan query biasa
use Illuminate\Support\Facades\DB;

class Penjualans extends Model
{
    use HasFactory;
    protected $table = 'penjualans';
    protected $fillable = ['no_transaksi', 'id_customer', 'tgl_transaksi', 'tgl_expired', 'total_harga','status'];

    // Definisikan relasi dengan model Keranjang
    public function keranjang()
    {
        return $this->hasMany('App\Models\Keranjang', 'no_transaksi', 'no_transaksi');
    }

    public static function viewKeranjang($id_customer){
        $sql = "SELECT  a.no_transaksi,
                        c.nama_barang,
                        c.foto,
                        c.harga,
                        b.tgl_transaksi,
                        b.tgl_expired,
                        b.jml_barang,
                        b.total,
                        a.status,
                        b.id as id_penjualan_detail
                FROM penjualan a
                JOIN penjualan_detail b
                ON (a.no_transaksi=b.no_transaksi)
                JOIN barangs c 
                ON (b.id_barang = c.id)
                WHERE a.id_customer = ? AND a.status 
                not in ('selesai','expired','siap_bayar','konfirmasi_bayar')";
        $barang = DB::select($sql,[$id_customer]);
        return $barang;
    }
}
