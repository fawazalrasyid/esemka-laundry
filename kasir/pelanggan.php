<?php
$title = 'Pelanggan';
require 'koneksi.php';

$query = 'SELECT * FROM pelanggan';
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
                <h4>Data Pelanggan</h4>
                <div class="buttons">
                    <a href="tambah_pelanggan.php" class="btn icon icon-left btn-primary"><i
                            data-feather="plus-square"></i>
                        Tambah Pelanggan</a>
                </div>
            </div>
            <div class="card-body">
                <table id="table1" class='table table-striped'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th class="col-sm-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $no = 1;
                                if (mysqli_num_rows($data) > 0) {
                                    while ($plg = mysqli_fetch_assoc($data)) {
                                ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $plg['nama_pelanggan']; ?></td>
                            <td><?= $plg['alamat_pelanggan']; ?></td>
                            <td><?php if ($plg['jenis_kelamin'] == 'L') {
                                                    echo "Laki-laki";
                                                } else {
                                                    echo "Perempuan";
                                                } ?>
                            </td>
                            <td>
                                <div class="buttons d-flex">
                                    <a href="edit_pelanggan.php?id=<?= $plg['id_pelanggan']; ?>"
                                        class="btn btn-sm btn-primary">
                                        Edit</a>
                                    <a href="hapus_pelanggan.php?id=<?= $plg['id_pelanggan']; ?>"
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