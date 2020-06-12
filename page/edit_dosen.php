<?php 
require '../config/functions.php';

$id = $_GET['id'];
$edit_dosen = query("SELECT * FROM tb_dosen WHERE id_dosen = '$id'")[0];

if(isset($_POST['edit_dosen'])) {
  if(edit_dosen($_POST) > 0) {
  echo "<script>alert('Data Mahasiswa Berhasil Diedit.');window.location='dosen.php';</script>";
  } else {
    echo "<script>alert('Data Mahasiswa Gagal Diedit.')</script>";
  }
}

// $jurusan = mysqli_query($conn, "SELECT * FROM tb_mahasiswa");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Edit Dosen</title>
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/admin.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
<a class="navbar-brand text-white" href="<?= base_url(); ?>">Selamat Datang Admin | <b>STMIK AMIK RIAU</b></a>
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
    <a class="nav-link active text-white" href="<?= base_url(); ?>"><i class="fas fa-tachometer-alt mr-1"></i> Dashboard</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="<?= base_url('page/mahasiswa.php'); ?>"><i class="fas fa-user-graduate mr-1"></i> Daftar Mahasiswa</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="<?= base_url('page/dosen.php'); ?>"><i class="fas fa-chalkboard-teacher mr-1"></i> Daftar Dosen</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="pegawai.html"><i class="fas fa-user-edit mr-1"></i> Daftar Pegawai</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="jadwal.html"><i class="fas fa-calendar-alt mr-1"></i> Jadwal Kuliah</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="nilai.html"><i class="fas fa-paper-plane mr-1"></i> Nilai Mahasiswa</a><hr class="bg-secondary">
  </li>
</ul>
</div>

<div class="col-md-10 p-5">
<h5><i class="fas fa-chalkboard-teacher mr-1"></i> Edit Dosen</h5><hr>

<div class="col-md-7 offset-md-2">
	<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
    <label for="nama_dosen">Nama Dosen</label>
    <input type="hidden" name="id_dosen" value="<?= $edit_dosen['id_dosen']; ?>">
    <input type="hidden" name="gambarLamaDsn" value="<?= $edit_dosen['gambar']; ?>">
    <input type="text" class="form-control" name="nama_dosen" id="nama_dosen" value="<?= $edit_dosen['nama_dosen']; ?>">
  </div>
  <div class="form-group">
    <label for="nidn">nidn</label>
    <input type="number" class="form-control" name="nidn" id="nidn" value="<?= $edit_dosen['nidn']; ?>">
    <small id="emailHelp" class="form-text text-muted">Masukan NIDN Maksimal 9 Angka.</small>
  </div>
  <div class="form-group">
    <label for="keahlian">keahlian</label>
    <select name="keahlian" id="keahlian" class="form-control">
      <option value="Jaringan" <?php if($edit_dosen['keahlian'] == "Jaringan"){echo "selected";} ?>>Jaringan</option>
      <option value="Struktur Data" <?php if($edit_dosen['keahlian'] == "Struktur Data"){echo "selected";} ?>>Struktur Data</option>
      <option value="Pemrogramman Web" <?php if($edit_dosen['keahlian'] == "Pemrogramman Web"){echo "selected";} ?>>Pemrogramman Web</option>
      <option value="Algoritma Dasar" <?php if($edit_dosen['keahlian'] == "Algoritma Dasar"){echo "selected";} ?>>Algoritma Dasar</option>
    </select>
  </div>
  <div class="form-group">
    <label for="jk">Jenis Kelamin</label><br>
    <label class="radio-inline">
      <input type="radio" name="jk" value="L" <?php if($edit_dosen['jenis_kelamin'] == "L") {echo "checked";} ?>> Laki-Laki
    </label>
    <label class="radio-inline">
      <input type="radio" name="jk" value="P" <?= $edit_dosen['jenis_kelamin'] == "P" ? "checked" : null; ?>> Perempuan
    </label>
  </div>
  <div class="form-group">
    <img src="../gambar/dosen/<?= $edit_dosen['gambar']; ?>" width="80">
    <input type="file" class="form-control-file" id="gambar" name="gambar" value="<?= $edit_dosen['gambar']; ?>">
  </div>
  <div class="form-group">
  	<button type="submit" name="edit_dosen" class="btn btn-primary">Edit Data</button>
  </div>
</form>
</div>


</div>
</div>

<script src="<?= base_url() ?>fontawesome/js/all.min.js"></script>
<script src="<?= base_url() ?>js/jquery-3.5.0.min.js"></script>
<script src="<?= base_url() ?>js/popper.min.js"></script>
<script src="<?= base_url() ?>js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>js/admin.js"></script>
</body>
</html>