<?php
include_once("koneksi.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    // Jika pengguna belum login, maka redirect ke halaman login
    echo '<script type="text/javascript">document.location="index.php?page=login_pasien";</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">
    <title>Sistem Informasi Poliklinik</title>   <!--Judul Halaman-->
</head>
<body>
    <div class="container">
            <!--Form Input Data-->

        <form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
            <!-- Kode php untuk menghubungkan form dengan database -->
            <?php
            $nama = '';
            $alamat = '';
            $no_hp = '';
            $no_ktp = '';
            $no_rm = '';
            if (isset($_GET['id'])) {
                $ambil = mysqli_query($mysqli, 
                "SELECT * FROM pasien 
                WHERE id='" . $_GET['id'] . "'");
                while ($row = mysqli_fetch_array($ambil)) {
                    $nama = $row['nama'];
                    $alamat = $row['alamat'];
                    $no_hp = $row['no_hp'];
                    $no_ktp = $row['no_ktp'];
                    $no_rm = $row['no_rm'];
                }
            ?>
                <input type="hidden" name="id" value="<?php echo
                $_GET['id'] ?>">
            <?php
            }
            ?>
            <div class="form-group">
                <label for="inputnama" class="form-label fw-bold">
                    Nama
                </label>
                <input type="text" class="form-control" name="nama" id="inputnama" placeholder="nama" value="<?php echo $nama ?>">
            </div>
            <div class="form-group">
                <label for="inputalamat" class="form-label fw-bold">
                    Alamat
                </label>
                <input type="text" class="form-control" name="alamat" id="inputalamat" placeholder="alamat" value="<?php echo $alamat ?>">
            </div>
            <div class="form-group">
                <label for="inputnohp" class="form-label fw-bold">
                    No Hp
                </label>
                <input type="text" class="form-control" name="no_hp" id="inputnohp" placeholder="no_hp" value="<?php echo $no_hp ?>">
            </div>
            <div class="form-group">
                <label for="inputnoktp" class="form-label fw-bold">
                    No KTP
                </label>
                <input type="text" class="form-control" name="no_ktp" id="inputnoktp" placeholder="no_ktp" value="<?php echo $no_ktp ?>">
            </div>
            <div class="form-group">
                <label for="inputnorm" class="form-label fw-bold">
                    No Rekam Medis
                </label>
                <input type="text" class="form-control" name="no_rm" id="inputnorm" placeholder="no_rm" value="<?php echo $no_rm ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
            </div>
        </form>

            <!-- Table-->
    <table class="table table-hover">
        <!--thead atau baris judul-->
        <thead>
            <tr>
                <th scope="col" style="text-align: center; vertical-align: middle;">No</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">Nama</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">Alamat</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">No Hp</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">No KTP</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">No Rekam Medis</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">Aksi</th>
            </tr>
        </thead>
        <!--tbody berisi isi tabel sesuai dengan judul atau head-->
        <tbody>
            <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
            berdasarkan status dan tanggal awal-->
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM pasien");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td class="text-center align-middle"><?php echo $no++ ?></td>
                    <td class="text-center align-middle"><?php echo $data['nama'] ?></td>
                    <td class="text-center align-middle"><?php echo $data['alamat'] ?></td>
                    <td class="text-center align-middle"><?php echo $data['no_hp'] ?></td>
                    <td class="text-center align-middle"><?php echo $data['no_ktp'] ?></td>
                    <td class="text-center align-middle"><?php echo $data['no_rm'] ?></td>
                    <td class="text-center align-middle">
                        <a class="btn btn-success rounded-pill px-3" href="index.php?page=pasien&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="index.php?page=pasien&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

        <?php
    if (isset($_POST['simpan'])) {
        if (isset($_POST['id'])) {
            $ubah = mysqli_query($mysqli, "UPDATE pasien SET 
                                            nama = '" . $_POST['nama'] . "',
                                            alamat = '" . $_POST['alamat'] . "',
                                            no_hp = '" . $_POST['no_hp'] . "',
                                            no_hp = '" . $_POST['no_ktp'] . "',
                                            no_hp = '" . $_POST['no_rm'] . "'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
        } else {
            $tambah = mysqli_query($mysqli, "INSERT INTO pasien(nama,alamat,no_hp,no_ktp,no_rm) 
                                            VALUES ( 
                                                '" . $_POST['nama'] . "',
                                                '" . $_POST['alamat'] . "',
                                                '" . $_POST['no_hp'] . "',
                                                '" . $_POST['no_ktp'] . "',
                                                '" . $_POST['no_rm'] . "'
                                                )");
        }

        echo "<script> 
                document.location='index.php?page=pasien';
                </script>";
    }

    if (isset($_GET['aksi'])) {
        if ($_GET['aksi'] == 'hapus') {
            $hapus = mysqli_query($mysqli, "DELETE FROM pasien WHERE id = '" . $_GET['id'] . "'");
        } else if ($_GET['aksi'] == 'ubah_status') {
            $ubah_status = mysqli_query($mysqli, "UPDATE pasien SET 
                                            status = '" . $_GET['status'] . "' 
                                            WHERE
                                            id = '" . $_GET['id'] . "'");
        }

        echo "<script> 
                document.location='index.php?page=pasien';
                </script>";
    }
    ?>
</body>
</html>