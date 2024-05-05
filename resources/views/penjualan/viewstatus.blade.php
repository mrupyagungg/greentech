@extends('layoutadmin')

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