<?php 
try {
   $hostname = "127.0.0.1"; // 173.212.235.205 oder 127.0.0.1 für Lokalhost
   $username = "root"; // edithcodefactory_edith oder root
   $password = ""; // TbyG_]q6CGd( oder space
   $dbname = "login"; //edithcodefactory_login oder login
   // create connection, you need to be aware of the order of the parameters
   $connect = new mysqli($hostname, $username, $password, $dbname);
   // echo"connected successfully";
} catch (mysqli_sql_exception $e) {
   echo "Failed to connect to the database: ". $e->getMessage() ."";
}







