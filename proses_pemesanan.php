<?php

	include_once("function/koneksi.php");
	include_once("function/helper.php");

	session_start();

	$nama_penerima = $_POST["nama_penerima"];
	$nomor_telepon = $_POST["nomor_telepon"];
	$alamat = $_POST["alamat"];
	$kota = $_POST['kota'];

	$user_id = $_SESSION['user_id'];
	$waktu_saat_ini = date("Y-m-d");

	$query = mysqli_query($koneksi, "INSERT INTO pesanan (nama_penerima, user_id, nomor_telepon, kota_id, alamat, tanggal_pemesanan, status) VALUES('$nama_penerima', '$user_id', '$nomor_telepon', '$kota', '$alamat', '$waktu_saat_ini', '0')");

	if($query){
		$last_pesanan_id = mysqli_insert_id($koneksi);

		$keranjang = $_SESSION['keranjang'];

		foreach ($keranjang AS $key => $value) {
			$barang_id = $key;
			$quantity = $value['quantity'];
			$harga = $value['harga'];

			mysqli_query($koneksi, "INSERT INTO pesanan_detail (pesanan_id, barang_id, quantity, harga) VALUES('$last_pesanan_id', '$barang_id', '$quantity', '$harga')");

			
				mysqli_query($koneksi, "INSERT INTO laporan (pesanan_id, barang_id, qty) VALUES('$last_pesanan_id', '$barang_id', '$quantity')");
			
		}

		unset($_SESSION["keranjang"]);

		header("location:".BASE_URL."index.php?page=pesanan&pesanan_id=$last_pesanan_id");
	}