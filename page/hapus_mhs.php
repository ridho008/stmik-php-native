<?php 
require '../config/functions.php';

$id = $_GET['id'];
if(hapus_mhs($id) > 0) {
	echo "<script>alert('Data Berhasil Dihapus.');document.location.href='mahasiswa.php';</script>";
} else {
	echo "<script>alert('Data Gagal Dihapus.');document.location.href='mahasiswa.php';</script>";
}

?>