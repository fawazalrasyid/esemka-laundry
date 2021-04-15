<?php
$title = 'Dashboard';
require 'koneksi.php';
require 'header.php';

setlocale(LC_ALL, 'id_id');
setlocale(LC_TIME, 'id_ID.utf8');

$query = mysqli_query($conn, "SELECT COUNT(id_transaksi) as jumlah_transaksi FROM transaksi");
$jumlah_transaksi = mysqli_fetch_assoc($query);

$query2 = mysqli_query($conn, "SELECT COUNT(id_pelanggan) as jumlah_pelanggan FROM pelanggan");
$jumlah_pelanggan = mysqli_fetch_assoc($query2);

$query3 = mysqli_query($conn, "SELECT COUNT(id_outlet) as jumlah_outlet FROM outlet");
$jumlah_outlet = mysqli_fetch_assoc($query3);

$query4 = mysqli_query($conn, "SELECT SUM(total_harga) as total_penghasilan FROM detail_transaksi INNER JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE status_bayar = 'dibayar'");
$total_penghasilan = mysqli_fetch_assoc($query4);

$query5 = mysqli_query($conn, "SELECT MONTHNAME(tgl_pembayaran) as bulan, SUM(total_harga) as penghasilan_bulan FROM detail_transaksi INNER JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE status_bayar = 'dibayar' AND YEAR(tgl_pembayaran) = YEAR(NOW()) GROUP BY MONTH(tgl_pembayaran)");
while($penghasilan_perbulan = mysqli_fetch_array($query5)){
	$nama_bulan[] = $penghasilan_perbulan['bulan'];
    $total_penghasilan_perbulan[] = $penghasilan_perbulan['penghasilan_bulan'];
}
?>


<!-- Content -->
<div class="main-content container-fluid">

    <div class="page-title mb-5">
        <h3><?= $title; ?> Esemka Laundry</h3>
    </div>

    <section class="section">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldBag mb-2"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Outlet</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlah_outlet['jumlah_outlet']; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldUser mb-2"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pelanggan</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlah_pelanggan['jumlah_pelanggan']; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldScan mb-2"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Transaksi</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlah_transaksi['jumlah_transaksi']; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldWallet mb-2"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Penghasilan</h6>
                                    <h6 class="font-extrabold mb-0">
                                        <?= 'Rp ' . number_format($total_penghasilan['total_penghasilan']); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Sales</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-monthly-sales"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- End Content -->

<script>
var optionsMonthlySales = {
    annotations: {
        position: 'back'
    },
    dataLabels: {
        enabled: false
    },
    chart: {
        type: 'bar',
        height: 300
    },
    fill: {
        opacity: 1
    },
    plotOptions: {},
    series: [{
        name: 'sales',
        data: <?php echo json_encode($total_penghasilan_perbulan); ?>
    }],
    colors: '#0D6EFD',
    xaxis: {
        categories: <?php echo json_encode($nama_bulan); ?>
    },
}

var chartMonthlySales = new ApexCharts(document.querySelector("#chart-monthly-sales"), optionsMonthlySales);
chartMonthlySales.render();
</script>

<?php require 'footer.php';?>