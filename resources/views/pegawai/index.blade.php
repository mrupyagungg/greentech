@extends('layoutadmin')

@section('konten')
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
            <div class="card-body">
              <div class="row">
                  <h2 class="card-title fw-semibold mb-4 text-center">Daftar Data Pegawai</h2>
                <div class="col-md-12">
                  <!-- Alert jika data berhasil ditambahkan -->

                  @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%; color:rgba(255, 255, 255, 0.166);"></div>
                        </div>
                        <strong>{{ session('success') }}</strong>
                        <button type="button"  data-bs-dismiss="alert" ></button>
                    </div>
                    @endif
                <script>
                    // Munculkan alert
                    $(document).ready(function(){
                        // Cari elemen alert dengan kelas .alert-success
                        $('.alert-success').fadeIn().delay(3000).fadeOut(); // Atur waktu muncul dan hilangnya alert
                    });
                </script>
                  <div class="card">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary">Master Data pegawai</h4>
                            
                            <!-- Tombol Tambah Data -->
                            <a href="{{ url('/pegawai/create') }}" class="btn btn-primary btn-icon-split btn-sm">
                                <span class="icon text-white-50">
                                    <i class="ti ti-plus"></i>
                                </span>
                                <span class="text">Tambah Data</span>
                            </a>
                            <!-- Akghir Tombol Tambah Data -->

                        </div>

                    <div class="card-body">
                      <!-- Awal Dari Tabel -->
                    <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Kode Pegawai</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Jenis Kelamin</th>
                                            <th>NO Hp</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="thead-dark">
                                        <tr>
                                            <th>Kode Pegawai</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Jenis Kelamin</th>
                                            <th>NO Hp</th>
                                            <th>Aksi</th>
                                        </tr>
                                 </tfoot>
                                <tbody>
                                    @foreach ($pegawai as $p)
                                        <tr>
                                            {{-- <td>{{ $p->id }}</td> --}}
                                            <td style="background-color: #f1f1f1">{{ $p->kode_pegawai }}</td>
                                            <td>{{ $p->nama_pegawai }}</td>
                                            <td>{{ $p->alamat_pegawai }}</td>
                                            <td>{{ $p->jenis_kelamin }}</td>
                                            <td>{{ $p->no_hp }}</td>
                                            <td>
                                                <a href="{{ route('pegawai.edit', $p->id) }}" class="btn btn-info btn-circle btn">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <a href="#" onclick="deleteConfirm(this); return false;" data-id="{{ $p->id }}" data-nama="{{ $p->nama_pegawai }}" class="btn btn-danger btn-circle btn">
                                                    <i class="fas fa-trash"></i>
                                                </a>
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
          </div>
        </div>

        <script>
            function deleteConfirm(e) {
            var tomboldelete = document.getElementById('btn-delete');  
            id = e.getAttribute('data-id');
            nama = e.getAttribute('data-nama'); 

            var url3 = "{{url('pegawai/destroy/')}}";
            var url4 = url3.concat("/", id);
            tomboldelete.setAttribute("href", url4);

            var pesan = "Apakah Anda yakin ingin menghapus data <b>";
            var pesan2 = "</b> dengan ID <b>" + id + "</b>?"; 
            document.getElementById("xid").innerHTML = pesan.concat(nama, pesan2);

            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {keyboard: false});
            myModal.show();
        }
        </script>

        <!-- Logout Delete Confirmation-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body" id="xid"></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
                    
                </div>
                </div>
            </div>
        </div>   
@endsection