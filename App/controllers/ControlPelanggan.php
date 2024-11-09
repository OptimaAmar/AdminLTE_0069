<?php
require_once "App/models/User.php";

class ControlPelanggan
{
    private $userModel;

    public function __construct($dbKoneksi)
    {
        $this->userModel = new User($dbKoneksi);
    }

    // Pelanggan
    public function tampilanPelanggan()
    {
        $user = $this->userModel->halPelanggan();
        require_once 'App/views/halPelanggan.php';
    }

    public function editPelanggan($id_pel)
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $id_pel = $_POST["id_pel"];
            $nama   = $_POST["nama"];
            $alamat = $_POST["alamat"];

            $update = $this->userModel->updatePelanggan($id_pel, $nama, $alamat);

            if ($update) {
                echo "<script>
                        alert('Data Pelanggan berhasil diubah');
                        window.location.href = 'index.php?aksi=pelanggan';
                      </script>";
                exit;
            } else {
                echo "<script>
                        alert('Data Pelanggan gagal diubah');
                        window.location.href = 'index.php?aksi=pelanggan';
                      </script>";
                exit;
            }
        } else {
            $user = $this->userModel->detailPelanggan($id_pel);
            require_once 'App/views/editPelanggan.php';
        }
    }

    public function nambahPelanggan()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $id_pel = $_POST["id_pel"];
            $nama   = $_POST["nama"];
            $alamat = $_POST["alamat"];

            $update = $this->userModel->tambahPelanggan($id_pel, $nama, $alamat);

            if ($update) {
                echo "<script>
                        alert('Data Pelanggan berhasil ditambah');
                        window.location.href = 'index.php?aksi=pelanggan';
                      </script>";
                exit;
            } else {
                echo "<script>
                        alert('Data Pelanggan gagal ditambah');
                        window.location.href = 'index.php?aksi=pelanggan';
                      </script>";
                exit;
            }
        }
        require_once 'App/views/tambahPelanggan.php';
    }

    public function hapusPelanggan($id_pel)
    {
        $user = $this->userModel->deletePelanggan($id_pel);
        if ($user) {
            echo "<script>
                    alert('Data Pelanggan berhasil dihapus');
                    window.location.href = 'index.php?aksi=pelanggan';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Data Pelanggan gagal dihapus');
                    window.location.href = 'index.php?aksi=pelanggan';
                  </script>";
            exit;
        }
    }
}
?>
