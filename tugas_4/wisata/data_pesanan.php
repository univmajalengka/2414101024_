<?php
include 'includes/header.php';
include 'includes/config.php';

$query = mysqli_query($conn, "
  SELECT p.*, pw.nama_paket
  FROM pemesanan p
  JOIN paket_wisata pw ON p.id_paket = pw.id
  ORDER BY p.id DESC
");
?>

<main class="main">
    <section class="section">
        <div class="container">

            <div class="section-title">
                <h2>Data Pesanan</h2>
                <p>Daftar pemesanan paket wisata</p>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Wisata</th>
                            <th>Jumlah Wisatawan</th>
                            <th>Hari</th>
                            <th>Biaya Paket Wisata</th>
                            <th>Biaya Layanan</th>
                            <th>Total Tagihan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($row = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['nama_paket'] ?></td>
                                <td><?= $row['jumlah_peserta'] ?></td>
                                <td><?= $row['lama_hari'] ?></td>
                                <td>Rp <?= number_format($row['harga_paket']) ?></td>
                                <td>Rp <?= number_format($row['harga_layanan']) ?></td>
                                <td><strong>Rp <?= number_format($row['total_tagihan']) ?></strong></td>
                                <td>
                                    <a href="edit_pesanan.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="hapus_pesanan.php?id=<?= $row['id'] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>