<?php
include_once("koneksi.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    // Jika pengguna belum login, maka redirect ke halaman login
    echo '<script type="text/javascript">document.location="index.php?page=login";</script>';
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
<?php
//Ambil data harga dari tabel 1
    $sql = "SELECT harga FROM obat";
    $hasil = mysqli_query($mysqli, $sql);
    $harga1 = 0;

    while($data = mysqli_fetch_array($hasil)){
        $harga1 += $data['harga'];
    }

    //Ambil data harga dari tabel 2
    $sql = "SELECT biaya_periksa FROM periksa";
    $hasil = mysqli_query($mysqli, $sql);
    $harga2 = 0;

    while($data = mysqli_fetch_array($hasil)){
        $harga2 += $data['biaya_periksa'];
    }

    //Jumlahkan kedua harga
    $total = $harga1 + $harga2;
?>

<!-- Table-->
    <table class="table table-hover">
        <!--thead atau baris judul-->
        <thead>
            <tr>
                <th scope="col" style="text-align: center; vertical-align: middle;">No</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">Pasien</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">Dokter</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">Tanggal Periksa</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">Catatan</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">Biaya Jasa</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">Obat</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">Biaya Obat</th>
                <th scope="col" style="text-align: center; vertical-align: middle;">Total</th>
            </tr>
        </thead>
        <!--tbody berisi isi tabel sesuai dengan judul atau head-->
        <tbody>
            <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
            berdasarkan status dan tanggal awal-->
            <?php
            $result = mysqli_query($mysqli, "SELECT pr.*,d.nama as 'nama_dokter', p.nama as 'nama_pasien' FROM periksa pr LEFT JOIN dokter d ON (pr.id_dokter=d.id) LEFT JOIN pasien p ON (pr.id_pasien=p.id) ORDER BY pr.tgl_periksa DESC");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td class="text-center align-middle"><?php echo $no++ ?></td>
                    <td class="text-center align-middle"><?php echo $data['nama_pasien'] ?></td>
                    <td class="text-center align-middle"><?php echo $data['nama_dokter'] ?></td>
                    <td class="text-center align-middle"><?php echo $data['tgl_periksa'] ?></td>
                    <td class="text-center align-middle"><?php echo $data['catatan'] ?></td>
                    <td class="text-center align-middle"><?php echo $data['biaya_periksa'] ?></td>
                    <td class="text-center align-middle"><select class="form-control" name="id_obat">
            <?php
            $selected = '';
            $obat = mysqli_query($mysqli, "SELECT * FROM obat");
            while ($data = mysqli_fetch_array($obat)) {
                if ($data['id'] == $id_obat) {
                    $selected = 'selected="selected"';
                } else {
                    $selected = '';
                }
            ?>
                <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama_obat'] ?></option>
            <?php
            }
            ?>
        </select></td>
                    <td class="text-center align-middle"><select class="form-control" name="id_obat">
            <?php
            $selected = '';
            $obat = mysqli_query($mysqli, "SELECT * FROM obat");
            while ($data = mysqli_fetch_array($obat)) {
                if ($data['id'] == $id_obat) {
                    $selected = 'selected="selected"';
                } else {
                    $selected = '';
                }
            ?>
                <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['harga'] ?></option>
            <?php
            }
            ?>
        </select></td>
        <td class="text-center align-middle"><?php
            //Ambil data harga dari tabel 1
                $sql = "SELECT harga FROM obat";
                $hasil = mysqli_query($mysqli, $sql);
                $harga1 = 0;

                while($data = mysqli_fetch_array($hasil)){
                    $harga1 += $data['harga'];
                }

                //Ambil data harga dari tabel 2
                $sql = "SELECT biaya_periksa FROM periksa";
                $hasil = mysqli_query($mysqli, $sql);
                $harga2 = 0;

                while($data = mysqli_fetch_array($hasil)){
                    $harga2 += $data['biaya_periksa'];
                }

                //Jumlahkan kedua harga
                $total = $harga1 + $harga2;
            ?>
            <?php echo $total; ?></h2></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    </form>
</body>
</html>