<?php include 'includes/header.php'; ?>
<?php include 'includes/config.php'; ?>
<?php
$id_paket = $_GET['id_paket'] ?? 0;

$data_paket = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM paket_wisata WHERE id='$id_paket'")
);
if (!$data_paket) {
    die("Paket tidak ditemukan");
}
?>
?>

<main class="main">
    <section class="section">
        <div class="container">

            <div class="section-title">
                <h2>Form Pemesanan Paket Wisata</h2>
                <p>Silakan lengkapi data pemesanan Anda</p>
            </div>

            <form action="proses_pemesanan.php" method="POST" id="formPemesanan">

                <div class="row g-4">

                    <div class="col-md-6">
                        <label>Nama Pemesan</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>No HP / Telp</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Tanggal Pesan</label>
                        <input type="date" name="tanggal_pesan" class="form-control" required>
                    </div>
                    <input type="hidden" name="id_paket" value="<?= $data_paket['id'] ?>">
                    <div class="col-md-6">
                        <label>Paket Wisata</label>
                        <input type="text" class="form-control"
                            value="<?= $data_paket['nama_paket'] ?>" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Harga Paket Wisata (per orang)</label>
                        <input type="number" id="harga_paket" name="harga_paket" class="form-control" value="<?= $data_paket['harga'] ?>" readonly>
                    </div>


                    <div class="col-md-6">
                        <label>Durasi Liburan (Hari)</label>
                        <input type="number" name="lama_hari" id="lama_hari" class="form-control" value="1" required>
                    </div>

                    <div class="col-md-6">
                        <label>Jumlah Wisatawan</label>
                        <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control" value="1" required>
                    </div>

                    <div class="col-md-6">
                        <label>Pelayanan</label><br>
                        <input type="checkbox" name="penginapan" value="100000" class="layanan"> Penginapan (Rp100.000)<br>
                        <input type="checkbox" name="transportasi" value="200000" class="layanan"> Transportasi (Rp200.000)<br>
                        <input type="checkbox" name="makanan" value="50000" class="layanan"> Makanan (Rp50.000)
                    </div>

                    <div class="col-md-6">
                        <label>Harga Pelayanan Tambahan</label>
                        <input type="number" id="harga_layanan" name="harga_layanan" class="form-control" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Jumlah Tagihan</label>
                        <input type="text" id="total_tagihan" name="total_tagihan" class="form-control" readonly>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Pesan Sekarang</button>
                    </div>

                </div>

            </form>

        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>