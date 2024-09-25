<?php
include "koneksi.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_vendor = $_POST['id_vendor'];
    $nama = $_POST['nama_vendor'];
    $kontak = $_POST['kontak'];
    $nama_barang = $_POST['nama_brgg'];
    
        $sql = "UPDATE vendor SET nama_vendor='$nama', kontak='$kontak', nama_brgg='$nama_barang' WHERE id_vendor='$id_vendor'";
    
        if ($koneksi ->query($sql) === TRUE) {
            echo "<script>alert('Sukses Mengubah Vendor Baru');location.href='index.php';</script>";
        } else {
            echo "Error updating record: " . $koneksi->error;
        }
    
        $koneksi->close();
     } else {
        $id_vendor = $_GET['id'];
        $sql = "SELECT * FROM vendor WHERE id_vendor='$id_vendor'";
        $result = $koneksi->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Record not found!";
        }
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vendor</title>
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
        h3 {
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
        <h3>Edit Vendor</h3>
        <form action="editvendor.php" method="post">
            <input type="hidden" name="id_vendor" value="<?php echo htmlspecialchars($row['id_vendor']); ?>">
            <div>
                <label for="nama_vendor" class="form-label">Nama Vendor:</label>
                <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="<?php echo htmlspecialchars($row['nama_vendor']); ?>" required>
            </div>
            <div>
                <label for="kontak" class="form-label">Kontak:</label>
                <input type="text" class="form-control" id="kontak" name="kontak" value="<?php echo htmlspecialchars($row['kontak']); ?>" required>
            </div>
            <div>
                <label for="nama_brgg" class="form-label">Nama Barang:</label>
                <input type="text" class="form-control" id="nama_brgg" name="nama_brgg" value="<?php echo htmlspecialchars($row['nama_brgg']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Edit</button>
            <a class="btn btn-danger" href="index.php">Cancel</a>
        </form>
    </div>
</body>
</html>
