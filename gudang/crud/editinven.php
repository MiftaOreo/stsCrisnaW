<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_brg = $_POST['id_brg'];
    $nama_brg = $_POST['nama_brg'];
    $jenis_brg = $_POST['jenis_brg'];
    $harga = $_POST['harga'];
    $jml_stok = $_POST['jml_stok'];
    $lokasi = $_POST['id_gudang'];
    $barcode = $_POST['barcode'];
    $ven = $_POST['id_vendor'];

    $sql = "UPDATE inventory SET
            nama_brg = '$nama_brg',
            jenis_brg = '$jenis_brg',
            harga = '$harga',
            jml_stok = '$jml_stok',
            id_gudang = '$lokasi',
            barcode = '$barcode',
            id_vendor = '$ven'
            WHERE id_brg = '$id_brg'";
        
    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Sukses Mengubah Barang Baru');location.href='index.php';</script>";
        exit(); 
    } else {
        echo "Error updating record: " . $koneksi->error;
    }

    $koneksi->close();
} else {
    $id_brg = $_GET['id'];
    $sql = "SELECT * FROM inventory WHERE id_brg='$id_brg'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found!";
        exit(); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory</title>
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
        .form-control, .form-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #444;
            border-radius: 4px;
            margin-bottom: 15px;
            background-color: #333;
            color: #ffffff;
            box-sizing: border-box;
        }
        .form-control:focus, .form-select:focus {
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
        <h3>Edit Inventory</h3>
        <form action="editinven.php" method="post">
            <input type="hidden" name="id_brg" value="<?php echo htmlspecialchars($row['id_brg']); ?>">

            <div>
                <label for="nama_brg" class="form-label">Nama Barang:</label>
                <input type="text" class="form-control" id="nama_brg" name="nama_brg" value="<?php echo htmlspecialchars($row['nama_brg']); ?>" required>
            </div>

            <div>
                <label for="jenis_brg" class="form-label">Nama Jenis:</label>
                <input type="text" class="form-control" id="jenis_brg" name="jenis_brg" value="<?php echo htmlspecialchars($row['jenis_brg']); ?>" required>
            </div>

            <div>
                <label for="harga" class="form-label">Harga Barang:</label>
                <input type="text" class="form-control" id="harga" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>" required>
            </div>

            <div>
                <label for="jml_stok" class="form-label">Jumlah Stok:</label>
                <input type="text" class="form-control" id="jml_stok" name="jml_stok" value="<?php echo htmlspecialchars($row['jml_stok']); ?>" required>
            </div>

            <div>
                <label for="id_gudang" class="form-label">Lokasi Gudang:</label>
                <?php
                include "koneksi.php";
                $id_gudang_terpilih = htmlspecialchars($row['id_gudang']);
                $query = mysqli_query($koneksi, "SELECT * FROM storage");
                ?>
                <select name="id_gudang" class="form-select" required>
                    <option value="" disabled>Pilih Lokasi Gudang</option>
                    <?php
                    while ($data = mysqli_fetch_array($query)) {
                        $selected = ($data['id_gudang'] == $id_gudang_terpilih) ? 'selected' : '';
                        echo '<option value="'.$data['id_gudang'].'" '.$selected.'>'.$data['lokasi_gudang'].'</option>';
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="barcode" class="form-label">Barcode:</label>
                <input type="text" class="form-control" id="barcode" name="barcode" value="<?php echo htmlspecialchars($row['barcode']); ?>">
            </div>

            <div>
                <label for="id_vendor" class="form-label">Nama Vendor:</label>
                <?php
                $id_vendor_terpilih = htmlspecialchars($row['id_vendor']);
                $query = mysqli_query($koneksi, "SELECT * FROM vendor");
                ?>
                <select name="id_vendor" class="form-select" required>
                    <option value="" disabled>Pilih Nama Vendor</option>
                    <?php
                    while ($data = mysqli_fetch_array($query)) {
                        $selected = ($data['id_vendor'] == $id_vendor_terpilih) ? 'selected' : '';
                        echo '<option value="'.$data['id_vendor'].'" '.$selected.'>'.$data['nama_vendor'].'</option>';
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Edit</button>
            <a class="btn btn-danger" href="index.php">Cancel</a>
        </form>
    </div>
</body>
</html>
