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
    const Uri = window.location.pathname.split('/').pop();
    document.addEventListener("DOMContentLoaded", function() {
      fetch('/api/user', {
          method: 'GET',
          headers: {
            Authorization: 'Bearer ' + localStorage.getItem('TOKEN'),
            Accept: 'application/json',
          }
        }).then(response => response.json())
        .then(response => {
          let CurrentUser = response.id;
          if (CurrentUser != Uri) {
            window.location.href = '/patientRole/' + response.id;
          }
        });
    });
  </script>
  <style>
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      background-color: #f8f9fa;
      border-bottom: 1px solid #dee2e6;
    }

    .title {
      flex-grow: 1;
      text-align: left;
    }

    .notification-icon {
      display: flex;
      align-items: center;
      margin-right: 20px;
      cursor: pointer;
    }

    .notification {
      margin-left: 5px;
      display: flex;
      align-items: center;
    }

    .logout-btn {
      cursor: pointer;
    }

    @media (max-width: 768px) {
      .notification-icon {
        margin-right: 10px;
      }
    }
  </style>
</head>

<body>

  <div class="navbar">
    <h5 class="fw-semibold title">Health Care System</h5>
    @php
    use App\Models\PatientNotification;
    $notification = PatientNotification::where('patient_id', $profiles->id)->get();
    @endphp
    <div class="notification-icon" data-bs-toggle="modal" data-bs-target="#notifModal">
      <i class="ti ti-bell-ringing"></i>
      <div class="notification bg-primary rounded-circle position-relative">
        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill">{{count($notification)}}</span>
      </div>
    </div>
    @include('PatientRole.notification')
    <div class="logout-btn">
      <button class="btn btn-danger" onclick="logout()">Logout</button>
    </div>
  </div>
</body>
<div class="card-body">
  <div class="card">
    <div class="card-body">
      <form action="{{route('patient.update', $profiles->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-6">
            <div class="text-center mb-3">
              @if($profiles->profile_image)
              <img src="{{asset('storage/'.$profiles->profile_image)}}" alt="Profile Image" id="profileImageView" class="img-fluid rounded-circle" style="width: 190px; height: 190px;">
              @else
              <img src="{{asset('images/profile_default.png')}}" alt="Profile Image" id="profileImageView" class="img-fluid rounded-circle" style="width: 190px; height: 190px;">
              @endif
            </div>
            <div class="mb-3">
              <label for="exampleInputImage" class="form-label">Profile Image</label>
              <input type="file" value="{{$profiles->profile_image}}" name="profile_image" class="form-control" id="exampleInputImage" accept="image/*" onchange="previewImage(event)">
            </div>
            <div class="mb-3">
              <label for="exampleInputFirstName" class="form-label">First Name</label>
              <input type="text" value="{{$profiles->first_name}}" name="first_name" class="form-control" id="exampleInputFirstName" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputMiddleName" class="form-label">Middle Name</label>
              <input type="text" value="{{$profiles->middle_name}}" name="middle_name" class="form-control" id="exampleInputMiddleName" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputLastName" class="form-label">Last Name</label>
              <input type="text" value="{{$profiles->last_name}}" name="last_name" class="form-control" id="exampleInputLastName" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="exampleInputEmail" class="form-label">Email</label>
              <input type="email" value="{{$profiles->email}}" name="email" class="form-control" id="exampleInputEmail" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputBirthDate" class="form-label">Birth Date</label>
              <input type="date" value="{{$profiles->date_of_birth}}" name="date_of_birth" class="form-control" id="exampleInputBirthDate" required>
            </div>
            <div class="mb-3">
              <label for="exampleSelectGender" class="form-label">Gender</label>
              <select name="gender" class="form-control" id="exampleSelectGender" required>
                <option value="">Choose gender</option>
                <option value="male" {{ $profiles->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $profiles->gender == 'female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleInputAddress" class="form-label">Address</label>
              <input type="text" value="{{$profiles->address}}" name="address" class="form-control" id="exampleInputAddress" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputAddress" class="form-label text-danger">User Email</label>
              <input type="text" value="{{$profiles->user->email}}" class="form-control" id="exampleInputAddress" readonly>
            </div>
            <div class="mb-3">
              <label for="exampleInputAddress" class="form-label text-danger">Temporary Password</label>
              <input type="text" value="healthcare2024" class="form-control" id="exampleInputAddress" readonly>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <!-- <a class="btn btn-light" href="{{route('patient.index')}}">Cancel</a> -->
        <a href="{{url('recordPatient', $profiles->id)}}" class="btn btn btn-success me-2">
          <i class="fas fa-eye"></i> Medical Record
        </a>
      </form>
    </div>
  </div>
</div>

<script>
  function previewImage(event) {
    var output = document.getElementById('profileImageView');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  }
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="col-lg-12 d-flex align-items-stretch">
  <div class="card w-100">
    <div class="card-body p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold mb-0">Appointments</h5>
        <a href="{{url('CreatePatientAppointment', $profiles->id)}}" class="btn btn-primary">New Appointment</a>
      </div>
      <div class="table-responsive">
        <table class="table text-nowrap mb-0 align-middle">
          <thead class="text-dark fs-4">
            <tr>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">#</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Date</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Requests</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Doctor</h6>
              </th>

              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Status</h6>
              </th>
              <th class="border-bottom-0"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($appointments as $appointment)
            <tr>
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{($appointments->currentPage() - 1) * $appointments->perPage() + $loop->iteration }}</p>
              </td>
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{$appointment->appointment_date}}</p>
              </td>
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{$appointment->requests}}</p>
              </td>
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{$appointment->doctor->full_name ?? 'Not Aprroved Yet'}}</p>
              </td>
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{$appointment->status}}</p>
              </td>
              <td class="border-bottom-0">
                <div class="d-flex">
                  @if($appointment->status == "Pending")
                  <a href="#" class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" data-bs-target="#approveUserModal{{$appointment->id}}">
                    <i class="fas fa-process-up"></i> Pending
                  </a>
                  <a href="" class="btn btn-sm btn-info me-2" data-bs-toggle="modal" data-bs-target="#editUserModal{{$appointment->id}}">
                    <i class="fas fa-edit"></i>
                  </a>
                  @include('Patient.Appointment.edit')
                  <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$appointment->id}}">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                  @else
                  <a href="#" class="btn btn-sm btn-success me-2" data-bs-toggle="modal" data-bs-target="#approveUserModal{{$appointment->id}}">
                    <i class="fas fa-check"></i> Approved
                  </a>
                  @endif

                  @include('Patient.Appointment.delete')
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $appointments->links() !!}
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
@include('layouts.alert_success')

</html>