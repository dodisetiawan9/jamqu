<?php 
	$pesanan_id = $_GET["pesanan_id"];

	$query = mysqli_query($koneksi, "SELECT status FROM pesanan WHERE pesanan_id='$pesanan_id'");
	$row = mysqli_fetch_assoc($query);
	$status = $row['status'];
?>

<div class="row">
<div class="col-md-5">
	<h3 class="text-center">Update Status Pesanan</h3>
	<hr />
<form action="<?php echo BASE_URL."module/pesanan/action.php?pesanan_id=$pesanan_id";?>" method="POST">
	<div class="form-group">
		<label>Pesanan id (Faktur id)</label>
			<input type="text" name="pesanan_id" class="form-control" value="<?php echo $pesanan_id;?>" readonly="true">
	</div>
	<div class="form-group">
		<label>Status</label>
		<select class="form-control" name="status">
			<?php 
				foreach ($arrayStatusPesanan AS $key => $value) {
					if($status == $key){
						echo "<option value='$key' selected='true'>$value</option>";
					}
					else{
						echo "<option value='$key'>$value</option>";
					}
						
				}
			?>
		</select>


	</div>
	<div class="form-group">
	<input type="submit" name="button" value="Edit Status" class="btn btn-primary btn-sm">
	</div>


</form>
</div>
<div class="col-md-5 col-md-offset-1">
<?php
	$queryKonfirmasi = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pembayaran WHERE pesanan_id='$pesanan_id'");

	if(mysqli_num_rows($queryKonfirmasi) == 0){
		echo "<div class='alert alert-warning alert-status'>Belum Melakukan Pembayaran</div>";
	}
	else{
		while($row = mysqli_fetch_assoc($queryKonfirmasi)){
			$pesanan_id = $row['pesanan_id'];
			$rekening = $row['nomor_rekening'];
			$nama_account = $row['nama_account'];
			$tgl = $row['tanggal_transfer']; 


			echo "<h3 class='text-center'>Detail Konfirmasi Pembayaran</h3>";
			echo "<hr />";

			echo "<table class='table'>
					<tr>
						<td>Pesanan ID</td>
						<td> : </td>
						<td>$pesanan_id</td>
					</tr>
					<tr>
						<td>Nama Account Rekening</td>
						<td> : </td>
						<td>$nama_account</td>
					</tr>	
					<tr>
						<td>Nomor Rekening</td>
						<td> : </td>
						<td>$rekening</td>
					</tr>
					<tr>
						<td>Tanggal Transfer</td>
						<td> : </td>
						<td>$tgl</td>
					</tr>
				  </table>";


		}
	}
?>
</div>
</div>

<div class="row">
	<div class="col-md-12">
	<div class="alert alert-warning alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>Cek Mutasi Rekening untuk memvalidasi pembayaran
	</div>
	</div>
</div>