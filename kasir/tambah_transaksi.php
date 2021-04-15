<?php
$title = 'Tambah Transaksi';
require 'koneksi.php';

$tgl = date('Y-m-d h:i:s');
$seminggu = mktime(0, 0, 0, date("n"), date("j") + 7, date("Y"));
$batas_waktu = date("Y-m-d h:i:s", $seminggu);

$kode = "EL" . date('Ymdsi');
$id_outlet = $_SESSION['outlet_id'];
$id_user = $_SESSION['user_id'];
$id_pelanggan = $_GET['id'];

$query = "SELECT nama_outlet FROM outlet WHERE id_outlet = '$id_outlet'";
$data = mysqli_query($conn, $query);
$outlet = mysqli_fetch_assoc($data);

$query2 = "SELECT nama_pelanggan FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'";
$data2 = mysqli_query($conn, $query2);
$pelanggan = mysqli_fetch_assoc($data2);

$query3 = "SELECT * FROM paket_cuci WHERE outlet_id = '$id_outlet'";
$paket = mysqli_query($conn, $query3);

if (isset($_POST['btn-simpan'])) {
    $kode_invoice = $_POST['kode_invoice'];
    $biaya_tambah = $_POST['biaya_tambahan'];
    $diskon = $_POST['diskon'];
    $pajak = $_POST['pajak'];

    $query4 = "INSERT INTO transaksi (outlet_id, kode_invoice, id_pelanggan, tgl, batas_waktu, biaya_tambahan, diskon, pajak, status, status_bayar, id_user) VALUES ('$id_outlet', '$kode_invoice', '$id_pelanggan', '$tgl', '$batas_waktu', '$biaya_tambah', '$diskon', '$pajak', 'baru', 'belum', '$id_user')";
    $insert = mysqli_query($conn, $query4);
    if ($insert == 1) {
        $id_paket = $_POST['id_paket'];
        $qty = $_POST['qty'];
        $query5 = mysqli_query($conn, "SELECT * FROM paket_cuci WHERE id_paket = $id_paket");
        $paket_harga = mysqli_fetch_assoc($query5);
        $total = $paket_harga['harga'] * $qty;
        $kode_invoice;
        $query6 = mysqli_query($conn, "SELECT * FROM transaksi WHERE kode_invoice = '" . $kode_invoice . "'");
        $transaksi = mysqli_fetch_assoc($query6);
        $id_transaksi = $transaksi['id_transaksi'];

        $query_detail = "INSERT INTO detail_transaksi (id_transaksi, id_paket, qty, total_harga) VALUES ('$id_transaksi', '$id_paket', '$qty', '$total')";
        $insert_detail = mysqli_query($conn, $query_detail);
        if ($insert_detail == 1) {
            $_SESSION['msg'] = 'Berhasil menambahkan ';
            header('location:transaksi_sukses.php?id=' . $id_transaksi);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Gagal transaksi!!!</div>";
            header('location:tambah_transaksi.php');
        }
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
                        <h4 class="card-title">Data Outlet</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="" method="POST">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kode Invoice</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="kode_invoice" value="<?= $kode; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Outlet</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="" value="<?= $outlet['nama_outlet']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Pelanggan</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="" value="<?= $pelanggan['nama_pelanggan']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="defaultSelect">Pilih Paket</label>
                                                <select name="id_paket" class="form-select" id="paket">
                                                    <?php while ($key = mysqli_fetch_array($paket)) { ?>
                                                        <option value="<?= $key['id_paket']; ?>"><?= $key['nama_paket']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Jumlah</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="qty">
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Biaya Tambahan</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="biaya_tambahan" value="0">
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Dsikon(%)</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="diskon" value="0">
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Pajak</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="pajak" value="0">
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