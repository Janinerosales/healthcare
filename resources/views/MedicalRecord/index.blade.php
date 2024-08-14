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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="col-lg-12 d-flex align-items-stretch">
  <div class="card w-100">
    <div class="card-body p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold mb-0">Record Table</h5>
        <!-- <a href="{{route('user.create')}}" class="btn btn-primary">Add Doctor</a> -->
      </div>
      <div class="table-responsive">
        <table class="table text-nowrap mb-0 align-middle">
          <thead class="text-dark fs-4">
            <tr>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">#</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Profile</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Patient</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">No of Appointments</h6>
              </th>


            </tr>
          </thead>
          <tbody>
            @foreach($patients as $user)
            <tr>
              <td class="border-bottom-0">
                <h6 class="fw-semibold mb-0">{{($patients->currentPage() - 1) * $patients->perPage() + $loop->iteration }}</h6>
              </td>
              <td class="border-bottom-0">
                @if($user->profile_image)
                <img src="{{asset('storage/'. $user->profile_image)}}" alt="Profile" class="img-fluid rounded-circle" style="width: 40px; height: 40px;">
                @else
                <img src="images/profile_default.png" alt="Profile" class="img-fluid rounded-circle" style="width: 40px; height: 40px;">
                @endif
              </td>

              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{ $user->full_name }}</p>
              </td>
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{ count($user->appointments)}}</p>
              </td>
              <td class="border-bottom-0">
                <div class="d-flex">
                  <a href="{{route('record.edit', $user->id)}}" class="btn btn-sm btn-success me-2">
                    <i class="fas fa-eye"></i>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $patients->links() !!}
      </div>
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

@endsection