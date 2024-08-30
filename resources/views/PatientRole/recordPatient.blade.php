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
    if (!token) {
      window.location.href = '/';
    }

    const currentUri = window.location.pathname.split('/').pop();
    const savedFirstUri = localStorage.getItem('FsavedUri');

    if (savedFirstUri === null) {

      localStorage.setItem('FsavedUri', currentUri);
    } else if (savedFirstUri !== currentUri) {

      window.history.go(-1);
    }
    const userId = localStorage.getItem('id');
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
          let userImage = response.profile_image
        if(userImage){
          //<img id="userID" width="35" height="35" class="rounded-circle">
          document.getElementById('userID').innerHTML =`<img width="35" height="35" class="rounded-circle" src="storage/${userImage}"/>` ;
        }else{
          document.getElementById('userID').src =  'images/profile_default.png';
        }
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

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      background-color: #f8f9fa;
      border-bottom: 1px solid #dee2e6;
    }

    .navbar .logout-btn {
      margin-left: auto;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="navbar">
    <h5 class="fw-semibold">Health Care System</h5>
    <div class="logout-btn">
      <button class="btn btn-danger" onclick="logout()">Logout</button>
      <a class="btn btn-light" href="javascript:void(0);" onclick="history.back()">Cancel</a>
    </div>
  </div>
  <style>
    .container {
      padding: 20px;
    }

    .record-table {
      margin-top: 20px;
    }

    .card {
      margin-bottom: 20px;
    }

    .card-header {
      background-color: #007bff;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .record-table th,
    .record-table td {
      vertical-align: middle;
    }

    .record-table th {
      background-color: #343a40;
      color: white;
    }

    .img-fluid {
      max-width: 100%;
      height: auto;
    }

    .rounded-circle {
      border-radius: 50%;
    }

    @media (max-width: 768px) {
      .container {
        padding: 10px;
      }

      .card-header {
        flex-direction: column;
        align-items: flex-start;
      }
    }

    @media print {
      body * {
        visibility: hidden;
      }

      .print-container,
      .print-container * {
        visibility: visible;
      }

      .print-container {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }

      .card-header button {
        display: none;
      }

      @page {
        size: landscape;
      }
    }
  </style>

  <div class="container print-container">
    <div class="card">
      <div class="card-header">
        <h3>Patient Medical Records</h3>
        <button onclick="window.print()" class="btn btn-success">
          <i class="fas fa-print"></i> Print
        </button>
      </div>
      <div class="card-body">
        <h5 class="card-title">Patient Information</h5>
        <div class="row">
          <div class="col-md-4">
            <p><strong>Name:</strong> {{$profile->full_name}}</p>
            <p><strong>Age:</strong> {{$profile->age}}</p>
            <p><strong>Gender:</strong> {{ucfirst($profile->gender)}}</p>
          </div>
          <div class="col-md-4">
            <p><strong>Address:</strong> {{$profile->address}}</p>
            <p><strong>Medical History:</strong>
              @if($profile->prescription->isEmpty())
              No medical history available.
              @else
              {{ $profile->prescription->pluck('medication')->implode(', ') }}
              @endif
            </p>
            <p><strong>Allergies:</strong> None</p>
          </div>
          <div class="col-md-4 text-center">
            @if($profile->profile_image)
            <img src="{{asset('storage/'. $profile->profile_image)}}" class="img-fluid rounded-circle" style="width: 150px; height: 150px;" alt="Patient Photo">
            @else
            <img src="{{asset('images/profile_default.png')}}" class="img-fluid rounded-circle" style="width: 150px; height: 150px;" alt="Patient Photo">
            @endif
          </div>
        </div>
        <h5 class="mt-4">Medical Records</h5>
        <table class="table table-bordered record-table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Treatments</th>
              <th scope="col">Medication</th>
              <th scope="col">Description</th>
            </tr>
          </thead>
          <tbody>
            @foreach($profile->appointments as $appointment)
            <tr>
              <td>{{$appointment->created_at}}</td>
              <td>{{$appointment->requests}}</td>
              <td>{{$appointment->prescription->medication ?? ''}}</td>
              <td>{{$appointment->prescription->description ?? ''}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  <script src="{{asset('dash_board/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('dash_board/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('dash_board/assets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('dash_board/assets/js/app.min.js')}}"></script>
  <script src="{{asset('dash_board/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('dash_board/assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{asset('dash_board/assets/js/dashboard.js')}}"></script>
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
          localStorage.removeItem('FirstsavedUri');
          localStorage.removeItem('FsavedUri');

          Swal.fire({
            title: 'Logged Out',
            text: 'You have been successfully logged out.',
            icon: 'success',
            timer: 2000,
            timerProgressBar: true,
            willClose: () => {
              window.location.href = '/';
            }
          });
        }
      });
    }
  </script>
</body>

</html>