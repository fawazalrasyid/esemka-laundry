<?php
$title = 'Edit Data Outlet';
require 'koneksi.php';

$query = "SELECT outlet.*, user.nama_user, user.id_user FROM outlet LEFT JOIN user ON user.outlet_id = outlet.id_outlet WHERE id_outlet  = " . $_GET['id'];
$data = mysqli_query($conn, $query);
$edit = mysqli_fetch_assoc($data);


$query2 = "SELECT user.*, outlet.nama_outlet FROM outlet RIGHT JOIN user ON user.outlet_id = outlet.id_outlet WHERE user.role = 'owner' ORDER BY user.outlet_id ASC";
$data2 = mysqli_query($conn, $query2);

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_outlet'];
    $alamat = $_POST['alamat_outlet'];
    $telp = $_POST['telp_outlet'];

    $query = "UPDATE outlet SET nama_outlet = '$nama', alamat_outlet = '$alamat', telp_outlet = '$telp' WHERE id_outlet = " . $_GET['id'];

    if ($_POST['owner_new_id']) {
        $query2 = "UPDATE user SET outlet_id = '" . $_GET['id'] . "' WHERE id_user = " . $_POST['owner_new_id'];
        $query3 = "UPDATE user SET outlet_id = NULL WHERE id_user = " . $edit['id_user'];
        $update3 = mysqli_query($conn, $query3);
    } else {
        $query2 = "UPDATE user SET outlet_id = '" . $_GET['id'] . "' WHERE id_user = " . $_POST['id_owner'];
    }

    $update = mysqli_query($conn, $query);
    $update2 = mysqli_query($conn, $query2);
    if ($update == 1 && $update2 == 1) {
        $_SESSION['msg'] = 'Berhasil Mengubah Data';
        header('location:outlet.php');
    } else {
        $_SESSION['msg'] = 'Gagal Mengubah Data!!!';
        header('location:outlet.php');
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
                                                    name="nama_outlet" value="<?= $edit['nama_outlet']; ?>"
                                                    placeholder="Outlet">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Alamat
                                                    Outlet</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                    name="alamat_outlet"
                                                    rows="3"><?= $edit['alamat_outlet']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">No Telepon</label>
                                                <input type="number" id="contact-info-vertical" class="form-control"
                                                    name="telp_outlet" value="<?= $edit['telp_outlet']; ?>"
                                                    placeholder="No Telp">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <?php if ($edit['nama_user'] == null) : ?>
                                                <label>Belum Ada Owner</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="id_owner">
                                                        <?php foreach ($data2 as $owner) : ?>
                                                        <option value="<?= $owner['id_user']; ?>">
                                                            <?= $owner['nama_user']; ?>
                                                            <?php if ($owner['outlet_id'] == null) : ?>
                                                            (Belum mempunyai outlet)
                                                            <?php else : ?>
                                                            (Owner di <?= $owner['nama_outlet']; ?>)
                                                            <?php endif ?>
                                                        </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </fieldset>
                                                <?php else : ?>
                                                <label>Owner Sekarang : <?= $edit['nama_user']; ?></label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="owner_new_id">
                                                        <?php foreach ($data2 as $owner) :  ?>
                                                        <option value="<?= $owner['id_user']; ?>" selected>
                                                            <?= $owner['nama_user'] ?>
                                                            <?php if ($owner['outlet_id'] == null) : ?>
                                                            (Belum memiliki outlet)
                                                            <?php else : ?>
                                                            (Owner berada di <?= $owner['nama_outlet']; ?>)
                                                            <?php endif ?>
                                                        </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </fieldset>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" name="btn-simpan"
                                                    class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button href="javascript:void(0)" onclick="window.history.back();"
                                                    type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Batal</button>
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
    </section>
</div>
<!-- End Content -->

<?php require 'footer.php';?>