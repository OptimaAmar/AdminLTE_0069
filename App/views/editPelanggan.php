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
        <form method="post" action="index.php?id_pel=<?= $user["id_pel"] ?>&aksi=editPelanggan">

            <!-- kirim id ke database -->
            <div class="mb-3">
                <label for="id_pel" class="form-label">ID Pelanggan : </label>
                <input type="text" class="form-control" id="id_pel" name="id_pel" value="<?= $user['id_pel']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pelanggan : </label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">alamat Pelanggan : </label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $user['alamat']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php?aksi=pelanggan" class="btn btn-warning">Kembali</a>
        </form>

    </div>
</body>

</html>