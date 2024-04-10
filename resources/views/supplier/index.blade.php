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
    .aksi{
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
                        <h5 class="card-title fw-semibold">Data supplier</h5>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Master Data supplier</h6>
                                 <!-- Tombol Tambah Data -->
                                <a href="{{ url('/supplier/create') }}" class="btn btn-primary btn-icon-split btn-sm">
                                <span class="icon text-white-50">
                                    <i class="ti ti-plus"></i>
                                </span>
                                <span class="text">Tambah Data</span>
                                </a>
                            <!-- Akghir Tombol Tambah Data -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="126%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Kategori</th>
                                                <th>Alamat</th>
                                                <th>Contact </th>
                                                <th>Term of Payment</th>
                                                <th>Ket</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="thead-dark">
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Kategori</th>
                                                <th>Alamat</th>
                                                <th>Contact </th>
                                                <th>Term of Payment</th>
                                                <th>Ket</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($suppliers as $sup)
                                            <tr>
                                                <td>{{ $sup->kode_supplier }}</td>
                                                <td>{{ $sup->nama_supplier }}</td> 
                                                <td>{{ $sup->kategori }}</td>
                                                <td>{{ $sup->alamat }}</td>
                                                <td>{{ $sup->no_telp }}</td>
                                                <td>{{ $sup->tgl_transaksi }}</td>
                                                <td>{{ $sup->ket }}</td>
                                                <td class="aksi">
                                                    <!-- Tombol untuk menampilkan detail, edit, dan hapus -->
                                                    <a class="btn btn-success" href="{{ route('presensi.edit',$sup->id) }}"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger" onclick="confirmDelete('{{ $sup->id }}', '{{ $sup->nama_pegawai }}')"> <i class="fas fa-trash"></i></button>
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
@endsection