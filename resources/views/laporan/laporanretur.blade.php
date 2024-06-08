@extends('layoutadmin')

@section('konten')
    <div class="container">

        <div class="body-wrapper">
            <h1>Laporan retur Bulanan</h1>
        
            <!-- Filter Form -->
            <form id="filter-form">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="month">Pilih Bulan</label>
                        <input type="month" name="month" id="month" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        
            <!-- Table -->
            <table class="table mt-4" id="retur-table">
                <thead>
                    <tr>
                        <th>Kode retur</th>
                        <th>Nama Barang</th>
                        <th>Nama Pegawai</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data retur akan diisi melalui AJAX -->
                </tbody>
            </table>
        </div>
        
        <script>
        document.getElementById('filter-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const month = document.getElementById('month').value;
        
            fetch(`/laporan/retur/${month}`)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#retur-table tbody');
                    tableBody.innerHTML = '';
        
                    if (data.status === 200) {
                        data.retur.forEach(retur => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${retur.nomor_faktur}</td>
                                <td>${retur.nama_barang}</td>
                                <td>${retur.nama_supplier}</td>
                                <td>${retur.tanggal_retur}</td>
                                <td>${retur.jumlah}</td>
                                <td>${retur.ket}</td>
                            `;
                            tableBody.appendChild(row);
                        });
                    } else {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td colspan="4" class="text-center">${data.message}</td>
                        `;
                        tableBody.appendChild(row);
                    }
                });
        });
        </script>
    </div>
@endsection
