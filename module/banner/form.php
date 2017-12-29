<?php
	$banner_id = isset($_GET['banner_id']) ? $_GET['banner_id'] : "";

	$banner = "";
	$link = "";
	$gambar = "";
	$status = "";
	$keterangan_gambar = "";
	$button = "Add";

	if($banner_id != ""){
		$button = "Update";

		$query = mysqli_query($koneksi, "SELECT * FROM banner WHERE banner_id='$banner_id'");
		$row = mysqli_fetch_assoc($query);

		$banner = $row["banner"];
		$link = $row["link"];
		$status = $row["status"];
		$gambar = "<img src='". BASE_URL."images/slide/$row[gambar]' style='width: 200px;vertical-align: middle;margin-left: 40%;' />";
		$keterangan_gambar = "(Klik pilih gambar jika ingin mengganti gambar)";
	}
?>
<form action="<?php echo BASE_URL."module/banner/action.php?banner_id=$banner_id";?>" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Banner</label>
			<input type="text" name="banner" class="form-control" value="<?php echo $banner; ?>">
	</div>
	<div class="form-group">
		<label>Link</label>
			<input type="text" name="link" class="form-control" value="<?php echo $link; ?>">
	</div>
	<div class="form-group">
			<label>Gambar Produk <?php echo $keterangan_gambar; ?></label>
				<span><input type="file" name="file"><?php echo $gambar; ?></span>
	</div>
	<div class="form-group">
		<label>Status</label></br>
			<input type="radio" name="status" value="on" <?php if($status == "on"){echo "checked='true'";} ?> class="radio-inline">On
			<input type="radio" name="status" value="off"  <?php if($status == "off"){echo "checked='true'";} ?> class="radio-inline">Off
	</div>
	<div class="form-group">
		<input type="submit" name="button" class="btn btn-primary" value="<?php echo $button; ?>">
	</div>


</form>