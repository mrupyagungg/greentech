@extends('layoutadmin')

@section('konten')

<!-- Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Data Barang</h5>

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

                <form action="{{ url('/barang/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset disabled>
                        <div class="mb-3">
                            <label for="kode_barang">Kode Barang</label>
                            <input class="form-control form-control-solid" id="kode_barang" name="kode_barang" type="text" value="{{$id_barang}}" readonly>
                        </div>
                    </fieldset>
                    <input type="hidden" id="id_barang" name="id_barang" value="{{$id_barang}}">

                    <div class="mb-3"><label for="namabaranglabel">Nama barang</label>
                        <input class="form-control form-control-solid" id="nama_barang" name="nama_barang" type="text" placeholder="" value="{{ old('nama_barang') }}">
                    </div>
                    <div class="form-group">
                        <label for="kategori_barang">Kategori Barang</label>
                        <select class="form-control" id="kategori_barang" name="kategori_barang">
                            <option value="Elektronik">Elektronik</option>
                            <option value="Pakaian">Pakaian</option>
                            <option value="Alat Tulis">Alat Tulis</option>
                            <!-- Tambahkan opsi untuk kategori barang lainnya jika diperlukan -->
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="deskripsi_barang">Deskripsi Barang</label>
                        <textarea class="form-control" id="deskripsi_barang" name="deskripsi_barang" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Barang</label>
                        <input class="form-control @error('image_barang') is-invalid @enderror" type="file" id="image" name="image_barang">
                        @error('image_barang')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="tanggal_masuk">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('/barang') }}" class="btn btn-secondary">Kembali</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
