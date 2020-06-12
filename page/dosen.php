<?php
session_start();
require '../config/functions.php';
include_once "../report/modal_generate_add_dosen.php";
if(!isset($_SESSION['login'])) {
  header("Location: " . base_url('logis/login.php'));
}

if(isset($_POST['tambah_dosen'])) {
  if(tambah_dosen($_POST) > 0) {
  echo "<script>alert('Data Dosen Berhasil Ditambahkan.')</script>";
  } else {
    echo "<script>alert('Data Dosen Gagal Ditambahkan.')</script>";
  }
}

$dosen = query("SELECT * FROM tb_dosen ORDER BY id_dosen DESC");
?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Dosen</title>
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
<h5><i class="fas fa-chalkboard-teacher mr-1"></i> Dosen</h5><hr>
<a href="" class="btn btn-primary mb-3 tombolTambahData" data-toggle="modal" data-target="#formModal"><i class="fas fa-plus-square"></i> Tambah Data Dosen</a>
<a href="" class="btn btn-info mb-3" data-toggle="modal" data-target="#generate">Tambah Multi Dosen</a>
<button type="submit" class="btn btn-danger mb-3" onclick="hapus_dsn_multi()"><i class="fa fa-trash"></i> Multiple Hapus</button>
<button type="submit" class="btn btn-success mb-3" onclick="edit_dsn_multi()"><i class="fa fa-edit"></i> Multiple Edit</button>
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
      <th>Nama Dosen</th>
      <th>NIDN</th>
      <th>Keahlian</th>
      <th>Jenis Kelamin</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    foreach($dosen as $dsn) : ?>
    <tr>
      <td><?= $no++; ?></td>
      <td>
        <center>
          <input type="checkbox" name="checked[]" class="check" value="<?= $dsn['id_dosen']; ?>">
        </center>
      </td>
      <td>
        <img src="../gambar/dosen/<?= $dsn['gambar']; ?>" width="50">
      </td>
      <td><?= $dsn['nama_dosen']; ?></td>
      <td><?= $dsn['nidn']; ?></td>
      <td><?= $dsn['keahlian']; ?></td>
      <td><?= jenisKelamin($dsn['jenis_kelamin']); ?></td>
      <td>
        <a href="" class="btn btn-primary" data-toggle="tooltip" title="Detail Mahasiswa"><i class="fas fa-user"></i></a>
        <a href="edit_dosen.php?id=<?= $dsn['id_dosen']; ?>" class="btn btn-info" data-toggle="tooltip" title="Edit Mahasiswa"><i class="fas fa-edit"></i></a>
        <a href="hapus_dosen.php?id=<?= $dsn['id_dosen']; ?>" class="btn btn-danger hapus" data-toggle="tooltip" title="Hapus Mahasiswa" onclick="return confirm('Yakin ?')"><i class="fas fa-trash-alt"></i></a>
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
        <h5 class="modal-title" id="formModalLabel">Tambah Data Dosen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nama_dosen">Nama Dosen</label>
            <input type="text" class="form-control" name="nama_dosen" id="nama_dosen" placeholder="Masukan Nama Mahasiswa" required>
          </div>
          <div class="form-group">
            <label for="nidn">NIDN</label>
            <input type="text" class="form-control" name="nidn" id="nidn" placeholder="Masukan Nama Mahasiswa" required>
            <small class="form-text text-muted">Masukan NIDN Maksimal 9 Angka.</small>
          </div>
          <div class="form-group">
            <label for="jk">Jenis Kelamin</label><br>
            <label class="radio-inline">
              <input type="radio" name="jk" value="L"> Laki-Laki
            </label>
            <label class="radio-inline">
              <input type="radio" name="jk" value="P"> Perempuan
            </label>
          </div>
          <div class="form-group">
            <label for="keahlian">Keahlian</label>
            <select name="keahlian" id="keahlian" class="form-control">
              <option value="">-- Keahlian --</option>
              <option value="Jaringan">Jaringan</option>
              <option value="Pemrogramman Web">Pemrogramman Web</option>
              <option value="Struktur Data">Struktur Data</option>
              <option value="Algoritma Dasar">Algoritma Dasar</option>
            </select>
          </div>
          <div class="form-group">
            <label for="gambar">Foto</label>
            <input type="file" class="form-control-file" id="gambar" name="gambar">
          </div>   
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="tambah_dosen">Tambah Data</button>
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
  $(document).ready(function() {
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

    $('.check').click(function() {
      if($('.check:checked').length == $('.check').length) {
        $('#select_all').prop('checked', true);
      } else {
        $('#select_all').prop('checked', false);
      }
    });

    

  });
  function hapus_dsn_multi() {
      var conf = confirm('Yakin ?');
      if(conf) {
        document.proses.action = 'del_multi_dsn.php';
        document.proses.submit();
      }
    }

  function edit_dsn_multi() {
    document.proses.action = 'edit_multi_dosen.php';
    document.proses.submit();
  }
</script>



<script src="<?= base_url() ?>fontawesome/js/all.min.js"></script>
<script src="<?= base_url() ?>js/popper.min.js"></script>
<script src="<?= base_url() ?>js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>js/admin.js"></script>
<script type="text/javascript" src="<?= base_url() ?>libs/DataTables/datatables.min.js"></script>
<script src="<?= base_url() ?>js/script.js"></script>
</body>
</html>