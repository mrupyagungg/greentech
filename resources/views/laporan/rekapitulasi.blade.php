@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Rekapitulasi Presensi</h1>

        <form action="{{ route('presensi.viewrekapitulasi', ['periode' => '', 'pegawai_id' => '']) }}" method="GET" class="mb-3">
            <div class="form-row">
                <div class="col">
                    <input type="month" name="periode" class="form-control">
                </div>
                <div class="col">
                    <select name="pegawai_id" class="form-control">
                        @foreach ($pegawai as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_pegawai }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Tampilkan Rekapitulasi</button>
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
            <tbody id="rekapitulasiData">
                <!-- Data akan diisi melalui AJAX -->
            </tbody>
        </table>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const periode = document.querySelector('input[name="periode"]').value;
            const pegawai_id = document.querySelector('select[name="pegawai_id"]').value;
            fetch(`/presensi/viewrekapitulasi/${periode}/${pegawai_id}`)
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById('rekapitulasiData');
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
