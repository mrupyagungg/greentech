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

    private function getKodeSupplier()
    {
        // Query kode supplier
        $maxKodeSupplier = Supplier::max('kode_supplier');
    
        // If there are no existing suppliers, start with SUP-001
        if (!$maxKodeSupplier) {
            return 'SUP001';
        }
    
        // Extract the numeric part of the code
        preg_match('/\d+$/', $maxKodeSupplier, $matches);
        $numericPart = (int)$matches[0];
    
        // Increment the numeric part and pad with leading zeros
        $nextNumericPart = $numericPart + 1;
        $nextKodeSupplier = 'SUP' . str_pad($nextNumericPart, 3, '0', STR_PAD_LEFT);
    
        return $nextKodeSupplier;
    }
    

}
