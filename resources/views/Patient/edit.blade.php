@extends('home')
@section('content')
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const userId = localStorage.getItem('USER_ID');
    console.log(userId);
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
        console.log(response);
        const userImage = response.profile_image ? response.profile_image : 'images/profile_default.png';
        document.getElementById('userID').src = userImage;
        if (response.role_id == 2) {
          // document.querySelector('#admin').classList.add('d-block');
          window.location.href = '/patientRole/' + response.id;
        }
        // console.log(response);
      });
  });
</script>
<div class="card-body">
  <h5 class="card-title fw-semibold mb-4">Edit Patient</h5>
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
            <!-- <div class="mb-3" id="specializationField">
              <label for="exampleInputSpecialization" class="form-label">Specialization</label>
              <textarea name="specialization" class="form-control" id="exampleInputSpecialization">{{$profiles->specialization}}</textarea>
            </div> -->

          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-light" href="{{route('patient.index')}}">Cancel</a>
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
        <a href="{{route('appointment.create', $profiles->id)}}" class="btn btn-primary">New Appointment</a>
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
                <h6 class="fw-semibold mb-0">Created By</h6>
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
                <p class="mb-0 fw-normal">{{$appointment->doctor->full_name ?? ''}}</p>
              </td>
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{$user->name}}</p>
              </td>

              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{$appointment->status}}</p>
              </td>

              <td class="border-bottom-0">
                <div class="d-flex">

                  @if($appointment->status == 'Approved')
                  <a href="#" class="btn btn-sm btn-danger me-2" data-bs-toggle="modal" data-bs-target="#rejectUserModal{{$appointment->id}}">
                    <i class="fas fa-thumbs-down"></i> Reject
                  </a>
                  @endif

                  @if($appointment->status == 'Pending')
                  <a href="#" class="btn btn-sm btn-success me-2" data-bs-toggle="modal" data-bs-target="#approveUserModal{{$appointment->id}}">
                    <i class="fas fa-thumbs-up"></i> Approved
                  </a>
                  @endif
                  @include('Patient.Appointment.update')

                  <a href="" class="btn btn-sm btn-info me-2" data-bs-toggle="modal" data-bs-target="#editUserModal{{$appointment->id}}">
                    <i class="fas fa-edit"></i>
                  </a>
                  @include('Patient.Appointment.edit')
                  <!-- <a href="#" class="btn btn-sm btn-success me-2">
                    <i class="fas fa-eye"></i>
                  </a> -->

                  <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$appointment->id}}">
                    <i class="fas fa-trash-alt"></i>
                  </a>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>


@endsection