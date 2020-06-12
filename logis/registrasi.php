<?php
require '../config/functions.php';

if(isset($_POST['daftar'])) {
	if(register($_POST) > 0) {
		echo "<script>alert('Akun Berhasil Dibuat, Silahkan Login!');window.location='login.php';</script>";
	} else {
		echo mysqli_error($conn);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Halaman Registrasi</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../fontawesome/css/all.min.css">
	<link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="container">
	<div class="row mt-5">
		<div class="col-md-6 offset-md-3">
			<h1>Halaman Registrasi</h1>
			<form action="" method="post">
			  <div class="form-group">
			    <label for="username">Username</label>
			    <input type="text" class="form-control" name="username" id="username"placeholder="Masukan username" required>
			    <small id="emailHelp" class="form-text text-muted">Maksiman Username 12 Karakter.</small>
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password" required>
			  </div>
			  <div class="form-group">
			    <label for="password2">Confirm Password</label>
			    <input type="password" class="form-control" name="password2" id="password2" placeholder="Masukan Konfirm Password" required>
			  </div>
			  <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
			</form>
		</div>
	</div>
</div>


<script src="../fontawesome/js/all.min.js"></script>
<script src="../js/jquery-3.5.0.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/admin.js"></script>
</body>
</html>