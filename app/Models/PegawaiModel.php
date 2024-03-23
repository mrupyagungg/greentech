<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PegawaiModel extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    
    // List kolom yang bisa diisi
    protected $fillable = ['kode_pegawai', 'nama_pegawai', 'alamat_pegawai', 'jenis_kelamin', 'no_hp'];


    // Method untuk mendapatkan kode pegawai secara otomatis
    public static function getKodepegawai()
    {
        // Query kode pegawai
        $sql = "SELECT IFNULL(MAX(kode_pegawai), 'PG-000') as kode_pegawai 
                FROM pegawai";
        $kodepegawai = DB::select($sql);

        // Cacah hasilnya
        foreach ($kodepegawai as $kdPrsh) {
            $kd = $kdPrsh->kode_pegawai;
        }

        // Mengambil substring tiga digit akhir dari string PR-000
        $noAwal = substr($kd, -3);
        $noAkhir = $noAwal + 1; // Menambahkan 1, hasilnya adalah integer contoh 1

        // Menyambung dengan string PG-001
        $noAkhir = 'PG-' . str_pad($noAkhir, 3, "0", STR_PAD_LEFT);

        return $noAkhir;
}
}