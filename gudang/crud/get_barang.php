<?php
include "koneksi.php";

if (isset($_GET['id_vendor'])) {
    $id_vendor = $_GET['id_vendor'];
    $query = mysqli_query($koneksi, "SELECT nama_brgg FROM vendor WHERE id_vendor = '$id_vendor'");
    $data = mysqli_fetch_assoc($query);
    echo json_encode($data);
}
?>
