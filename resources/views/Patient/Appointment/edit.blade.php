<div class="modal fade" id="editUserModal{{$appointment->id}}" tabindex="-1" aria-labelledby="editUserModalLabel{{$appointment->id}}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel{{$appointment->id}}">Edit Appointment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning">
          Note: You can't Edit Doctor.
        </div>
        <div class="card-body">
          <!-- <h5 class="card-title fw-semibold mb-4">Edit Appointment</h5> -->
          <div class="card">
            <div class="card-body">
              <form action="{{route('appointment.update', $appointment->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="status" value="Pending">
                <input type="hidden" name="user_id" value="{{$appointment->user_id}}">
                <input type="hidden" name="profile_id" value="{{$appointment->profile_id}}">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="appointmentDate" class="form-label">Appointment Date</label>

                      <input type="date" name="appointment_date" value="{{$appointment->appointment_date}}" class="form-control @error('appointment_date') is-invalid @enderror" id="appointmentDate" required>
                      @error('appointment_date')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="appointmentDate" class="form-label">Doctor </label>

                      <input type="text" readonly value="{{$appointment->doctor->full_name ?? 'Not Approved Yet'}}" class="form-control @error('appointment_date') is-invalid @enderror" id="appointmentDate" required>
                      @error('appointment_date')
                      <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="requestSelect" class="form-label">Add Request</label>
                      <select name="requests" class="form-control" id="requestSelect" required>
                        <option value="">Choose an option</option>
                        @if ($appointment->requests)
                        <option selected value="{{ $appointment->requests }}">{{ $appointment->requests }}
                        </option>
                        @else
                        <option selected value="" disabled>Select Doctor</option>
                        @endif
                        <option value="Consultation">Consultation</option>
                        <option value="Laboratory">Laboratory</option>
                        <option value="Procedure">Procedure</option>



                        <!-- Add more options as needed -->
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
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