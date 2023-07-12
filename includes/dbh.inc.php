<?php

$dBServername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "environment";

// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);
//$conn = mysqli_connect("localhost", "root", "", "environment", "8889");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
