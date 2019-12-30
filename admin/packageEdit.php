<?php
    require('../config/db.php');

    $alert = '';    

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM tbl_pack WHERE id = ?");
    $stmt->execute(array($_GET['id']));
    $res = $stmt->fetch(PDO::FETCH_OBJ);
}

    if (isset($_POST['updatePck'])) {

        $id = isset($_POST['id'])?$_POST['id']:$_GET['id'];
        $stmt = $pdo->prepare("DELETE FROM tbl_pack WHERE id = ?");
        $stmt->execute(array($id));

        $pckTitle = isset($_POST['pckTitle'])?$_POST['pckTitle']:null;
        $pckRate = isset($_POST['pckRate'])?$_POST['pckRate']:null;
        $pckNights = isset($_POST['pckNights'])?$_POST['pckNights']:null;
        $pckDays = isset($_POST['pckDays'])?$_POST['pckDays']:null;
        $pckMinPerson = isset($_POST['pckMinPerson'])?$_POST['pckMinPerson']:null;
        $pckDesc = isset($_POST['pckDesc'])?$_POST['pckDesc']:null;
        $pckCode = isset($_POST['pckCode'])?$_POST['pckCode']:null;
        $pckTag = isset($_POST['pckTag'])?$_POST['pckTag']:null;
        $pckStatus = isset($_POST['pckStatus'])?$_POST['pckStatus']:null;
        $hotelText = isset($_POST['hotelText'])?$_POST['hotelText']:null;
        $transportText = isset($_POST['transportText'])?$_POST['transportText']:null;
        $mealText = isset($_POST['mealText'])?$_POST['mealText']:null;
        $sightText = isset($_POST['sightText'])?$_POST['sightText']:null;

        $uploaddir = '../images/packages';
        $imgName = $_FILES['pckImage']['name'];
        $imgTempName = $_FILES['pckImage']['tmp_name'];
        $uploadfile = $uploaddir . basename($imgName);
        $updatedAt = date('Y-m-d H:i:s');

        move_uploaded_file($imgTempName, $uploadfile);

        $stmt = $pdo->prepare("INSERT INTO tbl_pack (id, title, rate, night, day, minPerson, description, code, tag, status, hotel, trans, meal, sight, pckImage, updatedAt) VALUES (:id, :title, :rate, :night, :day, :minPerson, :description, :code, :tag, :status, :hotel, :trans, :meal, :sight, :pckImage, :updatedAt)");
        $params = [
            ":id" => $id,
            ":title" => $pckTitle,
            ":rate" => $pckRate,
            ":night" => $pckNights,
            ":day" => $pckDays,
            ":minPerson" => $pckMinPerson,
            ":description" => $pckDesc,
            ":code" => $pckCode,
            ":tag" => $pckTag,
            ":status" => $pckStatus,
            ":hotel" => $hotelText,
            ":trans" => $transportText,
            ":meal" => $mealText,
            ":sight" => $sightText,
            ":pckImage" => $uploadfile,
            ":updatedAt" => $updatedAt,
        ];
        if ($stmt->execute($params)) {
            $alert = true;
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
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4 class="card-title">Create New Package</h4>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="./index.php" class="btn btn-block btn-danger">Back</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="pckTitle" placeholder="Enter Title" value="<?= isset($res->title)?$res->title:''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Rate per person</label>
                                                    <input type="number" class="form-control" name="pckRate" placeholder="Enter Rate Per Person" value="<?= isset($res->rate)?$res->rate:'0'; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Nights</label>
                                                    <input type="number" class="form-control" name="pckNights" placeholder="Enter Nights" value="<?= isset($res->night)?$res->night:'0'; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Days</label>
                                                    <input type="number" class="form-control" name="pckDays" placeholder="Enter Days" value="<?= isset($res->day)?$res->day:'0'; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Minimum Person (PAX)</label>
                                                    <input type="number" class="form-control" name="pckMinPerson" placeholder="Enter Minimum Person" value="<?= isset($res->minPerson)?$res->minPerson:'0'; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea rows="4" cols="80" class="form-control" name="pckDesc" placeholder="Here can be your description"><?= isset($res->description)?$res->description:''; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Package Code</label>
                                                    <input type="text" class="form-control" name="pckCode" placeholder="Enter Package Code" value="<?= isset($res->code)?$res->code:''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 px-3">
                                                <div class="btn-group" role="group" style="margin-top: 27px; text-align: center;">
                                                    <button type="button" class="btn btn-fill <?= ($res->hotel != 'selected')?'btn-primary':'btn-success'; ?> hotelBtn" style="cursor: pointer;">
                                                        <i class="fa fa-building" aria-hidden="true"></i> Hotel
                                                    </button>
                                                    <button type="button" class="btn btn-fill <?= ($res->trans != 'selected')?'btn-primary':'btn-success'; ?> transportBtn" style="cursor: pointer;">
                                                        <i title="Transportation" class="fa fa-car" aria-hidden="true"></i> Transport
                                                    </button>
                                                    <button type="button" class="btn btn-fill <?= ($res->meal != 'selected')?'btn-primary':'btn-success'; ?> mealBtn" style="cursor: pointer;">
                                                        <i class="fa fa-cutlery" aria-hidden="true"></i> Meal
                                                    </button>
                                                    <button type="button" class="btn btn-fill <?= ($res->sight != 'selected')?'btn-primary':'btn-success'; ?> sightBtn" style="cursor: pointer;">
                                                        <i class="fa fa-street-view" aria-hidden="true"></i> Sightseeing
                                                    </button>
                                                </div>
                                                <br>
                                                <small class="text-danger selectMsg" style="display: none;"></small>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Tag</label>
                                                    <select name="pckTag" class="form-control">
                                                        <option value="">Select Tag</option>
                                                        <option <?= ($res->tag == 'Popular')?'selected':''; ?> value="Popular">Popular</option>
                                                        <option <?= ($res->tag == 'Hot')?'selected':''; ?> value="Hot">Hot</option>
                                                        <option <?= ($res->tag == 'Trending')?'selected':''; ?> value="Trending">Trending</option>
                                                        <option <?= ($res->tag == 'New')?'selected':''; ?> value="New">New</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="pckStatus" class="form-control">
                                                        <option value="">Select Status</option>
                                                        <option <?= ($res->status == 'active')?'selected':''; ?> value="active">Active</option>
                                                        <option <?= ($res->status == 'inactive')?'selected':''; ?> value="inactive">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Select Image</label>
                                                    <input type="file" name="pckImage" id="pckImage" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="hidden" id="hotelText" name="hotelText" value="<?= isset($res->hotel)?$res->hotel:''; ?>">
                                                <input type="hidden" id="transportText" name="transportText" value="<?= isset($res->trans)?$res->trans:''; ?>">
                                                <input type="hidden" id="mealText" name="mealText" value="<?= isset($res->meal)?$res->meal:''; ?>">
                                                <input type="hidden" id="sightText" name="sightText" value="<?= isset($res->sight)?$res->sight:''; ?>">
                                                <input type="hidden" id="id" name="id" value="<?= isset($res->id)?$res->id:''; ?>">
                                                <button type="submit" name="updatePck" class="btn btn-success btn-fill btn-block" style="margin-top: 30px;">Update Package</button>
                                            </div>
                                        </div>
                                    </form>
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
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $('.hotelBtn').on('click', function() {
        let that = $(this);
        let selectMsg = $('.selectMsg');
        let hotelText = $('#hotelText');

        if (hotelText.val() == '') {
            that.removeClass('btn-primary').addClass('btn-success');
            selectMsg.text('Hotel Stay Selected').fadeIn('slow').delay(800).fadeOut('slow');
            hotelText.val('selected');
        }else{
            that.removeClass('btn-success').addClass('btn-primary');
            selectMsg.text('Hotel Stay Unselected').fadeIn('slow').delay(800).fadeOut('slow');
            hotelText.val('');
        }
    });

    $('.transportBtn').on('click', function() {
        let that = $(this);
        let selectMsg = $('.selectMsg');
        let transportText = $('#transportText');

        if (transportText.val() == '') {
            that.removeClass('btn-primary').addClass('btn-success');
            selectMsg.text('Transpotation Option Selected').fadeIn('slow').delay(800).fadeOut('slow');
            transportText.val('selected');
        }else{
            that.removeClass('btn-success').addClass('btn-primary');
            selectMsg.text('Transpotation Option Unselected').fadeIn('slow').delay(800).fadeOut('slow');
            transportText.val('');
        }
    });

    $('.mealBtn').on('click', function() {
        let that = $(this);
        let selectMsg = $('.selectMsg');
        let mealText = $('#mealText');

        if (mealText.val() == '') {
            that.removeClass('btn-primary').addClass('btn-success');
            selectMsg.text('Meal Option Selected').fadeIn('slow').delay(800).fadeOut('slow');
            mealText.val('selected');
        }else{
            that.removeClass('btn-success').addClass('btn-primary');
            selectMsg.text('Meal Option Unselected').fadeIn('slow').delay(800).fadeOut('slow');
            mealText.val('');
        }
    });

    $('.sightBtn').on('click', function() {
        let that = $(this);
        let selectMsg = $('.selectMsg');
        let sightText = $('#sightText');

        if (sightText.val() == '') {
            that.removeClass('btn-primary').addClass('btn-success');
            selectMsg.text('Sightseeing Selected').fadeIn('slow').delay(800).fadeOut('slow');
            sightText.val('selected');
        }else{
            that.removeClass('btn-success').addClass('btn-primary');
            selectMsg.text('Sightseeing Unselected').fadeIn('slow').delay(800).fadeOut('slow');
            sightText.val('');
        }
    });
</script>
<?php if ($alert) { ?>
        <script>
            Swal.fire({
                title: 'Submitted Successfully',
                text: "Package updated.",
                icon: 'Success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
            }).then((result) => {
                if (result.value) { window.location.href = "index.php"; }
            });
        </script>
    <?php } ?>
</html>
