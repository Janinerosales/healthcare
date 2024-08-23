<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Health Care System</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('dash_board/assets/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('dash_board/assets/css/styles.min.css')}}" />
  <script>
    const token = localStorage.getItem('TOKEN');
    // console.log(localStorage.getItem('id'));
    if (!token) {
      window.location.href = '/';
    }
    const userId = localStorage.getItem('id');
    // console.log(userId);
    document.addEventListener("DOMContentLoaded", function() {
      fetch('/api/user', {
          method: 'GET',
          headers: {
            Authorization: 'Bearer ' + localStorage.getItem('TOKEN'),
            Accept: 'application/json',
            body: JSON.stringify({
              user_id: userId
            })
          }
        }).then(response => response.json())
        .then(response => {
          let Uri = window.location.hostname;
          if(response.profile_image){
            document.getElementById('userID').innerHTML =  `<img  width="35" src={{asset('storage/${response.profile_image}')}} height="35" class="rounded-circle">`;
          }else{
            document.getElementById('userID').innerHTML =  `<img  width="35" src={{asset("images/profile_default.png")}} height="35" class="rounded-circle">`;
          }
          console.log(Uri);
          // const userImage = `{{asset('${response.profile_image}')}}` ? `{{asset('${response.profile_image}')}}` : `{{asset('images/profile_default.png')}}`;
          if (response.role_id == 1) {
            document.getElementById('roleName').textContent = 'Admin';
          } else if (response.role_id == 2) {
            document.getElementById('roleName').textContent = 'Patient';
          } else if (response.role_id == 3) {
            document.getElementById('roleName').textContent = 'Doctor';
          }

        
          if (response.role_id == 3) {
            document.getElementById('containerDoctor').innerHTML = `          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/doctor-dashboard" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('patient.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Patients</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('status.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Appointment</span>
              </a>
            </li>
              <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Records</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('record.index')}}" aria-expanded="false">
                <span>
                  <i class="fas fa-book-open"></i>
                </span>
                <span class="hide-menu">Medical Records</span>
              </a>
            </li>`;
          }
          if (response.role_id == 1) {
            document.getElementById('adminContainer').innerHTML = `
            <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/dashboard" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu"></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('patient.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Patients</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('doctor.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Doctors</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('status.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Appointment</span>
              </a>
            </li>
             <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Settings</span>
            </li>
            <li class="sidebar-item">

              <ul  class=" first-level" aria-expanded="false">
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{route('role.index')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-alert-circle"></i>
                    </span>
                    <span class="hide-menu">Roles</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{route('user.index')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-users"></i>
                    </span>
                    <span class="hide-menu">Users</span>
                  </a>
                </li>
                <li class="sidebar">
                  <a class="sidebar-link" href="#" aria-expanded="false">
                    <span>
                      <i class="ti ti-clock"></i>
                    </span>
                    <span class="hide-menu">{{now()->format('l , h:i:s A')}}</span>
                  </a>
                </li>

             
            </li>

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Records</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('record.index')}}" aria-expanded="false">
                <span>
                  <i class="fas fa-book-open"></i>
                </span>
                <span class="hide-menu">Medical Records</span>
              </a>
            </li>
          </ul>`;
          }

          // const userId = response.id;

          // Store user ID in localStorage
          // localStorage.setItem('USER_ID', userId);

          console.log(response);
        });
    });
  </script>
  <style>
    .collapse-icon {
      margin-left: auto;
      transition: transform 0.3s ease;
    }

    .collapse.show .collapse-icon>i {
      transform: rotate(180deg);
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="/dashboard" class="text-nowrap logo-img">
            <h4 class="fw-semibold mb-0">Health-Care-System</h4>
            <!-- <img src="{{asset('dash_board/assets/images/logos/dark-logo.svg')}}" width="180" alt="" /> -->
            <!-- <h2 width="180" class="text-center text-bold">Health Care</h2> -->
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <div id="containerDoctor"></div>
          <div id="adminContainer"></div>


        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            @php
            use App\Models\Notification;
            $notification = Notification::get();
            @endphp
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="#" data-bs-toggle="modal" data-bs-target="#notifModal">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle position-relative">
                  <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill">{{count($notification)}}</span>
                </div>
              </a>
            </li>


          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <!-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> -->
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">

                  <h5 id="roleName" style="padding-right: 10px; color: blue"></h5>
                  <div id="userID"></div>
                 
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    {{-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a> --}}
                    <a href="#" class="btn btn-outline-primary mx-3 mt-2 d-block" onclick="logout()">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        @yield('content')
        @include('notification')
      </div>
      <script src="{{asset('dash_board/assets/libs/jquery/dist/jquery.min.js')}}"></script>
      <script src="{{asset('dash_board/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('dash_board/assets/js/sidebarmenu.js')}}"></script>
      <script src="{{asset('dash_board/assets/js/app.min.js')}}"></script>
      <script src="{{asset('dash_board/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
      <script src="{{asset('dash_board/assets/libs/simplebar/dist/simplebar.js')}}"></script>
      <script src="{{asset('dash_board/assets/js/dashboard.js')}}"></script>
      <script>
        // const UserId = localStorage.getItem('id');
        // console.log(userId);
        document.addEventListener("DOMContentLoaded", function() {
          fetch('/api/user', {
              method: 'GET',
              headers: {
                Authorization: 'Bearer ' + localStorage.getItem('TOKEN'),
                Accept: 'application/json',
              }
            }).then(response => response.json())
            .then(response => {
              const userImage = response.profile_image ? response.profile_image : 'images/profile_default.png';
              document.getElementById('userID').src = userImage;

              // const userIlkmd = response.id;

              // Store user ID in localStorage
              // localStorage.setItem('USER_ID', userId);

              console.log(response);
            });
        });
      </script>
      <script>
        function logout() {
          Swal.fire({
            title: 'Confirm Logout',
            text: 'Are you sure you want to log out?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Log out',
            cancelButtonText: 'Cancel'
          }).then((result) => {
            if (result.isConfirmed) {
              localStorage.removeItem('TOKEN');
              Swal.fire({
                title: 'Logged Out',
                text: 'You have been successfully logged out.',
                icon: 'success',
                timer: 2000, // Show for 2 seconds
                timerProgressBar: true,
                willClose: () => {
                  window.location.href = '/';
                }
              });
            }
          });
        }
      </script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      @include('layouts.alert_success')

</body>

</html>