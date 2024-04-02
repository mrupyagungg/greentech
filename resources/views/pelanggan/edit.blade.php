@extends('layoutadmin')

@section('konten')

    <!--  Main wrapper -->
    <div class="body-wrapper">
    
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Data pelanggan</h5>

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
                <form action="{{ route('pelanggan.update', $id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <fieldset>
                        <div class="mb-3" hidden>
                            <label for="kodepelangganlabel">Kode pelanggan</label>
                            <input class="form-control form-control-solid" id="kode_pelanggan" name="kode_pelanggan" type="text" placeholder="Contoh: PG-001" value="{{ old('kode_pelanggan', $pelanggan->kode_pelanggan) }}" required>
 
                            value="{{$pelanggan}}" disabled>
                        </div>
                    </fieldset>

                    <div class="mb-3">
                        <label for="namapelangganlabel">Nama pelanggan</label>
                        <input class="form-control form-control-solid" id="nama_pelanggan" name="nama_pelanggan" type="text" placeholder="Contoh: Muhammad Raja" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}">
                    </div>

                    <div class="mb-0">
                        <label for="alamatpelangganlabel">Alamat pelanggan</label>
                        <textarea class="form-control form-control-solid" id="alamat_pelanggan" name="alamat_pelanggan" rows="3" placeholder="Cth: Jl Pelajar Pejuan 45">{{ old('alamat_pelanggan', $pelanggan->alamat_pelanggan) }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jeniskelaminlabel">Jenis Kelamin</label>
                        <select class="form-control form-control-solid" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="Laki-laki" {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                
                    <div class="mb-3">
                        <label for="notelplabel">Nomor Telp</label>
                        <input class="form-control form-control-solid" id="no_telp" name="no_telp" type="text" placeholder="Contoh: 081234567890" value="{{ old('no_telp', $pelanggan->no_telp) }}">
                    </div>
                    
                    <br>
                    <!-- untuk tombol simpan -->
                    <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/pelanggan') }}" role="button">Batal</a>
                </form>
                <!-- Akhir Dari Input Form -->
            
          </div>
        </div>
      </div>
    </div>
		
@endsection
