<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjualans;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\Keranjang;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Http\Requests\TambahKeKeranjangRequest;


// untuk validator
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; //untuk mendapatkan auth

class PenjualanController extends Controller
{
    public function index()
    {
         // Ambil data barang dari database
         $barangs = Barang::all();
         $id_customer = Auth::id();    
         // Kirim data barang ke view penjualan
         return view('penjualan.index', [
            'barang' => $barangs,
            'jml' => Penjualans::getJmlBarang($id_customer),
            'jml_invoice' => Penjualans::getJmlInvoice($id_customer),
         ]);
    }

    public function getDataBarang($id)
    {
        $barangs = Penjualans::getBarangId($id);
        if ($barangs) {
            return response()->json([
                'status' => 200,
                'barang' => $barangs,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }

    public function getDataBarangAll()
    {
        $barangs = Penjualans::getBarang();
        if ($barangs) {
            return response()->json([
                'status' => 200,
                'barang' => $barangs,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }

    public function getJumlahBarang()
    {
        $id_customer = Auth::id();
        $jml_barang = Penjualans::getJmlBarang($id_customer);
        if ($jml_barang) {
            return response()->json([
                'status' => 200,
                'jumlah' => $jml_barang,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }

    public function getInvoice()
    {
        $id_customer = Auth::id();
        $jml_barang = Penjualans::getJmlInvoice($id_customer);
        if ($jml_barang) {
            return response()->json([
                'status' => 200,
                'jmlinvoice' => $jml_barang,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }

    public function store(StorePenjualanRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'jumlah' => ''
            ]
        );

        if ($validator->fails()) {
            // gagal
            return response()->json(
                [
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]
            );
        } else {
            // berhasil

            // cek apakah tipenya input atau update
            // input => tipeproses isinya adalah tambah
            // update => tipeproses isinya adalah ubah

            if ($request->input('tipeproses') == 'tambah') {

                $id_customer = Auth::id();
                $jml_barang = $request->input('jumlah');
                $id_barang = $request->input('id_barang');

                $brg = Penjualans::getBarangId($id_barang);
                foreach ($brg as $b) {
                    $harga_jual = $b->harga;
                }

                $total_harga = $harga_jual * $jml_barang;
                Penjualans::inputPenjualan($id_customer, $total_harga, $id_barang, $jml_barang, $harga_jual, $total_harga);

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Input Data'
                    ]
                );
            }
        }
    }

    public function tambahKeKeranjang(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'jumlah' => 'required|integer|min:1',
            'id_barang' => 'required|exists:barang,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }

        // Proses penambahan ke keranjang disini
        // Misalnya, menyimpan data ke database atau melakukan operasi lainnya

        return response()->json(['status' => 200, 'sukses' => 'Barang berhasil ditambahkan ke keranjang.']);
    }

    public function show($id)
    {
        $barangs = Barang::findOrFail($id);
        return response()->json(['barang' => $barangs]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function keranjang()
    {
        $id_customer = Auth::id();
        $keranjang = Penjualans::viewKeranjang($id_customer);
        return view('penjualan.viewkeranjang', [
            'keranjang' => $keranjang
        ]);
    }

    public function viewstatus()
    {
        $id_customer = Auth::id();
        // dapatkan id ke berapa dari status pemesanan
        $id_status_pemesanan = Penjualans::getIdStatus($id_customer);
        $status_pemesanan = Penjualans::getStatusAll($id_customer);
        return view('penjualan.viewstatus', [
            'status_pemesanan' => $status_pemesanan,
            'id_status_pemesanan' => $id_status_pemesanan
        ]);
    }

    public function keranjangjson()
    {
        $id_customer = Auth::id();
        $keranjang = Penjualans::viewKeranjang($id_customer);
        if ($keranjang) {
            return response()->json([
                'status' => 200,
                'keranjang' => $keranjang,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada data ditemukan.'
            ]);
        }
    }
}