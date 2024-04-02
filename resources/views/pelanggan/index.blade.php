@extends('layoutadmin')

@section('konten')
<!--  Main wrapper -->
<div class="body-wrapper">
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row">
                  <h3 class="card-title fw-semibold mb-4 text-center">Daftar Data pelanggan</h3>
                <div class="col-md-12">
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
                            <h6 class="m-0 font-weight-bold text-primary">Master Data pelanggan</h6>
                            
                            <!-- Tombol Tambah Data -->
                            <a href="{{ url('/pelanggan/create') }}" class="btn btn-primary btn-icon-split btn-sm">
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
                                            <th>Kode pelanggan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Alamat</th>
                                            <th>jenis Kelamin</th>
                                            <th>NO Telp</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="thead-dark">
                                        <tr>
                                            <th>Kode pelanggan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Alamat</th>
                                            <th>Jenis Kelamin</th>
                                            <th>NO telp</th>
                                            <th>Aksi</th>
                                        </tr>
                                 </tfoot>
                                <tbody>
                                    @foreach ($pelanggan as $p)
                                        <tr>
                                            {{-- <td>{{ $p->id }}</td> --}}
                                            <td>{{ $p->kode_pelanggan }}</td>
                                            <td>{{ $p->nama_pelanggan }}</td>
                                            <td>{{ $p->alamat_pelanggan }}</td>
                                            <td>{{ $p->jenis_kelamin }}</td>
                                            <td>{{ $p->no_telp }}</td>
                                            <td>
                                                <a href="#" onclick="editData(this);" 
                                                data-id="{{ $p->id }}" 
                                                data-kode-pelanggan="{{ $p->kode_pelanggan }}" 
                                                data-nama-pelanggan="{{ $p->nama_pelanggan }}"
                                                data-alamat-pelanggan="{{ $p->alamat_pelanggan }}"
                                                data-jenis-kelamin="{{ $p->jenis_kelamin }}"
                                                data-no-telp="{{ $p->no_telp }}" 
                                                class="btn btn-info btn-circle btn">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" onclick="deleteConfirm(this); return false;" data-id="{{ $p->id }}" data-nama="{{ $p->nama_pelanggan }}" class="btn btn-danger btn-circle btn">
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

        <!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Pelanggan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengedit data pelanggan -->
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT') <!-- Method untuk menunjukkan bahwa ini adalah request PUT -->
                    <div class="form-group">
                        <label for="kode_pelanggan">Kode Pelanggan</label>
                        <input type="text" class="form-control" id="edit_kode_pelanggan" name="kode_pelanggan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_pelanggan">Nama</label>
                        <input type="text" class="form-control" id="edit_nama_pelanggan" name="nama_pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="alamat_pelanggan">Alamat</label>
                        <input type="text" class="form-control" id="edit_alamat_pelanggan" name="alamat_pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="edit_jenis_kelamin" name="jenis_kelamin">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telp</label>
                        <input type="text" class="form-control" id="edit_no_telp" name="no_telp">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editData(e) {
        var id = e.getAttribute('data-id');
        var kode_pelanggan = e.getAttribute('data-kode-pelanggan');
        var nama_pelanggan = e.getAttribute('data-nama-pelanggan');
        var alamat_pelanggan = e.getAttribute('data-alamat-pelanggan');
        var jenis_kelamin = e.getAttribute('data-jenis-kelamin');
        var no_telp = e.getAttribute('data-no-telp');

        // Mengatur nilai input dalam form edit dengan nilai yang sesuai
        document.getElementById('edit_kode_pelanggan').value = kode_pelanggan;
        document.getElementById('edit_nama_pelanggan').value = nama_pelanggan;
        document.getElementById('edit_alamat_pelanggan').value = alamat_pelanggan;
        document.getElementById('edit_jenis_kelamin').value = jenis_kelamin;
        document.getElementById('edit_no_telp').value = no_telp;

        var url = "{{ url('pelanggan') }}" + '/' + id;
        document.getElementById('editForm').action = url;

        $('#editModal').modal('show'); // Menampilkan modal edit
    }
</script>

{{-- delete sript --}}
        <script>
            function deleteConfirm(e) {
            var tomboldelete = document.getElementById('btn-delete');  
            id = e.getAttribute('data-id');
            nama = e.getAttribute('data-nama'); // Menambahkan atribut data-nama untuk mendapatkan nama pelanggan

            var url3 = "{{url('pelanggan/destroy/')}}";
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