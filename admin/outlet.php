<?php
$title = 'Outlet';
require 'koneksi.php';
require 'header.php';

$query = 'SELECT * FROM outlet';
$data = mysqli_query($conn, $query);
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
                <h4>Data Outlet</h4>
                <div class="buttons">
                    <a href="tambah_outlet.php" class="btn icon icon-left btn-primary"><i
                            data-feather="plus-square"></i>
                        Tambah Outlet</a>
                </div>
            </div>
            <div class="card-body">
                <table id="table1" class='table table-striped'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th class="col-sm-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($outlet = mysqli_fetch_assoc($data)) {
                                ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $outlet['nama_outlet']; ?></td>
                            <td><?= $outlet['telp_outlet']; ?></td>
                            <td><?= $outlet['alamat_outlet']; ?></td>
                            <td>
                                <div class="buttons d-flex">
                                    <a href="edit_outlet.php?id=<?= $outlet['id_outlet']; ?>"
                                        class="btn btn-sm btn-primary">
                                        Edit</a>
                                    <a href="hapus_outlet.php?id=<?= $outlet['id_outlet']; ?>"
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