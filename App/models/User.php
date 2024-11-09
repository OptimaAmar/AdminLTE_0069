<?php
class User
{

    private $db;

    public function __construct($dbKoneksi)
    {
        $this->db = $dbKoneksi;
    }

    // Barang
    public function halBarang()
    {
        $query = $this->db->prepare("SELECT * FROM barang");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detailBarang($kd_brg)
    {
        $query = $this->db->prepare("SELECT * FROM barang WHERE kd_brg = :kd_brg");
        $query->bindParam(':kd_brg', $kd_brg, PDO::PARAM_STR); // Sesuaikan tipe data jika kd_brg adalah string
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function tambahBarang($kd_brg, $nama, $harga, $stok)
    {
        $sql = "INSERT INTO barang (kd_brg, nama, harga, stok) VALUES (:kd_brg, :nama, :harga, :stok)";
        $query = $this->db->prepare($sql);

        $query->bindParam(':kd_brg', $kd_brg);
        $query->bindParam(':nama', $nama);
        $query->bindParam(':harga', $harga);
        $query->bindParam(':stok', $stok);
        return $query->execute();
    }

    public function updateBarang($kd_brg, $nama, $harga, $stok)
    {
        $sql = "UPDATE barang SET nama = :nama, harga = :harga, stok = :stok WHERE kd_brg = :kd_brg";
        $query = $this->db->prepare($sql);

        $query->bindParam(':nama', $nama);
        $query->bindParam(':harga', $harga);
        $query->bindParam(':stok', $stok);
        $query->bindParam(':kd_brg', $kd_brg, PDO::PARAM_STR); // Sesuaikan tipe data jika kd_brg adalah string
        return $query->execute();
    }

    public function deleteBarang($kd_brg)
    {
        $sql = "DELETE FROM barang WHERE kd_brg = :kd_brg";
        $query = $this->db->prepare($sql);
        $query->bindParam(":kd_brg", $kd_brg, PDO::PARAM_STR); // Sesuaikan tipe data jika kd_brg adalah string
        return $query->execute();
    }

    // Pelanggan
    public function halPelanggan()
    {
        $query = $this->db->prepare("SELECT * FROM pelanggan");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detailPelanggan($id_pel)
    {
        $query = $this->db->prepare("SELECT * FROM pelanggan WHERE id_pel = :id_pel");
        $query->bindParam(':id_pel', $id_pel, PDO::PARAM_STR); // Sesuaikan tipe data jika id_pel adalah string
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function tambahPelanggan($id_pel, $nama, $alamat)
    {
        $sql = "INSERT INTO pelanggan (id_pel, nama, alamat) VALUES (:id_pel, :nama, :alamat)";
        $query = $this->db->prepare($sql);

        $query->bindParam(':id_pel', $id_pel);
        $query->bindParam(':nama', $nama);
        $query->bindParam(':alamat', $alamat);
        return $query->execute();
    }

    public function updatePelanggan($id_pel, $nama, $alamat)
    {
        $sql = "UPDATE pelanggan SET nama = :nama, alamat = :alamat WHERE id_pel = :id_pel";
        $query = $this->db->prepare($sql);

        $query->bindParam(':nama', $nama);
        $query->bindParam(':alamat', $alamat);
        $query->bindParam(':id_pel', $id_pel, PDO::PARAM_STR); // Sesuaikan tipe data jika id_pel adalah string
        return $query->execute();
    }

    public function deletePelanggan($id_pel)
    {
        $sql = "DELETE FROM pelanggan WHERE id_pel = :id_pel";
        $query = $this->db->prepare($sql);
        $query->bindParam(":id_pel", $id_pel, PDO::PARAM_STR); // Sesuaikan tipe data jika id_pel adalah string
        return $query->execute();
    }


    // transaksi
    public function halTransaksi()
    {
        $query = $this->db->prepare("SELECT * FROM transaksi");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tambahTransaksi($id_trans, $id_pel, $kd_brg, $jmlh)
    {
        try {
            // Mulai transaksi untuk menjaga integritas data
            $mulai = $this->db->beginTransaction();

            if (!$mulai) {
               return false;
            }

            $query_pelanggan = $this->db->prepare("SELECT id_pel FROM pelanggan WHERE id_pel = :id_pel");
            $query_pelanggan->bindParam(':id_pel', $id_pel, PDO::PARAM_STR);
            $query_pelanggan->execute();
            $pelanggan = $query_pelanggan->fetch(PDO::FETCH_ASSOC);

            // cek apakah ada id pelanggan 
            if (!$pelanggan) {
                echo "<script>
                        alert('Pelanggan dengan ID $id_pel tidak ditemukan');
                      </script>";
                return false;
            }

            // Query untuk mengambil harga barang berdasarkan kode barang
            $query_barang = $this->db->prepare("SELECT harga, stok FROM barang WHERE kd_brg = :kd_brg");
            $query_barang->bindParam(':kd_brg', $kd_brg, PDO::PARAM_STR);
            $query_barang->execute();
            $barang = $query_barang->fetch(PDO::FETCH_ASSOC);

            if (!$barang) {
                echo "<script>
                        alert('Barang dengan kode $kd_brg tidak ditemukan');
                      </script>";
                return false;
            }

            // Mengecek apakah stok cukup sebelum mengurangi stok barang
            if ($barang['stok'] < $jmlh) {
                echo "<script>
                        alert('Stok barang tidak cukup');
                      </script>";
                return false;
            }

            // Hitung total harga
            $total = $barang['harga'] * $jmlh;

            // Query untuk menambahkan transaksi
            $sql_transaksi = "INSERT INTO transaksi (id_trans, id_pel, kd_brg, jmlh, total, tanggal_waktu) 
                            VALUES (:id_trans, :id_pel, :kd_brg, :jmlh, :total, NOW())";
            $query_transaksi = $this->db->prepare($sql_transaksi);
            $query_transaksi->bindParam(':id_trans', $id_trans);
            $query_transaksi->bindParam(':id_pel', $id_pel);
            $query_transaksi->bindParam(':kd_brg', $kd_brg);
            $query_transaksi->bindParam(':jmlh', $jmlh);
            $query_transaksi->bindParam(':total', $total);

            if (!$query_transaksi->execute()) {
                return false;
            }

            // Query untuk mengurangi stok barang
            $sql_update_stok = "UPDATE barang SET stok = stok - :jmlh WHERE kd_brg = :kd_brg";
            $query_update_stok = $this->db->prepare($sql_update_stok);
            $query_update_stok->bindParam(':kd_brg', $kd_brg);
            $query_update_stok->bindParam(':jmlh', $jmlh);

            if (!$query_update_stok->execute()) {
                return false;
            }

            // Commit transaksi jika semua query berhasil
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            // Rollback jika terjadi kesalahan
            $this->db->rollBack();
            echo "Terjadi kesalahan: " . $e->getMessage();
            return false;
        }
    }

    
    public function deleteTransaksi($id_trans)
    {
        $sql = "DELETE FROM transaksi WHERE id_trans = :id_trans";
        $query = $this->db->prepare($sql);
        $query->bindParam(':id_trans', $id_trans, PDO::PARAM_STR); // Sesuaikan tipe data jika id_pel adalah string
        return $query->execute();
    }

    public function detailTransaksi($id_trans)
    {
        $sql = "SELECT transaksi.id_trans, barang.kd_brg, barang.nama AS nama_brg, barang.harga AS harga_brg,
                    pelanggan.id_pel, pelanggan.nama AS nama_plg, transaksi.jmlh, transaksi.total, transaksi.tanggal_waktu
                                FROM transaksi
                    JOIN barang ON barang.kd_brg = transaksi.kd_brg
                    JOIN pelanggan ON pelanggan.id_pel = transaksi.id_pel
                    WHERE transaksi.id_trans  = :id_trans";
        $query = $this->db->prepare($sql);
        $query->bindParam(':id_trans', $id_trans, PDO::PARAM_STR); // Sesuaikan tipe data jika id_trans adalah string
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
