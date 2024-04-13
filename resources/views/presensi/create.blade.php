@extends('layoutadmin')

@section('konten')

    <!-- Main wrapper -->
    <div class="body-wrapper">
    
        <div class="container-fluid">
            <div class="card  mx-auto" style="max-width: 600px;">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Data presensi</h5>

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
                    <form method="POST" action="{{ route('presensi.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="kode_presensi">Kode presensi</label>
                            <input class="form-control form-control-solid" id="kode_presensi" name="kode_presensi" type="text" value="{{ $kode_presensi }}" readonly>
                        </div>
                        <!-- Dalam form untuk memasukkan ID pegawai -->
                        <div class="form-group">
                            <label for="nama_pegawai">Pilih Pegawai</label>
                            <select class="form-control" id="nama_pegawai" name="nama_pegawai" required>
                                <option value="">Pilih Pegawai...</option>
                                @foreach ($pegawai as $p)
                                    <option value="{{ $p->nama_pegawai }}">{{ $p->nama_pegawai }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="check_in">Status Kehadiran:</label>
                            <select class="form-control" id="check_in" name="check_in" required>
                                <option value="">...</option>
                                <option value="hadir">Hadir</option>
                                <option value="alfa">Alfa</option>
                                <option value="sakit">Sakit</option>
                                <option value="izin">Izin</option>
                            </select>
                        </div>
                        
                        <div class="form-group" id="image-upload" style="display: none;">
                            <label for="image">Unggah Foto:  <span style="color: red">*</span></label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                        </div>
                        
                        <script>
                            // Mengubah tampilan input foto berdasarkan pilihan status kehadiran
                            document.getElementById('check_in').addEventListener('change', function() {
                                var selectedValue = this.value;
                                var imageUploadDiv = document.getElementById('image-upload');
                                if (selectedValue === 'sakit' || selectedValue === 'izin') {
                                    imageUploadDiv.style.display = 'block'; // Menampilkan input foto
                                } else {
                                    imageUploadDiv.style.display = 'none'; // Menyembunyikan input foto
                                    if (selectedValue === 'hadir' || selectedValue === 'alfa') {
                                        // Jika hadir atau alfa, hilangkan atribut required dari input file
                                        document.getElementById('image').removeAttribute('required');
                                    } else {
                                        // Jika bukan hadir atau alfa, tambahkan atribut required ke input file
                                        document.getElementById('image').setAttribute('required', 'required');
                                    }
                                }
                            });
                        </script>
                        
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('presensi.index') }}" class="btn btn-dark">Back</a>
                    </form>
                    <!-- Akhir Dari Input Form -->
                
                </div>
            </div>
        </div>
        
    </div>
    
@endsection
