<?php
	if($user_id){
		$module=isset($_GET['module']) ? $_GET['module'] :false;
		$action=isset($_GET['action']) ? $_GET['action'] :false;
		$mode=isset($_GET['mode']) ? $_GET['mode'] :false;
	}
	else{
		header("location:".BASE_URL."index.php?page=login");
	}
	if($level !="superadmin"){
		$admin_pages = array("kategori", "barang", "kota", "user", "banner");
		if(in_array($module, $admin_pages)){
			header("location:".BASE_URL);
		}
	}
?>


<div class="row content">
	<div class="col-md-2 nav-kiri content">
		<ul class="nav nav-pills nav-stacked back-nav">
			<?php
				if($level == "superadmin"){

			?>
				<li <?php if($module=="kategori"){echo "class='active'"; } ?>>
					<a  href="<?php echo BASE_URL."index.php?page=my_profile&module=kategori&action=list" ?>">Kategori</a>
				</li>
				<li <?php if($module=="barang"){echo "class='active'";} ?>><a href="<?php echo BASE_URL."index.php?page=my_profile&module=barang&action=list" ?>">Barang</a></li>
				<li  <?php if($module=="kota"){echo "class='active'";} ?>>
					<a href="<?php echo BASE_URL."index.php?page=my_profile&module=kota&action=list" ?>">Kota</a>
				</li>
				<li  <?php if($module=="user"){echo "class='active'";} ?>>
					<a href="<?php echo BASE_URL."index.php?page=my_profile&module=user&action=list" ?>">User</a>
				</li>
				<li <?php if($module=="banner"){echo "class='active'";} ?>>
					<a href="<?php echo BASE_URL."index.php?page=my_profile&module=banner&action=list" ?>">Banner</a>
				</li>
				
			<?php
				}
			?>
			
			<li <?php if($module=="pesanan"){echo "class='active'";} ?>>
				<a href="<?php echo BASE_URL."index.php?page=my_profile&module=pesanan&action=list" ?>">Pesanan</a>
			</li>
			<li <?php if($module=="laporan"){echo "class='active'";} ?>>
					<a href="<?php echo BASE_URL."index.php?page=my_profile&module=laporan&action=list" ?>">Laporan</a>
				</li>
    		
		</ul>
	</div>

	<div class="col-md-10">
		<?php 
			$file="module/$module/$action.php";
			if(file_exists($file)){
				include_once($file);
			}
			else{
				echo "Maaf, Halaman tersebut tidak di temukan";
			}

		?>
	</div>
</div>