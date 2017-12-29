<?php
	if($user_id){
		header("location:".BASE_URL);
	}
?>

<form action="<?php echo BASE_URL."proses_login.php"; ?>" method="POST">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-6 col-md-offset-3 back-form">
				
				<?php	
						$notif=isset($_GET['notif']) ? $_GET['notif'] : false;
						$email=isset($_GET['email']) ? $_GET['email'] : false;
						
						if($notif == "true" ){
							echo "<div class='alert alert-danger'>Maaf, Email dan password yang anda masukan tidak cocok!</div>";
						}
						
				?>
				
				<div class="form-group">
					<label>Email</label>
						<input type="text" class="form-control" placeholder="Enter Email" name="email" value="<?php echo $email; ?>">
				</div>
				<div class="form-group">
					<label>Password</label>
						<input type="password" class="form-control" placeholder="Enter Password" name="password">
				</div>	
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Login">
				</div>
				
				<span>Belum punya account?<a href="<?php echo BASE_URL."register.html";?>"> Mendaftar</span>

			
			</div>			
		</div>	
	</div>		
</form>