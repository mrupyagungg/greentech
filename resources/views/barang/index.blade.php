@extends('layoutadmin')

@section('konten')
<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="card-title fw-semibold mb-4">Data Barang</h5>
                        <div class="card">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Master Data Barang</h6>
                                <!-- Tombol Tambah Data -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary"></button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tambah Data
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('/barang/create') }}">Tambah Barang</a>
                                        <a class="dropdown-item" href="{{ url('/supplier/create') }}">Tambah Supplier</a>
                                        <!-- Anda dapat menambahkan item dropdown untuk jenis data lainnya jika diperlukan -->
                                    </div>
                                </div>
                                <!-- Akhir Tombol Tambah Data -->
                            </div>
                            <div class="card-body">
                                <!-- Awal Dari Tabel -->
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                                <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori </th>
                                                <th>Deskripsi</th>
                                                <th>Gambar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="thead-dark">
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Gambar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($barang as $b)
                                            <tr>
                                                <td>{{ $b->kode_barang }}</td>
                                                <td>{{ $b->nama_barang }}</td>
                                                <td>{{ $b->kategori_barang }}</td>
                                                <td>{{ $b->deskripsi_barang }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/images/' . $b->image_barang) }}" alt="Uploaded Image">
                                                </td>
                                                
                                                <td>
                                                    <a href="#" onclick="editData(this);" 
                                                    data-id="{{ $b->id_barang }}" 
                                                    data-kode-barang="{{ $b->kode_barang }}" 
                                                    data-nama-barang="{{ $b->nama_barang }}"
                                                    data-kategori-barang="{{ $b->kategori_barang }}"
                                                    data-deskripsi-barang="{{ $b->deskripsi_barang }}"
                                                    class="btn btn-info btn-circle btn">
                                                    <i class="fas fa-edit"></i>
                                                    </a>
                                                 
                                                    <a href="#" onclick="deleteConfirm('{{ $b->id_barang }}')" class="btn btn-danger btn-circle btn">
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
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Barang</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengedit data barang -->
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT') <!-- Method untuk menunjukkan bahwa ini adalah request PUT -->
                    
                    <div class="form-group">
                        <label for="edit_kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" id="edit_kode_barang" name="kode_barang" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="edit_nama_barang" name="nama_barang">
                    </div>
                    <div class="form-group">
                        <label for="edit_kategori_barang">Kategori Barang</label>
                        <select class="form-control" id="edit_kategori_barang" name="kategori_barang">
                            <option value="Elektronik">Elektronik</option>
                            <option value="Pakaian">Pakaian</option>
                            <option value="Alat Tulis">Alat Tulis</option>
                            <!-- Anda dapat menambahkan opsi lainnya dari data yang diambil dari database -->
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="edit_deskripsi_barang">Deskripsi Barang</label>
                        <textarea class="form-control" id="edit_deskripsi_barang" name="deskripsi_barang" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- edit script --}}
<script>
    function editData(e) {
        var id = e.getAttribute('data-id');
        var kode_barang = e.getAttribute('data-kode-barang');
        var nama_barang = e.getAttribute('data-nama-barang');
        var kategori_barang = e.getAttribute('data-kategori-barang');
       
        var deskripsi_barang = e.getAttribute('data-deskripsi-barang');

        // Mengatur nilai input dalam form edit dengan nilai yang sesuai
        document.getElementById('edit_kode_barang').value = kode_barang;
        document.getElementById('edit_nama_barang').value = nama_barang;
        document.getElementById('edit_kategori_barang').value = kategori_barang;
       
        document.getElementById('edit_deskripsi_barang').value = deskripsi_barang;

        var url = "{{ url('barang') }}" + '/' + id;
        document.getElementById('editForm').action = url;

        $('#editModal').modal('show'); // Menampilkan modal edit
    }
</script>



<!-- Logout Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="xid"></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <form id="form-delete" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-block btn" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>   

<script>
    function deleteConfirm(id) {
    var url = "{{ url('barang/destroy/') }}/" + id;
    document.getElementById("form-delete").setAttribute("action", url);

    var pesan = "Data dengan ID <b>" + id + "</b> akan dihapus";
    document.getElementById("xid").innerHTML = pesan;

    var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
        keyboard: false
    });

    myModal.show();
}

</script>

@endsection
