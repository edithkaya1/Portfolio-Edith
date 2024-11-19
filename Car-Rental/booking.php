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
$result = mysqli_query($connect, $sql);
$row1 = mysqli_fetch_assoc($result);
$iduser = $_SESSION["user"];
//  echo"<pre>";
//     var_dump($_SESSION);
//   echo"</pre>";
$id = $_GET["id"];
$sqlcars = "SELECT * FROM cars WHERE id = {$id}";
$carsResult = mysqli_query($connect, $sqlcars);
$carsRows = mysqli_fetch_all($carsResult, MYSQLI_ASSOC);
// var_dump($carsRows);
$cards = "";

$options = '';
foreach ($carsRows as $cars) {
    $options .= "<option value='{$cars['id']} selected'>{$cars['brand']} {$cars['model']}</option>";
    $cards .= "<div>
                <div class='card mx-auto my-3'>
                   <div class='card-header text-center'>
                     {$cars['brand']} {$cars['model']}
                   </div>
                   <div class='text-center'>
                      <img src='pictures/{$cars["picture"]}' class='card-image-top' alt='{$cars["picture"]}'>
                   </div>
                   <div class='card-body'>
                    <p class='card-title fw-bold text-center'>Price per day: {$cars['price_day']}€</p>
                    <p class='card-title fw-bold text-center'>Price per hour: {$cars['price_hour']}€</p>
                    <p class='card-title fw-bold text-center'>Price per minute: {$cars['price_minute']}€</p>
               </div>
           </div>";
}

if (isset($_POST["book"])) {
    $iduser = $_SESSION["user"];
    // $carid = $_POST['car'];
    $carid = $id;
    $fname = $_POST["first_name"];
    $lname = $_POST["last_name"];
    $email = $_POST["email"];
    $pdate = $_POST["pickup_date"];
    $ptime = $_POST["pickup_time"];
    $rdate = $_POST["return_date"];
    $rtime = $_POST["return_time"];

    // var_dump($_POST);

    $sqlins = "INSERT INTO booking (first_name, last_name, email, pickup_date, pickup_time, return_date, return_time, fk_user_id, fk_cars_id) 
    VALUES ('$fname','$lname','$email','$pdate', '$ptime', '$rdate', '$rtime', $iduser, $carid)";
    // var_dump($sqlins);
    if (mysqli_query($connect, $sqlins)) {
        echo "<div class='alert alert-success' role='alert'>
           New booking has been successfully created
         </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
           Something went wrong
         </div>";
    }
    header("refresh: 3; url=home.php");
}
//  mysqli_close($connect);
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
            color: #6B9A6E;
        }
        input[type=text],
        input[type=email],
        input[type=date],
        input[type=time] {
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
        }
        input[type="text"]:focus {
            background-color: #cedf90;
        }
        input[type="email"]:focus {
            background-color: #cedf90;
        }
        input[type="date"]:focus {
            background-color: #cedf90;
        }
        input[type="time"]:focus {
            background-color: #cedf90;
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
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    <a class="nav-link" href="listbook.php">My bookings</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
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
        <div class="row">
            <div class="col col-md-6 mx-auto my-3">
                <h3 class="text-center header1 fw-bold">Book a car</h3>
                <div class="row row-cols-1">
                    <?= $cards ?>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <label for="first_name" class="text1 form-label">First name</label>
                        <input type="text" class="form-control" id="first_name" aria-describedby="first_name"
                            name="first_name" placeholder="Enter first name"
                            value="<?= $row1["first_name"] ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="last_name" class="text1 form-label">Last name</label>
                        <input type="text" class="form-control" id="first_name" aria-describedby="last_name"
                            name="last_name" placeholder="Enter last name"
                            value="<?= $row1["last_name"] ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="text1 form-label">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="email" name="email"
                            placeholder="Enter email"
                            value="<?= $row1["email"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="car" class="text1 form-label">Cars to select</label>
                        <select name="car" id="car" class="box form-select">
                            <!-- <option value="null">Select one of the options</option> -->
                            <?= $options ?>
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="pickup_date" class="text1 form-label">Pickup date</label>
                        <input type="date" class="form-control" id="pickup_date" aria-describedby="pickup_date"
                            name="pickup_date" placeholder="Enter pickup date" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="pickup_time" class="text1 form-label">Pickup time</label>
                        <input type="time" class="form-control" id="pickup_time" aria-describedby="pickup_time"
                            name="pickup_time" placeholder="Enter pickup time" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="return_date" class="text1 form-label">Return date</label>
                        <input type="date" class="form-control" id="return_date" aria-describedby="return_date"
                            name="return_date" placeholder="Enter return date" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="return_time" class="text1 form-label">Return time</label>
                        <input type="time" class="form-control" id="return_time" aria-describedby="return_time"
                            name="return_time" placeholder="Enter return time" required>
                    </div>
                    <div class="text-center">
                        <button name="book" type="submit" class="btn btn-lg btn-outline-secondary mx-5">Save
                            booking</button>
                        <a href="home.php" class="btn btn-lg btn-outline-dark mx-5">Back to home</a>
                    </div>
                    <br>
                    <br>
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