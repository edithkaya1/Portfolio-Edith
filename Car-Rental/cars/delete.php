<?php
ob_start();
session_start();
if(isset($_SESSION["user"])){
  header("Location: ../home.php");
}
if(!isset($_SESSION["adm"]) && !isset($_SESSION["user"])){
  header("Location: ../login.php"); 
} 
require_once "../components/db_connect.php";
//    echo "delete page";
//    echo"<pre>";
//         var_dump($_GET);
//    echo"</pre>";
$id=$_GET["id"] ;
$sql = "SELECT * FROM cars where id = {$id}";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
//print_r($row) or var_dump($row);

//remove the picture, not the default picture

if($row["picture"] != "car.png"){
    unlink('../pictures/{$row["picture"]}');
}

$delsql = "DELETE FROM cars WHERE id = {$id}";
mysqli_query($connect, $delsql);
header("Location: index.php");
ob_end_flush();
// mysqli_close($connect);
?>
