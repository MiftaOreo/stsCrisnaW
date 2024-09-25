<?php
include "koneksi.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_storage = $_POST['id_gudang'];
    $nama_gudang = $_POST['nama_gudang'];
    $lokasi_gudang = $_POST['lokasi_gudang'];

    $sql = "UPDATE storage SET nama_gudang='$nama_gudang', lokasi_gudang='$lokasi_gudang' WHERE id_gudang='$id_storage'";

    if ($koneksi ->query($sql) === TRUE) {
        echo "<script>alert('Sukses Mengubah Gudang Baru');location.href='index.php';</script>";
    } else {
        echo "Error updating record: " . $koneksi->error;
    }

    $koneksi->close();
 } else {
    $id_storage = $_GET['id'];
    $sql = "SELECT * FROM storage WHERE id_gudang='$id_storage'";
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
    <title>Edit Gudang</title>
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
        <h3>Edit Gudang</h3>
        <form action="editstorage.php" method="post">
            <input type="hidden" name="id_gudang" value="<?php echo htmlspecialchars($row['id_gudang']); ?>">
            <div>
                <label for="nama_gudang" class="form-label">Nama Gudang:</label>
                <input type="text" class="form-control" id="nama_gudang" name="nama_gudang" value="<?php echo htmlspecialchars($row['nama_gudang']); ?>" required>
            </div>
            <div>
                <label for="lokasi_gudang" class="form-label">Lokasi Gudang:</label>
                <input type="text" class="form-control" id="lokasi_gudang" name="lokasi_gudang" value="<?php echo htmlspecialchars($row['lokasi_gudang']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Edit</button>
            <a class="btn btn-danger" href="index.php">Cancel</a>
        </form>
    </div>
</body>
</html>
