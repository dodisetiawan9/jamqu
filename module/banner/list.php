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
	<a href="<?php echo BASE_URL."index.php?page=my_profile&module=banner&action=form";?>" class="btn btn-success">Tambah</a>
</div>

<?php
	$no=1;

	$query = mysqli_query($koneksi, "SELECT * FROM banner ORDER BY banner DESC");

	if(mysqli_num_rows($query) == 0){
		
		echo "<h3>Maaf belum ada data banner di database</h3>";
	}
	else{
		echo "<div class='table table-responsive'>";
		echo "<table class='table table-striped'>";
		echo "<tr>
				<th>No</th>
				<th>Banner</th>
				<th>Link</th>
				<th>Gambar</th>
				<th>Status</th>
				<th class='text-center'>Action</th>
			  </tr>";
		while($row=mysqli_fetch_assoc($query)){
			echo "<tr>
					<td>$no</td>
					<td>$row[banner]</td>
					<td><a target='blank' href='".BASE_URL."$row[link]'>$row[link]</a></td>
					<td>$row[gambar]</td>
					<td class='text-center'>$row[status]</td>
					<td class='text-center'>
						<a href='".BASE_URL."index.php?page=my_profile&module=banner&action=form&banner_id=$row[banner_id]"."' class='btn btn-warning btn-xs glyphicon glyphicon-pencil'></a>
						<a href='".BASE_URL."module/banner/hapus.php?banner_id=$row[banner_id]"."' class='btn btn-danger btn-xs glyphicon glyphicon-trash'></a>
					</td>
					

					
				  </tr>";
			$no++;
		}
	}
		echo "</table>";
		echo "</div>";
?>
</div>