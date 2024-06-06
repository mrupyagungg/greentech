<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GreenTech</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  {{-- <link rel="shortcut icon" type="image/png" href="{{asset('images/logos/sss')}}" /> --}}
  <link rel="stylesheet" href="{{asset('css/styles.min.css')}}" />
  <link rel="stylesheet" href="{{asset('css/sb-admin-2.css')}}" />
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-w4K+oryH/E5VYUk/p2FjKb0Akr71G4tij2UasENFgJBDL+/Il9Y4+I1LYNT73PeD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>


  {{-- font roboto --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


  <style>
    *{
      font-family: "Roboto", sans-serif;
    }
    /* Optional: Custom CSS for DataTables */
    table.dataTable thead tr {
      background-color: LightGray;
    }

    .left-sidebar .sidebar-item a.sidebar-link {
    text-decoration: none;
      }
    table.dataTable tfoot tr {
      background-color: LightGray;
    }

    .text{
      padding: 0.6rem;
    }

    .app-header {
      padding-bottom: 1rem;
      padding-top: 1rem;
      /* position: fixed; */
      top: 0;
      left: 0;
      width: 100%;
      z-index: 2;
    }
    h6{
      font-size: 25px;
    }
    td{
        /* color: #000; */
        text-transform: capitalize;
    }
    .card-title{
        color: rgb(0, 0, 0);
        text-align: center;
        text-transform: uppercase; 
        font-size: 20px;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
    }

  </style>

  
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

  
  <!-- Untuk sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Tambahan form validation pop up -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  
  <!--  Header Start -->
  <header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item d-block d-xl-none">
          <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)">
            <i class="ti ti-bell-ringing"></i>
            <div class="notification bg-primary rounded-circle"></div>
          </a>
        </li>
      </ul>
    </nav>
  </header>
  <!--  Header End -->
  <!-- Modal Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to logout?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="logout" class="btn btn-primary">Logout</a>
      </div>
    </div>
  </div>
</div>
<div class="body-wrapper">

</head>