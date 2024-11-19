<?php 
try {
   $hostname = "localhost";
   $username = "root";
   $password = "";
   $dbname = "be23_exam4_edithpeschke_biglibrary";
   $connect = new mysqli($hostname, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
   echo "Failed to connect to the database: ". $e->getMessage() ."";
}