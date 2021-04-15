<?php
$title = 'Transaksi';
require 'koneksi.php';

$query = "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.total_harga FROM transaksi INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi";
$data = mysqli_query($conn, $query);

require 'header.php';
?>

<!-- Content -->
<div class="main-content container-fluid">

    <div class="page-title mb-5">
        <h3><?= $title; ?></h3>
    </div>

    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] <> '') { ?>
        <div class="alert alert-success mb-5" role="alert" id="msg">
            <?= $_SESSION['msg']; ?>
        </div>
    <?php }
    $_SESSION['msg'] = ''; ?>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Data Transaksi</h4>
                <div class="buttons">
                    <a href="konfirmasi.php" class="btn icon icon-left btn-primary"><i data-feather="check-square"></i>
                        Konfirmasi Pembayaran</a>
                    <a href="cari.php" class="btn icon icon-left btn-primary"><i data-feather="plus-square"></i>
                        Tambah Transaksi</a>
                </div>
            </div>
            <div class="card-body">
                <table id="table1" class='table table-striped'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Nama Pelanggan</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Total</th>
                            <th class="col-sm-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (mysqli_num_rows($data) > 0) {
                            while ($trans = mysqli_fetch_assoc($data)) {
                                ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $trans['kode_invoice']; ?></td>
                                    <td><?= $trans['nama_pelanggan']; ?></td>
                                    <td><?= $trans['status']; ?></td>
                                    <td><?= $trans['status_bayar']; ?></td>
                                    <td><?= 'Rp ' . number_format($trans['total_harga']); ?></td>
                                    <td>
                                        <div class="buttons d-flex justify-content-between">
                                            <a href="detail.php?id=<?= $trans['id_transaksi']; ?>" class="btn btn-sm btn-primary">
                                                Detail</a>
                                        </div>

                                    </td>
                                </tr>
                        <?php }
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
<!-- End Content -->

<?php
require 'footer.php';
?>