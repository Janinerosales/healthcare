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
        let userImage = response.profile_image
        if(userImage){
          //<img id="userID" width="35" height="35" class="rounded-circle">
          document.getElementById('userID').innerHTML =`<img width="35" height="35" class="rounded-circle" src="storage/${userImage}"/>` ;
        }else{
          document.getElementById('userID').src =  'images/profile_default.png';
        }
        if (response.role_id == 2) {
          // document.querySelector('#admin').classList.add('d-block');
          window.location.href = '/patientRole/' + response.id;
        }
        // console.log(response);
      });
  });
</script>
<div class="card-body">
  <h5 class="card-title fw-semibold mb-4">Create Doctor</h5>
  <div class="card">
    <div class="card-body">
      <form action="{{route('doctor.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="exampleInputImage" class="form-label">Profile Image</label>
              <input type="file" name="profile_image" class="form-control" id="exampleInputImage" accept="image/*">
            </div>
            <input type="hidden" value="Doctor" name="role" class="form-control" id="exampleInputFirstName" required>
            <div class="mb-3">
              <label for="exampleInputFirstName" class="form-label">Full Name</label>
              <input type="text" value="{{old('full_name')}}" name="full_name" class="form-control" id="exampleInputFirstName" required>
            </div>
            <!-- <div class="mb-3">
              <label for="exampleInputLastName" class="form-label">Last Name</label>
              <input type="text" value="{{old('last_name')}}" name="last_name" class="form-control" id="exampleInputLastName" required>
            </div> -->
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="exampleInputEmail" class="form-label">Email</label>
              <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="exampleInputEmail" required>
              @error('email')
              <p class="text-danger">{{$message}}</p>
              @enderror
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