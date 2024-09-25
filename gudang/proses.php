<?php
include 'koneksi.php';
if(isset($_POST['login'])){

    $username = htmlentities(strip_tags(trim($_POST["username"])));
    $password = htmlentities(strip_tags(trim($_POST["password"])));

    $cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $hasil = mysqli_num_rows($cek);

    if($hasil > 0) {

        $ambildt = mysqli_fetch_array($cek);
        $role = $ambildt['level'];

        if($role == 'admin') {
            $_SESSION['log'] = 'logged';
            $_SESSION['level'] = 'admin';
            header('location:crud');
        } else {
            $_SESSION['log'] = 'logged';
            $_SESSION['level'] = 'user';
            header('location:user');
        }
    }
}
?>

