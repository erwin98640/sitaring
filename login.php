<?php
	if (isset($_POST["submi"])) {
		if ($_POST["username"]=="admin" AND $_POST["password"]=="admin") {
			session_start();
			$_SESSION['username']  = $_POST["username"];
			$_SESSION['passuser']  = $_POST["password"];
			header("location:index.php");
		}else{
		?>
			<script>
				alert("Username atau Password Salah");
				document.location.href="login.php";
			</script>
		<?php	
		}
	}
?>
<html>
<head>
	<title>Administrator | Aplikasi Sebaran Penyakit Tanaman Perkebunan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body id="login">
	<div class="container">
		<form class="form-signin" action="login.php" method="POST">
	        <h2 class="form-signin-heading"><legend>Masuk <small>Administrator</small></legend></h2>
			<input type="text" class="input-block-level" placeholder="Username" name="username"/>
			<input type="password" class="input-block-level" placeholder="Password" name="password"/>
			<button class="btn btn-primary" type="submit" name="submi">Masuk</button>
		</form>
	</div>
</body>
</html>