<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Import DB facade

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'harga_beli',
        'harga_jual',
        'stok_tersedia',
        'satuan',
        'tanggal_pembelian_terakhir',
        'deskripsi',
        'image',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($barang) {
            $barang->kode_barang = static::getKodeBarang();
            
            
        });
    }

    // Method untuk menghasilkan kode barang baru
    public static function getKodeBarang()
    {
        // Query kode barang
        $latestBarang = static::latest('kode_barang')->first();

        if (!$latestBarang) {
            return 'BRG-001';
        }

        // Extract nomor urut dari kode barang terakhir, tambahkan 1, dan format ulang
        $latestNumber = intval(substr($latestBarang->kode_barang, 4));
        $nextNumber = $latestNumber + 1;
        return 'BRG-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }
    public function getHargaBeliAttribute($value)
    {
        return number_format($value, 0, ',', '.');
    }

    // Accessor untuk format harga jual
    public function getHargaJualAttribute($value)
    {
        return number_format($value, 0, ',', '.');
    }
}
