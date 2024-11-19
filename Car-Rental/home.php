<?php
ob_start();
session_start();
if (isset($_SESSION["adm"])) {
  header("Location: dashboard.php");
}
if (!isset($_SESSION["adm"]) && !isset($_SESSION["user"])) {
  header("Location: login.php");
}
require_once "components/db_connect.php";

$sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
// echo $sql;
$result = mysqli_query($connect, $sql);
$row1 = mysqli_fetch_assoc($result);
// print_r($row1);

$sql = "SELECT * FROM cars";

$result = mysqli_query($connect, $sql);

$cards = "";

if (mysqli_num_rows($result) > 0) {
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($rows as $row) {
    // print_r($row);
    $statusError = "";
    $buttonDisablen = "";
    if (($row["status"]) == 'RESERVED') {
      $buttonDisablen = "disabled";
      $statusError = "Car not available";
    }
    // print_r($buttonDisablen);
    $cards .= "<div>
               <div class='card mx-auto my-3'>
                   <img src='pictures/{$row['picture']}' class='card-image-top mx-auto' alt='image'>
                   <div class='card-body'>
                   <h5 class='card-title fw-bold text-center'>{$row['brand']} {$row['model']}</h5>
                   <p class='card-text fw-bold text-center'>Price per day: {$row['price_day']}€</p>
                    <p class='card-text1 fw-bold text-center'>Price per hour: {$row['price_hour']}€</p>
                     <p class='card-text2 fw-bold text-center'>Price per minute: {$row['price_minute']}€</p>
                   <div class='text-center'>
                      <a href='details.php?id=$row[id]' class='{$buttonDisablen} btn btn-lg btn-secondary mx-4 my-3'>Details</a>
                      <a href='booking.php?id=$row[id]' class='{$buttonDisablen} btn btn-lg btn-warning mx-4 my-3'>Book a car</a>
                     <p class='error-text fw-bold'>$statusError</p>
                  </div>
               </div>
           </div>
         </div>";
  }
} else {
  $cards = "<h3>No results found</h3>";
}

mysqli_close($connect);
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome <?= $row1['first_name'] ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Indie+Flower&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&family=Doppio+One&family=Indie+Flower&family=Madimi+One&family=Ramaraja&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&family=Unkempt:wght@400;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&family=Coda:wght@400;800&family=Doppio+One&family=Goldman:wght@400;700&family=Indie+Flower&family=Limelight&family=Madimi+One&family=Ramaraja&family=Skranji:wght@400;700&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&family=Unkempt:wght@400;700&family=Yusei+Magic&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&family=Coda:wght@400;800&family=Doppio+One&family=Goldman:wght@400;700&family=Indie+Flower&family=Limelight&family=Madimi+One&family=Ramaraja&family=Skranji:wght@400;700&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&family=Unkempt:wght@400;700&family=Yusei+Magic&display=swap');
    .header1 {
      font-size: 5rem;
      font-family: "Indie Flower", serif;
      font-weight: 400;
      font-style: normal;
      color: #640007;
      text-shadow: 5px 5px 15px whitesmoke;
      animation: tada;
      animation-duration: 5s;
      --animate-delay: 0.9s;
    }
    .header2 {
      font-size: 5rem;
      font-family: "Indie Flower", serif;
      font-weight: 400;
      font-style: normal;
      color: #c70054;
      text-shadow: 5px 5px 15px whitesmoke;
      animation: flash;
      animation-duration: 5s;
      --animate-delay: 0.9s;
    }
    .image {
      width: 80px;
      height: auto;
    }
    .hero {
      display: flex;
      align-items: center;
      justify-content: center;

    }
    .hero img {
      max-width: 550px;
      margin-right: 20px;
    }
    .text1 {
      font-size: 1.8rem;
      font-family: "Yusei Magic", serif;
      font-weight: 400;
      font-style: normal;
      color: #395112;
    }
    .card-header {
      font-size: 2.5rem;
    }
    .card-image-top {
      width: 100%;
      height: 300px;
    }
    .card-title {
      font-size: 2.2rem;
      font-family: "Indie Flower", serif;
      font-weight: 400;
      font-style: normal;
      color: #640007;

    }
    .card-text {
      font-size: 1.3rem;
      font-family: "Unkempt", serif;
      font-weight: 700;
      font-style: normal;
      color: #639744;
    }
    .card-text1 {
      font-size: 1.3rem;
      font-family: "Unkempt", serif;
      font-weight: 700;
      font-style: normal;
      color: #fe47af;
    }
    .card-text2 {
      font-size: 1.3rem;
      font-family: "Unkempt", serif;
      font-weight: 700;
      font-style: normal;
      color: #c70054;
    }
    .error-text {
      font-size: 1.1rem;
      font-family: "Skranji", serif;
      font-weight: 700;
      font-style: normal;
      letter-spacing: 0.5;
      color: #D71232;
    }
    .bg-image {
      background-image: url(https://cdn.pixabay.com/photo/2016/11/29/01/54/wood-1866667_1280.jpg);
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: auto;
      margin: 0;
    }
    #neonShadow {
      height: 30px;
      width: 100px;
      border: none;
      border-radius: 50px;
      transition: 0.3s;
      background-color: rgba(156, 161, 160, 0.3);
      animation: glow 1s infinite;
      transition: 0.5s;
      text-decoration: none;
      margin-block: 15rem;
      font-size: 1.5rem;
      font-family: "Skranji", system-ui;
      font-weight: 700;
      font-style: normal;
      padding: 2rem;
      margin: 5rem;
      color: #640007;
    }
    #neonShadow:hover {
      transform: translateX(-20px)rotate(30deg);
      border-radius: 5px;
      background-color: #c3bacc;
      transition: 0.5s;
    }
    @keyframes glow {
      0% {
        box-shadow: 5px 5px 20px rgb(93, 52, 168), -5px -5px 20px rgb(93, 52, 168);
      }

      50% {
        box-shadow: 5px 5px 20px rgb(81, 224, 210), -5px -5px 20px rgb(81, 224, 210)
      }

      100% {
        box-shadow: 5px 5px 20px rgb(93, 52, 168), -5px -5px 20px rgb(93, 52, 168)
      }
    }
  </style>
