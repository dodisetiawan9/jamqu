<?php
	ob_start();
	if($user_id == false){
		$_SESSION["proses_pesanan"] = true;

		header("location:".BASE_URL."login.html");
		exit;
	}
	ob_flush();
?>


<div class="container-fluid">

	<div class="row content">
		<div class="col-md-5 detail-pesanan">
			<h5 class="form-pesanan">Lengkapi data-data berikut ini!</h5>
			<form class="form-user" action="<?php echo BASE_URL."proses_pemesanan.php"; ?>" method="POST">
				<div class="form-group">
					<label>Nama Penerima</label>
					<input type="text" name="nama_penerima" class="form-control">
				</div>
				<div class="form-group">
					<label>No Telepon</label>
					<input type="text" name="nomor_telepon" class="form-control">
				</div>
				<div class="form-group">
					<label>Alamat Penerima</label>
					<textarea name="alamat" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label>Ongkos Kirim <i>(JNE REG)</i></label>
						<select name="kota" class="form-control"> 
							<?php 
								$query = mysqli_query($koneksi,"SELECT * FROM kota WHERE status='on'");

								while($row = mysqli_fetch_assoc($query)){
									echo "<option value='$row[kota_id]'>$row[kota] (".rupiah($row["tarif"]).")</option>";
								}

							?>
						</select>
				</div>
				<div class="form-group btn-tengah">
					<input type="submit" value="submit" class="btn btn-primary">
				</div>

			</form>
		</div>



		<div class="col-md-6 detail-order table-responsive">
			<h5 class="form-pesanan">Detail Order Anda</h5>
			<div class="form-user">
				<table class="table">
				<?php
					$no = 1;
				?>
						<tr class="title-detail">
							<th>No</th>
							<th>Nama Barang</th>
							<th>Qty</th>
							<th>Harga</th>
							<th>Total</th>
						</tr>

						<?php 
							$subtotal = 0;
							foreach ($keranjang AS $key => $value) {
								$barang_id = $key;

								$nama_barang = $value['nama_barang'];
								$harga = $value['harga'];
								$quantity = $value['quantity'];
								$total = $quantity * $harga;

								$subtotal = $subtotal + $total;

								echo "<tr'>
										<td>$no</td>
										<td>$nama_barang</td>
										<td>$quantity</td>
										<td>".rupiah($harga)."</td>
										<td>".rupiah($total)."</td>
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
						?>
				</table>

			</div>
		</div>

	</div>
</div>