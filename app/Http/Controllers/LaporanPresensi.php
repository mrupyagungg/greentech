<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Carbon\Carbon;

class LaporanPresensi extends Controller
{
    // Laporan presensi bulanan
    public function laporanbulanan(){
        return view('laporan.laporanbulanan');
    }

    // View data laporan presensi bulanan
    public function viewlaporanbulanan($periode){
        $presensi = Presensi::whereMonth('check_in', Carbon::parse($periode)->month)
                            ->whereYear('check_in', Carbon::parse($periode)->year)
                            ->get();
    
        if($presensi->count() > 0)
        {
            return response()->json([
                'status'=>200,
                'presensi'=> $presensi,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tidak ada data ditemukan.'
            ]);
        }
    }
}
