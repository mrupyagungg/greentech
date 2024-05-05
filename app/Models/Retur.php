<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;
    
    protected $table = 'returs'; // Nama tabel dalam database

    protected $fillable = [
        'nomor_faktur',
        'nama_barang',
        'nama_supplier',
        'tanggal_retur',
        'jumlah',
        'ket'
    ];

  // Definisikan relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'nama_barang', 'id');
    }

    // Definisikan relasi dengan model Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'nama_supplier', 'id');
    }

}
