<?php
$koneksi = mysqli_connect("localhost","root","","gudang");

if(!$koneksi){
    die ("koneksi gagal". mysqli_connect_error(). mysqli_connect_error());
}

?>