@extends('layoutadmin')

@section('konten')
@if(isset($status_hapus))
<script>
    Swal.fire({
        title: 'Berhasil!',
        text: 'Hapus Data Berhasil',
        icon: 'success',
        confirmButtonText: 'Ok'
    });
</script>
@endif

<style>
h5 {
    font-size: 25px;
    font-weight: bold;
    font-family: Arial, Helvetica, sans-serif;
    text-transform: uppercase;
    text-align: center !important;
}
</style>

<div class="body-wrapper">
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold">Penjualan </h5>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <a href="{{url('penjualan/status')}}" class="btn btn-dark btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="ti ti-clock"></i>
                            </span>
                            <span class="text"> Lihat Status Pemesanan</span>
                        </a>
                        <a href="{{url('penjualan/keranjang')}}" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="ti ti-shopping-cart"></i>
                            </span>
                            <span class="text">Lihat Keranjang</span>
                        </a>
                    </div>

                    @foreach ($barangs as $p)
                    <div class="col-lg-6">
                        <div class="card shadow mb-8">
                            <a href="#collapseCardExample{{$p->id}}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">{{ $p->nama_barang }}</h6>
                            </a>
                            <div class="collapse show" id="collapseCardExample{{$p->id}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a data-fancybox="gallery">
                                                <img src="{{ url('storage/' . $p->image)}}" class="card-img-top" width="150px" height="150px" id="x-2" alt="">
                                            </a>                                                
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-12" align="justify">
                                                    <p>{{ $p->deskripsi }}</p>
                                                </div>
                                                <div class="col-12" align="justify">
                                                    <i class="fas fa-box-open"></i>&nbsp;&nbsp;Stok : <b id="xstok-{{$p->id}}">{{ $p->stok_tersedia }}</b><br><br>
                                                    <i class="fas fa-window-restore"></i>&nbsp;&nbsp;Kategori : <b id="kategori_barang-{{$p->id}}">{{ $p->kategori }}</b><br><br>
                                                    <i class="fas fa-coins"></i>&nbsp;&nbsp;Rp {{$p->harga_jual}} <br><br>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-icon-split tampilmodaltambah" data-toggle="modal" data-target="#tambahKeranjangModal" data-id="{{ $p->id }}">
                                                        <span class="icon text-white-50">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </span>
                                                        <span class="text">Tambah Keranjang</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div> 
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $('.tampilmodaltambah').click(function () {
        var id = $(this).data('id');
        $('#barang_id').val(id);
    });
});
</script>
        <div class="modal fade" id="tambahKeranjangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah ke Keranjang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk input -->
                        <form action="#" class="formpenjualan" method="post">
                        @csrf
                        <input type="hidden" id="idbaranghidden" name="idbaranghidden" value="">
                        <input type="hidden" id="tipeproses" name="tipeproses" value="">
            
                        <div class="mb-3 row">
                            <label for="nomerlabel" class="col-sm-4 col-form-label">Nama Barang</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $p->nama_barang }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lantailabel" class="col-sm-4 col-form-label">Harga Barang</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="{{ $p->harga_jual }}" readonly> 
                            </div>
                        </div>
                            <div class="mb-3 row">
                                <label for="hargalabel" class="col-sm-4 col-form-label">Jumlah</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" min=1>
                                    <div class="invalid-feedback errorjumlah"></div>
                                </div>
                            </div>
                        </div>    
            
                        <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Tambahkan ke Keranjang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
@endsection