<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLaundry - Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">

        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4 ">
                        <div class="card-body">
                            <div class=" text-center">
                                <img src="assets/images/favicon.svg" height="48" class='mb-4'>
                                <h3>Esemka Laundry</h3>
                                <p>Login untuk melanjutkan.</p>
                            </div>
                            <form action="cek_login.php" method="post">
                                <?php if (isset($_GET['message'])) : ?>
                                <div class="alert alert-danger text-center">
                                    <small role="alert">
                                        <?= $_GET['message']; ?>
                                    </small>
                                </div>
                                <?php endif ?>
                                <div class="form-group position-relative has-icon-left">
                                    <label for="username">Username</label>
                                    <div class="position-relative">
                                        <input type="text" name="username" placeholder="Username" class="form-control"
                                            id="username">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left mb-5">
                                    <label for="username">Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password" placeholder="Password"
                                            class="form-control" id="password">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix mb-3">
                                    <button class="btn btn-primary float-end">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>