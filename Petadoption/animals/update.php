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
$result = mysqli_query($connect, $sql);
$row1 = mysqli_fetch_assoc($result);

$id = $_GET["id"];
$sql = "SELECT * FROM animals where id = {$id}";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$status = $row["status"] == "AVAILABLE" ? "selected" : "";
// $vaccine = $row["vaccine"] == "YES" ? "selected" : "";
// $gender = $row["gender"] == "YES" ? "selected" : "";
$cards = "";
$cards .= "<div>
                // <div class='card mx-auto my-3'>
                   <div class='card-header text-center'>
                     {$row['name']}
                   </div>
                   <div class='text-center'>
                      <img src='../pictures/{$row["picture"]}' class='card-image-top' alt='{../pictures/{$row["picture"]}'>
                   </div>
                 </div>
           </div>";
// print_r($row);
if (isset($_POST["update"])) {
    $name = $_POST["name"];
    $breed = $_POST["breed"];
    $gender = $_POST["gender"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    $vaccine = $_POST["vaccine"];
    $status = $_POST["status"];
    $status = strtoupper($status);
    $size = strtoupper($size);
    $vaccine = strtoupper($vaccine);
    $picture = fileUpload($_FILES["picture"], 'animals');

    if ($_FILES["picture"]["error"] == 4) { // user didn't select a picture
        $updsql = "UPDATE animals SET name = '$name', breed = '$breed', gender ='$gender', location = '$location', description = '$description',  size = '$size', age = '$age', vaccine = '$vaccine', status = '$status' WHERE id = {$id}";
    } else {
        if ($row["picture"] != "animal.png") {
            unlink("../pictures/{$row["picture"]}");
        }
        $updsql = "UPDATE animals SET name = '$name', breed = '$breed', gender ='$gender', location = '$location', description = '$description',  size = '$size', age = '$age', vaccine = '$vaccine', picture = '$picture[0]', status = '$status' WHERE id = {$id}";
    }
    if (mysqli_query($connect, $updsql)) {
        echo "<div class='alert alert-success' role='alert'>
        Animal has been successfully updated}
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
            text-shadow: 6px 6px 0 gray;
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
        }

        .text1 {
            font-size: 1.8rem;
            font-family: "Madimi One", sans-serif;
            font-weight: 400;
            font-style: normal;
            color: #C91959;
        }

        input[type=text],
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
        }

        input[type=textarea] {
            width: 100%;
            height: 200px;
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
            text-align: start;
        }


        input[type="text"]:focus {
            background-color: #C0EDE4;
        }

        input[type="number"]:focus {
            background-color: #C0EDE4;
        }

        input[type="file"]:focus {
            background-color: #C0EDE4;
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
        }

        .box:focus {
            background-color: #C0EDE4;
        }

        .bg-image {
            background-image: url(https://static.vecteezy.com/system/resources/previews/011/410/588/original/abstract-watercolor-background-watercolor-texture-for-design-vector.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: auto;
            margin: 0;
        }

        .nav-link {
            font-size: 1.5rem;
            font-family: "Carlito", sans-serif;
            font-weight: 700;
            font-style: italic;
        }

        .nav-link:hover {
            background-color: #b3c6ff;
            border-radius: 15%;
            transform: scale(1.1);
        }

        /* Mobile phone */
        @media screen and (max-width: 480px) {
            .header1 {
                font-size: 4rem;
            }

            .card-header {
                font-size: 3rem;
            }

            .nav-link:hover {
                border-radius: 25%;
                width: 10rem;
                height: auto;
                transform: scale(1.0);
                text-align: center;
            }

            .footer h2,
            h5 {
                font-size: 1rem;
            }
        }

        /* Tablet */
        @media screen and (max-width: 1200px) and (min-width: 481px) {
            .header1 {
                font-size: 4.5rem;
            }

            .card-header {
                font-size: 3.2rem;
            }

            .nav-link:hover {
                border-radius: 25%;
                width: 10rem;
                height: auto;
                transform: scale(1.0);
                text-align: center;
            }

            .footer h2,
            h5 {
                font-size: 1.2rem;
            }

            .footer-links {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar sticky-top bg-dark navbar-expand-lg bg-body-secondary fs-5">
        <div class="container-fluid">
            <div class="w-1">
                <img class="image"
                    src="../pictures/<?= $row1['picture'] ?>"
                    alt="Logo" />
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse p-3" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" href="index.php">List of pets</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid bg-image">
        <div class="row">
            <div class="col col-md-6 mx-auto my-3">
                <h3 class="text-center header1 fw-bold">Update a pet</h3>
                <div class="row row-cols-1">
                    <?= $cards ?>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <label for="name" class="text1 form-label">Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="name" name="name"
                            value="<?= $row["name"] ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="breed" class="text1 form-label">Breed</label>
                        <input type="text" class="form-control" id="breed" aria-describedby="breed" name="breed"
                            value="<?= $row["breed"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="text1 form-label">Gender</label>
                        <select name="gender" id="gender" class="box form-select">
                            <option>MALE</option>
                            <option>FEMALE</option>
                            <!-- <option <?= $gender ?>></option> -->
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="location" class="text1 form-label">Location</label>
                        <input type="text" class="form-control" id="location" aria-describedby="location" name="location"
                            value="<?= $row["location"] ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="description" class="text1 form-label">Description</label>
                        <textarea class="box form-control" id="description" rows="3" name="description"><?= $row["description"] ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="size" class="text1 form-label">Size</label>
                        <select name="size" id="size" class="box form-select">
                            <option>SMALL</option>
                            <option>LARGE</option>
                            <!-- <option <?= $size ?>></option> -->
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="age" class="text1 form-label">Age</label>
                        <input type="number" class="form-control" id="age" aria-describedby="age"
                            name="age" value="<?= $row["age"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="vaccine" class="text1 form-label">Vaccinated</label>
                        <select name="vaccine" id="vaccine" class="box form-select">
                            <option>YES</option>
                            <option>NO</option>
                            <!-- <option <?= $vaccine ?>></option> -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="picture" class="text1 form-label">Picture</label>
                        <input type="file" class="form-control" id="picture" aria-describedby="picture" name="picture">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="text1 form-label">Status</label>
                        <select name="status" id="status" class="box form-select">
                            <option>RESERVED</option>
                            <option <?= $status ?>>AVAILABLE</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button name="update" type="submit" class="btn btn-lg btn-outline-secondary m-4">Update
                            pet</button>
                        <a href="index.php" class="btn btn-lg btn-outline-dark m-4">Back to home</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer p-2 bg-dark-subtle text-secondary-emphasis">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-2">
                    <h2><i class="fa-solid fa-paw"></i></i>Pet adoption Breitenfurt</h2>
                </div>
                <div class="col-md-5 col-sm-2">
                    <h5>Contact us</h5>
                    <ul class="list-unstyled">
                        <li>Email: petadoption@gmail.com</li>
                        <li>Phone: +43 616/1240356</li>
                        <li>Address: Hauptstrasse 777, 2384 Breitenfurt, Austria</li>
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
                <div class="col-md-5">
                    <p>&copy; Pet adoption Breitenfurt 2024</p>
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