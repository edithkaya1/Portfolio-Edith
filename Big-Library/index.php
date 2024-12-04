<?php
require_once "db_connect.php";
$cards = "";
if (isset($_GET["title"])){
  $title = $_GET["title"];
  $title = ucfirst($title);
  $sql = "SELECT * FROM products where title like '%{$title}%' or author_lastname like '%{$title}%' or author_firstname like '%{$title}%'";
}
else{
  $sql = "SELECT * FROM products";
}
$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) > 0) {
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($rows as $row) {
    $cards .= "<div>
           <div class='card mx-auto my-3';'>
               <img src='{$row['picture']}' class='card-image card-img-top mx-auto' alt='{$row['picture']}'>
               <div class='card-body text-center'>
                  <h5 class='card-title fw-bold'>{$row['title']}</h5>
                  <a href='publisher.php?name=$row[publisher_name]' class='card-link text-uppercase'>{$row['publisher_name']}</a>
                  <div class='text-center'>
                    <a href='details.php?id=$row[id]' class='btn btn-lg btn-outline-secondary mx-4 my-3'>Show details</a>
                  </div>
              </div>
          </div>
     </div>";
  }
} else {
  $cards = "<h3>No results found</h3>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Big Library Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Indie+Flower&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&family=Doppio+One&family=Indie+Flower&family=Madimi+One&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&family=Unkempt:wght@400;700&display=swap');
    * {
      margin: 0;
      padding: 0;
    }
    .header1 {
      font-size: 5.5rem;
      font-family: "Indie Flower", serif;
      font-weight: 400;
      font-style: normal;
      color: #8C4763;
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
    .card {
      width: 100%;
      height: 800px;
    }
    .card-body {
      width: 100%;
      height: 300px;
    }
    .card-image {
      width: 100%;
      height: 580px;
    }
    .card-title {
      font-size: 2rem;
      font-family: "Indie Flower", serif;
      font-weight: 400;
      font-style: normal;
      color: #B20000;
      text-align: center;
    }
    .card-link {
      font-size: 1.5rem;
      font-family: "Kanit", sans-serif;
      font-weight: 600;
      font-style: normal;
      text-decoration: none;
      text-align: center;
      color: #2d6b22;
    }
    .card-link:hover {
      font-size: 1.7rem;
      color: #8ab446;
    }
    .bg-image {
      background-image: url(https://getwallpapers.com/wallpaper/full/a/c/8/271947.jpg);
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }
    .nav-link{
      font-size: 1.5rem;
      font-family: "Carlito", sans-serif;
      font-weight: 700;
      font-style: italic;
    }
    .nav-link:hover {
      background-color: #acc864;
      border-radius: 15%;
      transform: scale(1.1);
    }
    input[type="search"]:focus {
      background-color: #acc864;
      font-family: "Carlito", sans-serif;
      font-weight: 700;
      font-style: normal;
      font-size: 1.3rem;
    }
    /* Mobile phone */
    @media screen and (max-width: 480px)
    {
      .header1 {
      font-size: 2rem;
    }
    .nav-link:hover {
      border-radius: 25%;
      width: 10rem;
      height: auto;
      transform: scale(1.0);
      text-align: center;
    }
    .card-header {
      font-size: 2rem;
    }
    .card {
      height: 700px;
      width: 80%;
    }
    .card-body {
      height: 100px;
      width: 80%;
    }
    .card-image {
      width: 100%;
      height: 400px;
    }
    .card-title {
      font-size: 1.5rem;
    }
    .card-text {
      font-size: 1.3rem;
    }
    .footer h2, h5 {
        font-size: 1rem;
    }
    }
     /* Tablet */
     @media screen and (max-width: 1200px) and (min-width: 481px)
    {
      .header1 {
      font-size: 4.5rem;
    }
    .nav-link:hover {
      border-radius: 25%;
      width: 10rem;
      height: auto;
      transform: scale(1.0);
      text-align: center;
    }
    .footer h2 {
        font-size: 1.5rem;
    }
    }
  </style>
<body>
  <nav class="navbar sticky-top bg-dark navbar-expand-lg bg-dark-subtle fs-5">
    <div class="container-fluid">
      <div class="w-1">
        <img class="image" src="https://icon-library.com/images/photo-library-icon/photo-library-icon-3.jpg"
          alt="Logo" />
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact us</a>
          </li>
        </ul>
        <form class="d-flex" role="search" method="GET">
          <input class="form-control me-2" type="search" name= "title" placeholder="Enter title or author" aria-label="Search">
          <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="container-fluid bg-image bg-body-secondary mx-2">
    <h1 class="header1 text-center fw-bold">Welcome to our Big Library</h1>
    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
      <?= $cards ?>
    </div>
    <div class="text-center">
      <a href='create.php' class='btn btn-outline-warning btn-lg text-center my-3'>Create a new title</a>
    </div>
  </div>

  <footer class="footer p-2 bg-dark-subtle text-secondary-emphasis">
    <div class="container">
      <div class="row">
        <div class="col-md-5 col-sm-2">
          <h2><i class="fa-solid fa-book"></i></i>Big Library Großhofen</h2>
        </div>
        <div class="col-md-5 col-sm-2">
          <h5>Contact us</h5>
          <ul class="list-unstyled">
            <li>Email: biglibrary.grosshofen@gmail.com</li>
            <li>Phone: +1233567890</li>
            <li>Address: Berger Platz 123, 7011 Großhofen, Austria</li>
          </ul>
        </div>
        <div class="col-md-2 col-sm-5">
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
        <div class="col-md-6">
          <p>&copy; Big Library Großhofen 2024</p>
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