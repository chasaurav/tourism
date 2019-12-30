<?php
require('./config/db.php');

$alert = false;

if (isset($_POST['enquiryForm'])) {
	$name = isset($_POST['name'])?$_POST['name']:null;
	$phno = isset($_POST['phno'])?$_POST['phno']:null;
	$email = isset($_POST['email'])?$_POST['email']:null;
	$status = "new";
	$createdAt = date('Y-m-d H:i:s');

	$stmt = $pdo->prepare("INSERT INTO tbl_enquiry (name, phno, email, status, createdAt) VALUES (:name, :phno, :email, :status, :createdAt)");
	$params = [
		":name" => $name,
		":phno" => $phno,
		":email" => $email,
		":status" => $status,
		":createdAt" => $createdAt 
	];
	if ($stmt->execute($params)) {
		$alert = true;
			// header('location: ./index.php');
	}
}

$stmt = $pdo->prepare("SELECT * FROM tbl_pack WHERE status = 'active'");
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Tour Packages for Darjeeling, Sikkim</title>
	<!-- FAVICON -->
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- CUSTOM STYLE -->
	<link rel="stylesheet" href="./css/style.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="headerWrapper">
			<div class="nav">
				<div class="logoBrand">
					<a href="index.php">
						<img src="./images/logo.png" alt="logo" style="width: 20%; height: auto;  margin-top: 20px;">
					</a>
				</div>
			</div>
			<div class="textContent">
				<h2>Get Ready!!!</h2>
				<p>Sikkim & Darjeeling season B2B ready packages. <br> Valid till June 2019 - August 2019</p>
				<ul class="contactItems">
					<li>Reach Us at:</li>
					<li><a href="tel:+918389898989" style="font-size: 1em;"><i class="fa fa-phone-square" aria-hidden="true"></i> 083 89 89 89 89</a></li>
					<li><a href="javascript:void()"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
					<li><a href="javascript:void()"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
					<li><a href="javascript:void()"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<li><a href="javascript:void()"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
				</ul>
				<a href="#popularTourPackages" style="margin-top: 25px;">
					<svg width="28px" height="100%" viewBox="0 0 247 390" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;">
						<path id="wheel" d="M123.359,79.775l0,72.843" style="fill:none;stroke:#fff;stroke-width:20px;"/>
						<path id="mouse" d="M236.717,123.359c0,-62.565 -50.794,-113.359 -113.358,-113.359c-62.565,0 -113.359,50.794 -113.359,113.359l0,143.237c0,62.565 50.794,113.359 113.359,113.359c62.564,0 113.358,-50.794 113.358,-113.359l0,-143.237Z" style="fill:none;stroke:#fff;stroke-width:20px;"/>
					</svg>
				</a>
			</div>
		</div>
		<div class="bodyWrapper">
			<h1 id="popularTourPackages" class="sectionHeader">
				Popular Tour Packages <br>
				<small class="sectionSubHeader">We are Expert in Sikkim and Darjeeling Tour Package</small>
			</h1>
			<div class="cardContainer">
				<?php foreach ($res as $k) { ?>
					<div class="card">
						<?php if (isset($k->tag)) { ?>
							<span class="ribbon"><?= $k->tag; ?></span>
						<?php } ?>
						<div class="cardLeft" style="background: url('./images/<?= $k->pckImage; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
						<div class="cardRight">
							<h4><?= $k->title; ?> (<?= $k->code; ?>)</h4>
							<p><?= $k->night; ?> Nights → <?= $k->day; ?> Days</p>
							<p><?= substr($k->description, 0, 250)."..."; ?></p>
							<p>
								<?php if ($k->hotel) { ?>
									<i title="Hotel Stay" class="fa fa-building" aria-hidden="true"></i>
								<?php } ?>
								<?php if ($k->trans) { ?>
									<i title="Transportation" class="fa fa-car" aria-hidden="true"></i>
								<?php } ?>
								<?php if ($k->meal) { ?>
									<i title="Meals" class="fa fa-cutlery" aria-hidden="true"></i>
								<?php } ?>
								<?php if ($k->sight) { ?>
									<i title="Sightseening" class="fa fa-street-view" aria-hidden="true"></i>
								<?php } ?>
							</p>
							<p><strong>Starts With :</strong> <span style="color: #bf8a11; font-weight: 600; font-size: 1.8em; letter-spacing: 3px;">Rs. <?= $k->rate; ?>/-</span> Per Person* (Min <?= $k->minPerson; ?> Pax)</p>
							<button type="button" name="getQuote" id="getQuote" class="getQuote" value="<?= $k->id; ?>">Get Quote</button>
						</div>
					</div>




					
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="modalContainerHidden">
		<h1 class="modalHead">Enquiry Modal</h1>
	</div>
	<div class="modalContainerVisible" style="display: none;">
		<i id="closeModal" class="fa fa-times" aria-hidden="true" style="font-size: 2em; float: right; cursor: pointer;"></i>
		<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
			<input type="text" name="name" class="custInput" id="name" placeholder="Enter Your Name" required="">
			<input type="text" name="phno" class="custInput" id="phno" placeholder="Enter Your Phone No." required="">
			<input type="email" name="email" class="custInput" id="email" placeholder="Enter Your Email">
			<button type="submit" name="enquiryForm" class="enquiryBtn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Plan my trip</button>
		</form>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script>
		$('.modalContainerHidden').on('click', function() {
			$('.modalContainerVisible').fadeIn('slow');
			$('.modalContainerHidden').fadeOut('slow');
		});
		$('#closeModal').on('click', function() {
			$('.modalContainerVisible').fadeOut('slow');
			$('.modalContainerHidden').fadeIn('slow');
		});
	</script>
	<?php if ($alert) { ?>
		<script>
			Swal.fire({
				title: 'Submitted Successfully',
				text: "We have received your enquiry.",
				icon: 'Success',
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			}).then((result) => {
				if (result.value) { window.location.href = "index.php"; }
			});
		</script>
	<?php } ?>
</body>
</html>