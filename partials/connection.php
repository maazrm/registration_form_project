<?php 
// Database connection parameters
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $database = "userlogins";

    // Attempt to establish a connection to MySQL server
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $database);

    // if($conn){
    //     echo "connection made<br>";
    // }
?>