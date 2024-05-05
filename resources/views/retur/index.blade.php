@extends('layoutadmin')

@section('konten')
<style>
    th {
        text-align: center;
        color: #000;
        text-transform: capitalize;
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

    .aksi {
        width: 15%;
        justify-content: center;
        text-align: center;
    }
</style>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h5 class="card-title fw-semibold">Data Retur Pembelian</h5>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Transaksi Data retur</h6>
                                <!-- Tombol Tambah Data -->
                                <a href="{{ url('/retur/create') }}" class="btn btn-primary btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="ti ti-plus"></i>
                                    </span>
                                    <span class="text">Tambah Data</span>
                                </a>
                                <!-- Akhir Tombol Tambah Data -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                {{-- <th>No</th> --}}
                                                <th>No Faktur</th>
                                                <th>Nama Barang</th>
                                                <th>Nama Supplier</th>
                                                <th>Tanggal Retur</th>
                                                <th>Jumlah Stok</th>
                                                <th>Ket</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="thead-dark">
                                            <tr>
                                                {{-- <th>No</th> --}}
                                                <th>No Faktur</th>
                                                <th>Nama Barang</th>
                                                <th>Nama Supplier</th>
                                                <th>Tanggal Retur</th>
                                                <th>Jumlah Stok</th>
                                                <th>Ket</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($returs as $retur)
                                            <tr>
                                                <td>{{ $retur->nomor_faktur }}</td>
                                                <td>{{ $retur->nama_barang }}</td>
                                                <td>{{ $retur->nama_supplier }}</td>
                                                <td>{{ $retur->tanggal_retur }}</td>
                                                <td>{{ $retur->jumlah }}</td>
                                                <td>{{ $retur->ket }}</td>
                                                <td class="aksi">
                                                    <!-- Tombol untuk menghapus -->
                                                    <form action="{{ route('retur.destroy', $retur->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                    <!-- Tombol untuk mengedit -->
                                                    <a class="btn btn-success" href="{{ route('retur.edit', $retur->id) }}"><i class="fas fa-edit"></i></a>
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
    <!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    function openDeleteModal(url) {
        $('#deleteForm').attr('action', url);
        $('#deleteModal').modal('show');
    }
</script>
@endsection
<style>
    .table-responsive {
        margin: 10px;
        overflow-x: auto;
    }

    #dataTable {
        width: 50%;
    }

    #dataTable th,
    #dataTable td {
        white-space: nowrap;
    }

    #dataTable th:nth-child(1),
    #dataTable td:nth-child(1) {
        width: 5%;
    }

    #dataTable th:nth-child(2),
    #dataTable td:nth-child(2) {
        width: 5%;
    }
</style>
</div>
@endsection
