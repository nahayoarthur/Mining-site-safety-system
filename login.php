<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In Page</title>
    <link rel="icon" type="image/x-icon" href="./dist/img/miner-with-mining-equipment-design-character-on-white-background-free-vector.jpg">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <h1><i class="fas fa-spinner fa-spin text-primary"></i></h1> 
            <h4>Loading</h4>
        </div>
        <div class="row flex-column justify-content-center align-items-start bg-image"
         style="height:97vh;background-image:url('assets/images/bg.jpg');
            background-size:cover;
            background-position:fixed;">
            <div class="col-md-6 col-sm-12 col-lg-5 bg-light rounded mx-5 px-5 py-5">
                <h2>Get's Started.</h2>
                <form class="form-group"  action="actions/loginOp.php" method="post">
                    <?php
                        if(isset($_SESSION['error'])){
                    ?>
                        <div class="alert alert-warning text-danger">
                            <?php print $_SESSION['error']; ?>
                        </div>
                    <?php
                            unset($_SESSION['error']);
                        }
                    ?>
                    <div class="input-container row">
                        <label for="" class="label col-12">
                            Username
                        </label>
                        <input type="text" name="username" placeholder="Username" class="form-control col-md-10 col-sm-12 col-lg-10" required>
                    </div>
                    <div class="input-container row">
                        <label for="" class="label col-12">
                            Password
                        </label>
                        <input type="password" name="password" placeholder="Password" class="form-control col-md-10 col-sm-12 col-lg-10" required>
                    </div>
                    <div class="input-container row d-flex justify-content-between py-4">
                        <div><button type="submit" class="btn btn-success px-5">
                            <i class="fa fa-user"></i> Sign In
                        </button></div>
                    </div>
                </form>
                
            </div>
        </div>

        <!-- Main Footer -->

    </div>

    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>

    <script src="dist/js/pages/dashboard2.js"></script>
</body>

</html>