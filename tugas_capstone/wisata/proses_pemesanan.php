<?php
include 'includes/config.php';
$wisata = $_POST['wisata'] ?? '';
$harga_tiket = $_POST['harga_tiket'] ?? 0;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_paket = $_POST['id_paket'];
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $tanggal_pesan = $_POST['tanggal_pesan'];
    $lama_hari = $_POST['lama_hari'];
    $jumlah_peserta = $_POST['jumlah_peserta'];

    $penginapan   = isset($_POST['penginapan']) ? 1 : 0;
    $transportasi = isset($_POST['transportasi']) ? 1 : 0;
    $makanan      = isset($_POST['makanan']) ? 1 : 0;

    $data_paket = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT harga FROM paket_wisata WHERE id='$id_paket'")
    );

    $harga_paket = $data_paket['harga'];

    $harga_layanan = 0;

    if ($penginapan) {
        $harga_layanan += 100000 * $lama_hari * $jumlah_peserta;
    }

    if ($transportasi) {
        $harga_layanan += 200000 * $lama_hari;
    }

    if ($makanan) {
        $harga_layanan += 50000 * $lama_hari * $jumlah_peserta;
    }

    $total_paket = $harga_paket * $jumlah_peserta;
    $total_tagihan = $total_paket + $harga_layanan;

    if (empty($nama) || empty($no_hp)) {
        echo "Data harus diisi!";
        exit;
    }

    $sql = "
    INSERT INTO pemesanan (
    id_paket, nama, no_hp, tanggal_pesan,
    lama_hari, jumlah_peserta,
    penginapan, transportasi, makanan,
    harga_paket, harga_layanan, total_tagihan
    ) VALUES (
    '$id_paket', '$nama', '$no_hp', '$tanggal_pesan',
    '$lama_hari', '$jumlah_peserta',
    '$penginapan', '$transportasi', '$makanan',
    '$total_paket', '$harga_layanan', '$total_tagihan'
    )
    ";

    if (mysqli_query($conn, $sql)) {
        header("Location: data_pesanan.php");
    } else {
        echo "Gagal menyimpan data";
    }
}
