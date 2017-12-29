<?php
	$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;

	$kategori = "";
	$status = "";
	$button = "Add";

	if($kategori_id){
		$querykategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori_id='$kategori_id'");
		$row = mysqli_fetch_assoc($querykategori);

		$kategori = $row['kategori'];
		$status = $row['status'];
		$button = "Update";
	}
?>


<form action="<?php echo BASE_URL."module/kategori/action.php?kategori_id=$kategori_id";?>" method="POST">

	<div class="form-group">
		<label>Kategori</label>
			<input type="text" name="kategori" class="form-control" value="<?php echo $kategori; ?>">
	</div>
	<div class="form-group">
		<label>Status</label>
			<input type="radio" name="status" value="on" <?php if($status == "on"){echo "checked='true'";} ?> class="radio-inline">On
			<input type="radio" name="status" value="off"  <?php if($status == "off"){echo "checked='true'";} ?> class="radio-inline">Off
	</div>
	<div class="form-group">
			<input type="submit" name="button" value="<?php echo $button; ?>" class="btn btn-primary btn-sm">
	</div>

</form>