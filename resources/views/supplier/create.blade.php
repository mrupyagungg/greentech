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
                <form action="{{ url('/supplier') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" required>
                        <div class="invalid-feedback">
                            Kode wajib diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                        <div class="invalid-feedback">
                            Nama wajib diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="kategori_barnag" value="Barang" checked>
                            <label class="form-check-label" for="kategori_barnag">
                                Barang
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="kategori" value="jasa">
                            <label class="form-check-label" for="kategori">
                                jasa
                            </label>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                        <div class="invalid-feedback">
                            Alamat wajib diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="number" class="form-control" id="contact" name="contact" required>
                        <div class="invalid-feedback">
                            Contact wajib diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="term_of_payment">Term of Payment</label>
                        <input type="text" class="form-control" id="term_of_payment" name="term_of_payment" required>
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
