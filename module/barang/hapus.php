<?php
	include_once("../../function/koneksi.php");
	include_once("../../function/helper.php");

	$barang_id = $_GET['barang_id'];

	$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$barang_id'");
	$row = mysqli_fetch_assoc($query);

	$gambar = $row['gambar'];

	if(file_exists("../../images/barang/$gambar")){
		unlink("../../images/barang/$gambar");
	}
	mysqli_query($koneksi, "DELETE FROM barang WHERE barang_id='$barang_id'");

	header("location: ".BASE_URL."index.php?page=my_profile&module=barang&action=list&notif=deleted");
	

