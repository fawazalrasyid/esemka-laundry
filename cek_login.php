<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "laundry");

$username = stripslashes($_POST['username']);
$query = "SELECT * FROM user where username='$username'";
$row = mysqli_query($conn,$query);
$data = $row->fetch_assoc();

if(password_verify($_POST['password'], $data['password'])){
    if ($data['role'] == 'admin') {
        $_SESSION['role'] = 'admin';
        $_SESSION['nama_user'] = $data['nama_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_id'] = $data['id_user'];
        $_SESSION['outlet_id'] = $data['outlet_id'];
        header('location:admin');
    } else if ($data['role'] == 'kasir') {
        $_SESSION['role'] = 'kasir';
        $_SESSION['nama_user'] = $data['nama_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_id'] = $data['id_user'];
        $_SESSION['outlet_id'] = $data['outlet_id'];
        header('location:kasir');
    } else if ($data['role'] == 'owner') {
        $_SESSION['role'] = 'owner';
        $_SESSION['nama_user'] = $data['nama_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_id'] = $data['id_user'];
        $_SESSION['outlet_id'] = $data['outlet_id'];
        header('location:owner');
    }
} else {
    $message = 'Username atau password salah!!!';
    header('location:index.php?message=' . $message);
}