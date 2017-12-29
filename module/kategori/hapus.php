<?php
	include_once("../../function/koneksi.php");
	include_once("../../function/helper.php");

	$kategori_id = $_GET['kategori_id'];

	mysqli_query($koneksi, "DELETE FROM kategori WHERE kategori_id='$kategori_id'");

	header("location: ".BASE_URL."index.php?page=my_profile&module=kategori&action=list&notif=deleted");