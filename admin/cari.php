<?php
$title = 'Pilih Pelanggan';
require 'koneksi.php';

$query = 'SELECT * FROM pelanggan';
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
                <h4>Data Pelanggan</h4>
            </div>
            <div class="card-body">
                <table id="table1" class='table table-striped'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th class="col-sm-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (mysqli_num_rows($data) > 0) {
                            while ($plg = mysqli_fetch_assoc($data)) {
                                ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $plg['nama_pelanggan']; ?></td>
                                    <td><?= $plg['alamat_pelanggan']; ?></td>
                                    <td><?php if ($plg['jenis_kelamin'] == 'L') {
                                                    echo "Laki-laki";
                                                } else {
                                                    echo "Perempuan";
                                                } ?>
                                    </td>
                                    <td>
                                        <div class="buttons d-flex justify-content-between">
                                            <a href="tambah_transaksi.php?id=<?= $plg['id_pelanggan']; ?>" class="btn btn-sm btn-primary">
                                                Pilih</a>
                                        </div>

                                    </td>
                                </tr>
                        <?php }
                        }
                        ?>
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