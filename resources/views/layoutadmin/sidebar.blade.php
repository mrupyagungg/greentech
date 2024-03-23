    <body>
        <!--  Body Wrapper -->
        <div class="page-wrapper " id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar Start -->
        <aside class="left-sidebar bg-gradient-white" id="accordionSidebar">
            <!-- Sidebar scroll-->
            <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{asset('img/logo1.png')}}" width="180" alt="" />
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
                </div>
            </div><hr>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
               
                <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('dashboard') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Masterdata</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('coa') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-table"></i>
                    </span>
                    <span class="hide-menu">Coa</span>
                    </a>
                 </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('pegawai') }}" aria-expanded="false">
                     <span>
                        <i class="ti ti-user"></i>
                     </span>
                        <span class="hide-menu">Pegawai</span>
                     </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('coa') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-wallet"></i>
                        </span>
                        <span class="hide-menu">Metode Pembayaran</span>
                    </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('perusahaan') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-cards"></i>
                    </span>
                    <span class="hide-menu">Barang</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Transaksi</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('coa') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-arrow-right"></i>
                        </span>
                        <span class="hide-menu">Pemasukan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('perusahaan') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-arrow-left"></i>
                    </span>
                    <span class="hide-menu">Pengeluaran</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">laporan </span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-mood-happy"></i>
                    </span>
                    <span class="hide-menu">Icons</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-aperture"></i>
                    </span>
                    <span class="hide-menu">Sample Page</span>
                    </a>
                </li>
    
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">GRAFIK</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-mood-happy"></i>
                    </span>
                    <span class="hide-menu">Icons</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-aperture"></i>
                    </span>
                    <span class="hide-menu">Sample Page</span>
                    </a>
                </li>
    
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">ANALISIS DATA</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-mood-happy"></i>
                    </span>
                    <span class="hide-menu">Icons</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                    <span>
                        <i class="ti ti-aperture"></i>
                    </span>
                    <span class="hide-menu">Sample Page</span>
                    </a>
                </li>
    
                </ul>
            
            </nav>
            <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->