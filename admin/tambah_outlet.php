<?php
$title = 'Tambah Data Outlet';
require 'koneksi.php';


if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_outlet'];
    $alamat = $_POST['alamat_outlet'];
    $telp = $_POST['telp_outlet'];

    $query = "INSERT INTO outlet (nama_outlet, alamat_outlet, telp_outlet) values ('$nama', '$alamat', '$telp')";
    $insert = mysqli_query($conn, $query);
    if ($insert == 1) {
        $_SESSION['msg'] = 'Berhasil Menyimpan Data';
        header('location: outlet.php');
    } else {
        $_SESSION['msg'] = 'Gagal menambahkan data baru!!!';
        header('location: outlet.php');
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
                                                <label for="first-name-vertical">Nama Outlet</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="nama_outlet" placeholder="Outlet">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Alamat
                                                    Outlet</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                    name="alamat_outlet" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">No Telepon</label>
                                                <input type="number" id="contact-info-vertical" class="form-control"
                                                    name="telp_outlet" placeholder="No Telp">
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

<?php require 'footer.php';?>