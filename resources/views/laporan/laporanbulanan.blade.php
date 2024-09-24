@extends('layoutadmin')

@section('konten')
    <div class="container">

        <div class="body-wrapper">
            <h1>Laporan Presensi Bulanan</h1>
        
            <!-- Filter Form -->
            <form id="filter-form">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="month">Pilih Bulan</label>
                        <input type="month" name="month" id="month" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Pilih</button>
            </form>
        
            <!-- Table -->
            <table class="table mt-4" id="presensi-table">
                <thead>
                    <tr>
                        <th>Kode Presensi</th>
                        <th>Nama Pegawai</th>
                        <th>Absen</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data presensi akan diisi melalui AJAX -->
                </tbody>
            </table>
        </div>
        
        <script>
        document.getElementById('filter-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const month = document.getElementById('month').value;
        
            fetch(`/laporan/bulanan/${month}`)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#presensi-table tbody');
                    tableBody.innerHTML = '';
        
                    if (data.status === 200) {
                        data.presensi.forEach(presensi => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${presensi.kode_presensi}</td>
                                <td>${presensi.nama_pegawai}</td>
                                <td>${presensi.absen}</td>
                                <td>${presensi.tanggal}</td>
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
