<?php
session_start();
require '../config/functions.php';
if(!isset($_SESSION["login"])) {
  header("Location: " . base_url('logis/login.php'));
  exit;
}
if(isset($_POST['tambah'])) {
  if(tambah_mhs($_POST) > 0) {
  echo "<script>alert('Data Mahasiswa Berhasil Ditambahkan.')</script>";
  } else {
    echo "<script>alert('Data Mahasiswa Gagal Ditambahkan.')</script>";
  }
}

include_once "../report/modalexportpdf.php";
$mahasiswa = query("SELECT * FROM tb_mahasiswa 
        INNER JOIN tb_jurusan ON tb_mahasiswa.id_jurusan = tb_jurusan.id_jurusan INNER JOIN tb_dosen ON tb_mahasiswa.id_dosen = tb_dosen.id_dosen ORDER BY id_mhs DESC");
$jurusan = query("SELECT * FROM tb_jurusan");

// $dosen = query("SELECT * FROM tb_mahasiswa INNER JOIN tb_dosen ON tb_mahasiswa.id_dosen = tb_dosen.id_dosen");
$nama_dosen = query("SELECT * FROM tb_dosen");
?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Mahasiswa</title>
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/admin.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>libs/DataTables/datatables.min.css">
  <!-- <link rel="stylesheet" href="<?= base_url('libs/sweetalert/package/dist/') ?>sweetalert2.min.css"> -->
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
    <a href="../index.php" class="nav-link active text-white"><i class="fas fa-tachometer-alt mr-1"></i> Dashboard</a><hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="<?= base_url(); ?>page/mahasiswa.php"><i class="fas fa-user-graduate mr-1"></i> Daftar Mahasiswa</a><hr class="bg-secondary">
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
  <li class="nav-item">
    <a class="nav-link text-white" href="<?= base_url(); ?>logis/logout.php"><i class="fas fa-paper-plane mr-1"></i> Logout</a><hr class="bg-secondary">
  </li>
</ul>
</div>

<div class="col-md-10 p-5">
<h5><i class="fas fa-user-graduate mr-1"></i></i> Mahasiswa</h5><hr>
<a href="" class="btn btn-primary mb-3 tombolTambahData" data-toggle="modal" data-target="#formModal"><i class="fas fa-plus-square"></i> Tambah Data Mahasiswa</a>
<div class="col-md-5 float-right">
<a href="<?= base_url('report/exportpdf.php'); ?>" class="btn btn-success mb-3" target="_blank" data-toggle="modal" data-target="#exampleModal">Export to PDF</a>
<a href="<?= base_url('report/exportexcel.php'); ?>" class="btn btn-info mb-3" target="_blank">Export to Excel</a>
</div>
<button type="submit" class="btn btn-danger mb-3" onclick="hapus_mhs()"><i class="fa fa-trash"></i> Multiple Hapus</button>
<form action="" method="post" name="proses">
<table class="table table-striped" id="mahasiswa">
  <thead>
    <tr>
      <th>No</th>
      <th>
        <center>
        
        <input type="checkbox" id="select_all" value="">
      </center> 
      </th>
      <th>Foto</th>
      <th>Nama Mahasiswa</th>
      <th>NRP</th>
      <th>Dosen</th>
      <th>Email</th>
      <th>Jurusan</th>
      <th>Tanggal</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1; 
    foreach($mahasiswa as $mhs) : ?>
    <tr>
      <td scope="row"><?= $no++; ?></td>
      <td>
        <center>
        <input type="checkbox" name="checked[]" class="check" value="<?= $mhs['id_mhs']; ?>">
      </center>
      </td>
      <td>
        <img src="<?= base_url('gambar/mahasiswa/') ?><?= $mhs['gambar_mhs']; ?>" width="100">
      </td>
      <td><?= $mhs["nama_mhs"]; ?></td>
      <td><?= $mhs["nrp"]; ?></td>
      <td><?= $mhs['nama_dosen']; ?></td>
      <td><?= $mhs["email"]; ?></td>
      <td><?= $mhs["jurusan"]; ?></td>
      <td><?= date('d F Y', strtotime($mhs["tgl"])) ; ?></td>
      <td>
        <a href="" class="btn btn-primary" data-toggle="tooltip" title="Detail Mahasiswa"><i class="fas fa-user"></i></a>
        <a href="edit_mhs.php?id=<?= $mhs['id_mhs']; ?>" class="btn btn-info" data-toggle="tooltip" title="Edit Mahasiswa"><i class="fas fa-edit"></i></a>
        <a href="hapus_mhs.php?id=<?= $mhs['id_mhs']; ?>" class="btn btn-danger hapus" data-toggle="tooltip" title="Hapus Mahasiswa" onclick="return confirm('Yakin ?')"><i class="fas fa-trash-alt"></i></a>
      </td>
      
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</form>


</div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Tambah Data Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nama_mhs">Nama Mahasiswa</label>
            <input type="text" class="form-control" name="nama_mhs" id="nama_mhs" placeholder="Masukan Nama Mahasiswa" required>
          </div>
          <div class="form-group">
            <label for="nrp">NRP</label>
            <input type="text" class="form-control" name="nrp" id="nrp" placeholder="Masukan Nama Mahasiswa" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email Mahasiswa" required>
          </div>
          <div class="form-group">
            <label for="id_dosen">Dosen</label>
            <select name="id_dosen" id="id_dosen" class="form-control">
              <?php foreach($nama_dosen as $ndsn) : ?>
                <option value="<?= $ndsn['id_dosen']; ?>"><?= $ndsn['nama_dosen']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="jurusan">Jurusan</label>
            <select class="form-control" id="jurusan" name="jurusan">
              <option>-- Jurusan --</option>
              <?php foreach($jurusan as $j) : ?>
                <option value="<?= $j['id_jurusan']; ?>"><?= $j['jurusan']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="gambar">Foto</label>
            <input type="file" class="form-control-file" id="gambar" name="gambar">
          </div>   
          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
            <button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- <script src="<?= base_url() ?>js/jquery.js"></script> -->
<!-- <script src="<?= base_url() ?>libs/DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script> -->


<script src="<?= base_url() ?>js/jquery-3.5.0.min.js"></script>
<script>
// menyeleksi semua checbox
  $('#select_all').click(function() {
  if(this.checked) {
    $('.check').each(function() {
      this.checked = true;
    });
  } else {
    $('.check').each(function() {
      this.checked = false;
    });
  }
});

// menyeleksi checbox satu per satu, jika tercentang semua, otomatis di atas thnya akan tercentang juga.
$('.check').click(function() {
  if($('.check:checked').length == $('.check').length) {
    $('#select_all').prop('checked', true);
  } else {
    $('#select_all').prop('checked', false);
  }
});

function hapus_mhs() {
  var conf = confirm('Yakin Menghapus Data ?');
  if(conf) {
    document.proses.action = 'del_multi_mhs.php';
    document.proses.submit();
  }
}
</script>
<script src="<?= base_url() ?>fontawesome/js/all.min.js"></script>
<script src="<?= base_url() ?>js/popper.min.js"></script>
<script src="<?= base_url() ?>js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>js/admin.js"></script>
<script type="text/javascript" src="<?= base_url() ?>libs/DataTables/datatables.min.js"></script>
<!-- <script src="<?= base_url('libs/sweetalert/package/dist/') ?>sweetalert2.min.js"></script> -->
<script src="<?= base_url() ?>js/script.js"></script>
</body>
</html>