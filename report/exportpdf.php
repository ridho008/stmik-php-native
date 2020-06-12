<?php 
ob_start();
require '../config/functions.php';
require '../libs/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$mahasiswa = query("SELECT * FROM tb_mahasiswa ORDER BY id_mhs DESC");


$html2pdf = new Html2Pdf();
$html = '
	<h2 align="center">Daftar Mahasiswa STMIK Amik Riau</h2>
	<table border="1" cellpadding="10" cellspacing="0" align="center">
	<tr>
		<td>No</td>
		<td>Foto</td>
		<td>Nama</td>
		<td>NRP</td>
		<td>Email</td>
		<td>Jurusan</td>
	</tr>';
	$no = 1;
	foreach($mahasiswa as $mhs) {
			$html .= '
						<tr>
								<td>'. $no++ .'</td>
								<td>
										<img src="../gambar/mahasiswa/'. $mhs['gambar'] .'" width="50">
								</td>
								<td>'. $mhs['nama_mhs'] .'</td>
								<td>'. $mhs['nrp'] .'</td>
								<td>'. $mhs['email'] .'</td>
								<td>'. $mhs['jurusan'] .'</td>
						</tr>
		';
		
	}
$html .= '
</table>
';

$html2pdf->writeHTML($html);
ob_end_clean();
$html2pdf->output('daftarmahasiswa' . date('d-m-Y') . '.pdf');

?>

