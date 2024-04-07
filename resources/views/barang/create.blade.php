@extends('layoutadmin')

@section('konten')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="card-title fw-semibold mb-4">Tambah Data Barang</h5>
                        <form method="post" action="{{ route('barang.store') }}" enctype="multipart/form-data">
                            @csrf
                            <fieldset disabled>
                                <div class="mb-3"><label for="kodebaranglabel">Kode barang</label>
                                    <input class="form-control form-control-solid" id="kode_barang_tampil" name="kode_barang_tampil" type="text" value="{{$kode_barang}}" readonly>
                                </div>
                            </fieldset>
                            <input type="hidden" id="kode_barang" name="kode_barang" value="{{$kode_barang}}">
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="kategori_elektronik" value="Tech" checked>
                                    <label class="form-check-label" for="kategori_elektronik">
                                        Tech
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori" id="kategori_farm" value="Farm">
                                    <label class="form-check-label" for="kategori_farm">
                                        Farm
                                    </label>
                                </div>
                                <!-- Anda dapat menambahkan opsi lainnya sesuai kebutuhan -->
                            </div>
                            
                            <div class="form-group">
                                <label for="harga_beli">Harga Beli</label>
                                <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_jual">Harga Jual</label>
                                <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                            </div>
                            <div class="form-group">
                                <label for="stok_tersedia">Stok Tersedia</label>
                                <input type="number" class="form-control" id="stok_tersedia" name="stok_tersedia" required>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <select class="form-control" id="satuan" name="satuan" required>
                                    <option value="kg">Kilogram (kg)</option>
                                    <option value="pcs">Pieces (pcs)</option>
                                    <option value="unit">Unit (unit)</option>
                                    <!-- Anda dapat menambahkan opsi lainnya sesuai kebutuhan -->
                                </select>
                            </div>
                            <fieldset disabled>
                                <div class="mb-3"><label for="kodebaranglabel">Supplier</label>
                                    <input class="form-control form-control-solid" id="supplier" name="supplier" type="text" value="{{$supplier}}" readonly>
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <label for="tanggal_pembelian_terakhir">Tanggal Pembelian Terakhir</label>
                                <input type="date" class="form-control" id="tanggal_pembelian_terakhir" name="tanggal_pembelian_terakhir" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar</label>
                                <input type="file" accept="image/*" id="image" name="image" value="" class="form-control">
                            </div>                            
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    label{
        color: black
    }
</style>
@endsection
