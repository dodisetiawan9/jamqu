<?php
	$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : "";

	$button="Update";

	$query = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$user_id'");
	$row = mysqli_fetch_assoc($query);

	$nama=$row["nama"];
	$email=$row["email"];
	$alamat=$row["alamat"];
	$phone=$row["phone"];
	$level=$row["level"];
	$status=$row["status"];
?>
<form action="<?php echo BASE_URL."module/user/action.php?user_id=$user_id";?>" method="POST">
<div class="container-fluid back-form">
	<div class="form-group">
		<label>Nama</label>
			<input type="text" name="nama" class="form-control" value="<?php echo $nama;?>">
	</div>
	<div class="form-group">
		<label>Email</label>
			<input type="text" name="email" class="form-control" value="<?php echo $email;?>">
	</div>
	<div class="form-group">
		<label>Alamat</label>
			<textarea class="form-control"><?php echo $alamat;?></textarea>
	</div>
	<div class="form-group">
		<label>Telepon</label>
			<input type="text" name="phone" class="form-control" value="<?php echo $phone;?>">
	</div>
	<div class="form-group">
		<label>Level</label></br>
			<input type="radio" name="level" value="superadmin" <?php if($level == "superadmin"){echo "checked='true'";} ?>>Superadmin
			<input type="radio" name="level" value="customer" <?php if($level == "customer"){echo "checked='true'";} ?>>Customer
	</div>
	<div class="form-group">
		<label>Status</label></br>
			<input type="radio" name="status" value="on" <?php if($status == "on"){echo "checked='true'";} ?>>On
			<input type="radio" name="status" value="off" <?php if($status == "off"){echo "checked='true'";} ?>>Off
	</div>
	<div class="form-group">
		<input type="submit" name="button" class="btn btn-primary" value="<?php echo $button;?>">
	</div>

</div>
</form>