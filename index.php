<?php
	ob_start();
	session_start();
	include_once("function/koneksi.php");
	include_once("function/helper.php");
	
	$page = isset($_GET['page']) ? $_GET['page'] : false;
	$notif = isset($_GET['notif']) ? $_GET['notif'] : false;
	$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;
	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
	$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
	$level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
	$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();
	$totalbarang = count($keranjang);
	$pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
	$module=isset($_GET['module']) ? $_GET['module'] :false;

?>
<!DOCTYPE html>
<html>
<head>
<title>JamQU Pusat Jam Tangan Murah</title>
    
	<link href="<?php echo BASE_URL."asset/css/bootstrap.css"; ?>" rel="stylesheet">
	<link href="<?php echo BASE_URL."asset/css/style2.css"; ?>" rel="stylesheet">
	<link href="<?php echo BASE_URL."asset/css/style.css"; ?>" rel="stylesheet">
	<link href="<?php echo BASE_URL."asset/css/banner.css"; ?>" rel="stylesheet">
    <script src="<?php echo BASE_URL."asset/js/jquery.min.js"; ?>"></script>
    <script src="<?php echo BASE_URL."asset/js/bootstrap.min.js"; ?>"></script>
    <script src="<?php echo BASE_URL."js/jquery-3.1.1.min.js"; ?>"></script>
    <script src="<?php echo BASE_URL."js/Slides-SlidesJS-3/source/jquery.slides.min.js"; ?>"></script>
	<script>
			$(function() {
				$('#slides').slidesjs({
					height: 350,
					play: { auto : true,
							interval : 3000
						  },
					navigation: false
				});
			});
	</script>

