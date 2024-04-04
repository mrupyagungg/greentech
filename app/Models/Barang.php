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
        'supplier',
        'tanggal_pembelian_terakhir',
        'deskripsi',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($barang) {
            $barang->kode_barang = static::getKodeBarang();
            $barang->supplier = static::getSupplier();
            
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

    // Method untuk menghasilkan kode supplier baru
    public static function getSupplier()
    {
        // Mengambil kode supplier terakhir dari database
        $lastBarang = Barang::latest()->first();

        // Jika ada data barang sebelumnya, maka kode supplier baru adalah kode supplier sebelumnya + 1
        if ($lastBarang) {
            $lastKode = $lastBarang->supplier;
            $noAwal = (int) substr($lastKode, -3);
            $noAkhir = $noAwal + 1;
        } else {
            // Jika tidak ada data barang sebelumnya, maka kode supplier baru dimulai dari SUP-001
            $noAkhir = 1;
        }

        // Format kode supplier dengan tiga digit angka di belakang
        return 'SUP-' . str_pad($noAkhir, 3, "0", STR_PAD_LEFT);
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
