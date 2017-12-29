<?php
	$kota_id = isset($_GET['kota_id']) ? $_GET['kota_id'] :false;

	$kota = "";
	$tarif = "";
	$status = "";
	$button = "Add";

	if($kota_id){
		$query = mysqli_query($koneksi, "SELECT * FROM kota WHERE kota_id='$kota_id'");
		$row = mysqli_fetch_assoc($query);

		$kota = $row['kota'];
		$tarif = $row ['tarif'];
		$status = $row ['status'];
		$button = "Update";
	}
?>
<form action="<?php echo BASE_URL."module/kota/action.php?kota_id=$kota_id";?>" method="POST">

<div class="container-fluid back-form">
	<div class="form-group">
		<label>Kota</label>
			<input type="text" class="form-control" name="kota" value="<?php echo $kota; ?>">
	</div>
	<div class="form-group">
		<label>Tarif</label>
			<input type="text" class="form-control" name="tarif" placeholder="(misal: 8000)" value="<?php echo $tarif;?>">
	</div>
	<div class="form-group">
		<label>Status</label></br>
			<input type="radio" name="status" value="on" <?php if($status=="on"){echo "checked='true'";}?>>On
			<input type="radio" name="status" value="off" <?php if($status=="off"){echo "checked='true'";}?>>Off
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="button" value="<?php echo $button; ?>">
	</div>

</div>