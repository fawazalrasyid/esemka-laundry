<?php
$title = 'Edit Data Pengguna';
require 'koneksi.php';

$role = [
    'admin',
    'owner',
    'kasir'
];
$id_user = $_GET['id'];
$query = "SELECT * FROM user WHERE id_user = '$id_user'";
$queryedit = mysqli_query($conn, $query);

if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_user'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    if ($_POST['password'] != null || $_POST['password'] == '') {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "UPDATE user SET nama_user = '$nama', username = '$username', role = '$role', password = '$password' WHERE id_user = '$id_user'";
    } else {
        $query = "UPDATE user SET nama_user = '$nama', username = '$username', role = '$role' WHERE id_user = '$id_user'";
    }

    $update = mysqli_query($conn, $query);
    if ($update == 1) {
        $_SESSION['msg'] = 'Berhasil Update ' . $role;
        header('location:pengguna.php');
    } else {
        echo "<div class='alert alert-danger>Gagal Update Data!!!</div>";
        $_SESSION['msg'] = 'Gagal mengupdate data ' . $role . '!!!';
        header('location:pengguna.php');
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
                        <h4 class="card-title">Data Pengguna</h4>
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
                                                <input name="nama_user" type="text" class="form-control" id="name"
                                                    value="<?= $edit['nama_user']; ?>" placeholder="Nama">
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Username</label>
                                                <input name="username" type="text" class="form-control" id="username"
                                                    value="<?= $edit['username']; ?>" placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Password (Kosongakan jika tidak
                                                    mengubah password)</label>
                                                <input name="password" type="text" class="form-control" id="password"
                                                    placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="defaultSelect">Role</label>
                                                <select name="role" class="form-select" id="role">
                                                    <?php foreach ($role as $key) : ?>
                                                    <?php if ($key == $edit['role']) : ?>
                                                    <option value="<?= $key ?>" selected><?= $key ?></option>
                                                    <?php endif ?>
                                                    <option value="<?= $key ?>"><?= ucfirst($key) ?></option>
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
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Form -->

    </section>
</div>
<!-- End Content -->

<?php require 'footer.php';