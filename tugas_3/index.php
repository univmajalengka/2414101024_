<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Siswa Baru</title>
</head>
<body>
    <h3>Pendaftaran Berhasil!</h3>
    <?php if(isset($_GET['status'])): ?>
    <p>
        <?php
            if($_GET['status'] == 'sukses'){
                echo "Pendaftaran siswa baru berhasil!";
            } else {
                echo "Pendaftaran gagal!";
            }
        ?>
    </p>
    <?php endif; ?>
    <br>
    <a href="form-daftar.php">Daftar Lagi</a>
</body>
</html>