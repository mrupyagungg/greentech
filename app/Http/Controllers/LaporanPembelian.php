<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use Carbon\Carbon;

class LaporanPembelian extends Controller
{
    // Menampilkan halaman laporan bulanan
    public function laporanpembelian()
    {
        return view('laporan.laporanpembelian');
    }

    // Mengambil data pembelian bulanan berdasarkan periode
    public function viewlaporanpembelian($periode)
    {
        $pembelian = Pembelian::whereMonth('tgl_transaksi', Carbon::parse($periode)->month)
                             ->whereYear('tgl_transaksi', Carbon::parse($periode)->year)
                             ->get();

        if ($pembelian->count() > 0) {
            $totalJumlah = $pembelian->sum('jumlah');
            $totalHarga = $pembelian->sum('harga_beli');
            
            return response()->json([
                'status' => 200,
                'pembelian' => $pembelian,
                'totalJumlah' => $totalJumlah,
                'totalHarga' => $totalHarga,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }
}
