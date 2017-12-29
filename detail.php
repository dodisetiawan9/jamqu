<div class="container-fluid">
	<div class="row detail">

		<?php 

			$barang_id = $_GET['barang_id'];
			$query = mysqli_query($koneksi,"SELECT * FROM barang WHERE barang_id='$barang_id' AND status='on'");
			$row = mysqli_fetch_assoc($query);

			echo "<div class='border-img col-xs-12 col-sm-6 col-md-5 col-lg-6'>
					  <div class='img-responsive'>
					  	<img src='".BASE_URL."images/barang/$row[gambar]' class='img-brg' />
					  </div>
				  </div>
				  <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					  <div>
						<h3>$row[nama_barang]</h3>
					  </div>
					  <div class='price-info'>
					  	<p>Harga:</p>
					  	<h4>".rupiah($row["harga"])."</h4>
				  	  	
					  </div>";
					  $stok = $row['stok'];
					  if($stok >= 0){
					  	echo "<p class='stock-info'><img src='".BASE_URL."images/ceklist.png'>Stok Tersedia</p>";
					  }
					  else{
					  	echo "<p class='stock-info'><img src='".BASE_URL."images/uncek.png'>Stok Kosong</p>";
					  }
			
			echo "<div class='btn-keranjang'>
					  <a href='".BASE_URL."tambah_keranjang.php?barang_id=$row[barang_id]' class='btn-beli'><img src='".BASE_URL."images/add-cart-whitee.png'>Beli Sekarang</a>
					 
			
					</div>
					<div class='sms-bar'>
						<h4>Order Via SMS | WA | BBM </h4>
						<p>Format Order:</p>
						<h5>Order#Nama Barang#jumlah</h5>
					</div>";

			echo  "</div>";
					  	
		?>
	</div>
			  <div class='detail-brg'>
			  	  <div class='strip'>
			  	  	<p class=' info-brg'><span>Deskripsi</span></p>
			  	  	<p><?php echo $row['spesifikasi']; ?></p>
			  	  </div>
			  	  
			  
			  </div>



</div>