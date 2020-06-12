<?php 
require '../config/functions.php';

$mahasiswa = query("SELECT * FROM tb_mahasiswa");

$fileName = "mahasiswaexcel". date('d-m-Y') . ".xls";
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$fileName");


?>
<table border="1" cellpadding="10" cellspacing="0">
	<tr>
		<th>No</th>
		<th>Nama</th>
		<th>NRP</th>
		<th>Email</th>
		<th>Jurusan</th>
	</tr>
	<?php foreach($mahasiswa as $mhs) : ?>
	<tr>
		<td><?= $no++; ?></td>
		<td><?= $mhs['nama_mhs']; ?></td>
		<td><?= $mhs['nrp']; ?></td>
		<td><?= $mhs['email']; ?></td>
		<td><?= $mhs['jurusan']; ?></td>
	</tr>
<?php endforeach; ?>
</table>