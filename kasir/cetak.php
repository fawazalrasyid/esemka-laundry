<?php

require 'koneksi.php';

$id_outlet = $_SESSION['outlet_id'];

$query = "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.total_harga, outlet.nama_outlet FROM transaksi INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi INNER JOIN outlet ON outlet.id_outlet = transaksi.outlet_id WHERE outlet_id = '$id_outlet'";
$data = mysqli_query($conn, $query);

setlocale(LC_ALL, 'id_id');
setlocale(LC_TIME, 'id_ID.utf8');
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>laporan-transaksi-laundry_<?= date('dmY'); ?></title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/app.css">
</head>

<body>
    <div class="main-content container-fluid">

        <!-- Header -->
        <table class="col-12 col-md-4 mb-5">
            <tbody>
                <tr>
                    <td>
                        <img src="../assets/images/logo.svg" height="40" class="mb-3">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>LAPORAN TRANSAKSI LAUNDRY</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Petugas : <?= $_SESSION['nama_user']; ?></h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Role : <?= $_SESSION['role']; ?></h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Tanggal : <?= strftime('%d %B %Y') ?></h6>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- End Header -->

        <table id="table1" class='table table-bordered'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama Pelanggan</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Total</th>
                    <th>Outlet Pembayaran</th>
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
                            <td><?= $trans['nama_outlet']; ?></td>
                        </tr>
                <?php }
                }
                ?>
            </tbody>
        </table>
        <script>
            window.print();
        </script>
    </div>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>