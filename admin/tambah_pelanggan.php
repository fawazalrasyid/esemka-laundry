<?php
$title = 'Tambah Data Pelanggan';
require 'koneksi.php';

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat_pelanggan'];
    $telp = $_POST['telp_pelanggan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $query = "INSERT INTO pelanggan (nama_pelanggan, alamat_pelanggan, telp_pelanggan, jenis_kelamin) values ('$nama', '$alamat','$telp', '$jenis_kelamin')";

    $insert = mysqli_query($conn, $query);
    if ($insert == 1) {
        $_SESSION['msg'] = 'Berhasil menambahkan pelanggan baru';
        header('location:pelanggan.php?');
    } else {
        $_SESSION['msg'] = 'Gagal menambahkan data baru!!!';
        header('location: pelanggan.php');
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
                        <h4 class="card-title">Data Pelanggan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" action="" method="POST">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Pengguna</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="nama_pelanggan" placeholder="Nama">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Alamat
                                                    Pelanggan</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                    name="alamat_pelanggan" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">No Telepon</label>
                                                <input type="number" id="contact-info-vertical" class="form-control"
                                                    name="telp_pelanggan" placeholder="No Telp">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="defaultSelect">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-select"
                                                id="defaultSelect">
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
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