<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Health Care System</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('dash_board/assets/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('dash_board/assets/css/styles.min.css')}}" />
  <script>
    // console.log(Uri);
    const token = localStorage.getItem('TOKEN');
    if (!token) {
      window.location.href = '/';
    }


    const currentUri = window.location.pathname.split('/').pop();
    const savedFirstUri = localStorage.getItem('FirstsavedUri');

    if (savedFirstUri === null) {

      localStorage.setItem('FirstsavedUri', currentUri);
    } else if (savedFirstUri !== currentUri) {

      window.history.go(-1);
    }


    // console.log(savedUri); // This will log the previously saved URI part
    // console.log(currentUri);
    document.addEventListener("DOMContentLoaded", function() {
      fetch('/api/user', {
          method: 'GET',
          headers: {
            Authorization: 'Bearer ' + localStorage.getItem('TOKEN'),
            Accept: 'application/json',
          }
        }).then(response => response.json())
        .then(response => {


          // console.log(CurrentUser);

          // const targetUri = '/CreatePatientAppointment/' + response.id;

          // Check if the current URI is different from the target URI
          // if (currentUri != targetUri) {
          //   window.location.href = '/patientRole/' + response.id;
          // }
          console.log(response);
        });
    });

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
    </div>

  </div>
  <div class="card-body">
    <!-- <h5 class="card-title fw-semibold mb-4">Create Appointment</h5> -->
    <div class="card">
      <div class="card-body">
        <form action="{{url('createAppointment')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="status" value="Pending">
          <input type="hidden" name="user_id" id="userID">
          <input type="hidden" name="profile_id" id="profileIdInput">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="appointmentDate" class="form-label">Appointment Date</label>
                <input type="date" name="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror" id="appointmentDate" required>
                @error('appointment_date')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="requestSelect" class="form-label">Add Request</label>
                <select name="requests" class="form-control" id="requestSelect" required>
                  <option value="">Choose an option</option>
                  <option value="Consultation">Consultation</option>
                  <option value="Laboratory">Laboratory</option>
                  <option value="Procedure">Procedure</option>
                  <!-- Add more options as needed -->
                </select>
              </div>
            </div>
          </div>
          <script>
            var currentUrl = window.location.href;
            var patientId = currentUrl.split('/').pop();
          </script>

          <div class="row mt-3">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a class="btn btn-light" id="CancelButton">Cancel</a>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('CancelButton').addEventListener('click', function() {

      fetch('/api/user', {
        method: 'GET',
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('TOKEN'),
          Accept: 'application/json',
        }
      }).then(response => {
        return response.json();
      }).then(response => {
        // console.log(response);
        window.location.href = '/patientRole/' + response.id;
      })


      // console.log('awh');

    })
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // const queryString = window.location.search;
      const profileId = window.location.href.split('/').pop();
      // console.log(profileId);
      document.getElementById('profileIdInput').value = profileId;

      fetch('/api/user', {
          method: 'GET',
          headers: {
            Authorization: 'Bearer ' + localStorage.getItem('TOKEN'),
            Accept: 'application/json',
          }
        }).then(response => response.json())
        .then(response => {
          console.log(response.id);
          document.getElementById('userID').value = response.id;
        });
    });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

  <script src="{{asset('dash_board/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('dash_board/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('dash_board/assets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('dash_board/assets/js/app.min.js')}}"></script>
  <script src="{{asset('dash_board/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('dash_board/assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{asset('dash_board/assets/js/dashboard.js')}}"></script>