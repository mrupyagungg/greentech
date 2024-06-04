@extends('layoutbootstrap')

@section('konten')

<!-- Sweet Alert -->
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

<!--  Main wrapper -->
<div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            <a href="#" class="btn btn-primary">{{ Auth::user()->name }}</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{asset('images/profile/user-1.jpg')}}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="{{url('logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <!-- <div class="col-md-12"> -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h5 class="card-title fw-semibold">Penjualan</h5>
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
                    <!-- List Data Barang yang dijual -->
                    @foreach ($barang as $p)
                        <div class="col-lg-6">

                            <!-- Collapsable Card Example -->
                            <div class="card shadow mb-8">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample{{$p->id}}" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ $p->nama_barang }}</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample{{$p->id}}">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <a data-fancybox="gallery" href="{{url('barang/')}}/{{ $p->foto }}">
                                                    <img width="150px" height="150px" id="x-2" src="{{url('barang/')}}/{{ $p->foto }}" zn_id="79">
                                                </a>
                                            </div>
                                            <div class="col-4" align="justify">
                                                {{ $p->deskripsi }}
                                            </div>
                                            <div class="col-4" align="justify">
                                                <i class="ti ti-package"></i>&nbsp;&nbsp;Stok <b id="xstok-{{$p->id}}">{{ $p->stok }}</b><br><br>
                                                <i class="ti ti-credit-card"></i>&nbsp;&nbsp;Rp {{ number_format($p->harga) }} <br><br>
                                                <a href="#" class="btn btn-primary btn-icon-split tampilmodaltambah" data-toogle="modal" data-target="#ubahModal" data-id="{{ $p->id }}">
                                                        <span class="icon text-white-50">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </span>
                                                        <span class="text">Tambah</span>
                                                </a>
                        
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

<!-- Ubah dan Tambah Data Menggunakan Modal -->
<div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="labelmodalubah">Tambahkan ke dalam keranjang</h5>
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
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="lantailabel" class="col-sm-4 col-form-label">Harga Barang</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="harga" name="harga" readonly>
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
            <button type="submit" class="btn btn-success btnsimpan">Simpan</button>
            </div>
        </div>
    </div>
</div>   
<!-- Akhir Ubah dan Tambah Data Menggunakan Modal -->
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