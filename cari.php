<?php

	

	if(isset($_POST['submit'])){
		$cari = $_POST['cari'];

		$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE nama_barang LIKE '%$cari%' LIMIT 6");

		if(mysqli_num_rows($query) == 0){
			echo "<h3 class='alert-height text-center'>Upsss,Maaf, Barang yang anda cari tidak ditemukan :'(</h3>";
		}
		else{
			echo "<div class='container-fluid'>";
			echo "<h5 class='list-cari'>Menampilkan data dari pencarian '<strong>".$cari."</strong>'</h5>";
			echo "<hr />";
			while($row=mysqli_fetch_assoc($query)){
						$barang = strtolower($row["nama_barang"]);
						$barang = str_replace(" ", "-", $barang);
						$stok = $row['stok'];
						
						echo "<div class='col-lg-3 col-md-3 col-sm-4 col-xs-12'>
								<div class='thumbnail icon-box'>
									<p class='price'>".rupiah($row['harga'])."</p>
									<div class='img-responsive img-info'>
										<a href='".BASE_URL."$row[barang_id]/$kategori/$barang.html'><img src='".BASE_URL."images/barang/$row[gambar]' class='img-responsive  phone'></a>
									</div>
									<div class='caption caption-detail'>
										<a href='".BASE_URL."index.php?page=detail&barang_id=$row[barang_id]'>
										</a>
									
										<h5 class='title-info'><a href='".BASE_URL."$row[barang_id]/$kategori/$barang.html'>$row[nama_barang]</a></h5>";
									  
									  	if($stok == 0){
									  		echo "<p class='stok-habis'>Stok Habis</p>";
									  	}else{

											echo "<p  class='stok'>Stok : $row[stok]</p>";
									  	}
									 
						echo "</div>
										<div class='btn-cart'>
										<a href='".BASE_URL."tambah_keranjang.php?barang_id=$row[barang_id]' class='btn-default btn-btn'>Add To Cart </a><img src='".BASE_URL."images/add-cart.png' class='cart-image' />

										</div>
										</div>
									
								</div>";

							
					}

		echo "</div>";			
		}
	}

?>
