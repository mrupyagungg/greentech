<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjualans;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;

// untuk validator
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth; //untuk mendapatkan auth

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Ambil data barang dari database
         $barangs = Barang::all();

         // Kirim data barang ke view penjualan
         return view('penjualan.index', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        // Proses penyimpanan data ke dalam keranjang
        // Tambahkan logika sesuai dengan kebutuhan aplikasi Anda

        // Setelah berhasil, kembalikan respons
        return response()->json(['sukses' => 'Barang berhasil ditambahkan ke keranjang.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json(['barang' => $barang]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function keranjang()
    {
        $keranjang = Penjualans::all();
        // Di sini Anda dapat menuliskan logika untuk menampilkan keranjang belanja
        // Misalnya, mengambil data dari tabel keranjang dan melewatkan ke tampilan
        
        // Kemudian, Anda akan mengembalikan tampilan keranjang
        return view('penjualan/keranjang', ['keranjang' => $keranjang]);

    }

    public function showKeranjang()
    {
        // Fetch all records from the Penjualan table
        $keranjang = Penjualans::all();
    
        // Pass $keranjang data to the view
        return view('penjualan/keranjang', compact('keranjang'));
    }
    
    public function tambahKeKeranjang(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'harga_jual' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Simpan data ke dalam keranjang (atau database)
        $keranjang = new Keranjang();
        $keranjang->nama_barang = $validatedData['nama_barang'];
        $keranjang->harga_jual = $validatedData['harga_jual'];
        $keranjang->jumlah = $validatedData['jumlah'];
        $keranjang->save();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect('penjualan.keranjang');
    }


}
