<?php
include "koneksi.php";
    $id_inventory = $_GET['id'];

    $sql = "DELETE FROM inventory WHERE id_brg='$id_inventory'";
    
    if ($koneksi ->query($sql) === TRUE) {
        echo "Data Berhasil Dihapus";
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $koneksi->error;
    }

    $koneksi->close();
?>

