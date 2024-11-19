<?php
ob_start();
session_start();
if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
}
if (!isset($_SESSION["adm"]) && !isset($_SESSION["user"])) {
    header("Location: ../login.php");
}
require_once "../components/db_connect.php";
require_once "../components/file_upload.php";
$sql = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
// echo $sql;
$result = mysqli_query($connect, $sql);
$row1 = mysqli_fetch_assoc($result);

$id = $_GET["id"];
$sql = "SELECT * FROM cars where id = {$id}";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$status = $row["status"] == "AVAILABLE" ? "selected" : "";
$cards = "";
$cards .= "<div>
                <div class='card mx-auto my-3'>
                   <div class='card-header text-center'>
                     {$row['brand']} {$row['model']}
                   </div>
                   <div class='text-center'>
                      <img src='../pictures/{$row["picture"]}' class='card-image-top' alt='{../pictures/{$row["picture"]}'>
                   </div>
                 </div>
           </div>";
// print_r($row);
if (isset($_POST["update"])) {
    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $type = $_POST["type"];
    $color = $_POST["color"];
    $transmission = $_POST["transmission"];
    $dprice = $_POST["price_day"];
    $hprice = $_POST["price_hour"];
    $mprice = $_POST["price_minute"];
    $description = $_POST["description"];
    $tspeed = $_POST["top_speed"];
    $status = $_POST["status"];
    $status = strtoupper($status);
    $picture = fileUpload($_FILES["picture"], 'cars'); //fileupload

    if ($_FILES["picture"]["error"] == 4) { // user didn't select a picture
        $updsql = "UPDATE cars SET brand = '$brand', model = '$model', type ='$type', color = '$color', transmission = '$transmission',  price_day = '$dprice', price_hour = '$hprice', price_minute = '$mprice', description = '$description', top_speed = $tspeed, status = '$status' WHERE id = {$id}";
    } else {
        if ($row["picture"] != "car.png") {
            unlink("../pictures/{$row["picture"]}");
        }
        $updsql = "UPDATE cars SET brand = '$brand', model = '$model', type ='$type', color = '$color', transmission = '$transmission',  price_day = '$dprice', price_hour = '$hprice', price_minute = '$mprice', description = '$description', picture='$picture[0]', top_speed = $tspeed, status = '$status' WHERE id = {$id}";
    }
    if (mysqli_query($connect, $updsql)) {
        echo "<div class='alert alert-success' role='alert'>
        Car has been successfully updated}
      </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
        Something went wrong}
      </div>";
    }
    header("refresh: 3; url=index.php");
}
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
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Indie+Flower&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Indie+Flower&family=Madimi+One&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&family=Coda:wght@400;800&family=Doppio+One&family=Goldman:wght@400;700&family=Indie+Flower&family=Madimi+One&family=Ramaraja&family=Texturina:ital,opsz,wght@0,12..72,100..900;1,12..72,100..900&family=Unkempt:wght@400;700&display=swap');

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
            font-size: 3.5rem;
            background-color: #C91959;
            color: whitesmoke;
            font-family: "Indie Flower", serif;
            font-weight: 400;
            font-style: normal;
        }
        .card-image-top {
            width: 100%;
            height: 400px;
        }
        .card-title {
            font-size: 1.5rem;
            font-family: "Unkempt", serif;
            font-weight: 700;
            font-style: normal;
            color: #640007;
        }
        .card-title:first-child {
            color: #639744;
        }
        .card-title:nth-child(2) {
            color: #fe47af;
        }
        .card-title:nth-child(3) {
            color: #c70054;
        }
        .card-title:nth-child(4) {
            color: #6B9A6E;
        }
        .text1 {
            font-size: 1.8rem;
            font-family: "Madimi One", sans-serif;
            font-weight: 400;
            font-style: normal;
            color: #C91959;
        }

        input[type=text],
        input[type=double],
        input[type=number],
        input[type=file] {
            width: 100%;
            font-size: 1.5rem;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid #110707;
            border-radius: 4px;
            outline: none;
            position: relative;
            resize: vertical;
            background-color: #FEF5E7;
            font-family: "Goldman", sans-serif;
            font-weight: 700;
            font-style: normal;
            color: #52A051;
        }

        input[type="text"]:focus {
            background-color: #cedf90;
        }

        input[type="double"]:focus {
            background-color: #cedf90;
        }

        input[type="number"]:focus {
            background-color: #cedf90;
        }

        .box {
            width: 100%;
            font-size: 1.5rem;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid #110707;
            border-radius: 4px;
            outline: none;
            position: relative;
            resize: vertical;
            background-color: #FEF5E7;
            font-family: "Goldman", sans-serif;
            font-weight: 700;
            font-style: normal;
            color: #52A051;
        }

        .box:focus {
            background-color: #cedf90;
        }

        .bg-image {
            background-image: url(https://cdn.pixabay.com/photo/2016/11/29/01/54/wood-1866667_1280.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: auto;
            margin: 0;
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
                    <a class="nav-link active" href="index.php">List of cars</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid bg-image">
        <div class="row">
            <div class="col col-md-6 mx-auto my-3">
                <h3 class="text-center header1 fw-bold">Update a car</h3>
                <div class="row row-cols-1">
                    <?= $cards ?>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <label for="brand" class="text1 form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" aria-describedby="brand" name="brand"
                            value="<?= $row["brand"] ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="model" class="text1 form-label">Model</label>
                        <input type="text" class="form-control" id="model" aria-describedby="model" name="model"
                            value="<?= $row["model"] ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="type" class="text1 form-label">Type</label>
                        <input type="text" class="form-control" id="type" aria-describedby="type" name="type"
                            value="<?= $row["type"] ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="color" class="text1 form-label">Color</label>
                        <input type="text" class="form-control" id="color" aria-describedby="color" name="color"
                            value="<?= $row["color"] ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="transmission" class="text1 form-label">Transmission</label>
                        <input type="text" class="form-control" id="transmission" aria-describedby="transmission"
                            name="transmission" value="<?= $row["transmission"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="price_day" class="text1 form-label">Price per day</label>
                        <input type="double" class="form-control" id="price_day" aria-describedby="price_day"
                            name="price_day" value="<?= $row["price_day"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="price_hour" class="text1 form-label">Price per hour</label>
                        <input type="double" class="form-control" id="price_hour" aria-describedby="price_hour"
                            name="price_hour" value="<?= $row["price_hour"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="price_minute" class="text1 form-label">Price per minute</label>
                        <input type="double" class="form-control" id="price_minute" aria-describedby="price_minute"
                            name="price_minute" value="<?= $row["price_minute"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="picture" class="text1 form-label">Picture</label>
                        <input type="file" class="form-control" id="picture" aria-describedby="picture" name="picture">
                        <!-- <input type="text" class="form-control" id="picture" aria-describedby="picture" name="picture"> -->
                    </div>
                    <div class="mb-3">
                        <label for="description" class="text1 form-label">Description</label>
                        <input type="text" class="form-control" id="description" aria-describedby="description"
                            name="description" value="<?= $row["description"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="top_speed" class="text1 form-label">Top speed</label>
                        <input type="number" class="form-control" id="top_speed" aria-describedby="top_speed"
                            name="top_speed" value="<?= $row["top_speed"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="text1 form-label">Status</label>
                        <select name="status" id="status" class="box form-select">
                            <option>RESERVED</option>
                            <option <?= $status ?>>AVAILABLE</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button name="update" type="submit" class="btn btn-lg btn-outline-secondary mx-5">Update
                            car</button>
                        <a href="index.php" class="btn btn-lg btn-outline-dark mx-5">Back to home</a>
                    </div>
                </form>
            </div>
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