<?php
session_start();
include('koneksi.php');
if (!isset($_SESSION['admin_username'])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="app">
        <nav>
            <ul>
                <li><a href="admin_depan.php">Halaman Depan</a></li>
                <?php if (in_array("guru", $_SESSION['admin_akses'])) { ?>
                    <li><a href="login.php">Admin</a></li>
                <?php } ?>
                <?php if (in_array("customer", $_SESSION['admin_akses'])) { ?>
                    <li><a href="customer.html">customer</a></li>
                <?php } ?>
                <?php if (in_array("kasir", $_SESSION['admin_akses'])) { ?>
                    <li><a href="">Halaman</a></li>
                <?php } ?>
                <li><a href="logout.php">Logout >></a></>
            </ul>
        </nav>