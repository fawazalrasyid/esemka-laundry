<?php
$title = 'Detail Pembayaran';
require 'koneksi.php';

$status = [
    'baru',
    'proses',
    'selesai',
    'diambil'
];

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT transaksi.*, pelanggan.nama_pelanggan, detail_transaksi.*, outlet.nama_outlet, paket_cuci.nama_paket FROM transaksi INNER JOIN pelanggan ON pelanggan.id_pelanggan = transaksi.id_pelanggan INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi INNER JOIN outlet ON outlet.id_outlet = transaksi.outlet_id INNER JOIN paket_cuci ON paket_cuci.outlet_id = transaksi.outlet_id WHERE transaksi.id_transaksi = '$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['btn-simpan'])) {
    $status = $_POST['status'];

    $query = "UPDATE transaksi SET status = '$status' WHERE id_transaksi = '$id'";
    $update = mysqli_query($conn, $query);
    if ($update == 1) {
        $msg = 'Berhasil mengubah status pembayaran';
        header('location:transaksi.php?msg=' . $msg);
        // $_SESSION['msg'] = 'Berhasil mengubah status pembayaran';
        // header('location: transaksi.php');
    } else {
        $_SESSION['msg'] = 'Gagal Mengubah Status Transaksi!!!';
        header('location:detail.php');
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
                                                <label for="first-name-vertical">Jenis Paket</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="jenis_paket" value="<?= $data['nama_paket']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Jumlah</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="jumlah" value="<?= $data['qty']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Total Harga</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="total_harga" value="<?= 'Rp ' . number_format($data['total_harga']); ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Total Bayar</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="total_bayar" value="<?= 'Rp ' . number_format($data['total_bayar']); ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Tanggal Dibayar</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="total_harga" value="<?= $data['tgl_pembayaran']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="defaultSelect">Status Transaksi</label>
                                                <select name="status" class="form-select" id="defaultSelect">
                                                    <?php foreach ($status as $key) : ?>
                                                        <?php if ($key == $data['status']) : ?>
                                                            <option value="<?= $key ?>" selected><?= $key ?></option>
                                                        <?php endif ?>
                                                        <option value="<?= $key ?>"><?= $key ?></option>
                                                    <?php endforeach ?>
                                                </select>
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