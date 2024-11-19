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
//    echo "delete booking page";
//    echo"<pre>";
//         var_dump($_GET);
//    echo"</pre>";
$id = $_GET["id"];
$sql = "SELECT * FROM booking where booking_id = {$id}";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
print_r($row) or var_dump($row);

$delsql = "DELETE FROM booking WHERE booking_id = {$id}";
mysqli_query($connect, $delsql);
header("Location: listbook.php");
ob_end_flush();
// mysqli_close($connect);
?>