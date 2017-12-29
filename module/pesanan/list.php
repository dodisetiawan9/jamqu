
<div class="container-fluid">
<div class="row content">
<h3 class="text-center">Data Pesanan Barang</h3>
<hr />
<br>
<?php
if($level == "superadmin"){
	$query = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id ORDER BY pesanan.tanggal_pemesanan DESC");
	
}
else{

	$query = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id WHERE pesanan.user_id='$user_id' ORDER BY pesanan.tanggal_pemesanan DESC");
}


if(mysqli_num_rows($query) == 0){
	echo "<h3>Maaf, Saat ini belum ada data pemesanan</h3>";
}
else{
	$no = 1;
	echo "<div class='table-responsive'>";
	echo "<table class='table table-bordered'>
			<tr class='title-brg'>
				<th class='no text-center'>No</th>
				<th class='text-center'>NO Pesanan</th>
				<th class='text-center'>Status</th>
				<th class='text-center'>Nama</th>
				<th class='text-center'>Action</th>
			</tr>";
	$btn_admin = "";
	while($row=mysqli_fetch_assoc($query)){

		if($level == "superadmin"){
			$btn_admin = "<a href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=status&pesanan_id=$row[pesanan_id]' class='btn btn-warning btn-xs'>Update Status</a>";
		}
		$status = $row['status'];
		echo "<tr>
				<td class='text-center'>$no</td>
				<td class='text-center'>$row[pesanan_id]</td>
				<td>$arrayStatusPesanan[$status]</td>
				<td>$row[nama]</td>
				<td class='text-center'>
					<a href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=detail&pesanan_id=$row[pesanan_id]'  class='btn btn-success btn-xs' >Detail Pesanan</a>
					$btn_admin
				</td>
			  </tr>";
	$no++;
	}
	echo "</table>";
	echo "</div>";
}
?>
</div>
</div>