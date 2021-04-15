<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $title; ?> - eLaundry</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="shortcut icon" href="../assets/images/favicon.svg" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/app.css">

    <link rel="stylesheet" href="../assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="../assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">

    <script src="../assets/vendors/apexcharts/apexcharts.js"></script>
</head>

<body>
    <div id="app">

        <!-- Sidebar -->
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="../assets/images/logo.svg" alt="" srcset="">
                </div>

                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-item <?php if ($title == 'Dashboard') {echo 'active'; }?>">
                            <a href="index.php" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class='sidebar-title'>Menu</li>

                        <li class="sidebar-item <?php if ($title == 'Pengguna') {echo 'active';}?>">
                            <a href="pengguna.php" class='sidebar-link'>
                                <i data-feather="user" width="20"></i>
                                <span>Pengguna</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php if ($title == 'Pelanggan') {echo 'active';}?>">
                            <a href="pelanggan.php" class='sidebar-link'>
                                <i data-feather="users" width="20"></i>
                                <span>Pelanggan</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php if ($title == 'Outlet') {echo 'active';}?>">
                            <a href="outlet.php" class='sidebar-link'>
                                <i data-feather="shopping-bag" width="20"></i>
                                <span>Outlet</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php if ($title == 'Paket') {echo 'active';}?>">
                            <a href="paket.php" class='sidebar-link'>
                                <i data-feather="package" width="20"></i>
                                <span>Paket</span>
                            </a>

                        </li>

                        <li class="sidebar-item <?php if ($title == 'Transaksi') {echo 'active';}?>">
                            <a href="transaksi.php" class='sidebar-link'>
                                <i data-feather="credit-card" width="20"></i>
                                <span>Transaksi</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php if ($title == 'Laporan') {echo 'active';}?>">
                            <a href="laporan.php" class='sidebar-link'>
                                <i data-feather="printer" width="20"></i>
                                <span>Laporan</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <!-- End Sidebar -->

        <div id="main">
            
            <!-- Navbar -->
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="../assets/images/avatar/avatar.jpg" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, <?= $_SESSION['nama_user']; ?>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="logout.php"
                                    onclick="return confirm('Anda yakin untuk Logout?');"><i data-feather="log-out"></i>
                                    Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar-->