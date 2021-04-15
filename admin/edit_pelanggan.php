<?php
$title = 'Edit Data pelanggan';
require 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM pelanggan WHERE id_pelanggan = $id";
$queryedit = mysqli_query($conn, $query);

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat_pelanggan'];
    $telp = $_POST['telp_pelanggan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $query = "UPDATE pelanggan SET nama_pelanggan = '$nama', alamat_pelanggan = '$alamat', telp_pelanggan = '$telp', jenis_kelamin = '$jenis_kelamin' WHERE id_pelanggan = $id";

    $update = mysqli_query($conn, $query);
    if ($update == 1) {
        $_SESSION['msg'] = 'Berhasil mengubah data pelanggan';
        header('location: pelanggan.php');
    } else {
        $_SESSION['msg'] = 'Gagal mengubah data!!!';
        header('location:pelanggan.php');
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
                            <?php while ($edit = mysqli_fetch_array($queryedit)) {
                    ?>
                            <form class="form form-vertical" action="" method="POST">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Pengguna</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="nama_pelanggan" value="<?= $edit['nama_pelanggan']; ?>"
                                                    placeholder="Nama">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Alamat
                                                    Pelanggan</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                    name="alamat_pelanggan"
                                                    rows="3"><?= $edit['alamat_pelanggan']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">No Telepon</label>
                                                <input type="number" id="contact-info-vertical" class="form-control"
                                                    name="telp_pelanggan" value="<?= $edit['telp_pelanggan']; ?>"
                                                    placeholder="No Telp">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="defaultSelect">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-select"
                                                id="defaultSelect">
                                                <option value="L" <?php if ($edit['jenis_kelamin'] == 'L') {
                                                                echo "selected";
                                                            } ?>>Laki-laki</option>
                                                <option value="P" <?php if ($edit['jenis_kelamin'] == 'P') {
                                                                echo "selected";
                                                            } ?>>Perempuan</option>
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
<?php } ?>
<!-- End Content -->

<?php require 'footer.php';