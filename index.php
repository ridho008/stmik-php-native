<?php
session_start();
require 'config/functions.php';
// require 'libs/vendor/autoload.php';
if(!isset($_SESSION["login"])) {
  header("Location: " . base_url('logis/login.php'));
  exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Dashboard Panel</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="fontawesome/css/all.min.css">
	<link rel="stylesheet" href="css/admin.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
<a class="navbar-brand text-white" href="#">Selamat Datang Admin | <b>STMIK AMIK RIAU</b></a>
	<form class="form-inline my-2 my-lg-0 ml-auto">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-secondary text-white my-2 my-sm-0" type="submit">Search</button>
    </form>
    <div class="icon ml-4 mt-1">
    	<h5>
    		<i class="fas fa-envelope mr-3" data-toggle="tooltip" title="Surat Masuk"></i>
    		<i class="fas fa-bell mr-3" data-toggle="tooltip" title="Notifikasi"></i>
    		<i class="fas fa-sign-out-alt mr-3" data-toggle="tooltip" title="Sign Out"></i>
    	</h5>
    </div>
  </div>
</nav>
<!-- /Navbar -->

<!-- no-gutters = berfungsi sebagai tidak ada jarak/margin antara col2 dan col10 menjadi menyatu -->
<div class="row no-gutters mt-5">
<div class="col-md-2 bg-dark mt-2 pr-3 pt-4">
<ul class="nav flex-column ml-3 mb-5">
  <li class="nav-item">
    <a class="nav-link active text-white" href="dashboard.html"><i class="fas fa-tachometer-alt mr-1"></i> Dashboard</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="<?= base_url() ?>page/mahasiswa.php"><i class="fas fa-user-graduate mr-1"></i> Daftar Mahasiswa</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="<?= base_url() ?>page/dosen.php"><i class="fas fa-chalkboard-teacher mr-1"></i> Daftar Dosen</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="<?= base_url(); ?>page/mahasiswa.php"><i class="fas fa-user-edit mr-1"></i> Daftar Pegawai</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="page/jadwal.html"><i class="fas fa-calendar-alt mr-1"></i> Jadwal Kuliah</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="page/nilai.html"><i class="fas fa-paper-plane mr-1"></i> Nilai Mahasiswa</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="<?= base_url(); ?>logis/logout.php"><i class="fas fa-paper-plane mr-1"></i> Logout</a><hr class="bg-secondary">
  </li>
</ul>
</div>
<div class="col-md-10 p-5">
<h5><i class="fas fa-tachometer-alt mr-1"></i> Dashboard</h5><hr>
<div class="row text-white justify-content-center">
<div class="card bg-info mt-3" style="width: 18rem;">
  <div class="card-body">
  	<div class="card-body-icon">
  		<i class="fas fa-user-graduate mr-1"></i>
  	</div>
    <h5 class="card-title">Jumlah Mahasiswa</h5>
    <div class="display-4 font-weight-bold">1.200</div>
    <a href=""><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
  </div>
</div>
<div class="card bg-success mr-3 ml-3 mt-3" style="width: 18rem;">
  <div class="card-body">
  	<div class="card-body-icon">
  		<i class="fas fa-chalkboard-teacher mr-1"></i>
  	</div>
    <h5 class="card-title">Jumlah Dosen</h5>
    <div class="display-4 font-weight-bold">58</div>
    <a href=""><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
  </div>
</div>
<div class="card bg-danger mt-3" style="width: 18rem;">
  <div class="card-body">
  	<div class="card-body-icon">
  		<i class="fas fa-user-edit mr-1"></i>
  	</div>
    <h5 class="card-title">Jumlah Pengawai</h5>
    <div class="display-4 font-weight-bold">21</div>
    <a href=""><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
  </div>
</div>
</div>

<div class="row mt-4 justify-content-center">
<div class="card text-white text-center mt-1" style="width: 18rem;">
  <div class="card-header bg-danger pt-4 pb-4 display-4">
    <i class="fab fa-instagram"></i>
  </div>
  <div class="card-body">
    <h5 class="card-title text-danger">Instagram</h5>
    <a href="#" class="btn btn-danger">Follow Me</a>
  </div>
</div>
<div class="card text-white text-center mr-3 ml-3 mt-1" style="width: 18rem;">
  <div class="card-header bg-info pt-4 pb-4 display-4">
    <i class="fab fa-facebook-f"></i>
  </div>
  <div class="card-body">
    <h5 class="card-title text-info">Facebook</h5>
    <a href="#" class="btn btn-info">Like Me</a>
  </div>
</div>
<div class="card text-white text-center mt-1" style="width: 18rem;">
  <div class="card-header bg-primary pt-4 pb-4 display-4">
    <i class="fab fa-twitter"></i>
  </div>
  <div class="card-body">
    <h5 class="card-title text-primary">Twitter</h5>
    <a href="#" class="btn btn-primary">Follow Me</a>
  </div>
</div>
</div>


</div>
</div>


<script src="fontawesome/js/all.min.js"></script>
<script src="js/jquery-3.5.0.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/admin.js"></script>
</body>
</html>