<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Presensi;
use App\Models\PegawaiModel;
use App\Http\Requests\StorePresensiRequest;
use App\Http\Requests\UpdatePresensiRequest;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presensi = Presensi::all(); // Gunakan nama model dengan benar

        return view('presensi.index', [
            'presensi' => $presensi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     /**
     * Menampilkan halaman form untuk membuat presensi baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mendapatkan data pegawai untuk ditampilkan sebagai pilihan dalam dropdown
        $pegawai = PegawaiModel::all();
        
        // Membuat kode presensi dengan format PR-0001, PR-0002, dst.
        $jumlah_presensi = Presensi::count();
        $kode_presensi = 'PR-' . str_pad($jumlah_presensi + 1, 3, '0', STR_PAD_LEFT);

        // Menampilkan halaman form pembuatan presensi
        return view('presensi.create', compact('pegawai', 'kode_presensi'));
    }

    /**
     * Menyimpan data presensi baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request)
        {
            // Validasi request
            $request->validate([
                'kode_presensi' => 'required',
                'nama_pegawai' => 'required|string',
                'check_in' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Validate image
            ]);
        
            // Simpan data presensi ke dalam database
            $presensi = Presensi::create([
                'kode_presensi' => $request->kode_presensi,
                'nama_pegawai' => $request->nama_pegawai,
                'check_in' => $request->check_in,
            ]);
        
            // Simpan gambar ke dalam penyimpanan
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('article', 'public');
                $presensi->image = $imagePath;
                $presensi->save();
            }
        
            // Redirect user ke halaman presensi
            return redirect('/presensi')->with('success', 'Data presensi telah disimpan!');
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function show(Presensi $presensi)
    {
        return view('presensi.show', compact('presensi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Presensi $presensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePresensiRequest  $request
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePresensiRequest $request, Presensi $presensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presensi $presensi)
    {
         // Hapus entri presensi dari database
    $presensi->delete();

    // Redirect user ke halaman presensi dengan pesan sukses
    return redirect('/presensi')->with('success', 'Data presensi telah dihapus!');
    }
}
