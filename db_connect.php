<?php

$conn = mysqli_connect("localhost", "root", "", "gestionproduit");

//IF the connection doesnot connect then error message is being showed...
if (!$conn) {
    die("Connection is failed: " . mysqli_connect_error());
}
?>
