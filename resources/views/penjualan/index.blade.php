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
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold">Penjualan </h5>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <a href="{{url('/penjualan/viewstatus')}}" class="btn btn-dark btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="ti ti-clock"></i>
                            </span>
                            <span class="text"> Lihat Status Pemesanan</span>
                        </a>
                        <a href="{{ url('keranjang') }}" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="ti ti-shopping-cart"></i>
                            </span>
                            <span class="text">Lihat Keranjang</span>
                        </a>
                    </div>

                    @foreach ($barang as $p)
                    <div class="col-lg-6">
                        <div class="card shadow mb-8">
                            <a href="#collapseCardExample{{$p->id}}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample{{$p->id}}">
                                <h6 class="m-0 font-weight-bold text-primary">{{ $p->nama_barang }}</h6>
                            </a>
                            <div class="collapse show" id="collapseCardExample{{$p->id}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a data-fancybox="gallery">
                                                <img src="{{ url('storage/' . $p->image)}}" class="card-img-top" width="150px" height="150px" id="x-{{$p->id}}" alt="">
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
                                                    <button type="button" class="btn btn-primary btn-icon-split tampilmodaltambah" data-toggle="modal" data-target="#tambahKeranjangModal{{ $p->id }}" data-id="{{ $p->id }}">
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
                    </div> 
                    <div class="modal fade" id="tambahKeranjangModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <form action="{{ 'penjualan.keranjang' }}" class="formpenjualan" method="POST">
                                            @csrf
                                            <input type="hidden" id="idbaranghidden" name="idbaranghidden" value="">
                                            <input type="hidden" id="tipeproses" name="tipeproses" value="">
                                            <input type="hidden" id="id_barang" name="id_barang" value="{{ $p->id_barang}}">
                                
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
                                                <a href="">
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                                </a>
                                                <button type="submit" class="btn btn-primary">Submit</button>                            
                                            </div>
                                        </div>
                                    </div>
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

        <script>

            function number_format (number, decimals, decPoint, thousandsSep) { 
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number) ? 0 : +number
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
            var s = ''
    
            var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
            }
    
            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
            if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
            }
    
            return s.join(dec)
            }
    
          $(function(){
                $('.tampilmodaltambah').on('click', function(){
                  // merubah label menjadi Tambah Data Kamar
                  $('#labelmodalubah').html('Tambah Data Belanja');
    
                  var id = $(this).data('id');
                  var url1 = "{{url('/penjualan/barang')}}";
                  var url2 = url1.concat("/",id); //menggabungkan url dengan data nama file
    
                  url = "{{url('penjualan')}}";
                  $('.formpenjualan').attr('action',url);
    
                  $('#tipeproses').val('tambah'); //untuk identifikasi di controller apakah tambah atau update
    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
    
                  $('#ubahModal').modal('show');
                  
                  $.ajax(
                    {
                      
                        type: "get", //isinya put untuk update dan post untuk insert
                        url: url2,
                        // data: data,
                        dataType: "json",
                        success: function (response) {
                            // console.log(response);
                            $('#nama_barang').val(response.barang[0].nama_barang);
                            $('#harga').val(number_format(response.barang[0].harga));
                            $('#jumlah').attr(
                                {
                                    'min':1,
                                    'max':response.barang[0].stok
                                }
                            );
                            $('#idbaranghidden').val(response.barang[0].id);
                        }
    
                    }
                  ); 
    
                });
              }); 
    </script>
        
<!-- Ketika tombol submit di form ditekan -->
<script>

    // definisikan tipe method yang berbeda 
    // untuk update=>put (pembedanga adalah inner html pada labelmodalubah berisi Ubah Data Coa)
    // sedangkan untuk input=>post nilai inner html pada labelmodalubah berisi Tambah Data Coa
    $(document).ready(function()
        {   		
            $('.formpenjualan').submit(function(e)
                {
                    e.preventDefault();
                    const fd = new FormData(this);
                    // var id = $(this).data('id');
                    // console.log(id);
                        $.ajax(
                            {
                                type: "post", //isinya post untuk insert dan put untuk delete
                                url: $(this).attr('action'),
                                //data: $(this).serialize(),
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: "json",
                                success: function (response){
                                    // console.log(response);
                                    // jika responsenya adalah error
                                    if (response.status == 400) {
                                        if(response.errors.jumlah){
                                            $('#jumlah').removeClass('is-valid').addClass('is-invalid');
                                            $('.errorjumlah').html(response.errors.jumlah);
                                        }else{
                                            $('#jumlah').removeClass('is-invalid').addClass('is-valid');
                                            $('.errorjumlah').html();
                                        }

                                    }
                                    else{
                                        // munculkan pesan sukses
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: response.sukses,
                                            icon: 'success',
                                            confirmButtonText: 'Ok'
                                        });
                                        
                                        // kosongkan form
                                        $('#ubahModal').modal('hide');
                                        // ubah tampilan stok
                                        // get htmlnya
                                        // dapatkan idnya dari
                                        var id = $('#idbaranghidden').val();
                                        refreshstok();
                                        
                                    }
                                },
                                error: function(xhr, ajaxOptions, thrownError){
                                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                                } 
                            } 
                        );
                        return false;
                }
            );
        }
    );
</script>
<!-- Akhir ketika tombol submit di form ditekan -->

<!-- Proses merefresh isian stok dan list -->
<script>
    function refreshstok(){
        $.ajax(
            {
                type: "GET",
                url: "{{url('penjualan/barang')}}",
                dataType: "json",
                success: function (response) {
                    $.each(response.barang, function (key, item) {
                        // update elemen stok html
                        var idelemenstok = "#xstok-"+item.id;
                        $(idelemenstok).html(item.stok);
                    });
                }
            }
        )
    }
    
</script>
<!-- Akhir mengisi data pada tabel -->
@endsection