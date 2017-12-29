<?php
	if($user_id){
		header("location:".BASE_URL);
	}
?>


<form action="<?php echo BASE_URL."proses_register.php"; ?>" method="POST">
	<div class="container">
		<div class="row">
			
			<div class="col-md-6 col-md-offset-3 back-form">
				
				<?php
						$notif=isset($_GET['notif']) ? $_GET['notif'] : false;
						$nama_lengkap=isset($_GET['nama_lengkap']) ? $_GET['nama_lengkap'] : false;
						$email=isset($_GET['email']) ? $_GET['email'] : false;
						$alamat=isset($_GET['alamat']) ? $_GET['alamat'] : false;
						$phone=isset($_GET['phone']) ? $_GET['phone'] : false;
						
						if($notif == "require" ){
							echo "<div class='alert alert-danger'>Maaf, Anda harus melengkapi form di bawah ini!</div>";
						}
						elseif($notif == "password"){
							echo "<div class='alert alert-danger'>Maaf, Password yang anda masukan tidak sama!</div>";
							
						}
						elseif($notif == "email"){
							echo "<div class='alert alert-danger'>Maaf, Email yang anda masukan sudah terdaftar!</div>";
							
						}
				?>
				
				<div class="form-group">
					<label>Nama Lengkap</label>
						<input type="text" class="form-control" placeholder="Enter Name" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>">
				</div>
				<div class="form-group">
					<label>Email</label>
						<input type="text" class="form-control" placeholder="Enter Email" name="email" value="<?php echo $email; ?>">
				</div>
				<div class="form-group">
					<label>Alamat</label>
						<textarea class="form-control" placeholder="Enter Address" name="alamat"><?php echo $alamat ?></textarea>
				</div>
				<div class="form-group">
					<label>No Telepon</label>
						<input type="text" class="form-control" placeholder="You Phone" name="phone" value="<?php echo $phone; ?>">
				</div>
				<div class="form-group">
					<label>Password</label>
						<input type="password" class="form-control" placeholder="Enter Password" name="password">
				</div>	
				<div class="form-group">
					<label>Re Password</label>
						<input type="password" class="form-control" placeholder="Re-type Password" name="re_password">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="register">
				</div>
			</div>			
	</div>			
</form>