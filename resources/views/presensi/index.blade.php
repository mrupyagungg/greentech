@extends('layoutadmin')

@section('konten')

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    window.onload = function() {
        updateProgressBar();
    };
</script>
<script>
    // Fungsi untuk mengubah lebar progress bar dari 0% hingga 100%
    function updateProgressBar() {
        var progressBar = document.querySelector('.progress-bar');
        var width = 0;
        var interval = setInterval(function() {
            if (width >= 100) {
                clearInterval(interval);
            } else {
                width++;
                progressBar.style.width = width + '%';
            }
        }, 20);
    }
</script>
<!--  Main wrapper -->
<div class="body-wrapper">

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="m-0 font-weight-bold text-primary">Form presensi</h4>
                    
                    <!-- Tombol Tambah Data -->
                    <a href="{{ url('/presensi/create') }}" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="ti ti-plus"></i>
                        </span>
                        <span class="text">Tambah Data</span>
                    </a>
                    <!-- Akhir Tombol Tambah Data -->
    
                </div>

                <div class="card-body">
                    <!-- Awal Dari Tabel -->
                      <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                  <thead class="thead-dark">
                                    <tr style="background-color: rgb(230, 230, 230)">
                                        <th>Kode Presensi</th>
                                        <th>Nama Pegawai</th>
                                        <th>Status</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tfoot class="thead-dark">
                                    <tr style="background-color: rgb(230, 230, 230)">
                                        <th>Kode Presensi</th>
                                        <th>Nama Pegawai</th>
                                        <th>Status</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                               </tfoot>
                              <tbody>
                                @foreach ($presensi as $pres)
                                <tr>
                                    <td>{{ $pres->kode_presensi }}</td>
                                    <td>{{ $pres->nama_pegawai }}</td> 
                                    <td>{{ $pres->check_in }}</td>
                                    <td>{{ $pres->updated_at }}</td>
                                    
                                    <td style="text-align: center">
                                        <!-- Tombol untuk menampilkan detail, edit, dan hapus -->
                                        <a class="btn btn-primary" href="{{ route('presensi.show',$pres->id) }}"><i class="fas fa-eye"></i></a>
                                        {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal{{ $pres->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button> --}}
                                        
                                        <button class="btn btn-danger" onclick="confirmDelete('{{ $pres->id }}', '{{ $pres->nama_pegawai }}')"> <i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                  </tbody>
                              </table>
                          </div>
                  <!-- Akhir Dari Tabel -->
                  </div>
            </div>
        </div>
    </div>
</div>
@foreach ($presensi as $pres)
    <!-- Modal -->
    <div class="modal fade" id="editModal{{ $pres->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $pres->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Konten modal di sini -->
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Presensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- Isi formulir edit di sini -->
        <form action="{{ route('presensi.update', $pres->id) }}" method="post">
            @csrf
            @method('PUT')
            <!-- Tambahkan input fields atau informasi yang ingin Anda edit -->
            <select class="form-control" id="nama_pegawai" name="nama_pegawai" required>
                <option value="">Pilih Pegawai...</option>
                @foreach ($pegawai as $p)
                    <option value="{{ $p->nama_pegawai }}">{{ $p->nama_pegawai }}</option>
                @endforeach
            </select><br>
            <!-- Tambahkan input fields atau informasi lainnya sesuai kebutuhan -->
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    <!-- Tambahan konten modal jika diperlukan -->
</div>

            </div>
        </div>
    </div>

    <!-- Tombol Edit -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal{{ $pres->id }}">
        <i class="fas fa-edit"></i>
    </button>
@endforeach

<script>
    function confirmDelete(id, nama) {
        var form = document.getElementById('deleteForm');
        form.action = '{{ url('presensi') }}' + '/' + id;
        $('#deleteModal').modal('show');
    }
</script>

@endsection
