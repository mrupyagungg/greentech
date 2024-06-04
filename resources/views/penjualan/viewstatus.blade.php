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

                
                <!-- Awal Status -->
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                        <div class="card-body p-12">
                            <div class="mb-12">
                            <h5 class="card-title fw-semibold">Status Transaksi</h5>
                            </div><br><br>
                            <ul class="timeline-widget mb-0 position-relative mb-n5">

                            <!-- dapatkan id -->

                            @foreach ($status_pemesanan as $p)

                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                
                                    @if(($p->id<=$id_status_pemesanan) and ($id_status_pemesanan!=0))
                                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                        <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                        </div>
                                        @if(!isset($p->tgl_transaksi))
                                            <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">{{$p->deskripsi}}</div>
                                        @else  
                                            <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">{{$p->deskripsi.' ('.$p->tgl_transaksi.')'}}</div>
                                        @endif
                                        
                                    @else
                                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                        <span class="timeline-badge border-2 border flex-shrink-0 my-8"></span>
                                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                        </div>
                                        <div class="timeline-desc fs-3 text-dark mt-n1">{{$p->deskripsi}}</div>
                                    @endif
                                    
                                
                                
                            </li>

                            @endforeach
                            </ul>
                        </div>
                        </div>
                    </div>
                <!-- Akhir Status -->

              </div>
            </div>
          </div>
        </div>


@endsection