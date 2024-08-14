@extends('home')
@section('content')
<div class="card-body">
  <h5 class="card-title fw-semibold mb-4">Create Appointment</h5>
  <div class="card">
    <div class="card-body">
      <form action="{{route('appointment.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="status" value="Pending">
        <input type="hidden" name="user_id" id="userID">
        <input type="hidden" name="profile_id" id="profileIdInput">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="appointmentDate" class="form-label">Appointment Date</label>
              <input type="date" name="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror" id="appointmentDate" required>
              @error('appointment_date')
              <p class="text-danger">{{$message}}</p>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="roleSelect" class="form-label">Doctor</label>
              <select name="doctor_id" class="form-control" id="roleSelect" required>
                <option value="">Choose an option</option>
                @foreach($doctors as $doctor)
                <option value="{{$doctor->id}}">{{$doctor->full_name}}</option>
                @endforeach
                <!-- Add more options as needed -->
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="requestSelect" class="form-label">Add Request</label>
              <select name="requests" class="form-control" id="requestSelect" required>
                <option value="">Choose an option</option>
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
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-light" href="{{route('patient.index')}}">Cancel</a>
          </div>
        </div>
      </form>
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
        console.log(response.id);
        document.getElementById('userID').value = response.id;
      });
  });
</script>

@endsection