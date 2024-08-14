<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="shortcut icon" type="image/png" href="dash_board/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="dash_board/assets/css/styles.min.css" />
  <script>
    let token = localStorage.getItem('TOKEN');
    if (token) {
      window.location.href = '/dashboard';
    }
  </script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <h4 class="fw-semibold mb-0">Health-Care-System</h4>

                  <!-- <img src="dash_board/assets/images/logos/dark-logo.svg" width="180" alt=""> -->
                </a>
                <p class="text-center">Your Health is Our Priority</p>
                <form id="LoginForm" method="POST">
                  <div id="message" class="text-danger"></div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>

                </form>
                <form id="Otp">
                  <div id="message3" class="text-danger"></div>
                  <div class="otp-input d-none">
                    <input type="hidden" name="email" class="form-control my-4 py-2" readonly />
                    <input type="number" name="otp" class="form-control my-4 py-2" placeholder="Enter OTP" />
                    <div class="text-center mt-3">
                      <button type="submit" class="btn btn-primary">Verify</button>
                      <div>
                      </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.getElementById('LoginForm').addEventListener('submit', function(event) {
      event.preventDefault();


      formData = new FormData(this);

      fetch('/api/login', {
        method: 'POST',
        body: formData,
        headers: {
          Accept: 'application/json',
        }
      }).then(response => {
        // dd(response);
        return response.json();
      }).then(response => {
        // console.log(response.data)
        if (response.message == 'OTP sent successfully') {

          const emailValue = formData.get('email');

          document.querySelector('.otp-input input[name="email"]').value = emailValue;

          document.getElementById('LoginForm').classList.add('d-none');
          document.querySelector('.otp-input').classList.remove('d-none');
        } else {
          document.getElementById('message').textContent = response.message;
        }
      });
    });


    document.getElementById('Otp').addEventListener('submit', function(event) {
      event.preventDefault();

      formData = new FormData(this);

      console.log(formData);
      fetch('/api/loginVerify', {
        method: 'POST',
        body: formData,
        headers: {
          Accept: 'application/json',
        }
      }).then(response => {
        return response.json();
      }).then(response => {
        console.log(response.message);
        if (response.role_id == '2') {
          if (response.token) {
            localStorage.setItem('TOKEN', response.token);
            Swal.fire({
              icon: 'success',
              title: 'Login Successfully!',
              showConfirmButton: false,
              timer: 2500
            }).then(() => {
              window.location.href = '/patientRole';
            })
          } else {
            window.alert(response.message);

          }
        }
        if (response.role_id == '3') {
          if (response.token) {
            localStorage.setItem('TOKEN', response.token);
            Swal.fire({
              icon: 'success',
              title: 'Login Successfully!',
              showConfirmButton: false,
              timer: 2500
            }).then(() => {
              window.location.href = '/doctor-dashboard';
            })
          } else {
            window.alert(response.message);

          }
        } else {
          if (response.token) {
            localStorage.setItem('TOKEN', response.token);
            Swal.fire({
              icon: 'success',
              title: 'Login Successfully!',
              showConfirmButton: false,
              timer: 2500
            }).then(() => {
              window.location.href = '/dashboard';
            })
          } else {
            window.alert(response.message);

          }
        }

      });
    });
  </script>
  <script src="dash_board/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="dash_board/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>