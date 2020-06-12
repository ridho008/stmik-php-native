<?php 
require '../config/functions.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM tb_dosen WHERE id_dosen = $id");
$row = mysqli_fetch_assoc($result);
$gambar = $row['gambar'];

$path = "../gambar/dosen/" . $gambar;
if(file_exists($path)) {
	unlink($path);
}

mysqli_query($conn, "DELETE FROM tb_dosen WHERE id_dosen = $id") or die(mysqli_error($conn));
echo "<script>alert('Data berhasil dihapus.');window.location='dosen.php';</script>";
?>