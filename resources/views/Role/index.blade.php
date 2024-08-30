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
        let userImage = response.profile_image
        if(userImage){
          //<img id="userID" width="35" height="35" class="rounded-circle">
          document.getElementById('userID').innerHTML =`<img width="35" height="35" class="rounded-circle" src= "storage/${userImage}"/>` ;
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="col-lg-12 d-flex align-items-stretch">
  <div class="card w-100">
    <div class="card-body p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold mb-0">Role Table</h5>
        <a href="{{route('role.create')}}" class="btn btn-primary">Add Role</a>
      </div>
      <div class="table-responsive">
        <table class="table text-nowrap mb-0 align-middle">
          <thead class="text-dark fs-4">
            <tr>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">#</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Role Name</h6>
              </th>
              <th class="border-bottom-0"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($roles as $role)
            <tr>
              <td class="border-bottom-0">
                <h6 class="fw-semibold mb-0">{{ ($roles->currentPage() - 1) * $roles->perPage() + $loop->iteration }}</h6>
              </td>
              <td class="border-bottom-0">
                <h6 class="fw-semibold mb-0">{{ $role->role_name }}</h6>
              </td>

              <td class="border-bottom-0">
                <div class="d-flex">
                  <!-- <a href="{{route('role.edit', $role->id)}}" class="btn btn-sm btn-info me-2">
                    <i class="fas fa-edit"></i>
                  </a> -->
                  @if($role->role_name == 'Admin' || $role->role_name == 'Patient' || $role->role_name == 'Nurse' || $role->role_name == 'Doctor')
                  @else
                  <a href="#" class="btn btn-sm btn-success me-2" data-bs-toggle="modal" data-bs-target="#editUserModal{{$role->id}}">
                    <i class="fas fa-eye"></i>
                  </a>
                  @include('Role.view')
                  <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$role->id}}">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                  @include('Role.delete')
                  @endif
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $roles->links() !!}
      </div>
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

@endsection