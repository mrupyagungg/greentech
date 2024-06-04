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
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" class="form-control" id="harga" name="harga" required>
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
