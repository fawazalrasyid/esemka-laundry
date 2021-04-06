<?php
$title = 'Edit Data Paket';
require 'koneksi.php';

$jenis = [
    'kiloan',
    'selimut',
    'bedcover',
    'kaos',
    'lain'
];

$id = $_GET['id'];
$query = "SELECT * FROM paket_cuci WHERE id_paket = '$id'";
$queryedit = mysqli_query($conn, $query);

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_paket'];
    $jenis = $_POST['jenis_paket'];
    $harga = $_POST['harga'];
    $id_outlet = $_POST['outlet_id'];

    $query = "UPDATE paket_cuci SET nama_paket = '$nama', jenis_paket = '$jenis', harga = '$harga', outlet_id = '$id_outlet' WHERE id_paket = '$id'";
    $update = mysqli_query($conn, $query);
    if ($update == 1) {
        $_SESSION['msg'] = 'Berhasil mengubah data';
        header('location:paket.php');
    } else {
        $_SESSION['msg'] = 'Gagal mengubah data!!!';
        header('location:paket.php');
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
        <!-- Form -->
        <section id="basic-vertical-layouts">
            <div class="col-md-10 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Paket</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <?php while ($edit = mysqli_fetch_assoc($queryedit)) { ?>
                            <form class="form form-vertical" action="" method="POST">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Paket</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="nama_paket" value="<?= $edit['nama_paket']; ?>"
                                                    placeholder="Paket">
                                            </div>
                                            <div class="form-group">
                                                <label for="defaultSelect">Jenis Paket</label>
                                                <select name="jenis_paket" class="form-select" id="basicSelect">
                                                    <?php foreach ($jenis as $key) : ?>
                                                    <?php if ($key == $edit['jenis_paket']) : ?>
                                                    <option value="<?= $key ?>" selected><?= $key ?></option>
                                                    <?php endif ?>
                                                    <option value="<?= $key ?>"><?= ucfirst($key) ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Harga</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="harga"
                                                        value="<?= $edit['harga']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="defaultSelect">Pilih Outlet</label>
                                                <?php
                                                    function ambildata($conn, $query)
                                                    {
                                                        $data = mysqli_query($conn, $query);
                                                        if (mysqli_num_rows($data) > 0) {
                                                            while ($row = mysqli_fetch_assoc($data)) {
                                                                $hasil[] = $row;
                                                            }
                                                            return $hasil;
                                                        }
                                                    }
                                                    $query2 = "SELECT * FROM outlet";
                                                    $data2 = ambildata($conn, $query2);
                                                ?>
                                                <select name="outlet_id" class="form-select" id="basicSelect">
                                                    <?php foreach ($data2 as $outlet) : ?>
                                                    <?php if ($data2['id_outlet'] == $edit['outlet_id']) : ?>
                                                    <option value="<?= $outlet['id_outlet'] ?>" selected>
                                                        <?= $outlet['nama_outlet']; ?>
                                                    </option>
                                                    <?php endif ?>
                                                    <option value="<?= $outlet['id_outlet'] ?>">
                                                        <?= $outlet['nama_outlet']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" name="btn-simpan"
                                                class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button href="javascript:void(0)" onclick="window.history.back();"
                                                type="reset" class="btn btn-light-secondary me-1 mb-1">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- End Form -->
        </section>
</div>
<!-- End Content -->

<?php require 'footer.php'; ?>