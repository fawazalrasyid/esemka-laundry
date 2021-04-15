<?php
$title = 'Pengguna';
require 'koneksi.php';

$data = mysqli_query($conn, 'SELECT * FROM user ORDER BY role asc');

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

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Data Pengguna</h4>
                <div class="buttons">
                    <a href="tambah_pengguna.php" class="btn icon icon-left btn-primary"><i
                            data-feather="plus-square"></i>
                        Tambah Pengguna</a>
                </div>
            </div>
            <div class="card-body">
                <table id="table1" class='table table-striped'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th class="col-sm-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($user = mysqli_fetch_assoc($data)) {
                                ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $user['nama_user']; ?></td>
                            <td><?= $user['username']; ?></td>
                            <td><?= $user['role']; ?></td>
                            <td>
                                <div class="buttons d-flex">
                                    <a href="edit_pengguna.php?id=<?= $user['id_user']; ?>"
                                        class="btn btn-sm btn-primary">
                                        Edit</a>
                                    <a href="hapus_pengguna.php?id=<?= $user['id_user']; ?>"
                                        onclick="return confirm('Anda yakin untuk menghapus data?');"
                                        class="btn btn-sm btn-danger">
                                        Hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php }
                                }
                                ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
<!-- End Content -->

<?php require 'footer.php';?>