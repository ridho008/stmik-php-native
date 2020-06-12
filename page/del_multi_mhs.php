<?php 
require '../config/functions.php';
$checked = @$_POST['checked'];
// cek apakah inputan data sudah diseleksi ?
if(!isset($checked)) {
	echo "<script>alert('Seleksi dulu data yang ingin dihapus!');window.location='mahasiswa.php';</script>";
} else {
	foreach($checked as $id) {
		// hapus gambar di dalam folder
		$result = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE id_mhs = '$id'");
		$row = mysqli_fetch_assoc($result);
		$gambar = $row['gambar_mhs'];
		$path = "../gambar/mahasiswa/" . $gambar;
			if(file_exists($path)) {
				unlink($path);
			}
		$query = mysqli_query($conn, "DELETE FROM tb_mahasiswa WHERE id_mhs = '$id'") or die(mysqli_error($conn));
	}
	if($query) {
		echo "<script>alert('Data Berhasil Dihapus.');window.location='mahasiswa.php';</script>";
	} else {
		echo "<script>alert('Data Gagal Dihapus.');window.location='mahasiswa.php';</script>";
	}
}

?>