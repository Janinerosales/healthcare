<div class="modal fade" id="editUserModal{{$user->id}}" tabindex="-1" aria-labelledby="editUserModalLabel{{$user->id}}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel{{$user->id}}">View User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
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
                <input type="file" value="{{$user->profile_image}}" name="profile_image" class="form-control" id="exampleInputImage" accept="image/*" onchange="previewImage(event)" readonly>
              </div>
              <div class="mb-3">
                <label for="exampleInputFirstName" class="form-label">First Name</label>
                <input type="text" value="{{$user->first_name}}" name="first_name" class="form-control" id="exampleInputFirstName" readonly>
              </div>
              <div class="mb-3">
                <label for="exampleInputMiddleName" class="form-label">Middle Name</label>
                <input type="text" value="{{$user->middle_name}}" name="middle_name" class="form-control" id="exampleInputMiddleName" readonly>
              </div>
              <div class="mb-3">
                <label for="exampleInputLastName" class="form-label">Last Name</label>
                <input type="text" value="{{$user->last_name}}" name="last_name" class="form-control" id="exampleInputLastName" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="exampleInputEmail" class="form-label">Email</label>
                <input type="email" value="{{$user->email}}" name="email" class="form-control" id="exampleInputEmail" readonly>
              </div>
              <div class="mb-3">
                <label for="exampleInputBirthDate" class="form-label">Birth Date</label>
                <input type="date" value="{{$user->date_of_birth}}" name="date_of_birth" class="form-control" id="exampleInputBirthDate" readonly>
              </div>
              <div class="mb-3">
                <label for="exampleSelectGender" class="form-label">Gender</label>
                <select disabled name="gender" class="form-control" id="exampleSelectGender" readonly>
                  <option value="">Choose gender</option>
                  <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="exampleInputAddress" class="form-label">Address</label>
                <input type="text" value="{{$user->address}}" name="address" class="form-control" id="exampleInputAddress" readonly>
              </div>
              <div class="mb-3">
                <label for="exampleInputAddress" class="form-label text-danger">User Email</label>
                <input type="text" value="{{$user->user->email}}" name="address" class="form-control" id="exampleInputAddress" readonly>
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
          <!-- <button type="submit" class="btn btn-primary">Update</button> -->
          <!-- <a class="btn btn-light" href="javascript:history.back()">Cancel</a> -->
        </form>
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
  </div>


</div>