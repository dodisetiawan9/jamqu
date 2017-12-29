<?php

	$server="localhost";
	$username="root";
	$password="bismillah";
	$database="jamqu";
	
	$koneksi=mysqli_connect($server, $username, $password, $database) or die("Koneksi ke database gagal!");