
<div class="container-fluid">
	<div class="row">
			
	</div>
		

	
		<div class="hidden-sm hidden-xs slidbar" id="slides">
					
					<?php

						$querybanner=mysqli_query($koneksi, "SELECT * FROM banner WHERE status='on' ORDER BY banner_id DESC LIMIT 3");
						while($row=mysqli_fetch_assoc($querybanner)){
							echo "<a href='".BASE_URL."$row[link]'><img src='".BASE_URL."images/slide/$row[gambar]' width='100%' /></a>";
						}
					?>
				
					
		</div>
		<div class="welcome-message">
			<div class="text-center">
				<h4>Selamat Datang Di Website kami :)</h4>
				<p>Dapatkan produk terbaik dengan harga termurah, hanya disi.!</p>
			</div>

		</div>
		
		
			<!-- <div class="col-md-12 panel-content"> -->
			
				
			<table>
				<?php

					$pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
					$data_per_halaman = 8;
					$mulai_dari = ($pagination-1) * $data_per_halaman;
					
					if($kategori_id){
						$kategori_id = "AND barang.kategori_id='$kategori_id'";

					}
						$query=mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id=kategori.kategori_id WHERE barang.status='on' $kategori_id ORDER BY rand() DESC LIMIT $mulai_dari, $data_per_halaman");
		
					while($row=mysqli_fetch_assoc($query)){
						$kategori = strtolower($row["kategori"]);
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
					
				?>
	
		</table>
			</div>
		
			<div class="page">
			<?php
				
				$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;
				
				
				if($kategori_id){
					$queryHitungBarang = mysqli_query($koneksi, "SELECT * FROM barang WHERE kategori_id='$kategori_id'");
					pagination($queryHitungBarang, $data_per_halaman, $pagination,"index.php?$kategori_id");
				}
				else{
					$kategori = $row['kategori_id'];
					$queryHitungBarang = mysqli_query($koneksi, "SELECT * FROM barang");
					pagination($queryHitungBarang, $data_per_halaman, $pagination, "index.php?kategori_id=$row[kategori_id]" );
				}
			?>
			</div>

	</div>
</div>