</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
	<nav class="navbar navbar-default navbar-fixed-top navbar-color">
		<?php 
			if(!$module){
		?>
		<div class="info-toko hidden-sm hidden-xs">
					<marquee><p>Toko buka jam 08:00-20:00 , Diluar Jam Berikut Slow Response</p> </marquee>
		</div>
		<?php } ?>
		<div class="container-fluid back-color">

			<div class="navbar-header">
			
				<button type="button" class="navbar-toggle btn-toggle pull-left" data-toggle="collapse" data-target="#list">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

					<span class="navbar-toggle nav-cart"><a href="<?php echo BASE_URL."keranjang.html"; ?>"><img src="<?php echo BASE_URL."images/cart2.png"; ?>" class="img-cart">
						<?php
							if($totalbarang != 0){
								echo "<span class='cart-mbl badge'>$totalbarang</span>";
							}
						?>

					</a>
					</span>
				
			
				<a href="<?php echo BASE_URL."index.php"; ?>"><span><img src="<?php echo BASE_URL."images/logo.png"; ?>" class="logo"></span></a>
			</div>
			
			
			<div class="collapse navbar-collapse l-bar" id="list">
				
				<ul class="nav navbar-nav navbar-right pad">
					
					<li><form action="<?php echo BASE_URL."index.php?page=cari"; ?>" method="POST" class="navbar-form">
						<div class="form-group">
							<input type="text" name="cari" class="form-control search-style" placeholder="Cari....." required="">
							<button type="submit" name="submit" class="btn btn-primary glyphicon glyphicon-search search-back"></button>

						</div>

					</form></li>
					<?php
						if(!$module){
					?>
					<li class="hidden-sm hidden-xs"><a href="<?php echo BASE_URL."keranjang.html"; ?>"><img src="<?php echo BASE_URL."images/cart2.png"; ?>" class="cart-img img-cart">
						<?php
							if($totalbarang != 0){
								echo "<span class='keranjang-usr badge'>$totalbarang</span>";
							}
						?>

					</a>
					</li>
					<?php } ?>
					
					<?php
						if($user_id){
							echo  "<li><span class='navbar-text'>Hi, $nama</span></li>";
							echo  "<li><a href='".BASE_URL."logout.php'>Logout</a></li>";
						}
						else{
							echo "<li><a href='".BASE_URL."register.html'>Signup</a></li>";
							echo "<li><a href='".BASE_URL."login.html'>Login</a></li>";
						}
						if($level == "superadmin"){
								echo "<li><a href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=list' class='glyphicon glyphicon-cog'></a></li>";
							}
					?>
				</ul>
			</div>
		</div>	
	
	</nav> 
	<div class="row content bar-menu">
		<div class="nav-menu">
			<ul class="bar">
				<li class="list-bar left"><a href="<?php echo BASE_URL."index.php"; ?>" class="style-text">Home</a></li>
				<div class="dropdown drd-menu">
					<button class="btn btn-default dropdown-toggle btn-border style-text" type="button" data-toggle="dropdown">Kategori <span class="caret"></span>
					</button>
						
							<ul class="dropdown-menu">
														<?php
								$query=mysqli_query($koneksi, "SELECT * FROM kategori WHERE status='on'");

								while($row=mysqli_fetch_assoc($query)){
								$kategori = strtolower($row['kategori']);

									if($kategori_id == $row['kategori_id']){
										echo "<li class='list-kategori active'><a href='".BASE_URL."$row[kategori_id]/$kategori.html'>$row[kategori]</a></li>";
										
									}
									else{

										echo "<li class='list-kategori'><a href='".BASE_URL."$row[kategori_id]/$kategori.html'>$row[kategori]</a></li>";
									}

								}
							?>
							
					</ul>
						
					
				</div>
				<?php
						if($level == "customer"){
							echo "<li class='list-bar right pull-right'><a href='".BASE_URL."index.php?page=pesanan&id=$user_id' class='style-text'>Pesanan Anda</a></li>";
							
						}
					?>
				<!-- <li class="list-bar right pull-right">SignUp</li>
				<li class="list-bar right pull-right">Login</li> -->
			</ul>


		</div>
		</div>
		<?php
			if($notif == "addcart"){
				echo "<div class='alert alert-info alert-dismissable alert-cart'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a> Barang Berhasil ditambahkan kedalam keranjang <a href='".BASE_URL."keranjang.html' class='alert-link'><strong> Lihat Keranjang</strong></a>
					  </div>";
			}
		?>

	
		<div class="container-fluid  width-min">
			<!-- <div class="margin-top-body"> -->
				<div class="content">
				<?php
					$filename="$page.php";
				
					if(file_exists($filename)){
						include_once($filename);
					}
					else{
						include_once("main.php");
						
					}
				?>
				
				</div>

			<!-- </div> -->
		</div>
		<?php
			if(!$module){
		?>
		<div class="container-fluid footer-style">
			
			<div class="row footer-info text-color-footer">
				<div class="col-md-4 page-info">
					<h3> Fast Response</h3>
					
					<P><img src="<?php echo BASE_URL."images/kontak/bbm.png"; ?>" class="img-sosial"><i class="scl">DCF756E8</i></p>
					<P><img src="<?php echo BASE_URL."images/kontak/wa.png"; ?>" class="img-sosial"><i class="scl">085315543409</i></p>
					<P><img src="<?php echo BASE_URL."images/kontak/line.png"; ?>" class="img-sosial"><i class="scl">@jamqucom</i></p>
				</div>
				<div class="footer-info col-md-4">
					<h3> Alamat Kami</h3>
					<p><span class="glyphicon glyphicon-home"></span> Jl. Raya Banjaran no.177</br>
					Banjaran Bandung</p>
				</div>
				<div class="footer-info col-md-4">
					<h3>Temukan Kami</h3>
					
					<p><a href="https://web.facebook.com/jamqucom"><img src="<?php echo BASE_URL."images/kontak/fb.png"; ?>" class="img-sosial"><span><a href=""><img src="<?php echo BASE_URL."images/kontak/ig.png"; ?>" style="width: 60px;"></span></p>
					<p></p>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="container-fluid label-footer">
				<p>Copyright JamQu @2017</p>
		</div>
	</div>
		
</div>	

		
		
</body>
</html>

