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
		<a href="<?php echo BASE_URL."index.php?page=my_profile&module=kategori&action=form"; ?>" class="btn btn-success btn-float">Tambah</a>
	</div>

	<?php

		$pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
		$data_per_halaman = 10;
		$mulai_dari = ($pagination-1) * $data_per_halaman;
		$querykategori = mysqli_query($koneksi, "SELECT * FROM kategori LIMIT $mulai_dari, $data_per_halaman");

		if(mysqli_num_rows($querykategori) == 0){
			echo "Maaf Belum ada Kategori di dalam database";
		}
		else{	
				echo "<div class='table table-responsive'>";
			
				echo "<table class='table table-bordered'>";
				echo "<tr>
							<th class='no text-center'>No</th>
							<th class='text-center'>Kategori</th>
							<th class='text-center'>Status</th>
							<th class='text-center'>Action</th>
					  </tr>";
				$no=1 + $mulai_dari;
				while($row=mysqli_fetch_assoc($querykategori)){
				echo "<tr>
							<td class='text-center'>$no</td>
							<td>$row[kategori]</td>
							<td class='text-center'>$row[status]</td>
							<td class='text-center'>
								<a href='".BASE_URL."index.php?page=my_profile&module=kategori&action=form&kategori_id=$row[kategori_id]' class='btn btn-warning btn-xs glyphicon glyphicon-pencil'></a>
								<a href='".BASE_URL."module/kategori/hapus.php?kategori_id=$row[kategori_id]' class='btn btn-danger btn-xs glyphicon glyphicon-trash'></a>
							</td>
						
					  </tr>";
					  $no++;
				}
				echo "</table>";

				$queryHitungkategori = mysqli_query($koneksi, "SELECT * FROM kategori");
				pagination($queryHitungkategori, $data_per_halaman, $pagination, "index.php?page=my_profile&module=kategori&action=list");
			
		}
				echo "</div>";
	?>
</div>
</div>