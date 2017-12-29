<?php

	define("BASE_URL","http://localhost/jamqu/");
	
	$arrayStatusPesanan[0] = "<img class='img-size' src='".BASE_URL."images/pay.png'> Menunggu Pembayaran";
	$arrayStatusPesanan[1] = "<img class='img-size' src='".BASE_URL."images/val-rp.png'> Pembayaran Sedang Di Validasi";
	$arrayStatusPesanan[2] = "<img class='img-size' src='".BASE_URL."images/payment2.png'> Lunas";
	$arrayStatusPesanan[3] = "<img class='img-size' src='".BASE_URL."images/uncek.png'>  Pembayaran Di Tolak";


	function rupiah($nilai = 0){
		$string="Rp. ".number_format($nilai);
		return $string;
	}

	function pagination($query, $data_per_halaman, $pagination, $url){
		$total_data = mysqli_num_rows($query);
			$total_halaman = ceil($total_data / $data_per_halaman);

			echo "<ul class='pagination page'>";
			for($i = 1; $i<=$total_halaman;$i++){
				if($pagination == $i){
					echo "<li class='active'><a href='".BASE_URL."$url&pagination=$i'>$i</a></li>";
					
				}else{

					echo "<li><a href='".BASE_URL."$url&pagination=$i'>$i</a></li>";
				}
			}

			echo "</ul>";	
	}
