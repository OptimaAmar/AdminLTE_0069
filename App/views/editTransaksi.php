<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Edit Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
</head>
 
<body>
    <div class="container mt-3">
        <h1>Form Edit Data Pelanggan</h1>
        <hr>
        <!-- form input data  -->
        <form method="post" action="index.php?id_trans=<?= $user["id_trans"] ?>&aksi=editTransaksi">
        
            <!-- kirim id ke database -->
            <div class="mb-3">
                <label for="id_trans" class="form-label">ID Transaksi : </label>
                <input type="text" class="form-control" id="id_trans" name="id_trans" value="<?= $user['id_trans']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="id_pel" class="form-label">ID Pelanggan : </label>
                <input type="text" class="form-control" id="id_pel" name="id_pel" value="<?= $user['id_pel']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="kd_brg" class="form-label">Kode Barang : </label>
                <input type="text" class="form-control" id="kd_brg" name="kd_brg" value="<?= $user['kd_brg']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_waktu" class="form-label">Tanggak Transaksi : </label>
                <input type="text" class="form-control" id="tanggal_waktu" name="tanggal_waktu" value="<?= $user['tanggal_waktu']; ?>" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php?aksi=barang" class="btn btn-warning">Kembali</a>
        </form>

    </div>
</body>

</html>