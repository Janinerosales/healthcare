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
        let userImage = 'storage/' + response.profile_image
        if(userImage){
          //<img id="userID" width="35" height="35" class="rounded-circle">
          document.getElementById('userID').innerHTML =`<img width="35" height="35" class="rounded-circle" src="${userImage}"/>` ;
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
@php
  use App\Models\Profile;
@endphp
<div class="col-lg-12 d-flex align-items-stretch">
  <div class="card w-100">
    <div class="card-body p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold mb-0">Appointments</h5>
      </div>
      <div class="table-responsive">
        <table class="table text-nowrap mb-0 align-middle">
          <thead class="text-dark fs-4">
            <tr>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">#</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Patient</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Date</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Requests</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Doctor</h6>
              </th>
              <th class="border-bottom-0"></th>
              <th class="border-bottom-0"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($appointments as $appointment)
            <tr>
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{($appointments->currentPage() - 1) * $appointments->perPage() + $loop->iteration }}</p>
              </td>
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{$appointment->profile->full_name ?? 'deleted patient'}}</p>
              </td>
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{$appointment->appointment_date}}</p>
              </td>
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{$appointment->requests}}</p>
              </td>
              @php
            

                  $doctor = Profile::find($appointment->doctor_id)->full_name ?? 'Not Assigned Yet';
              // dump($doctor);
              @endphp
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{$doctor ?? 'Not Assigned Yet'}}</p>
              </td>
              <td class="border-bottom-0">
                <div class="d-flex flex-wrap">
                  @if(!empty($appointment->profile->id))
                  @if($appointment->status == 'Approved')
                  <a href="#" class="btn btn-sm btn-danger me-2 mb-2" data-bs-toggle="modal" data-bs-target="#rejectUserModal{{$appointment->id}}">
                    <i class="fas fa-thumbs-down"></i> Reject
                  </a>
                  @endif
                  @if($appointment->status == 'Pending')
                  <a href="#" class="btn btn-sm btn-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#approveUserModal{{$appointment->id}}">
                    <i class="fas fa-thumbs-up"></i> Approved
                  </a>
                  @endif
                  @include('Patient.Appointment.update')
                  <a href="" class="btn btn-sm btn-info me-2 mb-2" data-bs-toggle="modal" data-bs-target="#editUserModal{{$appointment->id}}">
                    <i class="fas fa-edit"></i>
                  </a>
                  @include('Patient.Appointment.edit')
                  <a href="#" class="btn btn-sm btn-danger me-2 mb-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{$appointment->id}}">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                  @include('Patient.Appointment.delete')

                  @if(!empty($appointment->prescription))
                  <a href="#" class="btn btn-sm btn-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#viewPrescriptionModal{{$appointment->id}}">
                    <i class="fas fa-eye"></i> View Prescription
                  </a>
                  @include('Prescription.view')
                  @include('Prescription.delete')
                  @else
                  @if($appointment->status == 'Approved')
                  <a href="#" class="btn btn-sm btn-primary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#createPrescriptionModal{{$appointment->id}}">
                    <i class="fas fa-prescription"></i> Add Prescription
                  </a>
                  @endif

                  @include('Prescription.create')
                  @endif
                  
                  @else
                  <a href="#" class="btn btn-sm btn-danger me-2 mb-2" data-bs-toggle="modal" data-bs-target="#createPrescriptionModal{{$appointment->id}}">
                    <i class="fas fa-warning"></i>
                  </a>
                  @endif

                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $appointments->links() !!}
      </div>
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@endsection