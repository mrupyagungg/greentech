<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create', [
            'kode_barang' => Barang::generateKodeBarang(),
            'supplier' => Barang::generateSupplier()
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok_tersedia' => 'required|numeric',
            'satuan' => 'required',
            'tanggal_pembelian_terakhir' => 'required|date',
            'deskripsi' => 'nullable',
        ]);

        // Buat instance barang baru
        $barang = new Barang();
        $barang->nama_barang = $request->nama_barang;
        $barang->kategori = $request->kategori;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_jual = $request->harga_jual;
        $barang->stok_tersedia = $request->stok_tersedia;
        $barang->satuan = $request->satuan;
        $barang->supplier = $request->supplier; // Jika supplier tidak dimasukkan dalam formulir, Anda perlu menyesuaikan bagian ini
        $barang->tanggal_pembelian_terakhir = $request->tanggal_pembelian_terakhir;
        $barang->deskripsi = $request->deskripsi;

        // Simpan barang ke dalam database
        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok_tersedia' => 'required|numeric',
            'satuan' => 'required',
            'tanggal_pembelian_terakhir' => 'required|date',
            'deskripsi' => 'nullable',
        ]);

        // Mengambil data barang berdasarkan ID
        $barang = Barang::findOrFail($id);

        // Memperbarui data barang
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok_tersedia' => $request->stok_tersedia,
            'satuan' => $request->satuan,
            'supplier' => $request->supplier,
            'tanggal_pembelian_terakhir' => $request->tanggal_pembelian_terakhir,
            'deskripsi' => $request->deskripsi,
        ]);

        // Redirect ke halaman tertentu dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Mengambil data barang berdasarkan ID
        $barang = Barang::findOrFail($id);

        // Hapus data barang
        $barang->delete();

        // Redirect ke halaman tertentu dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 