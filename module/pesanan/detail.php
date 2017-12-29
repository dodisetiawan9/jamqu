<?php

	$pesanan_id = $_GET["pesanan_id"];

	$query = mysqli_query($koneksi, "SELECT pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan, user.nama, kota.kota, kota.tarif FROM pesanan JOIN user ON pesanan.user_id=user.user_id JOIN kota ON kota.kota_id=pesanan.kota_id WHERE pesanan.pesanan_id='$pesanan_id'");

	$row = mysqli_fetch_assoc($query);

	$tanggal_pemesanan = $row['tanggal_pemesanan'];
	$nama_penerima = $row['nama_penerima'];
	$nomor_telepon = $row['nomor_telepon'];
	$alamat = $row['alamat'];
	$tarif = $row['tarif'];
	$nama = $row['nama'];
	$kota = $row['kota'];
?>
<div class="container-fluid">
	<h3><center>Detail Pesanan</h3>

	<hr/>
	<table class="table table-responsive">
		<tr>
			<td>No Faktur</td>
			<td>:</td>
			<td><?php echo $pesanan_id; ?></td>
		</tr>
		<tr>
			<td>Nama Pemesan</td>
			<td>:</td>
			<td><?php echo $nama; ?></td>
		</tr>
		<tr>
			<td>Nama Penerima</td>
			<td>:</td>
			<td><?php echo $nama_penerima; ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?php echo $alamat; ?></td>
		</tr>
		<tr>
			<td>No Telepon</td>
			<td>:</td>
			<td><?php echo $nomor_telepon; ?></td>
		</tr>
		<tr>
			<td>Tanggal Pemesanan</td>
			<td>:</td>
			<td><?php echo $tanggal_pemesanan; ?></td>
		</tr>

	</table>

<div class="table-responsive">
	<table class="table"> 
		<tr class="title-brg">
			<th>No</th>
			<th>Nama Barang</th>
			<th>Qty</th>
			<th>Harga Satuan</th>
			<th>Total</th>
		</tr>
		<?php 
			$querydetail = mysqli_query($koneksi, "SELECT pesanan_detail.*, barang.nama_barang FROM pesanan_detail JOIN barang ON pesanan_detail.barang_id=barang.barang_id WHERE pesanan_detail.pesanan_id='$pesanan_id'");
			$no = 1;
			$subtotal = 0;
			while($rowdetail = mysqli_fetch_assoc($querydetail)){
				$total = $rowdetail["harga"] *$rowdetail["quantity"];
				$subtotal = $total + $subtotal;
				echo "<tr>
						<td>$no</td>
						<td>$rowdetail[nama_barang]</td>
						<td>$rowdetail[quantity]</td>
						<td>".rupiah($rowdetail["harga"])."</td>
						<td>".rupiah($total)."</td>
					  </tr>";
			$no++;
			}
			$subtotal = $subtotal + $tarif;

		?>
		<tr>
			<td>Biaya Pengiriman</td>
			<td></td>
			<td></td>
			<td></td>
			<td colspan="4" class="kanan"><?php echo rupiah($tarif); ?></td>
		</tr>
		<tr class="title-subtotal">
			<td><b>Subtotal</b></td>
			<td></td>
			<td></td>
			<td></td>
			<td colspan="4" class="kanan"><b><?php echo rupiah($subtotal); ?><b></td>
		</tr>

	</table>
		</div>
	<div class="back-form tengah">
		<h5>Silahakan melakukan pembayaran pada salah satu bank berikut:</h5>
		<ul>
			<lI>BCA :xxxxxx</lI>
			<lI>BNI :xxxxxx</lI>
			<lI>MANDIRI :xxxxxx</lI>
		</ul>
		<h6>(A/N Dodi Setiawan)</h6>
		<h6>Jika sudah melakukan pembarayan silahkan melakukan konfirmasi pembayaran <a href="<?php echo BASE_URL."index.php?page=konfirmasi_pembayaran&pesanan_id=$pesanan_id";?>" class="btn-konfir">Di Sini</h6>
	</div>
</div>
