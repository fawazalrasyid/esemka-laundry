<?php
$title = 'Tambah Data Paket';
require 'koneksi.php';

$query = "SELECT * FROM outlet";
$data = mysqli_query($conn, $query);

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_paket'];
    $jenis = $_POST['jenis_paket'];
    $harga = $_POST['harga'];
    $id_outlet = $_POST['outlet_id'];

    $query = "INSERT INTO paket_cuci (nama_paket, jenis_paket, harga, outlet_id) values ('$nama', '$jenis', '$harga', '$id_outlet')";
    $insert = mysqli_query($conn, $query);
    if ($insert == 1) {
        $_SESSION['msg'] = 'Berhasil tambah paket baru';
        header('location:paket.php');
    } else {
        $_SESSION['msg'] = 'Gagal menambahkan data baru';
        header('location: paket.php');
    }
}

require 'header.php'
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
                        <h4 class="card-title">Data Paket</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="" method="POST">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Paket</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="nama_paket" placeholder="Paket">
                                            </div>
                                            <div class="form-group">
                                                <label for="defaultSelect">Jenis Paket</label>
                                                <select name="jenis_paket" class="form-select" id="basicSelect">
                                                    <option value="kiloan">Kiloan</option>
                                                    <option value="selimut">Selimut</option>
                                                    <option value="bedcover">Bedcover</option>
                                                    <option value="kiloan">Kiloan</option>
                                                    <option value="kaos">Kaos</option>
                                                    <option value="lain">Lain</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Harga</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="harga"
                                                        aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="defaultSelect">Pilih Outlet</label>
                                                <select name="outlet_id" class="form-select" id="basicSelect">
                                                    <?php while ($key = mysqli_fetch_array($data)) { ?>
                                                    <option value="<?= $key['id_outlet']; ?>">
                                                        <?= $key['nama_outlet']; ?></option>
                                                    <?php } ?>
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
                    </div>
                </div>
            </div>
            <!-- // Basic Vertical form layout section end -->
        </section>
</div>
<!-- End Content -->

<?php require 'footer.php'; ?>