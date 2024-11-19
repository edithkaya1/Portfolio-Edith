<?php
ob_start();
session_start();
if(isset($_SESSION["user"])){
    header("Location: home.php");
}
if(!isset($_SESSION["adm"]) && !isset($_SESSION["user"])){ 
    header("Location: login.php"); 
} 
require_once "components/db_connect.php";

$sql = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}"; 
// echo $sql;
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
// print_r($row);

// admin can see all users and edit users -> noch nicht jetzt

// $sqlUsers = "SELECT * FROM users WHERE status != 'adm'";
$sqlUsers = "SELECT * FROM users WHERE id = {$_SESSION["adm"]} or status = 'user' ORDER BY status";
$resultUsers = mysqli_query($connect, $sqlUsers);

$layout = "";

if(mysqli_num_rows($resultUsers) > 0){
    while($userRow = mysqli_fetch_assoc($resultUsers)){
      // var_dump($userRow);
        $layout .= "<div>
        <div class='card mx-auto' style='width: 18rem;'>
            <img src='pictures/{$userRow["picture"]}' class='card-image-top' alt='...'>
            <div class='card-body'>
            <h5 class='card-title'>{$userRow["first_name"]} {$userRow["last_name"]}</h5>
            <p class='card-text'>{$userRow["email"]}</p>
            <a href='update-profile.php?id=$userRow[id]' class='btn btn-warning'>Update</a>
        </div>
    </div>
  </div>";
    }
}else {
    $layout .= "No results found!";
}

mysqli_close($connect);
ob_end_flush();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome  <?= $row['first_name']?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
   <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Indie+Flower&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&family=Doppio+One&family=Indie+Flower&family=Madimi+One&family=Ramaraja&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&family=Unkempt:wght@400;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&family=Coda:wght@400;800&family=Doppio+One&family=Goldman:wght@400;700&family=Indie+Flower&family=Madimi+One&family=Ramaraja&family=Skranji:wght@400;700&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&family=Unkempt:wght@400;700&display=swap');

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

    .image {
      width: 80px;
      height: auto;
    }

    .card-header {
      font-size: 2.5rem;
    }

    .card-image-top {
      width: 100%;
      height: 300px;
    }

    .card-title {
      font-size: 2rem;
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
      color: #52A051;
    }

    .bg-image {
      background-image: url(https://www.wallpapersun.com/wp-content/uploads/2020/12/Pastel-Wallpaper-21.jpg);
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 150vh;
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
      margin-block;
      15rem;
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
        <img class="image" src="https://img.freepik.com/premium-vector/car-rental-logo-template-design_316488-1614.jpg?w=1380"
          alt="Logo" />
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse p-3" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
          <a class="nav-link" href="cars/index.php">List of cars</a>
          <a class="nav-link" href="cars/listbook.php">User bookings</a>
          <a class="nav-link" href="logout.php?logout">Logout</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid bg-image">
    <br><br>
        <div class="row row-cols-3">
            <?= $layout ?>
        </div>
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