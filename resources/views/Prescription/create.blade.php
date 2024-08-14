<div class="modal fade" id="createPrescriptionModal{{$appointment->id}}" tabindex="-1" aria-labelledby="createPrescriptionModalLabel{{$appointment->id}}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createPrescritionModalLabel{{$appointment->id}}">Add Prescription</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <!-- <h5 class="card-title fw-semibold mb-4">Edit Appointment</h5> -->
          <div class="card">
            <div class="card-body">
              <form action="{{route('prescription.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="profile_id" value="{{$appointment->profile_id}}">
                <input type="hidden" name="doctor_id" value="{{$appointment->doctor->id ?? ''}}">
                <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                <div class="row">

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="exampleInputFirstName" class="form-label">Medication </label>
                      <textarea type="text" name="medication" class="form-control @error('medication') is-invalid @enderror" id="exampleInputFirstName" required> </textarea>
                      @error('medication')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="exampleInputFirstName" class="form-label">Dosage </label>
                      <input type="number" name="dosage" class="form-control @error('dosage') is-invalid @enderror" id="exampleInputFirstName" required> </input>
                      @error('dosage')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="exampleInputFirstName" class="form-label">Issued Date </label>
                      <input type="date" name="issued_date" class="form-control @error('issued_date') is-invalid @enderror" id="exampleInputFirstName" required> </input>
                      @error('issued_date')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>

                  <label for="exampleInputFirstName" class="form-label">Attach Image </label>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="appointmentDate" class="form-label">Image I </label>

                      <input type="file" readonly name="image_1" class="form-control @error('image_2') is-invalid @enderror" id="appointmentDate" required>
                      @error('image_1')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="appointmentDate" class="form-label">Image II </label>

                      <input type="file" readonly name="image_2" class="form-control @error('image_2') is-invalid @enderror" id="appointmentDate" required>
                      @error('image_2')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="appointmentDate" class="form-label">Description </label>

                      <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="appointmentDate" required> </textarea>
                      @error('description')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-light" href="">Cancel</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener("DOMContentLoaded", function() {
          const queryString = window.location.search;
          const profileId = queryString.substring(1);
          document.getElementById('profileIdInput').value = profileId;

          fetch('/api/user', {
              method: 'GET',
              headers: {
                Authorization: 'Bearer ' + localStorage.getItem('TOKEN'),
                Accept: 'application/json',
              }
            }).then(response => response.json())
            .then(response => {
              // console.log(response.id);
              document.getElementById('userID').value = response.id;
            });
        });
      </script>
    </div>
  </div>
</div>