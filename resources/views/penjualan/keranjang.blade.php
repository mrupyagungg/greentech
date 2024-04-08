@extends('layoutadmin')

@section('konten')

<!-- Sweet Alert -->
@if(isset($status_hapus))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Hapus Data Berhasil',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        </script>
@endif

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <!-- <div class="col-md-12"> -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h5 class="card-title fw-semibold mb-4">Penjualan</h5>
                    <a href="{{url('penjualan/checkout')}}" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="ti ti-check"></i>
                            </span>
                            <span class="text">Checkout</span>
                    </a>
                </div>

                <!-- Awal Dari Tabel -->
                <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Barang</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Barang</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach ($keranjang as $p)
                                        <tr>
                                            <td>{{ $p->no_transaksi }}</td>
                                            <td>
                                                <img width="150px" height="150px" id="x-2" src="{{url('barang/')}}/{{ $p->foto }}" zn_id="79">
                                                <br>{{ $p->nama_barang }}
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>Harga   : Rp {{number_format($p->harga)}}</li>
                                                    <li>Jumlah  : {{$p->jml_barang}}</li>
                                                    <li>Total   : <b>Rp {{number_format($p->total)}}</b></li>
                                                </ul>  
                                            </td>
                                            <td>
                                                    <a onclick="deleteConfirm(this); return false;" href="#" data-id="{{ $p->id_penjualan_detail }}" class="btn btn-danger btn-circle">
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    <!-- Akhir Dari Tabel -->
                
                
              </div>
            </div>
          </div>
        </div>

<!-- Modal Delete -->
<script>
        function deleteConfirm(e){
            var tomboldelete = document.getElementById('btn-delete')  
            id = e.getAttribute('data-id');

            // const str = 'Hello' + id + 'World';
            var url3 = "{{url('penjualan/destroypenjualandetail/')}}";
            var url4 = url3.concat("/",id);
            // console.log(url4);

            // console.log(id);
            // var url = "{{url('perusahaan/destroy/"+id+"')}}";
            
            // url = JSON.parse(rul.replace(/"/g,'"'));
            tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

            var pesan = "Data dengan ID <b>"
            var pesan2 = " </b>akan dihapus"
            var res = id;
            document.getElementById("xid").innerHTML = pesan.concat(res,pesan2);

            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {  keyboard: false });
            
            myModal.show();
        
        }
    </script>
    <!-- Logout Delete Confirmation-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                
            </div>
            <div class="modal-body" id="xid"></div>
            <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>

            </div>
            </div>
        </div>
    </div>   
<!-- Akhir Modal Delete -->
@endsection