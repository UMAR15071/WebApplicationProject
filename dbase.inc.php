<?php

$hostname = "localhost:3306";
$username = "recruitment";
$password = "#b3nu98N5";

$database = "recruitment_";

$con = mysqli_connect($hostname, $username, $password, $database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>