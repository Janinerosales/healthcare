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
<div class="modal fade" id="viewPrescriptionModal{{$appointment->id}}" tabindex="-1" aria-labelledby="viewPrescriptionModalLabel{{$appointment->id}}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewPrescritionModalLabel{{$appointment->id}}">Prescription</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <!-- <h5 class="card-title fw-semibold mb-4">Edit Appointment</h5> -->
          <div class="card">
            <div class="card-body">
              <form action="{{route('prescription.update', $appointment->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="profile_id" value="{{$appointment->profile_id}}">
                <input type="hidden" name="doctor_id" value="{{$appointment->doctor->id ?? ''}}">
                <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                <div class="row">

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="exampleInputFirstName" class="form-label">Medication </label>
                      <textarea type="text" name="medication" class="form-control @error('medication') is-invalid @enderror" id="exampleInputFirstName" required>{{$appointment->prescription->medication}}</textarea>
                      @error('medication')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="exampleInputFirstName" class="form-label">Dosage </label>
                      <input type="number" value="{{$appointment->prescription->dosage}}" name="dosage" class="form-control @error('dosage') is-invalid @enderror" id="exampleInputFirstName" required>
                      @error('dosage')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="exampleInputFirstName" class="form-label">Issued Date </label>
                      <input type="date" value="{{$appointment->prescription->issued_date}}" name="issued_date" class="form-control @error('issued_date') is-invalid @enderror" id="exampleInputFirstName" required>
                      @error('issued_date')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="exampleInputFirstName" class="form-label">Renew Date </label>
                      <input type="date" value="{{$appointment->prescription->renew_date}}" name="renew_date" class="form-control @error('renew_date') is-invalid @enderror" id="exampleInputFirstName">
                      @error('renew_date')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="appointmentDate" class="form-label">Image I </label>
                      @if($appointment->prescription->image_1)
                      <img src="{{ asset($appointment->prescription->image_1) }}" alt="Image I" class="img-thumbnail mb-2" style="max-width: 100px;">
                      @endif
                      <input type="file" name="image_1" class="form-control @error('image_1') is-invalid @enderror" id="appointmentDate">
                      @error('image_1')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="appointmentDate" class="form-label">Image II </label>
                      @if($appointment->prescription->image_2)
                      <img src="{{ asset($appointment->prescription->image_2) }}" alt="Image II" class="img-thumbnail mb-2" style="max-width: 100px;">
                      @endif
                      <input type="file" name="image_2" class="form-control @error('image_2') is-invalid @enderror" id="appointmentDate">
                      @error('image_2')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="appointmentDate" class="form-label">Description </label>
                      <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="appointmentDate">{{$appointment->prescription->description}}</textarea>
                      @error('description')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletePModal{{$appointment->prescription->id}}">
                      <i class="fas fa-trash-alt"></i>
                    </a>

                    <a class="btn btn-light" href="">Cancel</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>