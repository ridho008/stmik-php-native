<?php
session_start();
require '../config/functions.php';

// jalankan cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username di database db_user
	$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if($username == hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}

// cek session apakah ada dihalama ini ?
if(isset($_SESSION['login'])) {
	header("Location: " . base_url());
}

if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	// cek apakah username ada di database
	$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

	// jika nilai 1 ada usernamenya, kecil dari itu 0 null
	if(mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
		// cek password sama dengan di DB
		if(password_verify($password, $row['password'])) {
			// set session
			$_SESSION['login'] = true;

			// set cookie
			if(isset($_POST['remember'])) {
				setcookie('id', $row['id_user'], time() + 60);
				setcookie('key', hash('sha256', $row['username']), time() + 60);
			}

			// pindahkan kehalaman index.php
			header("Location: " . base_url());
			exit;
		}
	}
	$error = true;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Halaman Login</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../fontawesome/css/all.min.css">
	<link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="container">
	<div class="row mt-5">
		<div class="col-md-6 offset-md-3 mt-5">
			<h1>Halaman Login</h1>
			<form action="" method="post">
				<?php if(isset($error)) : ?>
					<div class="alert alert-danger" role="alert">
			 		 	Username/Password salah!.
					</div>
				<?php endif; ?>
			  <div class="form-group">
			    <label for="username">Username</label>
			    <input type="text" class="form-control" name="username" id="username"placeholder="Masukan username" required>
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password" required>
			  </div>
			  <div class="form-check mt-1">
				  <input class="form-check-input" type="checkbox" value="" id="remember" name="remember">
				  <label class="form-check-label" for="remember">
				    Remember Me
				  </label>
				</div>
			  <button type="submit" name="login" class="btn btn-primary">Login</button>
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