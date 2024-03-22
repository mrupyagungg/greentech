<?php

namespace App\Http\Controllers;

use App\Models\PegawaiModel;
use Illuminate\Http\Request;


class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $pegawai = PegawaiModel::all(); // Gunakan nama model dengan benar

    return view('pegawai.index', [
        'pegawai' => $pegawai
    ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create', [
            'kode_pegawai' => PegawaiModel::getKodepegawai()
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
        // Validasi data yang diterima dari formulir jika diperlukan
        $request->validate([
            'nama_pegawai' => 'required|string',
            'alamat_pegawai' => 'required|string',
        ]);
        
        // Simpan data ke dalam database
        PegawaiModel::create([
            'kode_pegawai' => $request->kode_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'alamat_pegawai' => $request->alamat_pegawai,
        ]);
        
        // Arahkan pengguna ke halaman home
        return redirect('/pegawai')->with('success', 'Data pegawai berhasil disimpan!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PegawaiModel  $pegawaiModel
     * @return \Illuminate\Http\Response
     */
    public function show(PegawaiModel $pegawaiModel)
    {
        return view('pegawai.show', compact('pegawaiModel'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PegawaiModel  $pegawaiModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PegawaiModel $pegawaiModel)
    {
        return view('pegawai.edit', compact('pegawaiModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PegawaiModel  $pegawaiModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PegawaiModel $pegawaiModel)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'kode_pegawai' => 'required',
            'nama_pegawai' => 'required|max:255',
            'alamat_pegawai' => 'required',
        ]);
    
        $pegawaimodel->update($validated);
    
        return redirect()->route('pegawai.index')->with('success','Data Berhasil di Ubah');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PegawaiModel  $pegawaiModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PegawaiModel $pegawaiModel)
    {
         $pegawaiModel->delete();

    return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');

    }
}
