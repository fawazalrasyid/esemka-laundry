<?php
require 'koneksi.php';

$query = "DELETE FROM outlet WHERE id_outlet = " . $_GET['id'];
$delete = mysqli_query($conn, $query);

if ($delete == 1) {
    $_SESSION['msg'] = 'Berhasil menghapus data outlet';
    header('location:outlet.php?');
} else {
    $_SESSION['msg'] = 'Gagal menghapus data!!!';
    header('location:outlet.php');
}