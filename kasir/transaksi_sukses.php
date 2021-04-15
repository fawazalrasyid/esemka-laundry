<?php
$title = 'Transaksi Sukses';
require 'koneksi.php';
require 'header.php';

$query = "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.total_harga FROM transaksi INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi WHERE transaksi.id_transaksi = " . $_GET['id'];
$transaksi = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($transaksi);
?>

<!-- Content -->
<div class="main-content container-fluid">

    <div class="page-title mb-5">
        <h3><?= $title; ?></h3>
    </div>

    <section class="section">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
                    </script> -->
                    <!-- <div class="row justify-content-center align-items-center">
                        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_udsg68fb.json" background="transparent" speed="1" style="width: 300px; height: 300px;" autoplay></lottie-player>
                    </div> -->
                    <div class="row text-center mt-5 mb-3">
                        <h4>Pesanan atas nama</h3>
                        <h3 class="font-bold mb-3"><?= $data['nama_pelanggan'] ?></h6>
                        <h4>Berhasil di simpan</h3>
                        <h4 class="font-semibold">Kode Invoice <?= $data['kode_invoice'] ?></h6>
                        <h4 class="font-semibold">Total Pembayaran <?= 'Rp ' . number_format($data['total_harga']); ?></h6>
                    </div>
                    <div class="button text-center mb-5">
                        <a href="transaksi.php"  class="btn btn-primary">Kembali Ke Menu Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- End Content -->

<?php require 'footer.php'; ?>