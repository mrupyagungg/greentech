<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Carbon\Carbon;
use App\Http\Requests\StorePembelianRequest;
use App\Http\Requests\UpdatePembelianRequest;


class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembelian = Pembelian::all();
        return view('pembelian.index', compact('pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lastTransaction = Pembelian::latest()->first();
        $lastTransactionId = $lastTransaction ? $lastTransaction->no_transaksi : 0;
        $noTransaksi = $lastTransactionId + 1;
        
        $suppliers = Supplier::pluck('kode_supplier', 'id');
        return view('pembelian.create', compact('suppliers', 'noTransaksi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePembelianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $hargaBeli = $request->harga_beli;
    $stokTersedia = $request->stok_tersedia;
    $jumlah = $hargaBeli * $stokTersedia;

    Pembelian::create([
        'no_transaksi' => $request->no_transaksi,
        'kode_supplier' => $request->kode_supplier,
        'nama_barang' => $request->nama_barang,
        'harga_beli' => $hargaBeli,
        'stok_tersedia' => $stokTersedia,
        'jumlah' => $jumlah,
        'tgl_transaksi' => $request->tgl_transaksi,
        'tgl_expired' => $request->tgl_expired,
    ]);

    return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil ditambahkan.');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePembelianRequest  $request
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePembelianRequest $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }
}
