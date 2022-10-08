<?php
$servername = 'localhost';
$username = 'root';
$password = "";

//Create a connection
$conn = mysqli_connect($servername, $username, $password);


//Creating database
$sql = "CREATE DATABASE IF NOT EXISTS `notes`";
$result = mysqli_query($conn, $sql);

//Create table
$sql = "CREATE TABLE IF NOT EXISTS`notes`.`notes` (`sno` INT(11) NOT NULL AUTO_INCREMENT , `title` VARCHAR(30) NOT NULL , `description` VARCHAR(200) NOT NULL , `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sno`))";
$result = mysqli_query($conn, $sql);
