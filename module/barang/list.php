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
		<a href="<?php echo BASE_URL."index.php?page=my_profile&module=barang&action=form"; ?>" class="btn btn-success btn-brg pull">Tambah</a>
	</div>

	<?php

		$pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
		$data_per_halaman = 10;
		$mulai_dari = ($pagination-1) * $data_per_halaman;
		$query = mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id=kategori.kategori_id LIMIT $mulai_dari, $data_per_halaman");

		if(mysqli_num_rows($query) == 0){
			echo "Maaf Belum ada barang di dalam database";
		}
		else{
				echo "<div class='table-responsive'>";
				echo "<table class='table table-bordered'>";
				echo "<tr>
							<th class='text-center'>No</th>
							<th class='text-center'>Nama Barang</th>
							<th class='text-center'>Kategori</th>
							<th class='text-center'>Harga</th>
							<th class='text-center'>Stok</th>
							<th class='text-center'>Status</th>
							<th class='text-center'>Action</th>
					  </tr>";
				$no=1 + $mulai_dari;
				while($row=mysqli_fetch_assoc($query)){
				echo "<tr>
							<td class='text-center'>$no</td>
							<td>$row[nama_barang]</td>
							<td>$row[kategori]</td>
							<td>".rupiah($row["harga"])."</td>
							<td class='text-center'>$row[stok]</td>
							<td class='text-center'>$row[status]</td>
							<td class='text-center'>
								<a href='".BASE_URL."index.php?page=my_profile&module=barang&action=form&barang_id=$row[barang_id]' class='btn btn-warning btn-xs glyphicon glyphicon-pencil'></a>
								<a href='".BASE_URL."module/barang/hapus.php?barang_id=$row[barang_id]' class='btn btn-danger btn-xs glyphicon glyphicon-trash'></a>
							</td>
						
					  </tr>";
					  $no++;
				}
				echo "</table>";
				echo "</div>";

				$queryHitungBarang = mysqli_query($koneksi, "SELECT * FROM barang");
				pagination($queryHitungBarang, $data_per_halaman, $pagination, "index.php?page=my_profile&module=barang&action=list");
			
		}
	?>
</div>
</div>