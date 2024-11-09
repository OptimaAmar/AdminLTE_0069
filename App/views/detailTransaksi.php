<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
  
</head>

<body> 
    <div class="container mt-3">

        <h1>Detail Transaksi</h1>
        <hr>
        <div class="card mb-1" style="max-width: 580px;">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5>ID Transaksi        : <?= $user["id_trans"] ?></h5>
                        <h5>Kode Barang         : <?= $user["kd_brg"] ?></h5>
                        <h5>Nama Barang         : <?= $user["nama_brg"] ?></h5>
                        <h5>Harga Per Item      : <?= $user["harga_brg"] ?></h5>
                        <h5>ID Pelanggan        : <?= $user["id_pel"] ?></h6>
                        <h5>Nama Pelanggan      : <?= $user["nama_plg"] ?></h6>
                        <h5>Jumlah Barang       : <?= $user["jmlh"] ?></h6>
                        <h5>Total harga         : <?= $user["total"] ?></h6>
                        <h5>Tanggal Transaksi   : <?= $user["tanggal_waktu"] ?></h6>
                        <a href="index.php?aksi=Transaksi" class="btn btn-success">Kembali</a>
                    </div>
                </div>
            </div>

        </div>
</body>

</html>