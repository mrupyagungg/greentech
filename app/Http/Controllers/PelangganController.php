<?php

namespace App\Http\Controllers;

use App\Models\PelangganModel;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = PelangganModel::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create', [
            'kode_pelanggan' => PelangganModel::getKodepelanggan()
        ]);
    }

    public function store(Request $request)
    {
        PelangganModel::create($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
        PelangganModel::create([
            'kode_pelanggan' => $request->kode_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
        ]);
    }

    public function show($id)
    {
        $pelanggan = PelangganModel::findOrFail($id);
        return view('pelanggan.show', compact('pelanggan'));
    }

    public function edit($id)
    {
        $pelanggan = PelangganModel::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }   

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_pelanggan' => 'required',
            'nama_pelanggan' => 'required|string|max:255',
            'alamat_pelanggan' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'no_telp' => 'required|string',
        ]);

        $pelanggan = PelangganModel::findOrFail($id);
        $pelanggan->update($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil di Ubah');
    }
    public function destroy($id)
    {
        $pelanggan = PelangganModel::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus.');
    }
}
