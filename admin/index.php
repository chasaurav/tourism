<?php
    require('../config/db.php');

    $stmt = $pdo->prepare("SELECT * FROM tbl_pack");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);

    if (isset($_GET['action']) && $_GET['action'] == 'inactive') {
        $stmt = $pdo->prepare("UPDATE tbl_pack SET status = 'inactive' WHERE id = ?");
        if ($stmt->execute(array($_GET['id']))) {
            header('location: index.php');
        }
    }

    if (isset($_GET['action']) && $_GET['action'] == 'active') {
        $stmt = $pdo->prepare("UPDATE tbl_pack SET status = 'active' WHERE id = ?");
        if ($stmt->execute(array($_GET['id']))) {
            header('location: index.php');
        }
    }

    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $stmt = $pdo->prepare("DELETE FROM tbl_pack WHERE id = ?");
        if ($stmt->execute(array($_GET['id']))) {
            header('location: index.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin Panel</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        Trip Anthem
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Packages</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="enquiry.php">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Enquries</p>
                        </a>
                    </li>                    
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"> Dashboard </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-palette"></i>
                                    <span class="d-lg-none">Dashboard</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4 class="card-title">All Packages</h4>
                                            <p class="card-category">List Of Packages</p>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="packageCreate.php" class="btn btn-block btn-danger">New</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th class="text-center">Code</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Rate</th>
                                            <th class="text-center">Tag</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Created At</th>
                                            <th class="text-center">Update Status</th>
                                            <th class="text-center">Edit</th>
                                            <th class="text-center">Delete</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($res as $k) { ?>
                                            <tr>
                                                <th><?= $k->code; ?></th>
                                                <th><?= $k->title; ?></th>
                                                <th><?= number_format($k->rate, 2, '.',','); ?></th>
                                                <th><?= $k->tag?></th>
                                                <th><?= $k->status?></th>
                                                <th><?= date('d-m-Y h:i a', strtotime($k->createdAt))?></th>
                                                <th>
                                                    <?php if ($k->status == 'inactive') { ?>
                                                        <a href="?action=active&id=<?= $k->id; ?>" class="btn btn-fill btn-sm btn-block">Change</a>
                                                    <?php }else{ ?>
                                                        <a href="?action=inactive&id=<?= $k->id; ?>" class="btn btn-fill btn-sm btn-block">Change</a>
                                                    <?php } ?>
                                                </th>
                                                <th>
                                                    <a href="packageEdit.php?id=<?= $k->id; ?>" class="btn btn-fill btn-sm btn-block">Edit</a>
                                                </th>
                                                <th>
                                                    <a href="?action=delete&id=<?= $k->id; ?>" class="btn btn-fill btn-sm btn-block">Delete</a>
                                                </th>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>
