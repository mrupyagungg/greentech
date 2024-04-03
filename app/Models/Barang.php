<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    public $incrementing = false; // Disable auto-incrementing for the primary key
    protected $keyType = 'string'; // Define the key type as string
    
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_barang',
        'deskripsi_barang',
        'image_barang',
        'tanggal_masuk',
    ];

    

    public static function getIdbarang()
    {
        // Query kode pegawai
        $sql = "SELECT IFNULL(MAX(id_barang), 'BR-000') as id_barang 
                FROM barang";
        $idbarang = DB::select($sql);

        // Cacah hasilnya
        foreach ($idbarang as $idbrng) {
            $br = $idbrng->id_barang;
        }

        // Mengambil substring tiga digit akhir dari string BR-000
        $noAwal = substr($br, -3);
        $noAkhir = $noAwal + 1; // Menambahkan 1, hasilnya adalah integer contoh 1

        // Menyambung dengan string PG-001
        $noAkhir = 'BR-' . str_pad($noAkhir, 3, "0", STR_PAD_LEFT);

        return $noAkhir;
}
}
