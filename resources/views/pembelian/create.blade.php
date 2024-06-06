@extends('layoutadmin')

@section('konten')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h5 class="card-title fw-semibold">Tambah Pembelian</h5>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <form action="{{ route('pembelian.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="kode_supplier">Kode Supplier:</label>
                                <select name="kode_supplier" id="kode_supplier" class="form-control">
                                    @foreach($suppliers as $id => $kode_supplier)
                                        <option value="{{ $kode_supplier }}">{{ $kode_supplier }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                            </div>
                            <!-- Nomor Transaksi (hidden input) -->
                            <input type="hidden" name="no_transaksi" value="{{ $noTransaksi }}">
                            
                            <div class="form-group">
                                <label for="stok_tersedia">Stok Tersedia</label>
                                <input type="number" class="form-control" id="stok_tersedia" name="stok_tersedia" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_beli">Harga Beli</label>
                                <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_transaksi">Tanggal Transaksi</label>
                                <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_expired">Tanggal Expired</label>
                                <input type="date" class="form-control" id="tgl_expired" name="tgl_expired" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
