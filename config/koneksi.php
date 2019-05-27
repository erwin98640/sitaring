<?php
	$db["engi"] = "mysql";
	$db["host"] = "localhost";
	$db["user"] = "root";
	$db["pass"] = "";
	$db["dbes"] = "maping";

	$koneksi = new mysqli($db["host"], $db["user"], $db["pass"], $db["dbes"]) or die ('Error connecting to database');
	// $koneksi = NEW PDO($db["engi"].':dbname='.$db["dbes"].';$host='.$db["host"], $db["user"], $db["pass"]);
?>
