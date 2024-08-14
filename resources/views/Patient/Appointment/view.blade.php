<div class="modal fade" id="editUserModal{{$patient->id}}" tabindex="-1" aria-labelledby="editUserModalLabel{{$patient->id}}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel{{$patient->id}}">View Patient</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- <h5 class="card-title fw-semibold mb-4">Edit Patient</h5> -->
      <div class="card">
        <div class="card-body">
          <form action="{{route('patient.update', $patient->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6">
                <div class="text-center mb-3">
                  @if($patient->profile_image)
                  <img src="{{asset('storage/'.$patient->profile_image)}}" alt="Profile Image" id="profileImageView" class="img-fluid rounded-circle" style="width: 190px; height: 190px;">
                  @else
                  <img src="{{asset('images/profile_default.png')}}" alt="Profile Image" id="profileImageView" class="img-fluid rounded-circle" style="width: 190px; height: 190px;">
                  @endif

                </div>
                <div class="mb-3">
                  <label for="exampleInputImage" class="form-label">Profile Image</label>
                  <input type="file" value="{{$patient->profile_image}}" name="profile_image" class="form-control" id="exampleInputImage" accept="image/*" onchange="previewImage(event)">
                </div>
                <div class="mb-3">
                  <label for="exampleInputFirstName" class="form-label">First Name</label>
                  <input type="text" value="{{$patient->first_name}}" name="first_name" class="form-control" id="exampleInputFirstName" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputMiddleName" class="form-label">Middle Name</label>
                  <input type="text" value="{{$patient->middle_name}}" name="middle_name" class="form-control" id="exampleInputMiddleName" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputLastName" class="form-label">Last Name</label>
                  <input type="text" value="{{$patient->last_name}}" name="last_name" class="form-control" id="exampleInputLastName" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleInputEmail" class="form-label">Email</label>
                  <input type="email" value="{{$patient->email}}" name="email" class="form-control" id="exampleInputEmail" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputBirthDate" class="form-label">Birth Date</label>
                  <input type="date" value="{{$patient->date_of_birth}}" name="date_of_birth" class="form-control" id="exampleInputBirthDate" required>
                </div>
                <div class="mb-3">
                  <label for="exampleSelectGender" class="form-label">Gender</label>
                  <select name="gender" class="form-control" id="exampleSelectGender" required>
                    <option value="">Choose gender</option>
                    <option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>Female</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="exampleInputAddress" class="form-label">Address</label>
                  <input type="text" value="{{$patient->address}}" name="address" class="form-control" id="exampleInputAddress" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputAddress" class="form-label text-danger">User Email</label>
                  <input type="text" value="{{$patient->user->email}}" class="form-control" id="exampleInputAddress" readonly>
                </div>
                <div class="mb-3">
                  <label for="exampleInputAddress" class="form-label text-danger">Temporary Password</label>
                  <input type="text" value="healthcare2024" class="form-control" id="exampleInputAddress" readonly>
                </div>
                <!-- <div class="mb-3" id="specializationField">
              <label for="exampleInputSpecialization" class="form-label">Specialization</label>
              <textarea name="specialization" class="form-control" id="exampleInputSpecialization">{{$patient->specialization}}</textarea>
            </div> -->

              </div>
            </div>
            <!-- <button type="submit" class="btn btn-primary">Update</button> -->
            <a class="btn btn-light" href="{{route('patient.index')}}">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>