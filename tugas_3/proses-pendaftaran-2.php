<?php

include("koneksi.php");

// cek apakah tombol daftar sudah diklik atau belum?
if(isset($_POST['daftar'])){

    // ambil data dari formulir
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah = $_POST['sekolah_asal'];

    // --- BAGIAN INI KITA UBAH JADI PREPARED STATEMENT (LEBIH AMAN) ---
    
    // 1. Siapkan template query dengan tanda tanya (?) sebagai placeholder
    $sql = "INSERT INTO calon_siswa (nama, alamat, jenis_kelamin, agama, sekolah_asal) VALUES (?, ?, ?, ?, ?)";
    
    // 2. Inisialisasi statement
    $stmt = mysqli_stmt_init($db);

    // 3. Cek kesiapan query
    if (mysqli_stmt_prepare($stmt, $sql)) {
        
        // 4. Bind parameter (mengikat data ke tanda tanya tadi)
        // "sssss" artinya ada 5 data bertipe String (s)
        mysqli_stmt_bind_param($stmt, "sssss", $nama, $alamat, $jk, $agama, $sekolah);
        
        // 5. Eksekusi query
        $execute = mysqli_stmt_execute($stmt);

        // Cek apakah berhasil
        if( $execute ) {
            header('Location: index.php?status=sukses');
        } else {
            header('Location: index.php?status=gagal');
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
        
    } else {
        // Jika query gagal disiapkan
        die("Query Error: " . mysqli_error($db));
    }

} else {
    die("Akses dilarang...");
}

?>