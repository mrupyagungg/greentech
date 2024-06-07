@extends('layoutadmin')

@section('konten')
    <div class="container">
        <div class="body-wrapper">
            <h1>Laporan Pembelian Bulanan</h1>

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
        <table class="table mt-4" id="pembelian-table">
            <thead>
                <tr>
                    <th>no transaksi</th>
                    <th>kode_supplier</th>
                    <th>nama_barang</th>
                    <th>harga</th>
                    <th>stok</th>
                    <th>tgl</th>
                    <th>jumlah</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Total Per Bulan</th>
                    <th></th>
                    <th></th>
                    <th> </th>
                    <th></th>
                    <th></th>
                    <th id="total-jumlah"></th>
                </tr>
            </tfoot>
            <tbody>
                <!-- Data pembelian akan diisi melalui AJAX -->
            </tbody>
        </table>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('filter-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const month = document.getElementById('month').value;
    
            fetch(`/laporan/pembelian/${month}`)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#pembelian-table tbody');
                    tableBody.innerHTML = '';
    
                    if (data.status === 200) {
                        data.pembelian.forEach(pembelian => {
                            const row = document.createElement('tr');
                            const formatter = new Intl.NumberFormat('id-ID'); // Menggunakan locale Indonesia ('id-ID')
                            const formattedHargaBeli = formatter.format(pembelian.harga_beli);
                            const formattedJumlah = formatter.format(pembelian.jumlah);
                            row.innerHTML = `
                                <td>${pembelian.no_transaksi}</td>
                                <td>${pembelian.kode_supplier}</td>
                                <td>${pembelian.nama_barang}</td>
                                <td>Rp. ${formattedHargaBeli}</td>
                                <td>${pembelian.stok_tersedia}</td>
                                <td>${pembelian.tgl_transaksi}</td>
                                <td>Rp. ${formattedJumlah}</td>
                            `;
                            tableBody.appendChild(row);
                        });
    
                        // Update total jumlah
                        document.getElementById('total-jumlah').innerText ='Rp. ' + data.totalJumlah.toLocaleString();
                    } else {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td colspan="7" class="text-center"> w</td>
                        `;
                        tableBody.appendChild(row);
    
                        // Reset total jumlah
                        document.getElementById('total-jumlah').innerText = '';
                    }
                });
        });
    </script>    
@endsection
