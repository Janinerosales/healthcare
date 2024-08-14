<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>LifeSure - Life Insurance Website Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link rel="stylesheet" href="front_page/lib/animate/animate.min.css" />
  <link href="front_page/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
  <link href="front_page/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


  <!-- Customized Bootstrap Stylesheet -->
  <link href="front_page/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="front_page/css/style.css" rel="stylesheet">
</head>

<body>
  <div class="header-carousel owl-carousel">
    <div class="header-carousel-item bg-primary">
      <div class="carousel-caption">
        <div class="container">
          <div class="row g-4 align-items-center">
            <div class="col-lg-7 animated fadeInLeft">
              <div class="text-sm-center text-md-start">
                <h4 class="text-white text-uppercase fw-bold mb-4">Welcome To LifeSure</h4>
                <h1 class="display-1 text-white mb-4">Life Insurance Makes You Happy</h1>
                <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy...
                </p>
                <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                  <a id="proceedButton" class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="#">Proceed</a>
                  <!-- <a class="btn btn-dark rounded-pill py-3 px-4 px-md-5 ms-2" href="#">Learn More</a> -->
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- Carousel End -->

  <!-- <div class="container center-container">
    <label id="label" for="proceedButton" class="h5"></label>
    <a id="proceedButton" class="btn btn-primary">Click here to proceed</a>
  </div> -->

  <script>
    document.getElementById('proceedButton').addEventListener('click', function(event) {
      event.preventDefault();


      fetch('/api/user', {
          method: 'GET',
          headers: {
            Authorization: 'Bearer ' + localStorage.getItem('TOKEN'),
            Accept: 'application/json',
          }
        }).then(response => response.json())
        .then(data => {
          console.log(data);
          window.location.href = '/patientRole/' + data.id;
        });
    })
  </script>
  <!-- Bootstrap JS, Popper.js, and jQuery -->
  <!-- Back to Top -->
  <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="front_page/lib/wow/wow.min.js"></script>
  <script src="front_page/lib/easing/easing.min.js"></script>
  <script src="front_page/lib/waypoints/waypoints.min.js"></script>
  <script src="front_page/lib/counterup/counterup.min.js"></script>
  <script src="front_page/lib/lightbox/js/lightbox.min.js"></script>
  <script src="front_page/lib/owlcarousel/owl.carousel.min.js"></script>


  <!-- Template Javascript -->
  <script src="front_page/js/main.js"></script>
</body>

</html>