</head>

<body>
  <nav class="navbar sticky-top bg-dark navbar-expand-lg bg-body-secondary fs-5">
    <div class="container-fluid">
      <div class="w-1">
        <img class="image"
          src="https://img.freepik.com/premium-vector/car-rental-logo-template-design_316488-1614.jpg?w=1380"
          alt="Logo" />
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse p-3" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          <a class="nav-link" href="listbook.php">My bookings</a>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user"></i>My account
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="edit-profile.php">Edit profile</a></li>
              <li><a class="dropdown-item" href="logout.php?logout">Logout</a></li>
            </ul>
          </li>
        </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid bg-image">
    <h1 class="header1 text-center fw-bold">Welcome to car rental Fritz</h1>

    <div class="container-fluid hero">
      <img src="https://cdn.pixabay.com/photo/2020/08/24/06/04/cars-5512851_1280.jpg" alt="Description">
      <p class="text1">Renting a car has never been so easy. We have a large selection of vehicles in all categories. With us, you
        don't have to stand in line. Register on our website and let the fun begin. For a rental car from <strong>Car Rental Fritz</strong>, you don't need any paperwork or pick-up times. With our transparent pricing, you can rent a car for as
        little as a few minutes or as long as 30 days. Find a rental car near you and, when you get to your destination,
        park it anywhere near you. All you need is our app. Let's go!</p>
    </div>

    <h1 class="header2 text-center fw-bold">List of cars to rent</h1>
    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
      <?= $cards ?>
    </div>
    <br>
    <br>
  </div>

  <footer class="footer p-2 bg-dark-subtle text-secondary-emphasis">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h2><i class="fa-solid fa-car"></i>Car rental Fritz</h2>
        </div>
        <div class="col-md-6">
          <h5>Contact us</h5>
          <ul class="list-unstyled">
            <li>Email: cars.fritz@gmail.com</li>
            <li>Phone: +1233567890</li>
            <li>Address: Musterstrasse 123, 1010 Vienna, Austria</li>
          </ul>
        </div>
        <div class="col-md-2">
          <h5>Follow Us</h5>
          <ul class="list-inline footer-links">
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-facebook"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-linkedin"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <hr />
      <div id="foot" class="row">
        <div class="col-md-4">
          <p>&copy; Car Rental Fritz 2024</p>
        </div>
        <div class="col-md-6">
          <p>All rights reserved</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/1d760a24a6.js" crossorigin="anonymous"></script>
</body>

</html>