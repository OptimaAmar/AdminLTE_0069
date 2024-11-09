<?php
include_once "App/models/User.php";

class ControlBarang
{
    private $userModel;

    public function __construct($dbKoneksi)
    {
        $this->userModel = new User($dbKoneksi);
    }

    public function index()
    {
        $user = $this->userModel->halBarang();
        require_once 'App/views/halBarang.php';
    }

    public function editBarang($kd_brg)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $kd_brg = $_POST['kd_brg'];
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];

            $kirim = $this->userModel->updateBarang($kd_brg, $nama, $harga, $stok);
            if ($kirim) {
                echo "<script>
                        alert('Data Barang berhasil diubah');
                        window.location.href = 'index.php';
                      </script>";
                exit;
            } else {
                echo "<script>
                        alert('Data Barang gagal diubah');
                        window.location.href = 'index.php';
                      </script>";
                exit;
            }
        } else {
            $user = $this->userModel->detailBarang($kd_brg);
            include 'App/views/editBarang.php';
        }
    }

    public function nambahBarang()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $kd_brg = $_POST['kd_brg'];
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];

            $kirim = $this->userModel->tambahBarang($kd_brg, $nama, $harga, $stok);
            if ($kirim) {
                echo "<script>
                        alert('Data Barang berhasil ditambahkan');
                        window.location.href = 'index.php';
                      </script>";
                exit;
            } else {
                echo "<script>
                        alert('Data Barang gagal ditambahkan');
                        window.location.href = 'index.php';
                      </script>";
                exit;
            }
        }
        include 'App/views/tambahBarang.php';
    }

    public function hapusBarang($kd_brg)
    {
        $user = $this->userModel->deleteBarang($kd_brg);
        if ($user) {
            echo "<script>
                    alert('Data Barang berhasil dihapus');
                    window.location.href = 'index.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Data Barang gagal dihapus');
                    window.location.href = 'index.php';
                  </script>";
            exit;
        }
    }
}
