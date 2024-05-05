<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
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
         // getViewBarang()
         $barang = Penjualan::getBarang();
         $id_customer = Auth::id(); //dapatkan id customer dari sesi user
         return view('penjualan.index',
                 [
                     'barang' => $barang,
                     'jml' => Penjualan::getJmlBarang($id_customer),
                     'jml_invoice' => Penjualan::getJmlInvoice($id_customer),
                 ]
         );
     }
 
     // dapatkan data barang berdasarkan id barang
     public function getDataBarang($id){
         $barang = Penjualan::getBarangId($id);
         if($barang)
         {
             return response()->json([
                 'status'=>200,
                 'barang'=> $barang,
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
 
     // dapatkan data barang berdasarkan id barang
     public function getDataBarangAll(){
         $barang = Penjualan::getBarang();
         if($barang)
         {
             return response()->json([
                 'status'=>200,
                 'barang'=> $barang,
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
 
     // dapatkan jumlah barang untuk keranjang
     public function getJumlahBarang(){
         $id_customer = Auth::id();
         $jml_barang = Penjualan::getJmlBarang($id_customer);
         if($jml_barang)
         {
             return response()->json([
                 'status'=>200,
                 'jumlah'=> $jml_barang,
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
 
     // dapatkan jumlah barang untuk keranjang
     public function getInvoice(){
         $id_customer = Auth::id();
         $jml_barang = Penjualan::getJmlInvoice($id_customer);
         if($jml_barang)
         {
             return response()->json([
                 'status'=>200,
                 'jmlinvoice'=> $jml_barang,
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
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         //
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \App\Http\Requests\StorePenjualanRequest  $request
      * @return \Illuminate\Http\Response
      */
     
public function store(StorePenjualanRequest $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'jumlah' => 'required|numeric|min:1', // Add numeric validation and minimum value of 1
    ]);

    // If validation fails
    if ($validator->fails()) {
        return response()->json([
            'status' => 400,
            'errors' => $validator->messages(),
        ]);
    }

    // If validation passes
    $id_customer = Auth::id();
    $jml_barang = $request->input('jumlah');
    $id_barang = $request->input('idbaranghidden');

    // Get the price of the product
    $harga_jual = Penjualan::getHargaJualById($id_barang);

    // Calculate total harga
    $total_harga = $harga_jual * $jml_barang;

    // Store the data in the database
    Penjualan::create([
        'id_customer' => $id_customer,
        'total_harga' => $total_harga,
        'id_barang' => $id_barang,
        'jml_barang' => $jml_barang,
        'harga_satuan' => $harga_jual,
    ]);

    return response()->json([
        'status' => 200,
        'message' => 'Sukses Input Data',
    ]);
}
 
     /**
      * Display the specified resource.
      *
      * @param  \App\Models\Penjualan  $penjualan
      * @return \Illuminate\Http\Response
      */
     public function show(Penjualan $penjualan)
     {
         //
     }
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Models\Penjualan  $penjualan
      * @return \Illuminate\Http\Response
      */
     public function edit(Penjualan $penjualan)
     {
         //
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \App\Http\Requests\UpdatePenjualanRequest  $request
      * @param  \App\Models\Penjualan  $penjualan
      * @return \Illuminate\Http\Response
      */
     public function update(UpdatePenjualanRequest $request, Penjualan $penjualan)
     {
         //
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Models\Penjualan  $penjualan
      * @return \Illuminate\Http\Response
      */
     public function destroy(Penjualan $penjualan)
     {
         //
     }
 
     // view keranjang
     public function keranjang(){
         $id_customer = Auth::id();
         $keranjang = Penjualan::viewKeranjang($id_customer);
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
         $id_status_pemesanan = Penjualan::getIdStatus($id_customer);
         $status_pemesanan = Penjualan::getStatusAll($id_customer);
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
         $keranjang = Penjualan::viewKeranjang($id_customer);
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
         Penjualan::checkout($id_customer); //proses cekout
         $barang = Penjualan::getBarang();
 
         return redirect('penjualan/status');
     }
 
     // invoice
     public function invoice(){
         $id_customer = Auth::id();
         $invoice = Penjualan::getListInvoice($id_customer);
         if($invoice)
         {
             return response()->json([
                 'status'=>200,
                 'invoice'=> $invoice,
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
 
     // delete penjualan detail
     public function destroypenjualandetail($id_penjualan_detail){
         // kembalikan stok ke semula
         Penjualan::kembalikanstok($id_penjualan_detail);
 
         //hapus dari database
         Penjualan::hapuspenjualandetail($id_penjualan_detail);
 
         $id_customer = Auth::id();
         $keranjang = Penjualan::viewKeranjang($id_customer);
 
         return view('penjualan/viewkeranjang',
             [
                 'keranjang' => $keranjang,
                 'status_hapus' => 'Sukses Hapus'
             ]
         );
     }
}