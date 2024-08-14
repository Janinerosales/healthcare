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
  <h5 class="card-title fw-semibold mb-4">Edit Role</h5>
  <div class="card">
    <div class="card-body">
      <form action="{{route('role.update', $role->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="exampleInputFirstName" class="form-label">Role Name</label>
              <input type="text" value="{{$role->role_name}}" name="role_name" class="form-control @error('role_name') is-invalid @enderror" id="exampleInputFirstName" required>
              @error('role_name')
              <p class="text-danger">{{$message}}</p>
              @enderror
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-light" href="{{route('role.index')}}">Cancel</a>
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