
<?php
	if($totalbarang == 0){
		echo "<h3 class='alert-height text-center'>Upsss, Keranjang Kosong!!!</h3>";
	}
	else{
		$no=1;
		echo "<div class='container-fluid'>";
		echo "<div class='table-responsive'>";
		echo "<div class='action-btn'><a href='".BASE_URL."index.php' class='btn btn-primary btn-sm btn-xs lnj-blj'><img src='".BASE_URL."images/cart3.png'> Lanjut Belanja</a>
				<a href='".BASE_URL."data-pemesan.html' class='btn btn-success btn-sm btn-xs lanjut-pesan'><img src='".BASE_URL."images/cart-list.png'> Lanjut Pemesanan</a></div>";

			
			echo "</div>";

		echo "<h4 class='title-keranjang table'>Keranjang Anda</h4>";
		echo "<div class='table-responsive'>";
		echo "<table class='table pad'>
			   <tr class='title-detail'>
			   		
			   		<th>Item</th>
			   		<th>Nama Barang</th>
			   		<th>Qty</th>
			   		<th>Harga</th>
			   		<th>Total</th>
			   		
			  </tr>";

			$subtotal = 0;	  
			foreach($keranjang AS $key => $value) {
			$barang_id = $key;
			
			$nama_barang = $value["nama_barang"];
			$gambar = $value["gambar"];
			$quantity = $value["quantity"];
			$harga = $value["harga"];

			$total = $quantity * $harga;
			$subtotal = $subtotal + $total;



			echo "<tr>
					
					<td><img src='".BASE_URL."images/barang/$gambar' width='50px'/></td>
					<td class='tengah'>$nama_barang</td>
					<td><input type='number' name='$barang_id' value='$quantity' class='update-quantity tengah' /></td>
					<td>".rupiah($harga)."</td>
					<td class='hapus-item'>".rupiah($total)."
					<a href='".BASE_URL."hapus_item.php?barang_id=$barang_id' class='btn-hapus glyphicon glyphicon-trash'></a>
					</td>
				  </tr>";

				 $no++;

			

		}

			echo "<tr>
					<td></td>
					<td></td>
					<td></td>
					
					<td class='subtotal-info'><b>Sub total</b></td>
					<td><b>".rupiah($subtotal)."</b></td>
				  </tr>";
			echo "</table>";
			echo "</div>";

			
		// echo "</table>";
	}

?>


<script>
	$(".update-quantity").on("input", function(e){
		var barang_id = $(this).attr("name");
		var value = $(this).val();

		$.ajax({
			method: "POST",
			url: "update_keranjang.php",
			data: "barang_id="+barang_id+"&value="+value
		})
		.done(function(data){
			location.reload();
		});


	});



</script>