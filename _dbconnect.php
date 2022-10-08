<?php

include '_dbcreate.php';
//Connect to database

$servername = 'localhost';
$username = 'root';
$password = "";
$database = "notes";


//Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

//Checking conection
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
} else {
    // echo "Connection was successful <br>";
}
