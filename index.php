<?php //error_reporting(0);
	include_once "config/koneksi.php";
	// session_start();
	// if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
	// 	header('location:login.php');
	// } else {
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SITARING HAJA</title>
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="css/bootstrap.css">
		<!-- <link rel="stylesheet" href="css/bootstrap-v4.css"> -->
		<script type="text/javascript" src="js/jquery-1.12.3.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script>
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
				})
		</script>

		<script src="js/highcharts.js" type="text/javascript"></script>
	</head>
	<body onload="carikordinat()">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<img src="images/header.jpg" alt="header" class="img-responsive" width="780px" height="120px" usemap="#Map" />
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
								<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Master<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href=?module=kabupaten>Kabupaten</a></li>
										<li><a href=?module=komoditi>Komoditi</a></li>
										<li><a href=?module=penyakit>Penyakit</a></li>
										<li><a href=?module=triwulan>Triwulan</a></li>
										<li><a href=?module=luaskomoditi>Luas Komoditi</a></li>
									</ul>
								</li>
								<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Transaksi<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href=?module=pemetaan>Pemetaan</a></li>
										<li><a href=?module=pengendalian>Pengendalian</a></li>
									</ul>
								</li>
								<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Laporan<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href=?module=laporan_triwulan>Pemetaan Triwulan</a></li>
										<li><a href=?module=laporan_pengendalian>Pengendalian Triwulan</a></li>
										<li><a href=?module=grafik>Grafik Pemetaan</a></li>
									</ul>
								</li>
								<li><a href=?module=pesan>Pesan</a></li>
								<li><a href=?module=pengaturan>Pengaturan</a></li>
								<li><a href="logout.php">Keluar</a></li>
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
<?php
// }
?>