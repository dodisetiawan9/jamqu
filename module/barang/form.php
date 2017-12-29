<?php
	$barang_id=isset($_GET['barang_id']) ? $_GET['barang_id'] :false;
	
	$nama_barang="";
	$kategori_id="";
	$spesifikasi="";
	$gambar="";
	$stok="";
	$harga="";
	$status = "";
	$button = "Add";
	$keterangan_gambar="";

	if($barang_id){
		$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$barang_id'");
		$row = mysqli_fetch_assoc($query);

		$nama_barang = $row['nama_barang'];
		$kategori_id = $row['kategori_id'];
		$spesifikasi = $row['spesifikasi'];
		$stok = $row['stok'];
		$harga = $row['harga'];
		$gambar = $row['gambar'];
		$status = $row['status'];
		$button = "Update";
		$keterangan_gambar="(Klik pilih gambar jika ingin mengganti gambar)";

		$gambar= "<img src='".BASE_URL."images/barang/$gambar' style='width: 200px;vertical-align: middle;display: block;margin-left: 40%;' />";
	}

?>

<div class="container-fluid back-form">

	<script src="<?php echo BASE_URL."js/ckeditor/ckeditor.js"; ?>"></script>

	<form action="<?php echo BASE_URL."module/barang/action.php?barang_id=$barang_id";?>" method="POST" enctype="multipart/form-data">


	<div class="form-group">
		<label>Kategori</label>
				<span>
					<select class="form-control" name="kategori_id">
					
						<?php
							$query=mysqli_query($koneksi,"SELECT kategori_id, kategori FROM kategori WHERE status='on' ORDER BY kategori ASC");
							while($row=mysqli_fetch_assoc($query)){
								if($kategori_id == $row['kategori_id']){
									echo "<option value='$row[kategori_id]' selected='true'>$row[kategori]</option>";
									
								}
								else{
									echo "<option value='$row[kategori_id]'>$row[kategori]</option>";									
								}
							}
						?>
					</select>
					
				</span>
	</div> 
	
		<div class="form-group">
			<label>Nama Barang</label>
				<input type="text" name="nama_barang" class="form-control" value="<?php echo $nama_barang; ?>">
		</div>
		<div class="form-group">
			<label>Spesifikasi</label>
				<textarea class="form-control" name="spesifikasi" id="editor"><?php echo $spesifikasi; ?></textarea>
		</div>
		<div class="form-group">
			<label>Stok</label>
				<input type="text" name="stok" class="form-control" value="<?php echo $stok; ?>">
		</div>
		<div class="form-group">
			<label>Harga</label>
				<input type="text" name="harga" class="form-control" value="<?php echo $harga; ?>">
		</div>
		<div class="form-group">
			<label>Gambar Produk <?php echo $keterangan_gambar; ?></label>
				<span><input type="file" name="file"><?php echo $gambar; ?></span>
		</div>
		<div class="form-group">
			<label>Status</label>
				<input type="radio" name="status" value="on" <?php if($status == "on"){echo "checked='true'";} ?> class="radio-inline">On
				<input type="radio" name="status" value="off"  <?php if($status == "off"){echo "checked='true'";} ?> class="radio-inline">Off
		</div>
		<div class="form-group">
				<input type="submit" name="button" value="<?php echo $button; ?>" class="btn btn-primary btn-md">
		</div>

	</form>
</div>

<script>
	CKEDITOR.replace("editor");

</script>