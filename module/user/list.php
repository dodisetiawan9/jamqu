<div class="row content">
<?php
	$no=1;

	$query = mysqli_query($koneksi, "SELECT * FROM user ORDER BY nama ASC");

	if(mysqli_num_rows($query) == 0){
		echo "<h3>Maaf belum ada user di database</h3>";
	}
	else{
		echo "<table class='table table-striped'>";
		echo "<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Alamat</th>
				<th>No Telepon</th>
				<th>Level</th>
				<th>Status</th>
				<th>Action</th>
			  </tr>";

		while($row = mysqli_fetch_assoc($query)){
			echo "<tr>
					<td>$no</td>
					<td>$row[nama]</td>
					<td>$row[email]</td>
					<td>$row[alamat]</td>
					<td>$row[phone]</td>
					<td>$row[level]</td>
					<td>$row[status]</td>
					<td>
						<a href='".BASE_URL."index.php?page=my_profile&module=user&action=form&user_id=$row[user_id]' class='btn btn-warning btn-xs glyphicon glyphicon-pencil'></a>
					</td>
				  </tr>";
			$no++;
		}



		echo "</table>";
	}
?>
</div>