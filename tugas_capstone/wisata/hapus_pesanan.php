<?php
include 'includes/config.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM pemesanan WHERE id='$id'");

header("Location: data_pesanan.php");
