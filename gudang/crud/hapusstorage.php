<?php
include "koneksi.php";
    $id_storage = $_GET['id'];

    $sql = "DELETE FROM storage WHERE id_gudang='$id_storage'";
    
    if ($koneksi ->query($sql) === TRUE) {
        echo "Data Berhasil Dihapus";
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $koneksi->error;
    }

    $koneksi->close();
?>
