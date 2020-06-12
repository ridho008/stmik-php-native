<?php 
require '../config/functions.php';

$id = $_GET['id'];
$edit_mahasiswa = query("SELECT * FROM tb_mahasiswa WHERE id_mhs = '$id'")[0];

if(isset($_POST['edit'])) {
  if(edit_mhs($_POST) > 0) {
  echo "<script>alert('Data Mahasiswa Berhasil Diedit.');window.location='mahasiswa.php';</script>";
  } else {
    echo "<script>alert('Data Mahasiswa Gagal Diedit.')</script>";
  }
}

$jurusan = mysqli_query($conn, "SELECT * FROM tb_jurusan");
// $dosen = query($conn, "SELECT * FROM tb_dosen WHERE id_dosen");
$dosen = query("SELECT * FROM tb_mahasiswa INNER JOIN tb_dosen ON tb_mahasiswa.id_dosen = tb_dosen.id_dosen");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Edit Mahasiswa</title>
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/admin.css">
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
    <a class="nav-link active text-white" href="../dashboard.html"><i class="fas fa-tachometer-alt mr-1"></i> Dashboard</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="mahasiswa.html"><i class="fas fa-user-graduate mr-1"></i> Daftar Mahasiswa</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="dosen.html"><i class="fas fa-chalkboard-teacher mr-1"></i> Daftar Dosen</a><hr class="bg-secondary">
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
<h5><i class="fas fa-user-graduate mr-1"></i></i> Edit Mahasiswa</h5><hr>

<div class="col-md-7 offset-md-2">
	<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
    <label for="nama_mhs">Nama Mahasiswa</label>
    <input type="hidden" name="id" value="<?= $edit_mahasiswa['id_mhs']; ?>">
    <input type="hidden" name="gambarLamaMhs" value="<?= $edit_mahasiswa['gambar_mhs']; ?>">
    <input type="text" class="form-control" name="nama_mhs" id="nama_mhs" placeholder="Masukan Nama Anda" value="<?= $edit_mahasiswa['nama_mhs']; ?>">
  </div>
  <div class="form-group">
    <label for="nrp">NRP</label>
    <input type="number" class="form-control" name="nrp" id="nrp" placeholder="Masukan Nama Anda" value="<?= $edit_mahasiswa['nrp']; ?>">
    <small id="emailHelp" class="form-text text-muted">Masukan NRP Maksimal 9 Angka.</small>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email Anda" value="<?= $edit_mahasiswa['email']; ?>">
  </div>
  <!-- <div class="form-group">
    <label for="id_dosen">Dosen</label>
    <?php foreach($dosen as $dsn) : ?>
    <?php if($edit_mahasiswa['id_dosen'] == $dsn['id_dosen']) : ?>
      <input type="text" name="id_dosen" id="id_dosen" value="<?= $dsn['nama_dosen']; ?>" readonly class="form-control">
    <?php endif; ?>
  <?php endforeach; ?> -->
    <!-- <select name="id_dosen" id="id_dosen" class="form-control">
    <?php foreach($dosen as $dsn) : ?>
      <option value="<?= $dsn['id_dosen']; ?>" <?php if($edit_mahasiswa['id_dosen'] == $dsn['id_dosen']){echo "selected";} ?> readonly><?= $dsn['nama_dosen']; ?></option>
    <?php endforeach; ?>
    </select> -->
  <!-- </div> -->
  <div class="form-group">
    <label for="jurusan">Jurusan</label>
    <select class="form-control" id="jurusan" name="jurusan">
      <?php foreach($jurusan as $j) : ?>
        <option value="<?= $j["id_jurusan"]; ?>" <?php if($edit_mahasiswa['id_jurusan'] == $j['id_jurusan']){echo "selected";} ?>><?= $j['jurusan']; ?></option>
      <?php endforeach; ?>
      <!-- <?php foreach($edit_mahasiswa as $emhs) : ?>
          <option value="<?= $emhs['jurusan']; ?>" <?php if($emhs['jurusan'] == $emhs['id_mhs']){ echo 'selected'; } ?>><?= $emhs['jurusan']; ?></option>
      <?php endforeach; ?> -->
      <!-- <option value="Teknik Informatika" <?php if($edit_mahasiswa['jurusan'] == 'Teknik Informatika'){ echo 'selected'; } ?>>Teknik Informatika</option>
      <option value="Teknik Pemasaran" <?php if($edit_mahasiswa['jurusan'] == 'Teknik Pemasaran'){ echo 'selected'; } ?>>Teknik Pemasaran</option>
      <option value="Teknik Transaksi" <?php if($edit_mahasiswa['jurusan'] == 'Teknik Transaksi'){ echo 'selected'; } ?>>Teknik Transaksi</option>
      <option value="Teknik Sipil" <?php if($edit_mahasiswa['jurusan'] == 'Teknik Sipil'){ echo 'selected'; } ?>>Teknik Sipil</option> -->
    </select>
  </div>
  <div class="form-group">
    <img src="../gambar/mahasiswa/<?= $edit_mahasiswa['gambar_mhs']; ?>" width="80">
    <input type="file" class="form-control-file" id="gambar" name="gambar" value="<?= $edit_mahasiswa['gambar_mhs']; ?>">
  </div>
  <div class="form-group">
  	<button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
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