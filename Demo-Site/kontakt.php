<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt zu Yasmina Peschke</title>
</head>
<body>
<?php
    $vorname = htmlentities($_POST["vorname"]);
    $zuname = htmlentities($_POST["zuname"]);
    $email = htmlentities($_POST["email"]);
    $nachricht = htmlentities($_POST["nachricht"]);

    if (mb_strlen($vorname) == 0)
        echo "Bitte geben Sie einen Vornamen ein<br>";
    else
    {
        if (mb_strlen($zuname) == 0)
            echo "Bitte geben Sie einen Zunamen ein<br>";
        else
            if (mb_strlen($email) == 0)
                echo "Bitte geben Sie eine Email-Adresse<br>";
            else
                if (mb_strlen($nachricht) == 0)
                    echo "Bitte geben Sie eine Nachricht ein<br>";
                else
                    //echo "Vielen Dank $vorname " . $zuname . " für Ihre Nachricht. Sie wird sobald wie möglich bearbeitet!<br>";
                    echo "<script type='text/javascript'>document.location='https://blizzwerk.de/1/gf/edith/website/html/antwort.html ';</script>";
    }
?>    
</body>
</html>