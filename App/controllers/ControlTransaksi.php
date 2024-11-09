<?php
require_once "App/models/User.php";

class ControlTransaksi
{
    private $userModel;

    public function __construct($dbKoneksi)
    {
        $this->userModel = new User($dbKoneksi);
    }

    // Transaksi
    public function tampilanTransaksi()
    {
        $user = $this->userModel->halTransaksi();
        require_once 'App/views/halTransaksi.php';
    }

    // public function ubahTransaksi($id_trans)
    // {
    //     if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    //         $id_trans   = $_POST["id_trans"];
    //         $kd_brg     = $_POST["kd_brg"];
    //         $id_pel     = $_POST["id_pel"];

    //         $update = $this->userModel->updateTransaksi($id_trans, $kd_brg, $id_pel);

    //         if ($update) {
    //             echo "<script>
    //                     alert('Data Transaksi berhasil diubah');
    //                     window.location.href = 'index.php?aksi=Transaksi';
    //                   </script>";
    //             exit;
    //         } else {
    //             echo "<script>
    //                     alert('Data Transaksi gagal diubah');
    //                     window.location.href = 'index.php?aksi=Transaksi';
    //                   </script>";
    //             exit;
    //         }
    //     } else {
    //         $user = $this->userModel->detailTransaksi($id_trans);
    //         require_once 'App/views/editTransaksi.php';
    //     }
    // }

    public function nambahTransaksi()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $id_trans = $_POST["id_trans"];
            $id_pel   = $_POST["id_pel"];
            $kd_brg   = $_POST["kd_brg"];
            $jmlh     = $_POST["jmlh"];
            
            $nambah = $this->userModel->tambahTransaksi($id_trans, $id_pel, $kd_brg, $jmlh);

            if ($nambah) {
                echo "<script>
                        alert('Data Transaksi berhasil ditambah');
                        window.location.href = 'index.php?aksi=Transaksi';
                      </script>";
                exit;
            } else {
                echo "<script>
                        alert('Data Transaksi gagal ditambah');
                        window.location.href = 'index.php?aksi=Transaksi';
                      </script>";
                exit;
            }
        } else {
            require_once 'App/views/tambahTransaksi.php';
        }
    }

    public function hapusTransaksi($id_trans)
    {
        $user = $this->userModel->deleteTransaksi($id_trans);
        if ($user) {
            echo "<script>
                    alert('Data Transaksi berhasil dihapus');
                    window.location.href = 'index.php?aksi=Transaksi';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Data Transaksi gagal dihapus');
                    window.location.href = 'index.php?aksi=Transaksi';
                  </script>";
            exit;
        }
    }
    public function show($id_trans){
        
        $user = $this->userModel->detailTransaksi($id_trans);
        require_once 'App/views/detailTransaksi.php';
    }
}

