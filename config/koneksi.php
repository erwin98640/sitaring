<?php
	$db["engi"] = "mysql";
	$db["host"] = $_SERVER['HTTP_HOST'];
	// $db["user"] = "root";
	$db["user"] = "smknkot2_websmk";
	// $db["pass"] = "";
	$db["pass"] = "websmk2212*";
	// $db["dbes"] = "maping";
	$db["dbes"] = "smknkot2_sitaring";


	$koneksi = new mysqli($db["host"], $db["user"], $db["pass"], $db["dbes"]) or die ('Error connecting to database');
?>
