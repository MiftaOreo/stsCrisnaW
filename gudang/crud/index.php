<?php
$kon = mysqli_connect("localhost", "root", "", "gudang");

if (!$kon) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$cek = "SELECT * FROM inventory WHERE jml_stok <= 0";
$hasil = mysqli_query($kon, $cek);
$tampilkanAlert = (mysqli_num_rows($hasil) > 0);

// Determine the current table to display
$currentTable = isset($_GET['table']) ? $_GET['table'] : 'inventoryTable';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #ffffff;
        }
        .container-fluid {
            display: flex;
        }
        nav {
            width: 20%;
            background-color: #1e1e1e;
            height: 100vh;
            padding-top: 20px;
        }
        nav h3 {
            text-align: center;
            background-color: #333333;
            color: #ffffff;
            padding: 10px;
            margin: 0;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            margin: 10px 0;
        }
        nav a {
            text-decoration: none;
            color: #ffffff;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        nav a:hover {
            background-color: #444444;
        }
        nav .active {
            background-color: #666666;
        }
        main {
            width: 80%;
            padding: 20px;
        }
        h1, h2 {
            color: #ffffff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #1e1e1e;
        }
        th, td {
            border: 1px solid #444444;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333333;
            color: #ffffff;
        }
        tr:hover {
            background-color: #444444;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 5px;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        footer {
            text-align: center;
            background-color: #333333;
            color: white;
            padding: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <nav>
            <h3>Dashboard</h3>
            <ul>
                <li><a class="<?= $currentTable === 'inventoryTable' ? 'active' : '' ?>" href="?table=inventoryTable">Inventory</a></li>
                <li><a class="<?= $currentTable === 'storageTable' ? 'active' : '' ?>" href="?table=storageTable">Storage</a></li>
                <li><a class="<?= $currentTable === 'vendorTable' ? 'active' : '' ?>" href="?table=vendorTable">Vendor</a></li>
                <li class="text-danger"><a id="logoutLink" href="../logout.php">Logout</a></li>
            </ul>
        </nav>

        <main>
            <h1>Selamat Datang</h1>
            <form method="get">
                <input type="text" name="search" placeholder="Cari" style="padding: 10px; border-radius: 5px; border: 1px solid #444444; width: 250px;">
                <button type="submit" class="btn btn-primary">Telusuri</button>
            </form>

            <div class="tab-content">
                <!-- Inventory Table -->
                <div id="inventoryTable" style="<?= $currentTable === 'inventoryTable' ? 'display: block;' : 'display: none;' ?>">
                    <button class="btn btn-primary" onclick="window.location.href='prosesinven.php'">Tambah Inventory</button>
                    <table>
                        <thead>
                            <tr>
                                <th>Id Barang</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Harga</th>
                                <th>Jumlah Stok</th>
                                <th>Barcode</th>
                                <th>Lokasi Gudang</th>
                                <th>Nama Vendor</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $search = isset($_GET['search']) ? mysqli_real_escape_string($kon, $_GET['search']) : '';
                            $qry = "SELECT * FROM inventory 
                                    INNER JOIN vendor ON inventory.id_vendor = vendor.id_vendor
                                    INNER JOIN storage ON inventory.id_gudang = storage.id_gudang
                                    WHERE inventory.nama_brg LIKE '%$search%' OR
                                          inventory.jenis_brg LIKE '%$search%' OR
                                          vendor.nama_vendor LIKE '%$search%'";

                            $hsl = mysqli_query($kon, $qry);

                            if (!$hsl) {
                                die("Query gagal: " . mysqli_error($kon));
                            }
                            while ($dt = mysqli_fetch_assoc($hsl)) {
                                echo "<tr>";
                                echo "<td>{$dt['id_brg']}</td>";
                                echo "<td>{$dt['nama_brg']}</td>";
                                echo "<td>{$dt['jenis_brg']}</td>";
                                echo "<td>{$dt['harga']}</td>";
                                echo "<td>{$dt['jml_stok']}</td>";
                                echo "<td>{$dt['barcode']}</td>";
                                echo "<td>{$dt['lokasi_gudang']}</td>";
                                echo "<td>{$dt['nama_vendor']}</td>";
                                echo "<td>
                                    <button class='btn btn-success'><a href='editinven.php?id={$dt['id_brg']}' style='color: white;'>Edit</a></button>
                                    <button class='btn btn-danger'><a href='hapusinven.php?id={$dt['id_brg']}' style='color: white;' onclick='return confirm(\"Apakah Anda yakin?\")'>Delete</a></button>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Storage Table -->
                <div id="storageTable" style="<?= $currentTable === 'storageTable' ? 'display: block;' : 'display: none;' ?>">
                    <button class="btn btn-primary" onclick="window.location.href='prosesstorage.php'">Tambah Storage</button>
                    <table>
                        <thead>
                            <tr>
                                <th>Id Gudang</th>
                                <th>Nama Gudang</th>
                                <th>Lokasi Gudang</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qry = "SELECT * FROM storage 
                                    WHERE nama_gudang LIKE '%$search%' OR
                                          lokasi_gudang LIKE '%$search%'";

                            $hsl = mysqli_query($kon, $qry);

                            if (!$hsl) {
                                die("Query gagal: " . mysqli_error($kon));
                            }
                            while ($dt = mysqli_fetch_assoc($hsl)) {
                                echo "<tr>";
                                echo "<td>{$dt['id_gudang']}</td>";
                                echo "<td>{$dt['nama_gudang']}</td>";
                                echo "<td>{$dt['lokasi_gudang']}</td>";
                                echo "<td>
                                    <button class='btn btn-success'><a href='editstorage.php?id={$dt['id_gudang']}' style='color: white;'>Edit</a></button>
                                    <button class='btn btn-danger'><a href='hapusstorage.php?id={$dt['id_gudang']}' style='color: white;' onclick='return confirm(\"Apakah Anda yakin?\")'>Delete</a></button>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Vendor Table -->
                <div id="vendorTable" style="<?= $currentTable === 'vendorTable' ? 'display: block;' : 'display: none;' ?>">
                    <button class="btn btn-primary" onclick="window.location.href='prosesvendor.php'">Tambah Vendor</button>
                    <table>
                        <thead>
                            <tr>
                                <th>Id Vendor</th>
                                <th>Nama Vendor</th>
                                <th>Kontak</th>
                                <th>Nama Barang</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $qry = "SELECT * FROM vendor 
                                    WHERE nama_vendor LIKE '%$search%' OR
                                          kontak LIKE '%$search%'";

                            $hsl = mysqli_query($kon, $qry);

                            if (!$hsl) {
                                die("Query gagal: " . mysqli_error($kon));
                            }
                            while ($dt = mysqli_fetch_assoc($hsl)) {
                                echo "<tr>";
                                echo "<td>{$dt['id_vendor']}</td>";
                                echo "<td>{$dt['nama_vendor']}</td>";
                                echo "<td>{$dt['kontak']}</td>";
                                echo "<td>{$dt['nama_brgg']}</td>";
                                echo "<td>
                                    <button class='btn btn-success'><a href='editvendor.php?id={$dt['id_vendor']}' style='color: white;'>Edit</a></button>
                                    <button class='btn btn-danger'><a href='hapusvendor.php?id={$dt['id_vendor']}' style='color: white;' onclick='return confirm(\"Apakah Anda yakin?\")'>Delete</a></button>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <footer>
        <p>&copy; Pt. Barokah</p>
    </footer>

    <?php if ($tampilkanAlert): ?>
        <script>
            alert("Stok barang ada yang mencapai nol. Harap periksa!");
        </script>
    <?php endif; ?>
</body>
</html>
