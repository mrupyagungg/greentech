@extends('layoutadmin')

@section('konten')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card mx-auto" style="max-width: 550px;">
            <div class="card-body">
                <h5 class="card-title">Edit Retur Pembelian</h5>
                <form id="editForm" action="{{ route('retur.update', $retur->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nomor_faktur" class="form-label">Nomor Faktur</label>
                        <input type="text" class="form-control" id="nomor_faktur" name="nomor_faktur" value="{{ $retur->nomor_faktur }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <select class="form-control" id="nama_barang" name="nama_barang">
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}" {{ $barang->id == $retur->nama_barang ? 'selected' : '' }}>{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <select class="form-control" id="nama_supplier" name="nama_supplier">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ $supplier->id == $retur->nama_supplier ? 'selected' : '' }}>{{ $supplier->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_retur" class="form-label">Tanggal Retur</label>
                        <input type="date" class="form-control" id="tanggal_retur" name="tanggal_retur" value="{{ $retur->tanggal_retur }}">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $retur->jumlah }}">
                    </div>
                    <div class="mb-3">
                        <label for="ket" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="ket" name="ket">{{ $retur->ket }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#editForm').submit(function(event) {
            event.preventDefault();
            
            var formData = $(this).serialize();
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert('Data berhasil diupdate.');
                    window.location.href = '{{ route('retur.index') }}';
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });
    });
</script>
@endsection
