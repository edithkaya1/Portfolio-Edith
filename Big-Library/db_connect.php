<?php 
try {
    // $hostname = "173.212.235.205"; // 173.212.235.205 oder 127.0.0.1 für Lokalhost
    $hostname = "127.0.0.1"; // 173.212.235.205 oder 127.0.0.1 für Lokalhost
    // $username = "edithcodefactory_edith"; // edithcodefactory_edith oder root
    $username = "root"; 
    // $password = "TbyG_]q6CGd("; // TbyG_]q6CGd( oder space
    $password = "";
    // // edithcodefactory_biglibrary oder be23_exam4_edithpeschke_biglibrary
    $dbname = "be23_exam4_edithpeschke_biglibrary";
    $connect = new mysqli($hostname, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
   echo "Failed to connect to the database: ". $e->getMessage() ."";
}