<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<h3 class="text-center">Laporan Penjualan</h3>
			<hr />
<!-- 
			<h4 class="glyphicon glyphicon-filter">Filter</h4> -->
				<div class="dropdown">
					<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-filter"></span> Filter
					<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a href="#" data-toggle="modal" data-target="#tgl">Tanggal Penjualan</a></li>
						<li><a href="#" data-toggle="modal" data-target="#kategori">Kategori Produk</a></li>
						<!-- <li><a href="#" data-toggle="modal" data-target="#merk">Merk</a></li> -->
						</ul>
					<?php
						if(@$_POST['lihat']){
							$dr = $_POST['dari'];
							$sp = $_POST['sampai'];

							$url = "module/laporan/cetak_laporan.php?dari=$dr&sampai=$sp";
							$uri = "module/laporan/save.php?dari=$dr&sampai=$sp";
						}
						else if(@$_POST['ktgr']){
							$kt = $_POST['kt'];

							$url = "module/laporan/cetak_laporan.php?kategori=$kt";
							$uri = "module/laporan/save.php?kategori=$kt";
						}

						
					?>
					<a href="<?php echo BASE_URL."$url"; ?>" target="_blank" class="btn btn-default pull-right"><span class="glyphicon glyphicon-print"></span> Cetak</a>
					<a href="<?php echo BASE_URL."$uri"; ?>" target="_blank" class="btn btn-default pull-right"><span class="glyphicon glyphicon-download"></span> Save</a>
				</div>
				<!-- end filter -->

				<!-- start modal tanggal -->
				<div class="modal fade" id="tgl" role="dialog">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Filter / Tanggal</h4>
							</div>
							<div class="modal-body">
								<form method="POST" >
									<div class="form-group">
										<label>Dari</label>
										<input type="date" name="dari" class="form-control">
									</div>
									<div class="form-group">
										<label>Sampai</label>
										<input type="date" name="sampai" class="form-control">
									</div>
									<div class="form-group">
										<input type="submit" name="lihat" class="btn btn-primary btn-sm" value="Lihat">
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<!-- end modal -->

				<!-- start modal kategori -->
				<div class="modal fade" id="kategori" role="dialog">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Filter / Kategori</h4>
							</div>
							<div class="modal-body">
								<form action="" method="POST">
									<div class="form-group">
									<select name="kt" class="form-control">
										<?php
											$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE status='on'");
											while($rowKategori = mysqli_fetch_assoc($queryKategori)){

											echo "<option value='$rowKategori[kategori_id]'>$rowKategori[kategori]</option>";
										}
										?>
										<!-- <option value="on">Aktif</option>
										<option value="off">Keluar</option> -->
									</select>
									</div>
									<div class="form-group">
										<input type="submit" name="ktgr" class="btn btn-primary btn-sm" value="Lihat">
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<!-- end modal status -->
			<!-- <form action="" method="POST">
				
					<label>Dari <input type="date" name="dari" class="form-control" required></label>
					<label>Sampai <input type="date" name="sampai" class="form-control" required></label>
					<input type="submit" name="lihat" value="Lihat" class="btn btn-primary btn-sm">
			</form> -->

			<!-- filter -->
				<!-- <div class="dropdown">
					<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-filter"></span> Filter
					<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#" data-toggle="modal" data-target="#tgl">Tanggal Penjualan</a></li>
							<li><a href="#" data-toggle="modal" data-target="#kategori">Kategori Produk</a></li>
						</ul>
				</div> -->
				<br />
			<!-- end filter -->


			<?php
				if(!$_POST){
					$queryLaporan = mysqli_query($koneksi, "SELECT laporan.*, barang.nama_barang, barang.harga, pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan FROM barang JOIN laporan ON barang.barang_id=laporan.barang_id JOIN pesanan ON pesanan.pesanan_id=laporan.pesanan_id WHERE pesanan.status='2'");
				}

				else if(@$_POST['lihat']){
					$dari = $_POST['dari'];
					$sampai = $_POST['sampai'];
					$queryLaporan = mysqli_query($koneksi, "SELECT laporan.*, barang.nama_barang, barang.harga, pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan FROM barang JOIN laporan ON barang.barang_id=laporan.barang_id JOIN pesanan ON pesanan.pesanan_id=laporan.pesanan_id WHERE pesanan.status='2' AND tanggal_pemesanan BETWEEN '$dari' AND '$sampai'");
				}
				else if(@$_POST['ktgr']){
					$kt = $_POST['kt'];
				$queryLaporan = mysqli_query($koneksi, "SELECT laporan.*, barang.nama_barang, barang.harga, pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan FROM barang JOIN laporan ON barang.barang_id=laporan.barang_id JOIN pesanan ON pesanan.pesanan_id=laporan.pesanan_id WHERE pesanan.status='2' AND kategori_id='$kt'");
				}

				if(mysqli_num_rows($queryLaporan) == 0){
					echo "<div class='alert alert-warning'>Belum ada Laporan Penjualan</div>";
				}
				else{
						echo "<div class='table-responsive'>
								<table class='table table-striped table-bordered table-hover'>
									<tr>
										<th class='text-center'>No</th>
										<th class='text-center'>Nama Pembeli</th>
										<th class='text-center'>Alamat</th>
										<th class='text-center'>Telepon</th>
										<th class='text-center'>Nama Barang</th>
										<th class='text-center'>Harga</th>
										<th class='text-center'>Qty</th>
										<th class='text-center'>Total</th>
										<th class='text-center'>Tgl Penjualan</th>
									</tr>";
					$no =1;
					while($row = mysqli_fetch_assoc($queryLaporan)){
					$total = $row['harga'] * $row['qty'];
						echo "<tr>
									<td class='text-center'>$no</td>
									<td class='text-center'>$row[nama_penerima]</td>
									<td class='text-center'>$row[alamat]</td>
									<td class='text-center'>$row[nomor_telepon]</td>
									<td class='text-center'>$row[nama_barang]</td>
									<td class='text-center'>".rupiah($row['harga'])."</td>
									<td class='text-center'>$row[qty]</td>
									<td class='text-center'>".rupiah($total)."</td>
									<td class='text-center'>$row[tanggal_pemesanan]</td>
							  </tr>";
					$no++;

					}
					echo "</table>";
					echo "</div>";
							
				}
			
			?>
		</div>
	</div>
</body>
</html>