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
        let userImage = response.profile_image
        if(userImage){
          //<img id="userID" width="35" height="35" class="rounded-circle">
          document.getElementById('userID').innerHTML =`<img width="35" height="35" class="rounded-circle" src="storage/${userImage}"/>` ;
        }else{
          document.getElementById('userID').src =  'images/profile_default.png';
        }
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
  <h5 class="card-title fw-semibold mb-4">Create User</h5>
  <div class="card">
    <div class="card-body">
      <form action="{{route('patient.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="exampleInputImage" class="form-label">Profile Image</label>
              <input type="file" name="profile_image" class="form-control" id="exampleInputImage" accept="image/*">
            </div>
            <div class="mb-3">
              <label for="exampleSelectOption" class="form-label">Select Option</label>
              <select name="role_id" class="form-control" id="exampleSelectOption" required onchange="checkRole()">
                <option value="">Choose an option</option>
                @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                  {{ $role->role_name }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleInputFirstName" class="form-label">First Name</label>
              <input type="text" value="{{old('first_name')}}" name="first_name" class="form-control" id="exampleInputFirstName" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputMiddleName" class="form-label">Middle Name</label>
              <input type="text" value="{{old('middle_name')}}" name="middle_name" class="form-control" id="exampleInputMiddleName" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputLastName" class="form-label">Last Name</label>
              <input type="text" value="{{old('last_name')}}" name="last_name" class="form-control" id="exampleInputLastName" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="exampleInputEmail" class="form-label">Email</label>
              <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="exampleInputEmail" required>
              @error('email')
              <p class="text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3">
              <label for="exampleInputBirthDate" class="form-label">Birth Date</label>
              <input type="date" value="{{old('date_of_birth')}}" name="date_of_birth" class="form-control" id="exampleInputBirthDate" required>
            </div>
            <div class="mb-3">
              <label for="exampleSelectGender" class="form-label">Gender</label>
              <select name="gender" class="form-control" id="exampleSelectGender" required>
                <option value="">Choose gender</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleInputAddress" class="form-label">Address</label>
              <input type="text" value="{{old('address')}}" name="address" class="form-control" id="exampleInputAddress" required>
            </div>
            <div class="mb-3" id="specializationField" style="display: none;">
              <label for="exampleInputSpecialization" class="form-label">Specialization</label>
              <textarea value="{{old('specialization')}}" name="specialization" class="form-control" id="exampleInputSpecialization"></textarea>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-light" href="{{route('user.index')}}">Cancel</a>
      </form>
    </div>
  </div>
</div>

<script>
  function checkRole() {
    var roleSelect = document.getElementById('exampleSelectOption');
    var specializationField = document.getElementById('specializationField');
    if (roleSelect.options[roleSelect.selectedIndex].text.toLowerCase() === 'patient') {
      specializationField.style.display = 'block';
    } else {
      specializationField.style.display = 'none';
    }
  }
</script>



@endsection