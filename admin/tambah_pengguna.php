<?php
$title = 'Tambah Data Pengguna';
require 'koneksi.php';

$outlet = mysqli_query($conn, "SELECT * FROM outlet");
if (isset($_POST['btn-simpan'])) {
    $nama = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $id_outlet = $_POST['id_outlet'];
    $query = "INSERT INTO user (nama_user, username, password, role, outlet_id) values ('$nama', '$username', '$password', '$role', '$id_outlet')";

    $insert = mysqli_query($conn, $query);
    if ($insert == 1) {

        $_SESSION['msg'] = 'Berhasil menambahkan ' . $role . ' baru';
        header('location:pengguna.php');
    } else {
        $_SESSION['msg'] = 'Gagal mengubah data!!!';
        header('location: pengguna.php');
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
                            <form class="form form-vertical" action="" method="POST">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Pengguna</label>
                                                <input type="text" id="name" class="form-control" name="nama_user"
                                                    placeholder="Nama">
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Username</label>
                                                <input type="text" id="username" class="form-control" name="username"
                                                    placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Password</label>
                                                <input type="text" id="password" class="form-control" name="password"
                                                    placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="defaultSelect">Role</label>
                                                <select name="role" class="form-select" id="role">
                                                    <option value="admin">Admin</option>
                                                    <option value="kasir">Kasir</option>
                                                    <option value="owner">Owner</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="defaultSelect">Outlet</label>
                                            <select name="id_outlet" class="form-select" id="outlet">
                                                <?php while ($key = mysqli_fetch_array($outlet)) { ?>
                                                <option value="<?= $key['id_outlet']; ?>">
                                                    <?= $key['nama_outlet']; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" name="btn-simpan"
                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button href="javascript:void(0)" onclick="window.history.back();" type="reset"
                                            class="btn btn-light-secondary me-1 mb-1">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Form -->

    </section>
</div>
<!-- End Content -->

<?php require 'footer.php'; ?>