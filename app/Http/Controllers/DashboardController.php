<?php

// app/Http/Controllers/DashboardController.php

use App\Models\Transaction;

class DashboardController extends Controller
{
    public function getData()
    {
        // Ambil data yang diperlukan untuk dashboard, seperti total pembelian, uang masuk, dan sebagainya
        $totalPembelian = Transaction::where('type', 'pembelian')->sum('amount');
        $uangKeluar = Transaction::where('type', 'pengeluaran')->sum('amount');

        return response()->json([
            'totalPembelian' => $totalPembelian,
            'uangKeluar' => $uangKeluar,
        ]);
    }
}
