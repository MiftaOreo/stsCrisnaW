<?php
if($_POST){
    $nama = $_POST['nama_vendor'];
    $kontak = $_POST['kontak'];
    $nama_barang = $_POST['nama_brgg'];
    
    if(empty($nama)){
        echo "<script>alert('Nomor Invoice tidak boleh kosong');location.href='tambah_vendor.php';</script>";
    } elseif (empty($kontak)){
        echo "<script>alert('Nama Vendor tidak boleh kosong');location.href='tambah_vendor.php';</script>";
    } elseif (empty($nama_barang)){
        echo "<script>alert('Kontak Vendor tidak boleh kosong');location.href='tambah_vendor.php';</script>";
    }else {
        include "koneksi.php";
        $insert = mysqli_query ($koneksi, "INSERT INTO vendor ( nama_vendor, kontak, nama_brgg) VALUE ('".$nama."','".$kontak."','".$nama_barang."')")
        or die(mysqli_error($koneksi));
        if($insert){
            echo "<script>alert('Sukses Menambahkan Vendor Baru');location.href='index.php';</script>";
        } else {
            "<script>alert('Gagal Menambahkan Vendor Baru');location.href='index.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Vendor Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        h2 {
            margin-bottom: 20px;
            color: #ffffff;
        }
        .form-label {
            margin-bottom: 5px;
            display: block;
            color: #ffffff;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #444;
            border-radius: 4px;
            margin-bottom: 15px;
            background-color: #333;
            color: #ffffff;
            box-sizing: border-box;
        }
        .form-control:focus {
            border-color: #007bff;
            outline: none;
        }
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Vendor / Supplier Baru</h2>
        <form action="prosesvendor.php" method="post">
            <div>
                <label for="nama_vendor" class="form-label">Nama Vendor:</label>
                <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" required>
            </div>
            <div>
                <label for="kontak" class="form-label">Kontak:</label>
                <input type="text" class="form-control" id="kontak" name="kontak" required>
            </div>
            <div>
                <label for="nama_brgg" class="form-label">Nama Barang:</label>
                <input type="text" class="form-control" id="nama_brgg" name="nama_brgg" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Tambah</button>
            <a class="btn btn-danger" href="index.php">Cancel</a>
        </form>
    </div>
</body>
</html>
