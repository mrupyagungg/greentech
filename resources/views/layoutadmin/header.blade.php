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



  <style>
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
        font-size: 30px;
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
      <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
          <a href="" class="btn btn-primary">{{Auth::user()->name}}</a>
          <li class="nav-item dropdown">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
              aria-expanded="false">
              <img src="{{asset('images/profile/user-1.jpg')}}" alt="" width="35" height="35" class="img rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
              <div class="message-body">
                <a href="profile" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="ti ti-user fs-6"></i>
                  <p class="mb-0 fs-3">My Profile</p>
                </a>
                <a href="team" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="bi bi-people-fill"></i>
                  <p class="mb-0 fs-3">My Account</p>
                </a>
                <a class="btn btn-outline-primary mx-3 mt-2 d-block" data-bs-toggle="modal" href="#logoutModal">Logout</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
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