
<?php 
session_start();
if(!isset($_SESSION['uname'])){
    header("location:login.php");
}else{
require_once "../actions/db.php";
$sql = "SELECT * FROM `site-1` ORDER BY `id` DESC";
$sqlCount = "SELECT count(id) FROM `site-1` WHERE status=1";
$resCount = mysqli_query($con,$sqlCount);
$res = mysqli_query($con,$sql);
$newData = mysqli_fetch_array($resCount);
 ?>

 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="30">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mining-site-safety-system</title>
    <link rel="icon" type="image/x-icon" href="../dist/img/miner-with-mining-equipment-design-character-on-white-background-free-vector.jpg">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
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
                    <a class="nav-link position-relative" href="#" role="button">
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
                            <h1 class="m-0">Zone 1</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">Zone 1</a></li>
                                <li class="breadcrumb-item active">Data</li>
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
                    <div class="row">

                        <div class="col-md-12 d-flex justify-content-center">
                            <!-- Info Boxes Style 2 -->
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Ipg</th>
                                        <th>Smoke</th>
                                        <th>Carbon</th>
                                        <th>Temp</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>

                            <?php $n = 1;
                             while ($data = mysqli_fetch_array($res)){ 
                                ?>

                                    <tr>
                                        <td><?= $n++ ?></td>
                                        <td><?= $data['lpg'] ?></td>
                                        <td><?= $data['smoke'] ?></td>
                                        <td><?= $data['carbon'] ?></td>
                                        <td><?= $data['temp'] ?></td>
                                        <td><?= $data['time'] ?></td>
                                    </tr>
                             <?php } ?>  
                                    
                                </tbody>
                            </table>
                            
                            

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
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="../plugins/raphael/raphael.min.js"></script>
    <script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>

    <script src="../dist/js/pages/dashboard2.js"></script>
</body>

</html>

<?php
        $markAsRead = "UPDATE `site-1` SET `status`=0";
        mysqli_query($con,$markAsRead);
    } 
?>