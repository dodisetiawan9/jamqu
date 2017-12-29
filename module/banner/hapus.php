<?php

	include_once("../../function/koneksi.php");
	include_once("../../function/helper.php");

	$banner_id = $_GET['banner_id'];
	$query = mysqli_query($koneksi, "SELECT * FROM banner WHERE banner_id='$banner_id'");
	$row = mysqli_fetch_assoc($query);
	$gambar = $row['banner_id'];

	if(file_exists("../../images/silde/$gambar")){
		unlink("../../images/slide/$gambar");
	}

	mysqli_query($koneksi, "DELETE FROM banner WHERE banner_id='$banner_id'");

	header("location: ".BASE_URL."index.php?page=my_profile&module=banner&action=list&notif=deleted");