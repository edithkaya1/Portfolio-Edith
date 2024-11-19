<?php
require_once "db_connect.php";
if (isset($_POST["create"])) {
  $title = $_POST["title"];
  $picture = $_POST["picture"];
  $isbn = $_POST["isbn"];
  $description = $_POST["description"];
  $type = $_POST["type"];
  $fauthor = $_POST["fauthor"];
  $lauthor = $_POST["lauthor"];
  $pname = $_POST["pname"];
  $paddress = $_POST["paddress"];
  $pdate = $_POST["pdate"];
  $sql = "INSERT INTO products (title, picture, isbn_code, short_description, type, author_firstname, author_lastname, publisher_name, publisher_address, publish_date) VALUES 
        ('$title','$picture','$isbn','$description','$type','$fauthor','$lauthor','$pname','$paddress','$pdate')";
  if (mysqli_query($connect, $sql)) {
    echo "<div class='alert alert-success' role='alert'>
            New record has been created, {$picture}
          </div>";
  } else {
    echo "<div class='alert alert-danger' role='alert'>
            error found
          </div>";
  }
  header("refresh: 3; url=index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create new title</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Indie+Flower&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Indie+Flower&family=Madimi+One&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&family=Indie+Flower&family=Madimi+One&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&display=swap');
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
    input[type=text] {
      width: 100%;
      font-size: 1.3rem;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 2px solid #110707;
      border-radius: 4px;
      outline: none;
      position: relative;
      resize: vertical;
      background-color: #FEF5E7;
    }
    input[type=textarea] {
      width: 100%;
      font-size: 1.3rem;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 2px solid #110707;
      border-radius: 4px;
      outline: none;
      position: relative;
      resize: vertical;
      background-color: #FEF5E7;
    }
    input[type=date] {
      width: 100%;
      font-size: 1.3rem;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 2px solid #110707;
      border-radius: 4px;
      outline: none;
      position: relative;
      resize: vertical;
      background-color: #FEF5E7;
    }
    input[type="text"]:focus {
      background-color: #c6dc93;
      font-family: "Carlito", sans-serif;
      font-weight: 700;
      font-style: normal;
      font-size: 1.5rem;
    }
    input[type="textarea"]:focus {
      background-color: #c6dc93;
      font-family: "Carlito", sans-serif;
      font-weight: 700;
      font-style: normal;
      font-size: 1.5rem;
    }
    input[type="date"]:focus {
      background-color: #c6dc93;
      font-family: "Carlito", sans-serif;
      font-weight: 700;
      font-style: normal;
      font-size: 1.5rem;
    }
    .text1 {
      font-size: 1.8rem;
      font-family: "Madimi One", sans-serif;
      font-weight: 400;
      font-style: normal;
      color: #4B1E19;
    }
    .bg-image {
      background-image: url(https://getwallpapers.com/wallpaper/full/a/c/8/271947.jpg);
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

    }
     /* Tablet */
     @media screen and (max-width: 1200px) and (min-width: 481px)
    {
      .header1 {
      font-size: 3.6rem;
    }
    .nav-link:hover {
      border-radius: 25%;
      width: 10rem;
      height: auto;
      transform: scale(1.0);
      text-align: center;
    }
    }
  </style>
</head>

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
      </div>
    </div>
  </nav>

  <div class="container-fluid bg-image">
    <div class="row">
      <div class="col col-md-6 mx-auto my-3">
        <h3 class="text-center header1 fw-bold">Create a product</h3>
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3 mt-3">
            <label for="title" class="text1 form-label">Title</label>
            <input type="text" class="form-control" id="title" aria-describedby="title" name="title"
              placeholder="Product name" required>
          </div>
          <div class="mb-3">
            <label for="picture" class="text1 form-label">Picture</label>
            <!-- <input type="file" class="form-control" id="picture" aria-describedby="picture" name="picture"> -->
            <input type="text" class="form-control" id="picture" aria-describedby="picture" name="picture"
              placeholder="Picture url">
          </div>
          <div class="mb-3">
            <label for="isbn" class="text1 form-label">ISBN-Code</label>
            <input type="text" class="form-control" id="isbn" aria-describedby="isbn" name="isbn"
              placeholder="EAN number" required>
          </div>
          <div class="mb-3">
            <label for="description" class="text1 form-label">Description</label>
            <input type="text" class="form-control" id="description" aria-describedby="description" name="description"
              placeholder="Short description" required>
          </div>
          <div class="mb-3">
            <label for="type" class="text1 form-label">Type of the product</label>
            <input type="text" class="form-control" id="type" aria-describedby="type" name="type"
              placeholder="Book/Ebook/DVD/CD" required>
          </div>
          <div class="mb-3">
            <label for="fauthor" class="text1 form-label">Author first name</label>
            <input type="text" class="form-control" id="fauthor" aria-describedby="fauthor" name="fauthor"
              placeholder="Author first name" required>
          </div>
          <div class="mb-3">
            <label for="lauthor" class="text1 form-label">Author last name</label>
            <input type="text" class="form-control" id="lauthor" aria-describedby="lauthor" name="lauthor"
              placeholder="Author last name" required>
          </div>
          <div class="mb-3">
            <label for="pname" class="text1 form-label">Publisher name</label>
            <input type="text" class="form-control" id="pname" aria-describedby="pname" placeholder="Publisher name"
              name="pname">
          </div>
          <div class="mb-3">
            <label for="paddress" class="text1 form-label">Publisher address</label>
            <input type="textarea" class="form-control" id="paddress" aria-describedby="paddress"
              placeholder="Publisher address" name="paddress">
          </div>
          <div class="mb-3">
            <label for="pdate" class="text1 form-label">Publisher date</label>
            <input type="date" class="form-control" id="pdate" aria-describedby="pdate" placeholder="Publishing date"
              name="pdate">
          </div>
          <div class="text-center mx-2">
            <button name="create" type="submit" class="btn btn-lg btn-outline-warning mx-5 my-2">Save product</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <footer class="footer p-2 bg-dark-subtle text-secondary-emphasis">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <h2><i class="fa-solid fa-book"></i></i>Big Library Großhofen</h2>
        </div>
        <div class="col-md-5">
          <h5>Contact us</h5>
          <ul class="list-unstyled">
            <li>Email: biglibrary.grosshofen@gmail.com</li>
            <li>Phone: +1233567890</li>
            <li>Address: Berger Platz 123, 7011 Großhofen, Austria</li>
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