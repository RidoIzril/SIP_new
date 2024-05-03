<?php
session_start();
if (isset($_SESSION['admin_username'])) {
    header("location:header.php");
}
include('koneksi.php');
$username = '';
$password = '';
$err = "";
if (isset($_POST['login'])) {
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    if ($username == '' or $password == '') {
        $err .= "<li>Silakan masukkan username dan password</li>";
    }
    if (empty($err)) {
        $sql1 = "select * from admin where username = '$username'";
        $q1 = mysqli_query($koneksi, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if ($r1['password'] != MD5($password)) {
            $err .= "<li>Akun tidak ditemukan</li>";
        }
    }
    if (empty($err)) {
        $login_id = $r1['login_id'];
        $sql1 = "select * from admin where login_id = '$login_id'";
        $q1 = mysqli_query($koneksi, $sql1);
        while ($r1 = mysqli_fetch_array($q1)) {
            $akses[] = $r1['akses_id']; 
        }
        if (empty($akses)) {
            $err .= "<li>Kamu tidak punya akses ke halaman admin</li>";
        }
    }
    if (empty($err)) {
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin'] = $akses;
        header("location:header.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="css/login.css" />
<div class="container right-panel-active">
        <!-- Sign Up -->
        <div class="container__form container--signup">
        <form action="#" class="form" id="form1">
        <h2 class="form__title">Sign Up</h2>
        <h3 class="form__title">As Customer</h3>
        <input type="text" placeholder="User" class="input" />
        <input type="email" placeholder="Email" class="input" />
        <input type="password" placeholder="Password" class="input" />
        <a href="index.html"  class="btnlog">Sign Up</a>
        </form>
        </div>
        <!-- log In -->
        <div class="container__form container--signin">
        <form action="" method="post">
            <h2>Login</h2>
            <input type="text" value="<?php echo $username ?>" name="username" class="input" placeholder="Isikan Username..." /><br /><br />
            <input type="password" name="password" class="input" placeholder="Isikan Password" /><br /><br />
            <input type="submit" name="login" value="Masuk Ke Sistem" />
        </form>
        </div>
        <!-- Overlay -->
        <div class="container__overlay">
        <div class="overlay">
        <div class="overlay__panel overlay--left">
        <button class="btnlog" id="signIn">Log In</button>
        </div>
        <div class="overlay__panel overlay--right">
        <button class="btnlog" id="signUp">Sign Up</button>
        </div>
        </div>
        </div>
        </div>
        <script src="js/login.js"></script>

</html>