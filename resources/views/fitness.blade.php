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
          document.getElementById('userID').innerHTML =`<img width="35" height="35" class="rounded-circle" src="storage/${userImage}"/>` ;
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
        <h5 class="card-title fw-semibold mb-0">FITNESS</h5>
      </div>
      <div class="table-responsive">
        <table class="table text-nowrap mb-0 align-middle">
          <thead class="text-dark fs-4">
            <tr>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">#</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Image</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Name</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Age</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Phone Number</h6>
              </th>
              <th class="border-bottom-0">
                <h6 class="fw-semibold mb-0">Gender</h6>
              </th>
              <th class="border-bottom-0"></th>
            </tr>
          </thead>
          <tbody id="tableBody">
               
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>

fetch('http://fitandwells.online/api/allUsers', {
        method: 'GET',
    }).then(response => response.json())
    .then(response => {
        console.log(response.data);
        let tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';

        for(let i = 0; i < response.data.length; i++){
            let row = '<tr>' +
                        '<td>' + response.data[i].id + '</td>' +
                        '<td><img src="http://fitandwells.online/storage/' + response.data[i].avatar + '" alt="Product Image" style="width: 50px; height: 50px;"></td>' +
                        '<td>' + response.data[i].name + '</td>' +
                        '<td>' + response.data[i].age + '</td>' +
                        '<td>' + response.data[i].phone_number + '</td>' +
                        '<td>' + response.data[i].gender + '</td>' +
                      '</tr>';

            tbody.innerHTML += row;
        }
    })
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

@endsection