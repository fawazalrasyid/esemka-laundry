<?php
require 'koneksi.php';

$query = "DELETE FROM user WHERE id_user = " . $_GET['id'];
$delete = mysqli_query($conn, $query);

if ($delete) {
    $_SESSION['msg'] = 'Berhasil menghapus data pengguna';
    header('location:pengguna.php');
} else {
    $_SESSION['msg'] = 'Gagal menghapus data!!!';
    header('location:pengguna.php');
}