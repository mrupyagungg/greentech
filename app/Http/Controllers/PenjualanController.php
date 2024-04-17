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
    public function store(StorePenjualanRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'jumlah' => 'required',
            ]
        );
        
        if($validator->fails()){
            // gagal
            return response()->json(
                [
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]
            );
        }else{
            // berhasil

            // cek apakah tipenya input atau update
            // input => tipeproses isinya adalah tambah
            // update => tipeproses isinya adalah ubah
            
            if($request->input('tipeproses')=='tambah'){

                $id_customer = Auth::id();
                $jml_barang = $request->input('jumlah');
                $id_barang = $request->input('id_barang');

                $brg = Penjualans::getBarangId($id_barang);
                foreach($brg as $b):
                    $harga_jual = $b->harga;
                endforeach;

                $total_harga = $harga_jual*$jml_barang;
                Penjualans::inputPenjualan($id_customer,$total_harga,$id_barang,$jml_barang,$harga_jual,$total_harga);

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Input Data'
                    ]
                );
            }
        }
    }

    public function tambahKeKeranjang(TambahKeKeranjangRequest $request)
    {
        // Jika validasi berhasil, kode selanjutnya akan dieksekusi
        // Jika validasi gagal, pengguna akan diarahkan kembali dengan pesan kesalahan
        
        // Logika untuk menambah barang ke dalam keranjang
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
    
     // view keranjang
     public function keranjang(){
        $id_customer = Auth::id();
        $keranjang = Penjualans::viewKeranjang($id_customer);
        return view('penjualan/viewkeranjang',
                [
                    'keranjang' => $keranjang
                ]
        );
    }

    // view status
    public function viewstatus(){
        $id_customer = Auth::id();
        // dapatkan id ke berapa dari status pemesanan
        $id_status_pemesanan = Penjualans::getIdStatus($id_customer);
        $status_pemesanan = Penjualans::getStatusAll($id_customer);
        return view('penjualan.viewstatus',
                [
                    'status_pemesanan' => $status_pemesanan,
                    'id_status_pemesanan'=> $id_status_pemesanan
                ]
        );
    } 

    // view keranjang
    public function keranjangjson(){
        $id_customer = Auth::id();
        $keranjang = Penjualans::viewKeranjang($id_customer);
        if($keranjang)
        {
            return response()->json([
                'status'=>200,
                'keranjang'=> $keranjang,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tidak ada data ditemukan.'
            ]);
        }
    }

    // view keranjang
    public function checkout(){
        $id_customer = Auth::id();
        Penjualans::checkout($id_customer); //proses cekout
        $barangs = Penjualans::getBarang();

        return redirect('penjualan/status');
    }


}
