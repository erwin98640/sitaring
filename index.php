<?php include_once "config/koneksi.php"; include "./assets/lib/fungsi_upload.php"; session_start() ?>
<!DOCTYPE html lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SITARING HAJA - Sistem Informasi Inventarisasi Data Monitoring Hasil Pekerjaan</title>
		<!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"> -->
		<script type="text/javascript" src="./assets/js/jquery-1.12.3.js"></script>
		<script type="text/javascript" src="./assets/js/bootstrap.js"></script>
		<script>
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
				})
			function RefreshWindow() {
				window.location.reload(true);
				}
		</script>
		<script src="js/highcharts.js" type="text/javascript"></script>
		<link rel="stylesheet" href="./assets/css/bootstrap.css">

		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<script>
		     (adsbygoogle = window.adsbygoogle || []).push({
		          google_ad_client: "ca-pub-2586125774271995",
		          enable_page_level_ads: true
		     });
		</script>
	</head>
	<body onload="carikordinat()">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<img src="./assets/images/header.jpg" alt="header" class="img-responsive" width="780px" height="120px" usemap="#Map" />
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<nav class="navbar navbar-default">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#target-list">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="collapse navbar-collapse" id="target-list">
							<div class="nav navbar-nav">
								<li><a href="?module=home">Beranda</a></li>
								<li><a href=?module=pekerjaan>Data Pekerjaan</a></li>
								<?php if (!empty($_SESSION['username']) AND empty($_SESSION['password'])){ ?>
								<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Master<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href=?module=bidang>Bidang</a></li>
										<li><a href=?module=program>Program Pekerjaan</a></li>
										<li><a href=?module=jenis_pengadaan>Jenis Pengadaan</a></li>
										<li><a href=?module=satuan>Satuan</a></li>
									</ul>
								</li>
								<li><a href=?module=pemetaan>Pemetaan</a></li>
								<li><a href="logout.php">Logout</a></li>
								<?php } ?>
								<?php if (empty($_SESSION['username']) AND empty($_SESSION['password'])){ ?>
								<li><a href="?module=login">Login</a></li>
								<?php } ?>
							</div>
						</div>
					</nav>
				</div>
			</div>

			<?php include "content.php" ?>

			<div class="panel-footer">
				<p>supported by <a href="https://wa.me/6285746080544?text=Assalamualaikum%2C%20salam%20kenal%20HENDRI%20ARIFIN%2C%20S.Kom%20%F0%9F%98%81">Computer Media Utama</a></p>
			</div>
		</div>
	</body>
</html>