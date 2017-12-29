<div class="container-fluid">
	<?php
		// session_start();

		// $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
		// $level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
		// include_once("function/koneksi.php");
		// include_once("function/helper.php");
		
		$query = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id WHERE pesanan.user_id='$user_id' ORDER BY pesanan.tanggal_pemesanan DESC");
		if(mysqli_num_rows($query) == 0){
			echo "<h3>Maaf, Saat ini belum ada data pemesanan</h3>";
		}
		else{
			echo "<h4 class='text-center'>INFO PESANAN ANDA</h4>";
			echo "<hr />";
			echo "<div class='table-responsive'>";
			echo "<table class='table'>
					<tr class='title-brg'>
						<th>NO Pesanan</th>
						<th>Status</th>
						<th>Nama</th>
						<th>Action</th>
							</tr>";
			$btn_admin = "";
			while($row=mysqli_fetch_assoc($query)){

				if($level == "superadmin"){
					$btn_admin = "<a href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=status&pesanan_id=$row[pesanan_id]' class='btn btn-warning btn-xs'>Update Status</a>";
				}
				$status = $row['status'];
				
				echo "<tr>
						<td>$row[pesanan_id]</td>
						<td>$arrayStatusPesanan[$status]</td>
						<td>$row[nama]</td>
						<td>
							<a href='".BASE_URL."index.php?page=detail_pesanan&pesanan_id=$row[pesanan_id]'  class='btn btn-success btn-xs glyphicon glyphicon-zoom-in btn-back' > Detail</a>
							$btn_admin
						</td>
					  </tr>";
	}
		echo "</table>";
		echo "</div>";
}

	?>

</div>