<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create', [
            'kode_supplier' => $this->getKodeSupplier()
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
        // Validate the incoming request
        $validatedData = $request->validate([
            'nama_supplier' => 'string|max:255',
            'kategori' => 'required',
            'alamat' => 'required',
            'no_telp' => '',
            'tgl_transaksi' => 'date',
            'ket' => 'required',
        ]);

        // Create a new Supplier instance
        $supplier = new Supplier();
        $supplier->kode_supplier = $request->kode_supplier;
        $supplier->nama_supplier = $request->nama_supplier;
        $supplier->kategori = $request->kategori;
        $supplier->alamat = $request->alamat;
        $supplier->no_telp = $request->no_telp;
        $supplier->tgl_transaksi = $request->tgl_transaksi;
        $supplier->ket = $request->ket;

        // Save the Supplier instance
        $supplier->save();

        // Redirect to the index page with success message
        return redirect()->route('supplier.index')->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('supplier.show', compact('supplier'));
    }

    // Implement the edit, update, and destroy methods as needed

    /**
     * Generate the next supplier code.
     *
     * @return string
     */
    private function getKodeSupplier()
{
    // Query kode supplier
    $maxKodeSupplier = Supplier::max('kode_supplier');

    // If there are no existing suppliers, start with SUP-001
    if (!$maxKodeSupplier) {
        return 'SUP001';
    }

    // Extract the numeric part of the code
    preg_match('/\d+$/', $maxKodeSupplier, $matches);
    $numericPart = (int)$matches[0];

    // Increment the numeric part and pad with leading zeros
    $nextNumericPart = $numericPart + 1;
    $nextKodeSupplier = 'SUP-' . str_pad($nextNumericPart, 3, '0', STR_PAD_LEFT);

    return $nextKodeSupplier;
}

}
