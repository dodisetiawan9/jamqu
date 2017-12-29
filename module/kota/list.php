<div class="container-fluid">
<div class="row content">
<div class="form-group">
	<?php
			$notif = isset($_GET['notif']) ? $_GET['notif'] : false;

			if($notif == "deleted"){
				echo "<div class='alert alert-info alert-dismissable'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>Data Berhasil Dihapus!
					  </div>";
			}
			else if($notif =="success"){
				echo "<div class='alert alert-success alert-dismissable'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>Data Berhasil Ditambahkan!
					  </div>";
			}
			else if($notif == "updated"){
				echo "<div class='alert alert-success alert-dismissable'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>X</a>Data Berhasil Diperbaharui!
					  </div>";
			}
		?>
	<a href="<?php echo BASE_URL."index.php?page=my_profile&module=kota&action=form"; ?>" class="btn btn-success btn-float">Tambah</a>
</div>

<?php
	$query = mysqli_query($koneksi, "SELECT * FROM kota ORDER BY kota ASC");

	if(mysqli_num_rows($query) == 0){
		echo "<h3>Maaf, Belum ada nama kota di database</h3>";
	}
	else{
		echo "<table class='table table-bordered'>";
		echo "<tr>
				<th class='no text-center'>No</th>
				<th class='text-center'>kota</th>
				<th class='text-center'>Tarif</th>
				<th class='text-center'>Status</th>
				<th class='text-center'>Action</th>
			</tr>";
		$no=1;

		while($row = mysqli_fetch_assoc($query)){
			echo "<tr>
					<td>$no</td>
					<td>$row[kota]</td>
					<td>".rupiah($row["tarif"])."</td>
					<td class='no text-center'>$row[status]</td>
					<td class='text-center'>
						<a href='".BASE_URL."index.php?page=my_profile&module=kota&action=form&kota_id=$row[kota_id]' class='btn btn-warning btn-xs glyphicon glyphicon-pencil'></a>
						<a href='".BASE_URL."module/kota/hapus.php?kota_id=$row[kota_id]' class='btn btn-danger btn-xs glyphicon glyphicon-trash'></a>
					</td>
					
				  </tr>";
				  $no++;
		}
		echo "</table>";
	}

?>		
</div>
</div>