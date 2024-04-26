@extends('layoutadmin')

@section('konten')
<style>
    button{
        background: none;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
    }
</style>
    <!-- Main wrapper -->
    <div class="body-wrapper">
        <div class="container-fluid">

            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       SALDO</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                        <button>
                                            <span id="visibleText" onclick="toggleVisibility('visibleText', 'hiddenText')">****** <i class="fa fa-eye-slash"></span></i>
                                            <!-- Teks yang tidak bisa dilihat -->
                                            <span id="hiddenText" style="display: none;" onclick="toggleVisibility('hiddenText', 'visibleText')">40,000 <i class="fa fa-eye"></span></i>
                                        </button>
                                        <style>
                                            /* Tombol tanpa batas */
                                            .no-border-button {
                                                background: none;
                                                border: none;
                                                padding: 0;
                                                font: inherit;
                                                cursor: pointer;
                                                outline: inherit;
                                            }
                                        </style>    
                                        </style>
                                        <script>
                                            function toggleVisibility(visibleId, hiddenId) {
                                                var visibleText = document.getElementById(visibleId);
                                                var hiddenText = document.getElementById(hiddenId);
                                        
                                                if (visibleText.style.display !== 'none') {
                                                    visibleText.style.display = 'none';
                                                    hiddenText.style.display = 'inline';
                                                } else {
                                                    visibleText.style.display = 'inline';
                                                    hiddenText.style.display = 'none';
                                                }
                                            }
                                        </script>
                                        
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calculator fa-2x text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Uang Masuk</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp 215,000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Uang Keluar</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp 215,000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-dark shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                        Jumlah Transaksi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp 215,000</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-wallet fa-2x text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">BUKU BESAR</h5>
                    <p class="mb-0">This is a sample page </p>
                </div>
            </div>
        </div>
    </div>

@endsection
