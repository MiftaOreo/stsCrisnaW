<?php
if($_POST){
    $nama_gudang = $_POST['nama_gudang'];
    $lokasi_gudang = $_POST['lokasi_gudang'];
    
    if(empty($nama_gudang)){
        echo "<script>alert('Nama Gudang Tidak Boleh Kosong');location.href='tambah_storage.php';</script>";
    } elseif (empty($lokasi_gudang)){
        echo "<script>alert('Lokasi Gudang Tidak Boleh Kosong');location.href='tambah_storage.php';</script>";
    } else {
        include "koneksi.php";
        $insert = mysqli_query ($koneksi, "INSERT INTO storage (nama_gudang, lokasi_gudang) VALUE ('".$nama_gudang."','".$lokasi_gudang."')")
        or die(mysqli_error($koneksi));
        if($insert){
            echo "<script>alert('Sukses menambahkan gudang baru');location.href='index.php';</script>";
        } else {
            "<script>alert('Gagal menambahkan gudang baru');location.href='index.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gudang Baru</title>
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
        <h2>Tambah Gudang Baru</h2>
        <form action="proses_storage.php" method="post">
            <div>
                <label for="nama_gudang" class="form-label">Nama Gudang:</label>
                <input type="text" class="form-control" id="nama_gudang" name="nama_gudang" required>
            </div>
            <div>
                <label for="lokasi_gudang" class="form-label">Lokasi Gudang:</label>
                <input type="text" class="form-control" id="lokasi_gudang" name="lokasi_gudang" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Tambah</button>
            <a class="btn btn-danger" href="index.php">Cancel</a>
        </form>
    </div>
</body>
</html>