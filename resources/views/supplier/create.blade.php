@extends('layoutadmin')

@section('konten')

<!-- Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Data Supplier</h5>

                <!-- Display Error jika ada error -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- Akhir Display Error -->

                <!-- Awal Dari Input Form -->
                <form action="{{ route('supplier.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <fieldset disabled>
                        <div class="mb-3"><label for="kodesupplierlabel">Kode supplier</label>
                        <input class="form-control form-control-solid" id="kode_supplier_tampil" name="kode_supplier_tampil" type="text" value="{{$kode_supplier}}" readonly></div>
                    </fieldset>
                    <input type="hidden" id="kode_supplier" name="kode_supplier" value="{{$kode_supplier}}">
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" required>
                        <div class="invalid-feedback">
                            Nama Supplier wajib diisi.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Kategori</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="kategori_barang" value="Barang" checked>
                            <label class="form-check-label" for="kategori_barang">
                                Barang
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="kategori_jasa" value="Jasa">
                            <label class="form-check-label" for="kategori_jasa">
                                Jasa
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                        <div class="invalid-feedback">
                            Alamat wajib diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Contact</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                        <div class="invalid-feedback">
                            No Telp wajib diisi.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="tgl_transaksi">Term of Payment</label>
                        <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
                        <div class="invalid-feedback">
                            Term of Payment wajib diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ket">Keterangan</label>
                        <textarea class="form-control" id="ket" name="ket"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('supplier.index') }}" class="btn btn-dark">Back</a>
                </form>
                <!-- Akhir Dari Input Form -->

            </div>
        </div>
    </div>
</div>
@endsection
