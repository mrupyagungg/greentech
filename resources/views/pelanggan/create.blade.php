@extends('layoutadmin')

@section('konten')

    <!--  Main wrapper -->
    <div class="body-wrapper">
    
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data pelanggan</h5>

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
                <form action="{{ route('pelanggan.store') }}" method="post">
                    @csrf
                    <fieldset disabled>
                        <div class="mb-3"><label for="kodepelangganlabel">Kode pelanggan</label>
                        <input class="form-control form-control-solid" id="kode_pelanggan_tampil" name="kode_pelanggan_tampil" type="text" placeholder="PR-001" value="{{$kode_pelanggan}}" readonly></div>
                    </fieldset>
                    <input type="hidden" id="kode_pelanggan" name="kode_pelanggan" value="{{$kode_pelanggan}}">

                    <div class="mb-3"><label for="namapelangganlabel">Nama pelanggan</label>
                    <input class="form-control form-control-solid" id="nama_pelanggan" name="nama_pelanggan" type="text" placeholder="Mrupy Agung" value="{{old('nama_pelanggan')}}">
                    </div>

                    <div class="mb-0"><label for="alamatpelangganlabel">Alamat pelanggan</label>
                        <textarea class="form-control form-control-solid" id="alamat_pelanggan" name="alamat_pelanggan" rows="3" placeholder="Cth: Jl Pelajar Pejuan 45">{{old('alamat_pelanggan')}}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jeniskelaminlabel">Jenis Kelamin</label>
                        <select class="form-control form-control-solid" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    
                    
                    <div class="mb-3"><label for="nohplabel">Nomor HP</label>
                    <input class="form-control form-control-solid" id="no_hp" name="no_hp" type="number" placeholder="081234567890" value="{{old('no_hp')}}">
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
@endsection
