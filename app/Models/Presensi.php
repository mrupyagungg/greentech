<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';

    // List of fillable columns
    protected $fillable = ['kode_presensi', 'nama_pegawai', 'check_in','image'];

    /**
     * Get the latest presensi code and generate the next one.
     *
     * @return string
     */
    public static function getKodePresensi()
    {
        // Get the latest presensi code
        $latestPresensi = static::orderBy('kode_presensi', 'desc')->first();

        // If there are no existing presensi, start with PR-001
        if (!$latestPresensi) {
            return 'PR-001';
        }

        // Extract the numeric part of the code and increment by 1
        $numericPart = (int) substr($latestPresensi->kode_presensi, 3);
        $nextNumericPart = $numericPart + 1;

        // Pad the numeric part with leading zeros and concatenate with 'PR-'
        return 'PR-' . str_pad($nextNumericPart, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Define the relationship between Presensi and Pegawai.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nama_pegawai', 'id');
    }
}
