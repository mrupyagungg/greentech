@extends('layoutadmin')

@section('konten')
<script>
    window.onload = function() {
        updateProgressBar();
    };
</script>
<script>
    // Fungsi untuk mengubah lebar progress bar dari 0% hingga 100%
    function updateProgressBar() {
        var progressBar = document.querySelector('.progress-bar');
        var width = 0;
        var interval = setInterval(function() {
            if (width >= 100) {
                clearInterval(interval);
            } else {
                width++;
                progressBar.style.width = width + '%';
            }
        }, 20);
    }
</script>
<!--  Main wrapper -->
<div class="body-wrapper">

      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h4 class="m-0 font-weight-bold text-primary">Master Data presensi</h4>
                
                <!-- Tombol Tambah Data -->
                <a href="{{ url('/presensi/create') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="ti ti-plus"></i>
                    </span>
                    <span class="text">Tambah Data</span>
                </a>
                <!-- Akghir Tombol Tambah Data -->

            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode Presensi</th>
                            <th>Nama Pegawai </th>
                            <th>Check In</th>
                            <th>Auto Check</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presensi as $pres)
                        <tr>
                            <td>{{ $pres->kode_presensi }}</td>
                            <td>{{ $pres->nama_pegawai }}</td> 
                            <td>{{ $pres->check_in }}</td>
                            <td>{{ $pres->updated_at }}</td>
                            
                            <td>
                                <!-- Tombol untuk menampilkan detail, edit, dan hapus -->
                                <a class="btn btn-primary" href="{{ route('presensi.show',$pres->id) }}">Show</a>
                                <a class="btn btn-success" href="{{ route('presensi.edit',$pres->id) }}">Edit</a>
                                <form action="{{ route('presensi.destroy', $pres->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
        <script>
            // Panggil fungsi changeTextColor() saat halaman dimuat
            window.onload = function() {
                changeTextColor();
            };
        </script>
        

        <script>
            function deleteConfirm(e) {
            var tomboldelete = document.getElementById('btn-delete');  
            id = e.getAttribute('data-id');
            nama = e.getAttribute('data-nama'); 

            var url3 = "{{url('presensi/destroy/')}}";
            var url4 = url3.concat("/", id);
            tomboldelete.setAttribute("href", url4);

            var pesan = "Apakah Anda yakin ingin menghapus data <b>";
            var pesan2 = "</b> dengan ID <b>" + id + "</b>?"; 
            document.getElementById("xid").innerHTML = pesan.concat(nama, pesan2);

            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {keyboard: false});
            myModal.show();
        }
        </script>

        <!-- Logout Delete Confirmation-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body" id="xid"></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
                    
                </div>
                </div>
            </div>
        </div>   
@endsection