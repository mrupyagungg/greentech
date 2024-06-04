<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Retur;
use Illuminate\Support\Str; // Import class Str untuk menggunakan fungsi random()

class ReturController extends Controller
{
    public function index()
    {
        // Mengambil data retur dari database
        $returs = Retur::all();
        $barangs = Barang::all();
        $suppliers = Supplier::all();

        // Mengembalikan view dengan data retur
        return view('retur.index', compact('returs'));
    }

    public function create()
    {
        // Ambil nomor faktur terakhir dari database
        $lastRetur = Retur::latest()->first();
    
        // Tentukan nomor faktur berikutnya
        $nextNumber = $lastRetur ? intval(substr($lastRetur->nomor_faktur, 4)) + 1 : 1;
    
        // Format nomor faktur dengan str_pad
        $nomor_faktur = 'RET-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    
        // Ambil semua barang dan supplier
        $barangs = Barang::all();
        $suppliers = Supplier::all();
    
        // Kirim data ke view
        return view('retur.create', compact('nomor_faktur', 'barangs', 'suppliers'));
    }
    
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'nomor_faktur' => 'required',
            'nama_barang' => 'required',
            'nama_supplier' => 'required',
            'tanggal_retur' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'ket' => '',
        ]);
    
        try {
            // Menyimpan retur ke dalam database
            Retur::create([
                'nomor_faktur' => $request->nomor_faktur,
                'nama_barang' => $request->nama_barang,
                'nama_supplier' => $request->nama_supplier,
                'tanggal_retur' => $request->tanggal_retur,
                'jumlah' => $request->jumlah,
                'ket' => $request->ket,
            ]);
    
            // Redirect ke halaman yang sesuai dengan pesan sukses
            return redirect()->route('retur.index')->with('success', 'Data retur berhasil disimpan.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan ke halaman sebelumnya dengan pesan error
            return back()->withInput()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }    
    
    public function edit($id)
    {
        // Mengambil data retur berdasarkan ID
        $retur = Retur::findOrFail($id);

        // Mengambil semua data barang dan supplier
        $barangs = Barang::all();
        $suppliers = Supplier::all();

        // Mengembalikan view edit dengan data retur, barangs, dan suppliers
        return view('retur.edit', compact('retur', 'barangs', 'suppliers'));
    }

    public function destroy($id)
    {
        // Cari data retur berdasarkan ID
        $retur = Retur::findOrFail($id);
        
        // Hapus data retur
        $retur->delete();
        
        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('retur.index')->with('success', 'Data retur berhasil dihapus.');
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            // Aturan validasi di sini...
        ]);

        try {
            // Cari data retur berdasarkan ID
            $retur = Retur::findOrFail($id);

            // Update data retur dengan data baru
            $retur->update([
                'nomor_faktur' => $request->nomor_faktur,
                'nama_barang' => $request->nama_barang,
                'nama_supplier' => $request->nama_supplier,
                'tanggal_retur' => $request->tanggal_retur,
                'jumlah' => $request->jumlah,
                'ket' => $request->ket,
            ]);

            // Beri respons JSON untuk sukses
            return response()->json(['message' => 'Data retur berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            // Beri respons JSON untuk kesalahan
            return response()->json(['message' => 'Terjadi kesalahan. Silakan coba lagi.'], 500);
        }
    }
}