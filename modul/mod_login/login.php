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
				document.location.href="?module=login";
			</script>
		<?php	
		}
	}
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="judul">
				<span>LOGIN ADMINISTRATOR</span>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-5 col-md-offset-3" style="margin-bottom: 10px">
			<form class="form-signin" action="?module=login" method="POST">
				<div class="form-group form-inline">
					<label>Username</label>
					<input type="text" class="form-control pull-right" placeholder="Username" name="username"/>
				</div>
				<div class="form-group form-inline">
					<label>Password</label>
					<input type="password" class="form-control pull-right" placeholder="Password" name="password"/>
				</div>
				<button class="btn btn-success pull-right" type="submit" name="submi">Masuk</button>
			</form>
		</div>
	</div>
</div>