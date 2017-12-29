<?php
	include("../../function/koneksi.php");   
    include("../../function/helper.php");
 ?>

 <!DOCTYPE html>
  <html>
  <head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title></title>
  	<link rel="stylesheet" href="<?php echo BASE_URL."asset/css/bootstrap.min.css"; ?>">
	<link rel="stylesheet" href="<?php echo BASE_URL."asset/css/style.css"; ?>">
  </head>
  <body>
  	<div class="container-fluid">
  	<h2 class="text-center">Laporan Penjualan</h2>
  	<hr />
  			<?php
				

				if(@$_GET['dari'] AND $_GET['sampai']){
					$dari = $_GET['dari'];
					$sampai = $_GET['sampai'];
					$queryLaporan = mysqli_query($koneksi, "SELECT laporan.*, barang.nama_barang, barang.harga, pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan FROM barang JOIN laporan ON barang.barang_id=laporan.barang_id JOIN pesanan ON pesanan.pesanan_id=laporan.pesanan_id WHERE pesanan.status='2' AND tanggal_pemesanan BETWEEN '$dari' AND '$sampai'");
				}
				else if(@$_GET['kategori']){
					$kt = $_GET['kategori'];
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
  </body>
  </html> 

 <script>
	window.load=print_d();
	function print_d(){
		window.print();
	}
</script>
