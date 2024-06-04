@extends('layoutadmin')

@section('konten')
    <div class="container">
        <h1>Laporan Presensi Bulanan</h1>

        <form action="{{ url('laporan.viewlaporanbulanan', ['periode' => '']) }}" method="GET" class="mb-3">
            @csrf
            <div class="form-row">
                <div class="col">
                    <input type="month" name="periode" class="form-control">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
                </div>
            </div>
        </form>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Presensi</th>
                    <th>Nama Pegawai</th>
                    <th>Check-In</th>
                </tr>
            </thead>
            <tbody id="presensiData">
                <th></th>
                <!-- Data akan diisi melalui AJAX -->
            </tbody>
        </table>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const periode = document.querySelector('input[name="periode"]').value;
            fetch(`/laporan/viewlaporanbulanan/${periode}`)
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById('presensiData');
                    tableBody.innerHTML = '';
                    if (data.status === 200) {
                        data.presensi.forEach(item => {
                            let row = `<tr>
                                <td>${item.kode_presensi}</td>
                                <td>${item.nama_pegawai}</td>
                                <td>${item.check_in}</td>
                            </tr>`;
                            tableBody.innerHTML += row;
                        });
                    } else {
                        tableBody.innerHTML = '<tr><td colspan="3">Tidak ada data ditemukan.</td></tr>';
                    }
                });
        });
    </script>
@endsection
