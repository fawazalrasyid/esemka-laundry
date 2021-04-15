<?php
$title = 'Pembayaran';
require 'koneksi.php';

$query = mysqli_query($conn, "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.total_harga FROM transaksi INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi WHERE transaksi.id_transaksi = " . $_GET['id']);
$data = mysqli_fetch_assoc($query);

if (isset($_POST['btn-simpan'])) {
    $total_bayar = $_POST['total_bayar'];
    if ($total_bayar >= $data['total_harga']) {
        $query = "UPDATE transaksi SET status_bayar = 'dibayar', tgl_pembayaran = '" . date('Y-m-d h:i:s') . "' WHERE id_transaksi = " . $_GET['id'];
        $query2 = "UPDATE detail_transaksi SET total_bayar = '$total_bayar' WHERE id_transaksi = " . $_GET['id'];

        $insert = mysqli_query($conn, $query);
        $insert2 = mysqli_query($conn, $query2);
        if ($insert == 1 && $insert2 == 1) {
            echo "<script>alert('OK');</script>";
            header('location: transaksi_dibayar.php?id=' . $_GET['id']);
        } else {
            echo "<div class='alert alert-danger'>Gagal Tambah Data!!!</div>";
        }
    } else {
        $msg = "Jumlah Uang Pembayaran Kurang";
        header('location:bayar.php?id=' . $_GET['id'] . '&msg=' . $msg);
    }
}

require 'header.php';
?>

<!-- Content -->
<div class="main-content container-fluid">

    <div class="page-title mb-5">
        <h3><?= $title; ?></h3>
    </div>

    <section class="section">
        <!-- Basic Vertical form layout section start -->
        <section id="basic-vertical-layouts">
            <div class="col-md-10 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Pembayaran</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="bayar.php?id=<?= $data['id_transaksi']; ?>" method="POST">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kode Invoice</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="kode_invoice" value="<?= $data['kode_invoice']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Pelanggan</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="nama_pelanggan" value="<?= $data['nama_pelanggan']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Total Yang Harus Dibayarkan</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="total_harga" value="<?= 'Rp ' . number_format($data['total_harga']); ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Masukan Jumlah Pembayaran</label>
                                                <input type="number" id="first-name-vertical" class="form-control" name="total_bayar">
                                                <?php if (isset($_GET['msg'])) : ?>
                                                    <small class="text-danger"><?= $_GET['msg'] ?></small>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" name="btn-simpan" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button href="javascript:void(0)" onclick="window.history.back();" type="reset" class="btn btn-light-secondary me-1 mb-1">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // Basic Vertical form layout section end -->
        </section>
</div>
<!-- End Content -->

<?php require 'footer.php'; ?>