<?php
require 'koneksi.php';

$query = "DELETE FROM paket_cuci WHERE id_paket = " . $_GET['id'];
$delete = mysqli_query($conn, $query);

if ($delete) {
    $_SESSION['msg'] = 'Berhasil menghapus data paket';
    header('location:paket.php');
} else {
    $_SESSION['msg'] = 'Gagal menghapus Data!!!';
    header('location:paket.php');
}