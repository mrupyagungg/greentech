@extends('layoutadmin')

@section('konten')

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card  mx-auto" style="max-width: 550px;">
            <div class="card-body">
                <h5 class="card-title">Tambah Retur Pembelian</h5>
                <form action="{{ route('retur.store') }}" method="POST">
                    @csrf
                    <div disabled>
                        <div class="mb-3">
                            <label for="nomor_faktur" class="form-label">Nomor Faktur</label>
                            <input class="form-control form-control-solid" id="nomor_faktur" name="nomor_faktur" type="text" value="{{ $nomor_faktur }}" readonly>
                        </div>
                    </div>                   
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Barang</label>
                        <select class="form-control" id="nama_barang" name="nama_barang" required>
                            <option value="">Pilih Barang...</option>
                            @foreach ($barangs as $b)
                            <option value="{{ $b->nama_barang }}">{{ $b->nama_barang }}</option>
                        @endforeach
                        
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_supplier" class="form-label">Supplier</label>
                        <select class="form-control" id="nama_supplier" name="nama_supplier" required>
                            <option value="">Pilih Supplier ...</option>
                            @foreach ($suppliers as $s)
                            <option value="{{ $s->nama_supplier }}">{{ $s->nama_supplier }}</option>
                        @endforeach                        
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_retur" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal_retur" name="tanggal_retur">
                    </div>
                    
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah">
                    </div>
                    <div class="mb-3">
                        <label for="ket" class="form-label">Alasan</label>
                        <textarea class="form-control" id="ket" name="ket"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection