<?php
include_once "Config/Database.php";
include_once 'App/controllers/ControlBarang.php';
include_once 'App/controllers/ControlPelanggan.php';
include_once 'App/controllers/ControlTransaksi.php';

// Koneksi ke database
$dbKoneksi = GetKoneksi();

// Membuat Instance UserController
$Barang     = new ControlBarang($dbKoneksi);
$Pelanggan  = new ControlPelanggan($dbKoneksi);
$Transaksi  = new ControlTransaksi($dbKoneksi);

// Mendapatkan parameter dari URL menggunakan $_GET
// Memeriksa apakah parameter 'aksi' ada
if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];

    // Tentukan $id berdasarkan jenis aksi (kd_brg atau id_pel)
    if (isset($_GET['kd_brg'])){
        $id = $_GET['kd_brg'];

    }else if(isset($_GET['id_pel'])){
        $id = $_GET['id_pel'];
        
     }else if(isset($_GET['id_trans'])){
        $id = $_GET['id_trans'];

     }else{
        null;
     }
     

    // Barang
    if ($aksi == "tambahBarang") {
        $Barang->nambahBarang();

    } else if ($aksi == "editBarang" && $id) {
        $Barang->editBarang($id);

    }else if($aksi == "hapusBarang" && $id) {
        $Barang->hapusBarang($id);
    }

    // Pelanggan
     else if ($aksi == "pelanggan") {
        $Pelanggan->tampilanPelanggan();

    } elseif ($aksi == "tambahPelanggan") {
        $Pelanggan->nambahPelanggan();
        
    }elseif($aksi == "editPelanggan" && $id) {
        $Pelanggan->editPelanggan($id);

    }else if($aksi == "hapusPelanggan" && $id) {
        $Pelanggan->hapusPelanggan($id);
        
    }   

    // Transaksi
    else if ($aksi == "Transaksi") {
        $Transaksi->tampilanTransaksi();

    } elseif ($aksi == "tambahTransaksi") {
        $Transaksi->nambahTransaksi();
        
    // }elseif($aksi == "editTransaksi" && $id) {
    //     $Transaksi->ubahTransaksi($id);

    }else if($aksi == "hapusTransaksi" && $id) {
        $Transaksi->hapusTransaksi($id);
    }else if($aksi == "detailTransaksi" && $id) {
        $Transaksi->show($id);
    }   

} else {
    $Barang->index();
}
