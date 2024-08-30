@extends('DoctorRole.home')
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
          document.getElementById('userID').src = userImage;
        }else{
          document.getElementById('userID').src =  'images/profile_default.png';
        }
        if (response.role_id == 2) {
          // document.querySelector('#admin').classList.add('d-block');
          window.location.href = '/patientRole/' + response.id;
        }else if((response.role_id == 1)){
          document.querySelector('#admin').classList.remove('d-none');
          document.querySelector('#Byroles').classList.add('d-none');
        }
        // console.log(response);
      });
  });
</script>
<div id="admin" class="d-none">
  <div class="row">
    <div class="col-lg-8 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-4">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Appointment Overview</h5>
            </div>
          </div>
          <!-- Summary Section -->
          <div class="row mb-4">
            <div class="col-md-4">
              <div class="overview-item">
                <h6>Total Appointments</h6>
                <p class="text-primary">{{$totalAppointment}}</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="overview-item">
                <h6>Upcoming Appointments</h6>
                <p class="text-warning">{{$upcomingAppointment}}</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="overview-item">
                <h6>Completed Appointments</h6>
                <p class="text-success">{{$completedAppointment}}</p>
              </div>
            </div>
          </div>
          <!-- Statistics Section -->
          <div class="row mb-4">
            <div class="col-md-4">
              <div class="overview-item">
                <h6>Today's Appointments</h6>
                <p class="text-info">{{$todayAppointment}}</p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="overview-item">
                <h6>Rescheduled Appointments</h6>
                <p class="text-secondary">{{$rescheduleAppointment}}</p>
              </div>
            </div>
          </div>
          <!-- Chart Section -->

        </div>
      </div>
    </div>

    <style>
      .overview-item h6 {
        margin-bottom: 10px;
        font-weight: bold;
      }

      .overview-item p {
        font-size: 18px;
      }
    </style>

    <div class="col-lg-4">
      <div class="row">
        <div class="col-lg-12">
          <!-- Yearly Breakup -->
          <div class="card overflow-hidden">
            <div class="card-body p-4">
              <h5 class="card-title mb-9 fw-semibold">Total Patient</h5>
              <div class="row align-items-center">
                <div class="col-8">
                  <h4 class="fw-semibold mb-3">{{$totalPatient}}</h4>
                  <div class="d-flex align-items-center mb-3">

                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <!-- Monthly Earnings -->
            <!-- <div class="card">

              <div id="earning"></div>
            </div> -->
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<div id="Byroles" class="d-block">
  <div class="row">
    <div class="col-lg-8 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-4">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Appointment Overview</h5>
            </div>
          </div>
          <!-- Summary Section -->
          <div class="row mb-4">
            <div class="col-md-4">
              <div class="overview-item">
                <h6>Total Appointments</h6>
                <p class="text-primary">{{$totalAppointment}}</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="overview-item">
                <h6>Upcoming Appointments</h6>
                <p class="text-warning">{{$upcomingAppointment}}</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="overview-item">
                <h6>Completed Appointments</h6>
                <p class="text-success">{{$completedAppointment}}</p>
              </div>
            </div>
          </div>
          <!-- Statistics Section -->
          <div class="row mb-4">
            <div class="col-md-4">
              <div class="overview-item">
                <h6>Today's Appointments</h6>
                <p class="text-info">{{$todayAppointment}}</p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="overview-item">
                <h6>Rescheduled Appointments</h6>
                <p class="text-secondary">{{$rescheduleAppointment}}</p>
              </div>
            </div>
          </div>
          <!-- Chart Section -->

        </div>
      </div>
    </div>

    <style>
      .overview-item h6 {
        margin-bottom: 10px;
        font-weight: bold;
      }

      .overview-item p {
        font-size: 18px;
      }
    </style>


  </div>
</div>

@endsection