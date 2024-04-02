<?php

namespace App\Http\Controllers;
use App\Models\PelangganModel;
use Illuminate\Http\Request;


class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = PelangganModel::all();
        return view('pelanggan.index', compact('pelanggan'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggan.create', [
            'kode_pelanggan' => PelangganModel::getKodepelanggan()
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
        Pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PelangganModel  $pelangganModel
     * @return \Illuminate\Http\Response
     */
    public function show(PelangganModel $pelangganModel)
    {
        return view('Pelanggan.show', compact('pelangganModel'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PelangganModel  $pelangganModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggan = PelangganModel::findOrFail($id);
        return view('Pelanggan.edit', [
            'id' => $id,
            'Pelanggan' => $Pelanggan
        ]);
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PelangganModel  $pelangganModel
     * @return \Illuminate\Http\Response
     */
            public function update(Request $request, $id)
        {
            // Validasi data yang dikirimkan dari formulir
            $validated = $request->validate([
                'kode_pelanggan' => 'required',
                'nama_pelanggan' => 'required|string|max:255',
                'alamat_pelanggan' => 'required|string',
                'jenis_kelamin' => 'required|string',
                'no_telp' => 'required|string',
            ]);

            // Mengambil data pelanggan berdasarkan $id
            $pelanggan = PelangganModel::findOrFail($id);

            // Mengupdate data pelanggan dengan data yang telah divalidasi
            $pelanggan->update($validated);

            // Redirect ke halaman pelanggan dengan pesan sukses
            return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil di Ubah');
        }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PelangganModel  $pelangganModel
     * @return \Illuminate\Http\Response
     */

     public function destroy($id)
{
    // Cari entitas pelanggan berdasarkan ID
    $pelanggan = PelangganModel::findOrFail($id);

    // Hapus entitas dari database
    $pelanggan->delete();

    // Redirect ke halaman indeks dengan pesan sukses
    return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus.');
}
 
}
