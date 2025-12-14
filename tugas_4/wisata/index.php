<?php
include 'includes/config.php';
$paket = mysqli_query($conn, "SELECT * FROM paket_wisata");
include 'includes/header.php';
?>
<main class="main">

  <!-- Hero Section -->
  <section id="hero" class="hero section">
    <div class="hero-wrapper ">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-8 hero-content" data-aos="fade-right" data-aos-delay="100">
            <h1 class="text-center">Majalengka Exotic Sundaland</h1>
            <p class="text-center">Bukan sekadar destinasi wisata, Majalengka adalah rumah bagi ribuan cerita alam yang menanti untuk Anda singkap keindahannya. Dari puncak ketinggian hingga lembah yang asri, ciptakan momen tak terlupakan di setiap sudut eksotis Majalengka</p>
          </div>
        </div>
      </div>
    </div>

  </section><!-- /Hero Section -->

  <!-- About Section -->
  <section id="about" class="about section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-12">
          <div class="core-values" data-aos="fade-up" data-aos-delay="500">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-4">
              <div class="col">
                <div class="value-card">
                  <div class="value-icon">
                    <i class="bi bi-layers-fill"></i>
                  </div>
                  <h4>Terasering</h4>
                </div>
              </div>
              <div class="col">
                <div class="value-card">
                  <div class="value-icon">
                    <i class="bi bi-water"></i>
                  </div>
                  <h4>Curug</h4>
                </div>
              </div>
              <div class="col">
                <div class="value-card">
                  <div class="value-icon">
                    <i class="bi bi-droplet-fill"></i>
                  </div>
                  <h4>Situ</h4>
                </div>
              </div>
              <div class="col">
                <div class="value-card">
                  <div class="value-icon">
                    <i class="bi bi-cloud-sun-fill"></i>
                  </div>
                  <h4>Taman Publik</h4>
                </div>
              </div>
              <div class="col">
                <div class="value-card">
                  <div class="value-icon">
                    <i class="bi bi-house-heart-fill"></i>
                  </div>
                  <h4>Desa Wisata</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </section><!-- /About Section -->

  <!-- Featured Programs Section -->
  <section id="paket" class="featured-programs students-life-block section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Paket Wisata</h2>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row">
        <?php while ($row = mysqli_fetch_assoc($paket)) { ?>
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100" style="margin-bottom: 40px;">
            <div class="program-banner">
              <div class="banner-image">
                <img src="assets/img/paket/<?= $row['gambar'] ?>" alt="Program" class="img-fluid">
                <div class="banner-badge">
                  <a href="<?= $row['video_youtube'] ?>" class="discover-btn glightbox"><i class="bi bi-play-circle "></i>
                    <span class="badge-text">Video Wisata</span></a>
                </div>
              </div>
              <div class="banner-info">
                <div class="program-header">
                  <h3><?= $row['nama_paket'] ?></h3>
                </div>
                <p><?= $row['deskripsi'] ?></p>
                <div class="program-details" style="gap: 5px; margin-bottom: 5px;">Destinasi :
                  <div class="detail-item">
                    <span> <?= $row['destinasi'] ?></span>
                  </div>
                </div>
                <div class="program-details" style="gap: 5px; margin-bottom: 5px;">Harga :
                  <div class="detail-item">
                    <span>Rp <?= number_format($row['harga']) ?> / orang</span>
                  </div>
                </div>
                <a href="pemesanan.php?id_paket=<?= $row['id'] ?>" class="btn btn-success">
                  Pesan Tiket
                </a>
              </div>
            </div>
          </div><!-- End Program Banner -->
        <?php } ?>
      </div>

    </div>

    </div>

  </section><!-- /Featured Programs Section -->

</main>

<?php include 'includes/footer.php'; ?>