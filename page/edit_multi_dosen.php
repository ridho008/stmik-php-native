<?php
session_start();
require '../config/functions.php';
if(!isset($_SESSION['login'])) {
  header("Location: " . base_url('logis/login.php'));
}

if(isset($_POST['edit_multi_dosen'])) {
  if(multi_edit_dosen($_POST) > 0) {
    echo "<script>alert('Data Dosen Berhasil Diedit.');window.location='dosen.php';</script>";
  } else {
    echo "<script>alert('Data Dosen Gagal Diedit.');window.location='dosen.php';</script>";
  }
}

$checked = @$_POST['checked'];
if(!isset($checked)) {
  echo "<script>alert('Seleksi dulu data yang ingin dihapus!');window.location='dosen.php';</script>";
} else {




$jenis_kelamin = query("SELECT * FROM tb_dosen") or die(mysqli_error($conn));
?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Edit Multi Dosen</title>
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/admin.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>libs/DataTables/datatables.min.css">
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
<h5><i class="fas fa-chalkboard-teacher mr-1"></i> Tambah Dosen</h5><hr>

<a href="dosen.php" class="btn btn-success mb-1">Kembali</a>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="total" value="<?= @$_POST['count_add']; ?>">
    <table class="table">
      <tr>
        <th>#</th>
        <th>Foto</th>
        <th>Nama Dosen</th>
        <th>NIDN</th>
        <th>Keahlian</th>
        <th>Jenis Kelamin</th>
      </tr>
      <?php 
      $no = 1;
      foreach($checked as $id) { 
      $query = mysqli_query($conn, "SELECT * FROM tb_dosen WHERE id_dosen = '$id'") or die(mysqli_error($conn)); 
      while($data = mysqli_fetch_assoc($query)) { ?>
      <tr>
        <td><?= $no++ ?></td>
        <td>
          <input type="hidden" name="gambarLamaMulti" value="<?= $data['gambar']; ?>">
          <input type="hidden" name="id" value="<?= $data['id_dosen']; ?>">
          <img src="../gambar/dosen/<?= $data['gambar']; ?>" width="50">
          <input type="file" name="foto[]" class="form-control-file" value="<?= $data['gambar']; ?>">
        </td>
        <td>
          <input type="text" name="nama[]" class="form-control" required value="<?= $data['nama_dosen']; ?>">
        </td>
        <td>
          <input type="number" name="nidn[]" class="form-control" required value="<?= $data['nidn']; ?>">
        </td>
        <td>
          <input type="text" name="keahlian[]" class="form-control" required value="<?= $data['keahlian']; ?>">
        </td>
        <td>
          <input type="hidden" name="jk[]" value="L" <?php $data == "L" ? "Laki-Laki" : "Perempuan"; echo "checked"; ?>> L
          <input type="hidden" name="jk[]" value="P" <?php $data == "P" ? "Perempuan" : "Laki-Laki"; echo "checked"; ?>> P
        </td>
      </tr>
    <?php 
    }
  } ?>
    </table>
    <div class="form-group">
      <button type="submit" name="edit_multi_dosen" class="btn btn-primary">Tambah Data</button>
    </div>
  </form>


</div>
</div>

<!-- <script src="<?= base_url() ?>js/jquery.js"></script> -->
<!-- <script src="<?= base_url() ?>libs/DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script> -->
<script src="<?= base_url() ?>js/jquery-3.5.0.min.js"></script>




<script src="<?= base_url() ?>fontawesome/js/all.min.js"></script>
<script src="<?= base_url() ?>js/popper.min.js"></script>
<script src="<?= base_url() ?>js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>js/admin.js"></script>
<script type="text/javascript" src="<?= base_url() ?>libs/DataTables/datatables.min.js"></script>
<script src="<?= base_url() ?>js/script.js"></script>
</body>
</html>
<?php } ?>