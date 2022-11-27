<?php 
session_start();
if(!isset($_SESSION['uname'])){
    header("location:login.php");
}else{
    require "./actions/db.php";
    $sql = "SELECT * FROM `users`";
    $sqlCount = "SELECT count(id) FROM `site-1` WHERE status=1";
    $resCount = mysqli_query($con,$sqlCount);
    $res = mysqli_query($con,$sql);
    $newData = mysqli_fetch_array($resCount);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        //DELETE FROM `users` WHERE `users`.`id` = 4;
        $removeUsers = mysqli_query($con,"DELETE FROM `users` WHERE `users`.`id` =".$id."");
        if ($removeUsers) {
            header("Location: profileSetting.php"); 
        } else {
            echo "Problem in Query";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="60">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mining-site-safety-system</title>
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

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" href="data.php" role="button">
                        <i class="fas fa-bell"></i>
                        <?php if($newData[0]>0){
                        ?>
                       
                            <sup class="badge bg-success rounded-pill position-absolute top-2 start-100 ">
                                <?php print $newData[0] ?>
                            </sup>
                        <?php    
                            }
                        ?>
                    </a>
                </li>
                

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar  elevation-4">
            <!-- Brand Logo -->
            <?php require_once "./sidebar.php";?>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
                
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Add a new user</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->

                    <!-- Main row -->
                    <?php
                        if(isset($_SESSION['success'])){
                    ?>
                    <div class="alert alert-success text-warning text-center text-bold text-lg">
                        <?php print $_SESSION['success']; ?>
                    </div>
                    <?php 
                        unset($_SESSION['success']);
                        }
                    ?>
                    <?php
                        if(isset($_SESSION['error'])){
                    ?>
                    <div class="alert alert-warning text-danger text-center text-bold text-lg">
                        <?php print $_SESSION['error']; ?>
                    </div>
                    <?php 
                        unset($_SESSION['error']);
                        }
                    ?>
                    <div class="row">

                        <div class="col-md-12 d-flex justify-content-center">
                            <!-- Info Boxes Style 2 -->
                            <div class=" flex-column justify-content-center align-items-start py-0 my-0">
            <div class="bg-light rounded px-5 mx-5 py-5">
                <h2>Create Account.</h2>
                <form class="form-group" action="auth/createAccount.php" method="post">
                    
                    <div class="input-container row">
                        <label for="" class="label col-12">
                            Username
                        </label>
                        <input type="text" name="username" placeholder="Username" class="form-control">
                    </div>
                    <div class="input-container row">
                        <label for="" class="label col-12">
                            Phone
                        </label>
                        <input type="text" name="phone" placeholder="Phone" class="form-control">
                    </div>
                    <div class="input-container row">
                        <label for="" class="label col-12">
                            Password
                        </label>
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="input-container row d-flex justify-content-between py-4">
                        <div><button type="submit" class="btn btn-success px-5">
                            <i class="fas fa-save"></i> Save
                        </button></div>
                         
                    </div>
                </form>
                
            </div>
        </div>


                        <div class="bg-light rounded px-5 mx-5 py-5">
                             <table class="table table-striped table-hover">
                                        <h2>Users</h2>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Phone</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                <?php $n = 1;
                                while ($users = mysqli_fetch_array($res)){ 
                                    ?>

                                        <tr>
                                            <td><?= $n++ ?></td>
                                            <td><?= $users['name'] ?></td>
                                            <td><?= $users['phone'] ?></td>
                                            <td><div><a href="profileSetting.php?id=<?= $users['id'] ?>"><button type="submit" class="btn btn-danger px-5">
                                                <i class="fas fa-trash"></i></button></a></div></td>
                                        </tr>
                                <?php } ?>  
                                        
                                    </tbody>
                                             </table>
                                 </div>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php include "footer.php"; ?>
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
<?php } ?>