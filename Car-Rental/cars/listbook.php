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

$sql = "SELECT * FROM users WHERE id = {$_SESSION["adm"]}";
// echo $sql;
$result = mysqli_query($connect, $sql);
$row1 = mysqli_fetch_assoc($result);
// print_r($row1);

$sql = "SELECT * FROM booking INNER JOIN users ON booking.fk_user_id = users.id INNER JOIN cars ON booking.fk_cars_id = cars.id ORDER BY booking.pickup_date";
// print_r($sql);

$result = mysqli_query($connect, $sql);
$cards = "";

if (mysqli_num_rows($result) > 0) {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    foreach ($rows as $row) {
        // print_r($row);
        $pdate = date_format(new DateTime($row['pickup_date']), "d.m.Y");
        $rdate = date_format(new DateTime($row['return_date']), "d.m.Y");
        $ptime = date_format(new DateTime($row['pickup_time']), "H.i");
        $rtime = date_format(new DateTime($row['return_time']), "H.i");
       
        $cards .= "<div>
               <div class='card mx-auto my-3'>
                   <div class='card-header text-center style='width: 18rem;'>
                     {$row['brand']} {$row['model']}
                   </div>
                   <div class='text-center'>
                      <img src='../pictures/{$row["picture"]}' class='card-image-top img-fluid' alt='{$row["picture"]}'>
                   </div>
                    <h5 class='card-title fw-bold text-center'>{$row['first_name']} {$row['last_name']}</h5>
                    <h5 class='card-title fw-bold text-center'>{$row['email']}</h5>
                   <div class='card-body'>
                        <p class='card-text fw-bold text-center'>Pickup date and time: {$pdate} {$ptime}</p>
                        <p class='card-text1 fw-bold text-center'>Return date and time: {$rdate} {$rtime}</p>
                   </div>
                   <div class='text-center'>
                      <a href='deletebook.php?id=$row[booking_id]' class='btn btn-lg btn-danger mx-4 my-3'><i class='fa-solid fa-trash'></i></a>
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
            font-size: 3.5rem;
            background-color: #C91959;
            color: whitesmoke;
            font-family: "Indie Flower", serif;
            font-weight: 400;
            font-style: normal;
        }
        .card-image-top {
            max-width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.5rem;
            font-family: "Unkempt", serif;
            font-weight: 700;
            font-style: normal;
            color: #640007;
        }
        .card-title:first-child {
            color: #8ab446;
        }
        .card-title:nth-child(3) {
            color: #8ab446;
        }
        .card-title:nth-child(4) {
            color: #880015;
        }
        
        .card-text {
            font-size: 1.2rem;
            font-family: "Unkempt", serif;
            font-weight: 700;
            font-style: normal;
            color: #2d6b22;
        }
        .card-text1 {
            font-size: 1.2rem;
            font-family: "Unkempt", serif;
            font-weight: 700;
            font-style: normal;
            color: #e93667;
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
                    <a class="nav-link active" aria-current="page" href="index.php">List of cars</a>
                    <a class="nav-link" href="../dashboard.php">Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid bg-image">
        <h1 class="header1 text-center fw-bold">List of user bookings</h1>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
            <?= $cards ?>
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