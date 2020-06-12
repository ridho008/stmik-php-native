<?php 
require '../config/functions.php';
$checked = @$_POST['checked'];
if(!isset($checked)) {
	echo "<script>alert('Seleksi dulu data yang ingin dihapus!');window.location='dosen.php';</script>";
} else {
	foreach($checked as $id) {
		$result = mysqli_query($conn, "SELECT * FROM tb_dosen WHERE id_dosen = '$id'") or die(mysqli_error($conn));
		$row = mysqli_fetch_assoc($result);
		$gambar = $row['gambar'];

		$path = "../gambar/dosen/" . $gambar;
		if(file_exists($path)) {
			unlink($path);
		}
		$query_del = mysqli_query($conn, "DELETE FROM tb_dosen WHERE id_dosen = '$id'") or die(mysqli_error($conn));
		
	}
	if($query_del) {
			echo "<script>alert('Data Berhasil Dihapus.');window.location='dosen.php';</script>";
		} else {
			echo "<script>alert('Data Gagal Dihapus.');window.location='dosen.php';</script>";
		}
}

?>