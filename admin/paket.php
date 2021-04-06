<?php
$title = 'Paket';
require 'koneksi.php';

$query = "SELECT outlet.nama_outlet, paket_cuci.* FROM paket_cuci INNER JOIN outlet ON paket_cuci.outlet_id = outlet.id_outlet";
$data = mysqli_query($conn, $query);

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
                <h4>Data Paket</h4>
                <div class="buttons">
                    <a href="tambah_paket.php" class="btn icon icon-left btn-primary"><i data-feather="plus-square"></i>
                        Tambah Paket</a>
                </div>
            </div>
            <div class="card-body">
                <table id="table1" class='table table-striped'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Paket</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Outlet</th>
                            <th class="col-sm-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($paket = mysqli_fetch_assoc($data)) {
                                ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $paket['nama_paket']; ?></td>
                            <td><?= $paket['jenis_paket']; ?></td>
                            <td><?= 'Rp ' . number_format($paket['harga']); ?></td>
                            <td><?= $paket['nama_outlet']; ?>
                            </td>
                            <td>
                                <div class="buttons d-flex justify-content-between">
                                    <a href="edit_paket.php?id=<?= $paket['id_paket']; ?>"
                                        class="btn btn-sm btn-primary">
                                        Edit</a>
                                    <a href="hapus_paket.php?id=<?= $paket['id_paket']; ?>"
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