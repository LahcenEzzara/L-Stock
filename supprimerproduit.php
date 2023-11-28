<?php
session_start();
if ($_SESSION['Login'] != "Active") {
    header("location:login.php");
}


if (isset($_GET['supid'])) {
    $_SESSION['prodId'] = $_GET['supid'];
}

$reference = $_SESSION['prodId'];

$conn = mysqli_connect("localhost", "root", "", "gestionproduit");

$sql = "DELETE FROM produit WHERE reference=$reference";

$result = mysqli_query($conn, $sql);

if ($result) {
    header("location:index.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>