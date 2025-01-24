
<?php

use GuzzleHttp\Promise\Is;

include('./includes/connect.php');
session_start();
// echo $_SESSION['username'];
// echo $_SESSION['passengerUsername'];
// $sessionDriverName = $_SESSION['username'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./assets/img/taxi-img.png" type="image/x-icon" class="object-fit-cover" />
  <title>Home | City - Taxi</title>
  <h1>About Us Page</h1>

  <!-- Google Font (Sen) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <!-- Bootsrap CSS -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />



  <!-- External CSS -->
  <link rel="stylesheet" href="./assets/css/style.css" />

</head>

<body class="overflow-x-hidden">

 

  <!-- Footer -->
  <div class="bg-black">
    <div class="row gap-2 p-5">
      <div class="col-12 col-md-4">
        <div class="text-light">
          <h4 class="fw-bold">About City<span class="text-warning">Taxi</span></h4>
        </div>
        <p class="text-color">
          Meet City<span class="text-warning">Taxi</span> – your go-to for
          swift, safe rides! With a commitment to excellence, we offer
          seamless travel with a reliable fleet and professional drivers. Your
          journey, our priority. Choose us for a ride that exceeds
          expectations!
        </p>
        <div class="text-warning">
          <a href="https://www.facebook.com/mxmdaasik17?mibextid=ZbWKwL" target="_blank" class="text-decoration-none text-warning mx-3"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="https://wa.me/message/3XRINMPRVWI2O1" target="_blank" class="text-decoration-none text-warning mx-3"><i class="fa-brands fa-whatsapp"></i></a>
          <a href="https://www.linkedin.com/in/mohamed-aasik-08348425a" target="_blank" class="text-decoration-none text-warning mx-3"><i class="fa-brands fa-instagram"></i></a>
          <a href="https://www.linkedin.com/in/mohamed-aasik-08348425a" target="_blank" class="text-decoration-none text-warning mx-3"><i class="fa-brands fa-linkedin"></i></a>
        </div>
      </div>

      <div class="col-12 col-md-4"></div>
    </div>
  </div>


  <!-- Boostrap JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>

</html>



  </body>
</html>
