<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', ['barang' => $barang]);
    }

    public function create()
    {
        $id_barang = Barang::getIdbarang();
        return view('barang.create', compact('id_barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'deskripsi_barang' => 'required',
            'image_barang' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_masuk' => 'required|date',
        ]);

        // Upload image
        $imagePath = $request->file('image_barang')->store('public/images');

        // Get image filename
        $imageFilename = basename($imagePath);

        // Create new Barang instance
        $barang = new Barang();
        $barang->kode_barang = $this->getIdbarang(); // Menggunakan metode getIdbarang()
        $barang->nama_barang = $request->nama_barang;
        $barang->kategori_barang = $request->kategori_barang;
        $barang->deskripsi_barang = $request->deskripsi_barang;
        $barang->image_barang = $imageFilename; // Save image filename to database
        $barang->tanggal_masuk = $request->tanggal_masuk;
        $barang->save();

        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'deskripsi_barang' => 'required',
            'image_barang' => 'image|file|max:1024',
            'tanggal_masuk' => 'required|date',
        ]);

        // Ambil data barang berdasarkan ID
        $barang = Barang::findOrFail($id);

        // Update data barang dengan data baru dari form
        $barang->nama_barang = $request->nama_barang;
        $barang->kategori_barang = $request->kategori_barang;
        $barang->deskripsi_barang = $request->deskripsi_barang;
        $barang->tanggal_masuk = $request->tanggal_masuk;

        // Periksa apakah ada gambar yang diunggah
        if ($request->hasFile('image_barang')) {
            // Simpan gambar baru
            $imagePath = $request->file('image_barang')->store('public/images');

            // Hapus gambar lama (jika ada)
            Storage::delete($barang->image_barang);

            // Simpan nama gambar baru ke dalam database
            $barang->image_barang = $imagePath;
        }

        // Simpan perubahan data barang ke dalam database
        $barang->save();

        // Redirect kembali ke halaman barang dengan pesan sukses
        return redirect('/barang')->with('success', 'Data barang berhasil diperbarui.');
    }
 

    public static function getIdbarang()
    {
        $count = Barang::count();
        $id_barang = 'BR-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        return $id_barang;
    }

        public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store image in storage/app/public directory
        $imagePath = $request->file('image_barang')->store('public');

        // Get image filename
        $image_barang = basename($imagePath);

        // Save image filename to database
        YourModel::create(['image_barang' => $image_barang]);

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }

    public function destroy($id)
    {
        // Temukan data barang berdasarkan ID
        $barang = Barang::findOrFail($id);

        // Hapus gambar terkait dari storage
        Storage::delete($barang->image_barang);

        // Hapus data barang dari database
        $barang->delete();

        // Redirect kembali ke halaman barang dengan pesan sukses
        return redirect('/barang')->with('success', 'Data barang berhasil dihapus.');
    }

}
