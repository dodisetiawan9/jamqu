<?php
	include_once("../../function/koneksi.php");
	include_once("../../function/helper.php");

	$kota_id = $_GET['kota_id'];

	mysqli_query($koneksi, "DELETE FROM kota WHERE kota_id='$kota_id'");

	header("location: ".BASE_URL."index.php?page=my_profile&module=kota&action=list&notif=deleted");