@extends('layoutadmin')

@section('konten')

    <!-- Main wrapper -->
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="{{asset('images/profile/FOTO400X400.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">MRUPY AGUNG</h5>
                            <p class="card-text">MASTERDATA : <span>PEGAWAI</span> </p>
                            <p class="card-text">TRANSAKSI : </p>
                            <p class="card-text">LAPORAN : </p>
                            <a href="#" class="btn btn-info"><i class="fab fa-instagram"></i></a>
                            <a href="https://github.com/mrupyagungg/greentech" target="_blank" class="btn btn-dark"><i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="{{asset('img/haikal2.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">HAIKAL FAKHRULLAH</h5>
                            <p class="card-text">MASTERDATA : <span>BARANG</span> </p>
                            <p class="card-text">TRANSAKSI : </p>
                            <p class="card-text">LAPORAN : </p>
                            <!-- Menggunakan ikon Instagram dari Font Awesome -->
                            <a href="https://www.instagram.com/m_haikalf/?igsh=anJid3hndGpzZDlq&utm_source=qr" target="_blank" class="btn btn-info"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="{{asset('img/cyla2.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">VASHYA CYLA</h5>
                            <p class="card-text">MASTERDATA : <span>COA</span> </p>
                            <p class="card-text">TRANSAKSI : </p>
                            <p class="card-text">LAPORAN : </p>
                            <a href="#" class="btn btn-info"><i class="fab fa-instagram"></i></a>
    
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="{{asset('img/rila2.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">SYAKIRA GAVRILLA</h5>
                            <p class="card-text">MASTERDATA : <span>PELANGGAN</span> </p>
                            <p class="card-text">TRANSAKSI : </p>
                            <p class="card-text">LAPORAN : </p>
                            <a href="https://www.instagram.com/syakiragavrilahh/" target="_blank" class="btn btn-info"><i class="fab fa-instagram"></i></a>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .card-title{
            color: rgb(2, 102, 24);
        }
        span{
            color: black;
        }
    </style>

@endsection
