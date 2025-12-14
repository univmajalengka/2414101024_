<?php
include 'includes/config.php';
include 'includes/header.php';

$id = $_GET['id'] ?? 0;

/* =============================
   AMBIL DATA PESANAN + PAKET
   ============================= */
$data = mysqli_fetch_assoc(mysqli_query($conn, "
  SELECT p.*, pw.nama_paket, pw.harga
  FROM pemesanan p
  JOIN paket_wisata pw ON p.id_paket = pw.id
  WHERE p.id = '$id'
"));

if (!$data) {
    die("Data pesanan tidak ditemukan");
}

/* =============================
   PROSES UPDATE
   ============================= */
if (isset($_POST['update'])) {

    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $tanggal_pesan = $_POST['tanggal_pesan'];
    $lama_hari = (int)$_POST['lama_hari'];
    $jumlah_peserta = (int)$_POST['jumlah_peserta'];

    $penginapan   = isset($_POST['penginapan']) ? 1 : 0;
    $transportasi = isset($_POST['transportasi']) ? 1 : 0;
    $makanan      = isset($_POST['makanan']) ? 1 : 0;

    /* =============================
     HITUNG ULANG LAYANAN (SERVER)
     ============================= */
    $harga_layanan = 0;

    if ($penginapan) {
        $harga_layanan += 100000 * $lama_hari * $jumlah_peserta;
    }
    if ($transportasi) {
        $harga_layanan += 300000 * $lama_hari;
    }
    if ($makanan) {
        $harga_layanan += 50000 * $lama_hari * $jumlah_peserta;
    }

    $total_paket = $data['harga'] * $jumlah_peserta;
    $total_tagihan = $total_paket + $harga_layanan;

    /* =============================
     UPDATE DATABASE
     ============================= */
    mysqli_query($conn, "
    UPDATE pemesanan SET
      nama='$nama',
      no_hp='$no_hp',
      tanggal_pesan='$tanggal_pesan',
      lama_hari='$lama_hari',
      jumlah_peserta='$jumlah_peserta',
      penginapan='$penginapan',
      transportasi='$transportasi',
      makanan='$makanan',
      harga_layanan='$harga_layanan',
      total_tagihan='$total_tagihan'
    WHERE id='$id'
  ");

    header("Location: data_pesanan.php");
    exit;
}
?>

<section class="section">
    <div class="container">
        <h2 class="text-center mb-4">Edit Pesanan <?= $data['nama'] ?></h2>

        <form method="POST">
            <div class="row g-3">

                <div class="col-md-6">
                    <label>Nama Pemesan</label>
                    <input type="text" name="nama" class="form-control"
                        value="<?= $data['nama'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label>No HP / Telp</label>
                    <input type="text" name="no_hp" class="form-control"
                        value="<?= $data['no_hp'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label>Tanggal Pesan</label>
                    <input type="date" name="tanggal_pesan" class="form-control"
                        value="<?= $data['tanggal_pesan'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label>Paket Wisata</label>
                    <input type="text" class="form-control"
                        value="<?= $data['nama_paket'] ?>" readonly>
                </div>

                <div class="col-md-6">
                    <label>Harga Paket (per orang)</label>
                    <input type="number" id="harga_paket" class="form-control"
                        value="<?= $data['harga'] ?>" readonly>
                </div>

                <div class="col-md-6">
                    <label>Lama Perjalanan (Hari)</label>
                    <input type="number" id="lama_hari" name="lama_hari"
                        class="form-control"
                        value="<?= $data['lama_hari'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label>Jumlah Peserta</label>
                    <input type="number" id="jumlah_peserta" name="jumlah_peserta"
                        class="form-control"
                        value="<?= $data['jumlah_peserta'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label>Pelayanan</label><br>

                    <input type="checkbox" class="layanan" name="penginapan"
                        <?= $data['penginapan'] ? 'checked' : '' ?>>
                    Penginapan (Rp100.000 / hari / orang)<br>

                    <input type="checkbox" class="layanan" name="transportasi"
                        <?= $data['transportasi'] ? 'checked' : '' ?>>
                    Transportasi (Rp300.000 / hari / grup)<br>

                    <input type="checkbox" class="layanan" name="makanan"
                        <?= $data['makanan'] ? 'checked' : '' ?>>
                    Makanan (Rp50.000 / hari / orang)
                </div>

                <div class="col-md-6">
                    <label>Harga Pelayanan Tambahan</label>
                    <input type="number" id="harga_layanan" class="form-control"
                        value="<?= $data['harga_layanan'] ?>" readonly>
                </div>

                <div class="col-md-6">
                    <label>Total Tagihan</label>
                    <input type="number" id="total_tagihan" class="form-control"
                        value="<?= $data['total_tagihan'] ?>" readonly>
                </div>

                <div class="col-md-12 mt-3">
                    <button type="submit" name="update" class="btn btn-success">
                        Update
                    </button>
                    <a href="data_pesanan.php" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </div>
        </form>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const layanan = document.querySelectorAll('.layanan');
        const lamaHari = document.getElementById('lama_hari');
        const jumlahPeserta = document.getElementById('jumlah_peserta');
        const hargaPaket = document.getElementById('harga_paket');
        const hargaLayanan = document.getElementById('harga_layanan');
        const totalTagihan = document.getElementById('total_tagihan');

        function hitungTotal() {

            let hargaDasar = parseInt(hargaPaket.value) || 0;
            let hari = parseInt(lamaHari.value) || 0;
            let peserta = parseInt(jumlahPeserta.value) || 0;

            let layananTotal = 0;

            layanan.forEach(item => {
                if (item.checked) {
                    if (item.name === 'penginapan') {
                        layananTotal += 100000 * hari * peserta;
                    }
                    if (item.name === 'transportasi') {
                        layananTotal += 300000 * hari;
                    }
                    if (item.name === 'makanan') {
                        layananTotal += 50000 * hari * peserta;
                    }
                }
            });

            let total = (hargaDasar * peserta) + layananTotal;

            hargaLayanan.value = layananTotal;
            totalTagihan.value = total;
        }

        layanan.forEach(item => item.addEventListener('change', hitungTotal));
        lamaHari.addEventListener('input', hitungTotal);
        jumlahPeserta.addEventListener('input', hitungTotal);

        hitungTotal();
    });
</script>

<?php include 'includes/footer.php'; ?>