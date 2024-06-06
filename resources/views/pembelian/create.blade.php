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
                            <div class="form-group">
                                <label for="no_transaksi">no_transaksi</label>
                                <input type="text" class="form-control" id="no_transaksi" name="no_transaksi" required>
                            </div>
                            <div class="form-group">
                                <label for="stok_tersedia">stok_tersedia</label>
                                <input type="text" class="form-control" id="stok_tersedia" name="stok_tersedia" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_beli">harga_beli</label>
                                <input type="text" class="form-control" id="harga_beli" name="harga_beli" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_transaksi">tgl_transaksi</label>
                                <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_expired">tgl_expired</label>
                                <input type="date" class="form-control" id="tgl_expired" name="tgl_expired" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                            </div>
                            <!-- tambahkan form untuk supplier jika diperlukan -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
