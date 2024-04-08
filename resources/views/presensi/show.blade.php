@extends('layoutadmin')

@section('konten')

<div class="body-wrapper">

    <div class="container-fluid">
        <div class="card mx-auto" style="max-width: 550px;">
            <div class="div row-mb3">
                <div class="col md-12">
                    <div class="justify-content-between">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Detail Presensi</h5>
                
                            <div class="form-group">
                                <label for="kode_presensi">Kode Presensi:</label>
                                <input class="form-control" id="kode_presensi" name="kode_presensi" type="text" value="{{ $presensi->kode_presensi }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_pegawai">Nama Pegawai:</label>
                                <input class="form-control" id="nama_pegawai" name="nama_pegawai" type="text" value="{{ $presensi->nama_pegawai }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="check_in">Status:</label>
                                <input class="form-control" id="check_in" name="check_in" type="text" value="{{ $presensi->check_in }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_pegawai">Waktu Presensi:</label>
                                <input class="form-control" id="nama_pegawai" name="nama_pegawai" type="text" value="{{ $presensi->created_at }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_pegawai">Bukti Tidak Hadir:</label>
                                <a data-fancybox="gallery">
                                    <img src="{{ url('storage/' . $presensi->image)}}" class="card-img-top" width="600px" height="600px" id="x-2" alt="">
                                </a>
                            </div>
                            <a href="{{ route('presensi.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
