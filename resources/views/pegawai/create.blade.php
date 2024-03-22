@extends('layoutadmin')

@section('konten')

    <!--  Main wrapper -->
    <div class="body-wrapper">
    
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data Pegawai</h5>

                <!-- Display Error jika ada error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Akhir Display Error -->

                <!-- Awal Dari Input Form -->
                <form action="{{ route('pegawai.store') }}" method="post">
                    @csrf
                    <fieldset disabled>
                        <div class="mb-3"><label for="kodepegawailabel">Kode pegawai</label>
                        <input class="form-control form-control-solid" id="kode_pegawai_tampil" name="kode_pegawai_tampil" type="text" placeholder="Contoh: PR-001" value="{{$kode_pegawai}}" readonly></div>
                    </fieldset>
                    <input type="hidden" id="kode_pegawai" name="kode_pegawai" value="{{$kode_pegawai}}">

                    <div class="mb-3"><label for="namapegawailabel">Nama pegawai</label>
                    <input class="form-control form-control-solid" id="nama_pegawai" name="nama_pegawai" type="text" placeholder="Contoh: Toko Mukena Sejuk Menenangkan" value="{{old('nama_pegawai')}}">
                    </div>
                    
        
                    <div class="mb-0"><label for="alamatpegawailabel">Alamat pegawai</label>
                        <textarea class="form-control form-control-solid" id="alamat_pegawai" name="alamat_pegawai" rows="3" placeholder="Cth: Jl Pelajar Pejuan 45">{{old('alamat_pegawai')}}</textarea>
                    </div>
                    <br>
                    <!-- untuk tombol simpan -->
                    
                    <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/pegawai') }}" role="button">Batal</a>
                    
                </form>
                <!-- Akhir Dari Input Form -->
            
          </div>
        </div>
      </div>
		
		
		
@endsection