<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PelangganModel extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    
    // List kolom yang bisa diisi
    protected $fillable = ['kode_pelanggan', 'nama_pelanggan', 'alamat_pelanggan', 'jenis_kelamin', 'no_telp'];


    // Method untuk mendapatkan kode pelanggan secara otomatis
    public static function getKodepelanggan()
    {
        // Query kode pelanggan
        $sql = "SELECT IFNULL(MAX(kode_pelanggan), 'PL-000') as kode_pelanggan
                FROM pelanggan";
        $kodepelanggan = DB::select($sql);

        // Cacah hasilnya
        foreach ($kodepelanggan as $kdPrsh) {
            $kd = $kdPrsh->kode_pelanggan;
        }

        // Mengambil substring tiga digit akhir dari string PR-000
        $noAwal = substr($kd, -3);
        $noAkhir = $noAwal + 1; // Menambahkan 1, hasilnya adalah integer contoh 1

        // Menyambung dengan string PL-001
        $noAkhir = 'PL-' . str_pad($noAkhir, 3, "0", STR_PAD_LEFT);

        return $noAkhir;
}
}