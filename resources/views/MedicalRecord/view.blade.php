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
<style>
  .container {
    padding: 20px;
  }

  .record-table {
    margin-top: 20px;
  }

  .card {
    margin-bottom: 20px;
  }

  .card-header {
    background-color: #007bff;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .record-table th,
  .record-table td {
    vertical-align: middle;
  }

  .record-table th {
    background-color: #343a40;
    color: white;
  }

  .img-fluid {
    max-width: 100%;
    height: auto;
  }

  .rounded-circle {
    border-radius: 50%;
  }

  @media (max-width: 768px) {
    .container {
      padding: 10px;
    }

    .card-header {
      flex-direction: column;
      align-items: flex-start;
    }
  }

  @media print {
    body * {
      visibility: hidden;
    }

    .print-container,
    .print-container * {
      visibility: visible;
    }

    .print-container {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
    }

    .card-header button {
      display: none;
    }

    @page {
      size: landscape;
    }
  }
</style>

<div class="container print-container">
  <div class="card">
    <div class="card-header">
      <h3>Patient Medical Records</h3>
      <button onclick="window.print()" class="btn btn-danger">
        <i class="fas fa-print"></i> Print
      </button>
    </div>
    <div class="card-body">
      <h5 class="card-title">Patient Information</h5>
      <div class="row">
        <div class="col-md-4">
          <p><strong>Name:</strong> {{$profile->full_name}}</p>
          <p><strong>Age:</strong> {{$profile->age}}</p>
          <p><strong>Gender:</strong> {{ucfirst($profile->gender)}}</p>
        </div>
        <div class="col-md-4">
          <p><strong>Address:</strong> {{$profile->address}}</p>
          <p><strong>Medical History:</strong>
            @if($profile->prescription->isEmpty())
            No medical history available.
            @else
            {{ $profile->prescription->pluck('medication')->implode(', ') }}
            @endif
          </p>
          <p><strong>Allergies:</strong> None</p>
        </div>
        <div class="col-md-4 text-center">
          @if($profile->profile_image)
          <img src="{{asset('storage/'. $profile->profile_image)}}" class="img-fluid rounded-circle" style="width: 150px; height: 150px;" alt="Patient Photo">
          @else
          <img src="{{asset('images/profile_default.png')}}" class="img-fluid rounded-circle" style="width: 150px; height: 150px;" alt="Patient Photo">
          @endif
        </div>
      </div>
      <h5 class="mt-4">Medical Records</h5>
      <table class="table table-bordered record-table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Treatments</th>
            <th scope="col">Medication</th>
            <th scope="col">Description</th>
          </tr>
        </thead>
        <tbody>
          @foreach($profile->appointments as $appointment)
          <tr>
            <td>{{$appointment->created_at}}</td>
            <td>{{$appointment->requests}}</td>
            <td>{{$appointment->prescription->medication ?? ''}}</td>
            <td>{{$appointment->prescription->description ?? ''}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@endsection