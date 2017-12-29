<?php
	ob_start();
	include_once("../../function/koneksi.php");
	include_once("../../function/helper.php");

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
</head>
<body>
	
	<img src="../../images/logo.png"><br />
	<h3 align="center">Laporan Penjualan</h3>
	<br />
	<hr />
	<br />
	<table border="1px" align="center">
		<tr bgcolor="#ccc">
			<th width="30"  height="30" align="center"><b>No</b></th>
			<th width="150"  height="30" align="center"><b>Nama Pembeli</b></th>
			<th width="250"  height="30" align="center"><b>Alamat</b></th>
			<th width="70"  height="30" align="center"><b>Telepon</b></th>
			<th width="250" height="30" align="center"><b>Nama Barang</b></th>
			<th width="100" height="30" align="center">Harga</th>
			<th width="50" height="30" align="center">Qty</th>
			<!-- <th width="100" height="30" align="center">Total</th> -->
			<th width="100" height="30" align="center">Tgl Penjualan</th>
		</tr>

		<?php 
							$no =1;
							if(@$_GET['dari'] AND $_GET['sampai']){
								$dari = $_GET['dari'];
								$sampai = $_GET['sampai'];

								$queryLaporan = mysqli_query($koneksi, "SELECT laporan.*, barang.nama_barang, barang.harga, pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan FROM barang JOIN laporan ON barang.barang_id=laporan.barang_id JOIN pesanan ON pesanan.pesanan_id=laporan.pesanan_id WHERE pesanan.status='2' AND tanggal_pemesanan BETWEEN '$dari' AND '$sampai'");

								if(mysqli_num_rows($queryLaporan) == 0){
									header("location: ".BASE_URL."index.php?page=my_profile&module=laporan&action=list&notif=null");
								}

								else{
								$totalQty = 0;
								$total_penjualan = 0;
								while($row = mysqli_fetch_assoc($queryLaporan)){
									$barang = $row['nama_barang'];
									$harga = $row['harga'];
									$qty = $row['qty'];
									$nama = $row['nama_penerima'];
									$alamat = $row['alamat'];
									$no_tlp = $row['nomor_telepon'];
									$tgl = $row['tanggal_pemesanan'];

									$total = $harga * $qty;

									$totalQty = $totalQty + $qty;
									$total_penjualan = $total_penjualan + $total;

									echo "<tr>
											<td class='text-center'>$no</td>
											<td>$nama</td>
											<td>$alamat</td>
											<td>$no_tlp</td>
											<td>$barang</td>
											<td>".rupiah($harga)."</td>
											<td class='text-center'>$qty</td>
											
											<td>$tgl</td>

										  </tr>";
									$no++;
									}


								}

							}
							else if(isset($_GET['kategori'])){
								$kt = $_GET['kategori'];
								$totalQty = 0;
								$total_penjualan = 0;
								$queryLaporan = mysqli_query($koneksi, "SELECT laporan.*, barang.nama_barang, barang.harga, pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan FROM barang JOIN laporan ON barang.barang_id=laporan.barang_id JOIN pesanan ON pesanan.pesanan_id=laporan.pesanan_id WHERE pesanan.status='2' AND kategori_id='$kt'");

								while($row = mysqli_fetch_assoc($queryLaporan)){
									$barang = $row['nama_barang'];
									$harga = $row['harga'];
									$qty = $row['qty'];
									$nama = $row['nama_penerima'];
									$alamat = $row['alamat'];
									$no_tlp = $row['nomor_telepon'];
									$tgl = $row['tanggal_pemesanan'];

									$total = $harga * $qty;
								
									$totalQty = $totalQty + $qty;
									$total_penjualan = $total_penjualan + $total;
							?>
		
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $nama; ?></td>
			<td><?php echo $alamat; ?></td>
			<td><?php echo $no_tlp; ?></td>
			<td><?php echo $barang; ?></td>
			<td><?php echo rupiah($harga); ?></td>
			<td><?php echo $qty; ?></td>
			
			<td height="20"><?php echo $tgl; ?></td>
		</tr>
		<?php $no++; ?>
			<?php } ?>
			<?php } ?>

		
	</table>
	<br />
	<br />
	<table>
		<tr>
			<td height="30"><b>Total Barang yang terjual</b></td>
			<td height="30"> : </td>
			<td height="30"><b><?php echo $totalQty; ?></b></td>
		</tr>
		<tr>
			<td height="30"><b>Total Penjualan</b></td>
			<td height="30"> : </td>
			<td height="30"><b><?php echo rupiah($total_penjualan); ?></b></td>
		</tr>
		
	</table>
</body>
</html>

<?php
	$content=ob_get_clean();
	require_once("../../html2pdf/html2pdf.class.php");
	$pdf=new HTML2PDF('L', 'f4', 'en');
	$pdf->writeHTML($content);
	$pdf->pdf->includeJS('print(TRUE)');
	$pdf->output('laporan_penjualan.pdf');
	
	
?>