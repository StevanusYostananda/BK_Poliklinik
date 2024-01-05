<?php
include_once("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- /Logo -->
            <form method="POST">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="nama" autofocus />
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" placeholder="alamat" autofocus />
              </div>
              <div class="mb-3">
                <label for="no_ktp" class="form-label">No KTP</label>
                <input type="text" class="form-control" name="no_ktp" placeholder="no_ktp" autofocus />
              </div>
              <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="text" class="form-control" name="no_hp" placeholder="no_hp" autofocus />
              </div>
              <div class="mb-3">
                <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                <input type="text" class="form-control" name="no_rm" placeholder="no_rm" autofocus />
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit" name="simpan">Register</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>
  <?php
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $no_ktp = $_POST['no_ktp'];
        $no_hp = $_POST['no_hp'];
        $no_rm = $_POST['no_rm'];
        $query = mysqli_query($mysqli, "SELECT * FROM pasien WHERE nama = '$nama'");
        if(mysqli_num_rows($query) > 0){
          echo
          "<script> alert('Username Has Already Taken'); </script>";
        }else{
            $tambah = mysqli_query($mysqli, "INSERT INTO pasien (id,nama,alamat,no_ktp,no_hp,no_rm) 
            VALUES ('','$nama','$alamat','$no_ktp','$no_hp','$no_rm' )");
            echo
            "<script> alert('Registration Successful'); document.location='index.php?page=login'; </script>";         
        }
      }
    ?>
</body>
</html>