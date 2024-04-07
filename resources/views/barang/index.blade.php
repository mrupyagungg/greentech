@extends('layoutadmin')

@section('konten')
<style>
    th {
        text-align: center;
        color: #000;
        text-transform: uppercase;
        font-family: Arial, Helvetica, sans-serif;
    }

    td {
        /* color: #000; */
        text-transform: capitalize;
    }

    .card-body {
        background-color: rgb(255, 255, 255);
        border-radius: 1.5rem;
        padding: 2rem;
        size: 6rem;
    }
</style>
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h5 class="card-title fw-semibold">Data Barang</h5>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Master Data Barang</h6>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tambah Data
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('/barang/create') }}">Tambah Barang</a>
                                        <a class="dropdown-item" href="{{ url('/supplier/create') }}">Tambah Supplier</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori</th>
                                                <th>Hrg Beli</th>
                                                <th>Hrg Jual</th>
                                                <th>Stok</th>
                                                <th>Satuan</th>
                                                <th>Supplier</th>
                                                <th>Tanggal Pembelian</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="thead-dark">
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori</th>
                                                <th>Hrg Beli</th>
                                                <th>Hrg Jual</th>
                                                <th>Stok</th>
                                                <th>Satuan</th>
                                                <th>Supplier</th>
                                                <th>Tanggal Pembelian</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($barangs as $b)
                                            <tr>
                                                <td>{{ $b->kode_barang }}</td>
                                                <td>{{ $b->nama_barang }}</td>
                                                <td>{{ $b->kategori }}</td>
                                                <td>Rp. {{ $b->harga_beli }}</td>
                                                <td>Rp. {{ $b->harga_jual }}</td>
                                                <td>{{ $b->stok_tersedia }}</td>
                                                <td>{{ $b->satuan }}</td>
                                                <td>{{ $b->supplier }}</td>
                                                <td>{{ $b->tanggal_pembelian_terakhir }}</td>
                                                <td>
                                                    <a href="#" onclick="editData(this);" 
                                                    data-id="{{ $b->id }}" 
                                                        data-kode-barang="{{ $b->kode_barang }}" 
                                                        data-nama-barang="{{ $b->nama_barang }}"
                                                        data-stok_tersedia="{{ $b->stok_tersedia }}" 
                                                        data-kategori-barang="{{ $b->kategori }}" 
                                                        data-deskripsi-barang="{{ $b->deskripsi }}" 
                                                        class="btn btn-info btn-circle btn">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" onclick="deleteConfirm('{{ $b->id }}')" class="btn btn-danger btn-circle btn">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="edit_kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" id="edit_kode_barang" name="kode_barang" value="{{ $b->kode_barang }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="edit_nama_barang" name="nama_barang" value="{{ $b->nama_barang }}">
                    </div>
                    <div class="form-group">
                        <label for="edit_kategori_barang">Kategori Barang</label>
                        <select class="form-control" id="edit_kategori_barang" name="kategori">
                            <option value="Tech" {{ $b->kategori == 'Tech' ? 'selected' : '' }}>Technology</option>
                            <option value="Farm" {{ $b->kategori == 'Farm' ? 'selected' : '' }}>Farm</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="edit_stok_tersedia">Stok</label>
                        <input type="number" class="form-control" id="edit_stok_tersedia" name="stok_tersedia" value="{{ $b->stok_tersedia }}">
                    </div>
                    <div class="form-group">
                        <label for="edit_deskripsi_barang">Deskripsi Barang</label>
                        <textarea class="form-control" id="edit_deskripsi_barang" name="deskripsi" rows="3">{{ $b->deskripsi }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- script edit --}}
<script>
    function editData(e) {
        var id = e.getAttribute('data-id');
        var kode_barang = e.getAttribute('data-kode-barang');
        var nama_barang = e.getAttribute('data-nama-barang');
        var stok_tersedia = e.getAttribute('data-stok_tersedia');
        var kategori_barang = e.getAttribute('data-kategori-barang');
        var deskripsi_barang = e.getAttribute('data-deskripsi-barang');

        document.getElementById('edit_kode_barang').value = kode_barang;
        document.getElementById('edit_nama_barang').value = nama_barang;
        document.getElementById('edit_stok_tersedia').value = stok_tersedia;
        document.getElementById('edit_kategori_barang').value = kategori_barang;
        document.getElementById('edit_deskripsi_barang').value = deskripsi_barang;

        var url = "{{ url('barang') }}" + '/' + id;
        document.getElementById('editForm').action = url;

        $('#editModal').modal('show');
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
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>   

{{-- script delete --}}
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

<style>
    .table-responsive {
        margin: 20px;
        overflow-x: auto;
    }

    #dataTable {
        width: 100%;
    }

    #dataTable th,
    #dataTable td {
        white-space: nowrap;
    }

    #dataTable th:nth-child(1),
    #dataTable td:nth-child(1) {
        width: 10%;
    }

    #dataTable th:nth-child(2),
    #dataTable td:nth-child(2) {
        width: 20%;
    }
</style>
@endsection
