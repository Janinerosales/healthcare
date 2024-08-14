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
  <h5 class="card-title fw-semibold mb-4">Edit User</h5>
  <div class="card">
    <div class="card-body">
      <form action="{{route('user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-6">
            <div class="text-center mb-3">
              @if($user->profile_image)
              <img src="{{asset('storage/'.$user->profile_image)}}" alt="Profile Image" id="profileImageView" class="img-fluid rounded-circle" style="width: 190px; height: 190px;">
              @else
              <img src="{{asset('images/profile_default.png')}}" alt="Profile Image" id="profileImageView" class="img-fluid rounded-circle" style="width: 190px; height: 190px;">
              @endif

            </div>
            <div class="mb-3">
              <label for="exampleInputImage" class="form-label">Profile Image</label>
              <input type="file" value="{{$user->profile_image}}" name="profile_image" class="form-control" id="exampleInputImage" accept="image/*" onchange="previewImage(event)">
            </div>
            <div class="mb-3">
              <label for="exampleInputFirstName" class="form-label">First Name</label>
              <input type="text" value="{{$user->first_name}}" name="first_name" class="form-control" id="exampleInputFirstName" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputMiddleName" class="form-label">Middle Name</label>
              <input type="text" value="{{$user->middle_name}}" name="middle_name" class="form-control" id="exampleInputMiddleName" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputLastName" class="form-label">Last Name</label>
              <input type="text" value="{{$user->last_name}}" name="last_name" class="form-control" id="exampleInputLastName" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="exampleInputEmail" class="form-label">Email</label>
              <input type="email" value="{{$user->email}}" name="email" class="form-control" id="exampleInputEmail" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputBirthDate" class="form-label">Birth Date</label>
              <input type="date" value="{{$user->date_of_birth}}" name="date_of_birth" class="form-control" id="exampleInputBirthDate" required>
            </div>
            <div class="mb-3">
              <label for="exampleSelectGender" class="form-label">Gender</label>
              <select name="gender" class="form-control" id="exampleSelectGender" required>
                <option value="">Choose gender</option>
                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputAddress" class="form-label">Address</label>
              <input type="text" value="{{$user->address}}" name="address" class="form-control" id="exampleInputAddress" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputAddress" class="form-label text-danger">User Email</label>
              <input type="text" value="{{$user->user->email}}" class="form-control" id="exampleInputAddress" readonly>
            </div>
            <div class="mb-3">
              <label for="exampleInputAddress" class="form-label text-danger">Temporary Password</label>
              <input type="text" value="healthcare2024" class="form-control" id="exampleInputAddress" readonly>
            </div>
            <!-- <div class="mb-3" id="specializationField">
              <label for="exampleInputSpecialization" class="form-label">Specialization</label>
              <textarea name="specialization" class="form-control" id="exampleInputSpecialization">{{$user->specialization}}</textarea>
            </div> -->

          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-light" href="javascript:history.back()">Cancel</a>

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
@endsection