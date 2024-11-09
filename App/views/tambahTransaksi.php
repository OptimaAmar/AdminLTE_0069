<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Tambah Data Barang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">

</head>

<body>
  <div class="container mt-3">
    <h1>Tambah Data Transaksi</h1>
    <hr>
    <!-- form input data -->
    <form method="post" action="index.php?aksi=tambahTransaksi">
      <div class="mb-3">
        <label for="id_trans" class="form-label">ID Transaksi : </label>
        <input type="text" class="form-control" id="id_trans" name="id_trans" required>
      </div>

      <div class="mb-3">
        <label for="id_pel" class="form-label">ID Pelanggan :</label>
        <input type="text" class="form-control" id="id_pel" name="id_pel" required>
      </div>

      <div class="mb-3">
        <label for="kd_brg" class="form-label">Kode Barang:</label>
        <input type="text" class="form-control" id="kd_brg" name="kd_brg" required>
      </div>

      <div class="mb-3">
        <label for="jmlh" class="form-label">Jumlah Barang:</label>
        <input type="text" class="form-control" id="jmlh" name="jmlh" required>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="index.php?aksi=Transaksi"class="btn btn-success" >Kembali</a>
    </form>
  </div>
</body>

</html>