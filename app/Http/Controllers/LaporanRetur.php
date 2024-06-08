<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Retur;
use Carbon\Carbon;

class LaporanRetur extends Controller
{
    // Menampilkan halaman laporan bulanan
    public function laporanretur()
    {
        return view('laporan.laporanretur');
    }

    // Mengambil data retur bulanan berdasarkan periode
    public function viewlaporanretur($periode)
    {
        $retur = Retur::whereMonth('tanggal_retur', Carbon::parse($periode)->month)
                            ->whereYear('tanggal_retur', Carbon::parse($periode)->year)
                            ->get();

        if($retur->count() > 0)
        {
            return response()->json([
                'status' => 200,
                'retur' => $retur,
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }
}
