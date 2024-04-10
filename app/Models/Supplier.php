<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    
    protected $fillable =[
        'kode_supplier',
        'nama_supplier',
        'kategori',
        'alamat',
        'no_telp',
        'tgl_transaksi',
        'ket',
    ];

    public static function getKodeSupplier()
{
    // Get the latest supplier code
    $latestSupplier = static::orderBy('kode_supplier', 'desc')->first();

    // If there are no existing suppliers, start with SUP-001
    if (!$latestSupplier) {
        return 'SUP-001';
    }

    // Extract the numeric part of the code and increment by 1
    $numericPart = (int) substr($latestSupplier->kode_supplier, 3); // Skip 'SUP-'
    $nextNumericPart = $numericPart + 1;

    // Pad the numeric part with leading zeros and concatenate with 'SUP-'
    return 'SUP-' . str_pad($nextNumericPart, 3, '0', STR_PAD_LEFT);
}


}
