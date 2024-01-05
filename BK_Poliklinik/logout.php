<?php
    session_start();
    session_destroy();
    echo "Logout berhasil. Anda akan diarahkan ke halaman login...";
?>
<script>document.location='index.php?page=login_pasien'</script>
