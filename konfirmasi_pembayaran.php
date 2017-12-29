<?php 
	$pesanan_id = $_GET["pesanan_id"];


?>
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		
	
<form action="<?php echo BASE_URL."module/pesanan/action.php?pesanan_id=$pesanan_id";?>" method="POST">

<div class="container-fluid back-form">
	<h3 class="text-center">Konfirmasi Pembayaran</h3>
	<hr />
	<div class="form-group">
		<label>Nomor Rekening</label>
			<input type="text" name="nomor_rekening" class="form-control">
	</div>
	<div class="form-group">
		<label>Nama Account Bank</label>
			<input type="text" name="nama_account" class="form-control">
	</div>
	<div class="form-group">
		<label>Tanggal Transfer <i>(format yyyy-mm-dd)</i></label>
			<input type="date" name="tanggal_transfer" class="form-control">
	</div>
	<div class="form-group">
			<input type="submit" name="button" value="Konfirmasi" class="btn btn-primary">
	</div>

</div>
</form>

</div>
</div>
