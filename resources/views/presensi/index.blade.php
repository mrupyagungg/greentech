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
                                        <a class="btn btn-success" href="{{ route('presensi.edit',$pres->id) }}"><i class="fas fa-edit"></i></a>
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

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <a href="{{ route('presensi.index') }}" class="btn btn-dark">Back</a>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete(id, nama) {
        var form = document.getElementById('deleteForm');
        form.action = '{{ url('presensi') }}' + '/' + id;
        $('#deleteModal').modal('show');
    }
</script>

@endsection
