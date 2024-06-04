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
                  <h5 class="card-title fw-semibold mb-4">Penjualan</h5>
                    <a href="{{url('penjualan/checkout')}}" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="ti ti-check"></i>
                            </span>
                            <span class="text">Checkout</span>
                    </a>
                </div>

                <!-- Awal Dari Tabel -->
                <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Barang</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Barang</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach ($keranjang as $p)
                                        <tr>
                                            <td>{{ $p->no_transaksi }}</td>
                                            <td>
                                                <img width="150px" height="150px" id="x-2" src="{{url('barang/')}}/{{ $p->foto }}" zn_id="79">
                                                <br>{{ $p->nama_barang }}
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>Harga   : Rp {{number_format($p->harga)}}</li>
                                                    <li>Jumlah  : {{$p->jml_barang}}</li>
                                                    <li>Total   : <b>Rp {{number_format($p->total)}}</b></li>
                                                </ul>  
                                            </td>
                                            <td>
                                                    <a onclick="deleteConfirm(this); return false;" href="#" data-id="{{ $p->id_penjualan_detail }}" class="btn btn-danger btn-circle">
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    <!-- Akhir Dari Tabel -->
                
                
              </div>
            </div>
          </div>
        </div>

<!-- Modal Delete -->
<script>
        function deleteConfirm(e){
            var tomboldelete = document.getElementById('btn-delete')  
            id = e.getAttribute('data-id');

            // const str = 'Hello' + id + 'World';
            var url3 = "{{url('penjualan/destroypenjualandetail/')}}";
            var url4 = url3.concat("/",id);
            // console.log(url4);

            // console.log(id);
            // var url = "{{url('perusahaan/destroy/"+id+"')}}";
            
            // url = JSON.parse(rul.replace(/"/g,'"'));
            tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

            var pesan = "Data dengan ID <b>"
            var pesan2 = " </b>akan dihapus"
            var res = id;
            document.getElementById("xid").innerHTML = pesan.concat(res,pesan2);

            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {  keyboard: false });
            
            myModal.show();
        
        }
    </script>
    <!-- Logout Delete Confirmation-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                
            </div>
            <div class="modal-body" id="xid"></div>
            <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>

            </div>
            </div>
        </div>
    </div>   
<!-- Akhir Modal Delete -->

@endsection