<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap">
<style>
    .hide-menu{
        font-family: 'Montserrat', sans-serif;
    }
</style>
   <body>
        <!--  Body Wrapper -->
        <div class="page-wrapper " id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar Start -->
        <aside class="left-sidebar" id="accordionSidebar" style="background-color: rgb(248, 235, 0)">
            <!-- Sidebar scroll-->
            <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="./index.html" class="text-nowrap logo-img">
                {{-- <img src="{{asset('img/logo1.png')}}" width="180" alt="" /> --}}
                </a>

                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
                </div>
            </div><hr>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <!-- Nama Pengguna dan Foto -->

                    <li class="sidebar-item">
                        <div class="user-profile text-center no-block dropdown m-t-20">
                            <div class="user-pic">
                                <img src="{{asset('images/profile/user-1.jpg')}}" alt="foto" width="90" height="90" class="img rounded-circle">
                            </div>
                            <div class="user-content hide-menu m-t-2">
                            <a href="#" class="" id="Userdd" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <br> <h5 class="m-b-0 user-name font-medium"  style="font-family: 'Open Sans', sans-serif;">{{ Auth::user()->name }}</h5>
                            </a>
                                <span class="op-5 user-email" style="font-family: 'Open Sans', sans-serif;">{{ Auth::user()->email }}</span>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="Userdd">
                                <a class="dropdown-item" href="team"></i> My Team</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="ti-power-off m-r-5 m-l-5"></i> Logout
                                    </a>
                                </form>
                            </div>
                            </div>
                        </div>
                    </li>    
                <hr style="border-color: black">
                
                <!-- End Nama Pengguna dan Foto -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('dashboard') }}" aria-expanded="false">
                    <span>
                        {{-- <i class="ti ti-dashboard"></i> --}}
                    </span>
                    <span class="hide-menu"><b>Dashboard</b></span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#masterdata" data-bs-toggle="collapse" aria-expanded="false">
                        <span>
                            {{-- <i class="ti ti-book"></i> --}}
                        </span>
                        <span class="hide-menu"><b>Masterdata</b></span>
                        <span class="sidebar-dropdown-icon fas fa-chevron-down"></span>
                    </a>
                    <ul class="sidebar-submenu collapse" id="masterdata">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('pegawai') }}">
                                <span>
                                    <i class="ti ti-user"></i> <!-- Icon untuk Pegawai -->
                                </span>
                                <span class="hide-menu">Pegawai</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('pelanggan') }}">
                                <span>
                                    <i class="ti ti-wallet"></i> <!-- Icon untuk Pelanggan -->
                                </span>
                                <span class="hide-menu">Pelanggan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('barang') }}">
                                <span>
                                    <i class="ti ti-package"></i> <!-- Icon untuk Barang -->
                                </span>
                                <span class="hide-menu">Barang</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('supplier') }}">
                                <span>
                                    <i class="ti ti-building"></i> <!-- Icon untuk Supplier -->
                                </span>
                                <span class="hide-menu">Supplier</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#transaksi" data-bs-toggle="collapse" aria-expanded="false">
                        <span>
                            {{-- <i class="ti ti-shopping-cart"></i> --}}
                        </span>
                        <span class="hide-menu"><b>Transaksi</b></span>
                        <span class="sidebar-dropdown-icon fas fa-chevron-down"></span>
                    </a>
                    <ul class="sidebar-submenu collapse" id="transaksi" style="padding-top: 10px;">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('presensi') }}">
                                <span>
                                    <i class="ti ti-pin"></i> <!-- Icon untuk Presensi -->
                                </span>
                                <span class="hide-menu">Presensi</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('penjualan') }}">
                                <span>
                                    <i class="ti ti-shopping-cart"></i> <!-- Icon untuk Penjualan -->
                                </span>
                                <span class="hide-menu">Penjualan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('pembelian') }}">
                                <span>
                                    <i class="ti ti-server"></i> <!-- Icon untuk Pembelian -->
                                </span>
                                <span class="hide-menu">Pembelian</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('retur') }}">
                                <span>
                                    <i class="ti ti-cards"></i> <!-- Icon untuk Retur Pembelian -->
                                </span>
                                <span class="hide-menu">Retur Pembelian</span>
                            </a>
                        </li>
                    </ul>
                    
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#laporan" data-bs-toggle="collapse" aria-expanded="false">
                        <span>
                            {{-- <i class="ti ti-file-text"></i> --}}
                        </span>
                        <span class="hide-menu"><b>Laporan</b></span>
                        <span class="sidebar-dropdown-icon fas fa-chevron-down"></span>
                    </a>
                    <ul class="sidebar-submenu collapse" id="laporan">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('laporanbulanan') }}">
                                <span>
                                    <i class="ti ti-file-text"></i>
                                </span>
                                <span class="hide-menu">Laporan Presensi</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('laporanpembelian') }}">
                                <span>
                                    <i class="ti ti-file-text"></i>
                                </span>
                                <span class="hide-menu">Laporan Pembelian</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <br>
                <br>
                <br>            
            </nav>
            <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->