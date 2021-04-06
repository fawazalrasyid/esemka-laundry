<?php
$title = 'Tambah Transaksi';
require 'koneksi.php';

$tgl = date('Y-m-d h:i:s');
$seminggu = mktime(0, 0, 0, date("n"), date("j") + 7, date("Y"));
$batas_waktu = date("Y-m-d h:i:s", $seminggu);

$kode = "EL" . date('Ymdsi');
$id_user = $_SESSION['user_id'];
$id_pelanggan = $_GET['id'];

$query = "SELECT * FROM outlet";
$outlet = mysqli_query($conn, $query);

$query2 = "SELECT nama_pelanggan FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'";
$data2 = mysqli_query($conn, $query2);
$pelanggan = mysqli_fetch_assoc($data2);

$query3 = "SELECT id_paket, nama_paket, outlet.id_outlet, outlet.nama_outlet FROM paket_cuci INNER JOIN outlet ON paket_cuci.outlet_id = outlet.id_outlet";
$paket = mysqli_query($conn, $query3);

if (isset($_POST['btn-simpan'])) {
    $kode_invoice = $_POST['kode_invoice'];
    $id_outlet = $_POST['id_outlet'];
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
            // $_SESSION['msg'] = 'Berhasil menambahkan ';
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

    <?php if (isset($_SESSION['msg']) && $_SESSION['msg'] <> '') { ?>
    <div class="alert alert-success mb-5" role="alert" id="msg">
        <?= $_SESSION['msg']; ?>
    </div>
    <?php }
        $_SESSION['msg'] = ''; ?>

    <div class="page-inner">
        <div class="page-header">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><?= $title; ?></div>
                        </div>
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="largeInput">Kode Invoice</label>
                                    <input type="text" name="kode_invoice" class="form-control form-control"
                                        id="defaultInput" value="<?= $kode; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="defaultSelect">Outlet</label>
                                    <select name="id_outlet" class=" form-control form-control" id="defaultSelect">
                                        <?php while ($key = mysqli_fetch_array($outlet)) { ?>
                                        <option value="<?= $key['id_outlet']; ?>"><?= $key['nama_outlet']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Pelanggan</label>
                                    <input type="text" name="" class="form-control form-control" id="defaultInput"
                                        value="<?= $pelanggan['nama_pelanggan']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="defaultSelect">Pilih Paket</label>
                                    <select name="id_paket" class="form-control form-control" id="defaultSelect">
                                        <?php while ($key1 = mysqli_fetch_array($paket)) { ?>
                                        <option value="<?= $key1['id_paket']; ?>">
                                            <?= $key1['nama_paket']." - ".$key1['nama_outlet']  ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Jumlah</label>
                                    <input type="text" name="qty" class="form-control form-control" id="defaultInput">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Biaya Tambahan</label>
                                    <input type="text" name="biaya_tambahan" class="form-control form-control"
                                        id="defaultInput" value="0">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Diskon (%)</label>
                                    <input type="text" name="diskon" class="form-control form-control" id="defaultInput"
                                        value="0">
                                </div>
                                <div class="form-group">
                                    <label for="largeInput">Pajak</label>
                                    <input type="text" name="pajak" class="form-control form-control" id="defaultInput"
                                        value="0">
                                </div>
                                <div class="card-action">
                                    <button type="submit" name="btn-simpan" class="btn btn-success">Submit</button>
                                    <a href="javascript:void(0)" onclick="window.history.back();"
                                        class="btn btn-danger">Batal</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>