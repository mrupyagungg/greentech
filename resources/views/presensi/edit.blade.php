@extends('layoutadmin')

@section('konten')

    <!--  Main wrapper -->
    <div class="body-wrapper">
    
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Data Pegawai</h5>

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
                <form action="{{ route('pegawai.update', $id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <fieldset>
                        <div class="mb-3" hidden>
                            <label for="kodepegawailabel">Kode pegawai</label>
                            <input class="form-control form-control-solid" id="kode_pegawai" name="kode_pegawai" type="text" placeholder="Contoh: PG-001" value="{{ old('kode_pegawai', $pegawai->kode_pegawai) }}" required>
 
                            value="{{$pegawai}}" disabled>
                        </div>
                    </fieldset>

                    <div class="mb-3">
                        <label for="namapegawailabel">Nama pegawai</label>
                        <input class="form-control form-control-solid" id="nama_pegawai" name="nama_pegawai" type="text" placeholder="Contoh: Mrupy Agung" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}">
                    </div>

                    <div class="mb-0">
                        <label for="alamatpegawailabel">Alamat pegawai</label>
                        <textarea class="form-control form-control-solid" id="alamat_pegawai" name="alamat_pegawai" rows="3" placeholder="Cth: Jl Pelajar Pejuan 45">{{ old('alamat_pegawai', $pegawai->alamat_pegawai) }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jeniskelaminlabel">Jenis Kelamin</label>
                        <select class="form-control form-control-solid" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="Laki-laki" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                
                    <div class="mb-3">
                        <label for="nohplabel">Nomor HP</label>
                        <input class="form-control form-control-solid" id="no_hp" name="no_hp" type="text" placeholder="Contoh: 081234567890" value="{{ old('no_hp', $pegawai->no_hp) }}">
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
    </div>
		
@endsection
