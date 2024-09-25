<?php
include "koneksi.php";
    $id_vendor = $_GET['id'];

    $sql = "DELETE FROM vendor WHERE id_vendor='$id_vendor'";
    
    if ($koneksi ->query($sql) === TRUE) {
        echo "Data Berhasil Dihapus";
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $koneksi->error;
    }

    $koneksi->close();
?>
