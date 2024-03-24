@extends('layoutadmin')

@section('konten')
<!--  Main wrapper -->
<div class="body-wrapper">

      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h5 class="card-title fw-semibold mb-4">Daftar Data Pegawai</h5>
                  <!-- Alert jika data berhasil ditambahkan -->

                  @if(session('success'))
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%; color:green;"></div>
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
                            <h6 class="m-0 font-weight-bold text-primary">Master Data pegawai</h6>
                            
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
                                            <th>jenis Kelamin</th>
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
                                            <td>{{ $p->kode_pegawai }}</td>
                                            <td>{{ $p->nama_pegawai }}</td>
                                            <td>{{ $p->alamat_pegawai }}</td>
                                            <td>{{ $p->jenis_kelamin }}</td>
                                            <td>{{ $p->no_hp }}</td>
                                            <td>
                                                <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#" class="btn btn-info btn-circle btn" onclick="editData({{ $p->id }}, '{{ $p->nama_pegawai }}', '{{ $p->alamat_pegawai }}', '{{ $p->jenis_kelamin }}', '{{ $p->no_hp }}')">
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
            nama = e.getAttribute('data-nama'); // Menambahkan atribut data-nama untuk mendapatkan nama pegawai

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
        <script>
            function editData(id, nama, alamat) {
                // Mengatur nilai input dalam modal dengan data pegawai yang ingin diubah
                document.getElementById('editId').value = id;
                document.getElementById('editNama').value = nama;
                document.getElementById('editAlamat').value = alamat;
        
                // Menampilkan modal
                $('#editModal').modal('show');
            }
        </script>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editForm" action="{{ route('pegawai.update', ['pegawai' => $p->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                         <!-- Input tersembunyi untuk menyimpan ID pegawai -->
                        {{-- <input type="hidden" name="id" value="{{ $pegawai->id }}"> --}}
                        <div class="modal-body">
                            <!-- Tambahkan input tersembunyi untuk menyimpan ID pegawai -->
                            <input type="hidden" name="id" id="editId">
                            <!-- Tambahkan input untuk data pegawai yang akan diubah -->
                            <div class="mb-3">
                                <label for="editNama" class="form-label">Nama:</label>
                                <input type="text" class="form-control" id="editNama" name="nama">
                            </div>
                            <!-- Tambahkan input untuk alamat -->
                            <div class="mb-3">
                                <label for="editAlamat" class="form-label">Alamat:</label>
                                <input type="text" class="form-control" id="editAlamat" name="alamat">
                            </div>
                            <!-- Tambahkan input untuk jenis kelamin -->
                            <div class="mb-3">
                                <label for="editJenisKelamin" class="form-label">Jenis Kelamin:</label>
                                <select class="form-select" id="editJenisKelamin" name="jenis_kelamin">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <!-- Tambahkan input untuk nomor HP -->
                            <div class="mb-3">
                                <label for="editNoHp" class="form-label">Nomor HP:</label>
                                <input type="text" class="form-control" id="editNoHp" name="no_hp">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


@endsection