<?php 
// require __DIR__ . '../libs/vendor/autoload.php';
// use Ramsey\Uuid\Uuid;


// $uuid->toString();
// $uuid->getFields()->getVersion();

$conn = mysqli_connect("localhost", "root", "", "stmik_native") or die(mysqli_error($conn));

// query untuk semua halaman
function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

// base_url
function base_url($url = null) {
	$base_url = "http://localhost/chframeindo/tadminnative/";
	if($url != null) {
		return $base_url . $url;
	} else {
		return $base_url;
	}
}

function tambah_mhs($data) {
	global $conn;
	// $uuid = Uuid::uuid4()->toString();
	$nama_mhs = htmlspecialchars($data['nama_mhs']);
	$nrp = htmlspecialchars($data['nrp']);
	$email = htmlspecialchars($data['email']);
	$jurusan = htmlspecialchars($data['jurusan']);
	$id_dosen = htmlspecialchars($data['id_dosen']);
	$cekGambar = $_FILES['gambar']['error'];

	// apakah inputan sudah di masukan ?
	if(empty($nama_mhs && $nrp && $email && $jurusan)) {
		echo "<script>alert('Masukan data yang ingin di inputkan.')</script>";
		return false;
	}

	// apakah gambar sudah di upload ?
	if($cekGambar === 4) {
		echo "<script>alert('Upload gambar anda.')</script>";
		return false;
	}


	// cek upload gambar
	$ektensi = explode(".", $_FILES['gambar']['name']);
	// generate nama gambar baru
	$gambar = uniqid() . end($ektensi);
	$sumber = $_FILES['gambar']['tmp_name'];
	move_uploaded_file($sumber, "../gambar/mahasiswa/" . $gambar);

	mysqli_query($conn, "INSERT INTO tb_mahasiswa (nama_mhs, nrp, email, id_jurusan, id_dosen, gambar_mhs, tgl) VALUES ('$nama_mhs', '$nrp', '$email', '$jurusan', '$id_dosen', '$gambar', now())") or die(mysqli_error($conn));
	return mysqli_affected_rows($conn);
}

// function tampil_tgl($tgl1, $tgl2) {
// 	global $conn;
// 	$tgla = $_POST['tgla'];
// 	$tglb = $_POST['tglb'];
// 	$result = query($conn, "SELECT * FROM tb_mahasiswa WHERE tgl BETWEEN '$tgl1' AND '$tgl2'");

// 	// return $result;
// }

function edit_mhs($data) {
	global $conn;
	$id = $data['id'];
	// $uuid = Uuid::uuid4()->toString();
	$nama_mhs = htmlspecialchars($data['nama_mhs']);
	$nrp = htmlspecialchars($data['nrp']);
	$email = htmlspecialchars($data['email']);
	$jurusan = htmlspecialchars($data['jurusan']);
	// $id_dosen = htmlspecialchars($data['id_dosen']);
	$gambarLamaMhs = $data['gambarLamaMhs'];
	$cekGambar = $_FILES['gambar']['error'];
	// cek gambar
	if($cekGambar === 4) {
		$gambar = $gambarLamaMhs;
	} else {
		$gambar = upload_mhs();
	}

	// jalankan query
	mysqli_query($conn, "UPDATE tb_mahasiswa SET nama_mhs = '$nama_mhs', nrp = '$nrp', email = '$email', id_jurusan = '$jurusan', gambar_mhs = '$gambar' WHERE id_mhs = '$id'") or die(mysqli_error($conn));
	return mysqli_affected_rows($conn);
}

function upload_mhs() {
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	if($error === 4) {
		echo "<script>alert('Masukan gambar anda terlebih dahulu.')</script>";
		return false;
	}

	$ektensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ektensiGambar = explode('.', $namaFile);
	$ektensiGambar = strtolower(end($ektensiGambar));

	// cek apakah gambar yang diupload
	if(!in_array($ektensiGambar, $ektensiGambarValid)) {
		echo "<script>alert('yang anda upload bukan gambar.');window.location='index.php';</script>";
		return false;
	}

	if($ukuranFile > 1000000) {
		echo "<script>alert('ukuran gambar terlalu besar.')</script>";
		return false;
	}

	// generate nama gambar
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ektensiGambar;

	// replace gambar
	$gambarLama = $_POST["gambarLamaMhs"];
	$path = "../gambar/mahasiswa/" . $gambarLama;
	if(file_exists($path)) {
		unlink($path);
	}

	move_uploaded_file($tmpName, "../gambar/mahasiswa/" . $namaFileBaru);
	return $namaFileBaru;
}

function hapus_mhs($id) {
	global $conn;
	$id = $_GET['id'];
	$result = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE id_mhs = '$id'");
	$row = mysqli_fetch_assoc($result);
	$gambar = $row['gambar_mhs'];
	if(file_exists("../gambar/mahasiswa/" . $gambar)) {
		unlink("../gambar/mahasiswa/" . $gambar);
	}
	mysqli_query($conn, "DELETE FROM tb_mahasiswa WHERE id_mhs = '$id'");
	return mysqli_affected_rows($conn);
}

function register($data) {
	global $conn;
	$username = htmlspecialchars(strtolower(stripcslashes($data['username'])));
	$password = htmlspecialchars(mysqli_real_escape_string($conn, $data['password']));
	$password2 = htmlspecialchars(mysqli_real_escape_string($conn, $data['password2']));

	// cek username sudah terdaftar ?
	$cekUser = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");
	if(mysqli_fetch_assoc($cekUser)) {
		echo "<script>alert('Username sudah terdaftar')</script>";
		return false;
	}

	// cek apakah password 1 & password2 sudah sama ?
	if($password != $password2) {
		echo "<script>alert('Password yang diinputkan tidak sama.')</script>";
		return false;
	}

	// acak password
	$password = password_hash($password, PASSWORD_DEFAULT);
	mysqli_query($conn, "INSERT INTO tb_user (username, password) VALUES ('$username', '$password')");
	return mysqli_affected_rows($conn);
}

// -------------------DOSEN--------------------------
function tambah_dosen($data) {
	global $conn;
	$nama_dosen = htmlspecialchars($data['nama_dosen']);
	$nidn = htmlspecialchars($data['nidn']);
	$keahlian = htmlspecialchars($data['keahlian']);
	$jk = htmlspecialchars($data['jk']);

	// cek apakah gambar sudah diupload
	if($_FILES['gambar']['error'] === 4) {
		echo "<script>alert('Upload gambar dosen dulu.')</script>";
		return false;
	}

	// upload gambar
	$ektensi = explode('.', $_FILES['gambar']['name']);
	$gambar = uniqid() . end($ektensi);
	$sumber = $_FILES['gambar']['tmp_name'];
	move_uploaded_file($sumber, "../gambar/dosen/" . $gambar);

	mysqli_query($conn, "INSERT INTO tb_dosen (nama_dosen, nidn, keahlian, jenis_kelamin, gambar) VALUES ('$nama_dosen', '$nidn', '$keahlian', '$jk', '$gambar')");
	return mysqli_affected_rows($conn);
}

function edit_dosen($data) {
	global $conn;
	$id = $data['id_dosen'];
	$nama_dosen = htmlspecialchars($data['nama_dosen']);
	$nidn = htmlspecialchars($data['nidn']);
	$keahlian = htmlspecialchars($data['keahlian']);
	$jk = htmlspecialchars($data['jk']);
	$gambarLamaDsn = $data['gambarLamaDsn'];

	// cek apakah inputan kosong
	if(empty($nama_dosen && $nidn && $keahlian)) {
		echo "<script>alert('Pastikan anda mengisi inputan.')</script>";
		return false;
	}

	// jika tidak ada yang dipilih gambar
	if($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLamaDsn;
	} else {
		$gambar = upload_dosen();
	}

	mysqli_query($conn, "UPDATE tb_dosen SET nama_dosen = '$nama_dosen', nidn = '$nidn', keahlian = '$keahlian', jenis_kelamin = '$jk', gambar = '$gambar' WHERE id_dosen = $id") or die(mysqli_error($conn));
	return mysqli_affected_rows($conn);
}

function upload_dosen() {
	$namaFile = $_FILES['gambar']['name'];
	$UkuranG = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];
	$gambarLamaDsn = $_POST['gambarLamaDsn'];

	$ektensiGambarValid = ['jpg','jpeg','png'];
	$ektensiGambar = explode('.', $namaFile);
	$ektensiGambar = strtolower(end($ektensiGambar));

	// cek apakah gambar yang diupload ?
	if(!in_array($ektensiGambar, $ektensiGambarValid)) {
		echo "<script>alert('yang anda upload bukan gambar.')</script>";
		return false;
	} 

	// cek ukuran gambar
	if($UkuranG > 1000000) {
		echo "<script>alert('Ukuran Gambar Harus Dibawah 1MB.')</script>";
		return false;
	}

	// generate nama gambar
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ektensiGambar;
	
	$path = "../gambar/dosen/" . $gambarLamaDsn;
	if(file_exists($path)) {
		unlink($path);
	}


	move_uploaded_file($tmpName, '../gambar/dosen/' . $namaFileBaru);
	return $namaFileBaru;
}

function jenisKelamin($data) {
	return $data == "L" ? "Laki-Laki" : "Perempuan";
}

// ---------------- MULTIPLE TAMBAH DOSEN ------------------
function multi_tambah_dosen($data) {
	global $conn;
	$total = $data['total'];
	for($i = 1; $i <= $total; $i++) {
		$nama_dosen = htmlspecialchars($data['nama-'.$i]);
		$nidn = htmlspecialchars($data['nidn-'.$i]);
		$keahlian = htmlspecialchars($data['keahlian-'.$i]);
		$jenis_kelamin = htmlspecialchars($data['jk-'.$i]);

		$ektensi = explode('.', $_FILES['foto-'.$i]['name']);
		$gambar = uniqid() . end($ektensi);
		$sumber = $_FILES['foto-'.$i]['tmp_name'];
		move_uploaded_file($sumber, "../gambar/dosen/" . $gambar);

		mysqli_query($conn, "INSERT INTO tb_dosen (nama_dosen, nidn, keahlian, jenis_kelamin, gambar) VALUES('$nama_dosen', '$nidn', '$keahlian', '$jenis_kelamin', '$gambar')") or die(mysqli_error($conn));
		
	}
	return mysqli_affected_rows($conn);
}

function multi_edit_dosen($data) {
	global $conn;
	for($i = 0; $i < count($_POST['id']); $i++) {
		$id = $_POST['id'];
		$nama_dosen = htmlspecialchars($data['nama'][$i]);
		$nidn = htmlspecialchars($data['nidn'][$i]);
		$keahlian = htmlspecialchars($data['keahlian'][$i]);
		$jenis_kelamin = htmlspecialchars($data['jk'][$i]);
		$gambarLamaMulti = $data['gambarLamaMulti'];

		if($_FILES['foto']['error'] === 4) {
			$gambar = $gambarLamaMulti;
		} else {
			$namaFile = $_FILES['foto']['name'];
			$ukuranFile = $_FILES['foto']['size'];
			$error = $_FILES['foto']['error'];
			$tmpName = $_FILES['foto']['tmp_name'];

			if($error === 4) {
				echo "<script>alert('Masukan gambar anda terlebih dahulu.')</script>";
				return false;
			}

			$ektensiGambarValid = ['jpg', 'jpeg', 'png'];
			$ektensiGambar = explode('.', $namaFile);
			$ektensiGambar = strtolower(end($ektensiGambar));

			// cek apakah gambar yang diupload
			if(!in_array($ektensiGambar, $ektensiGambarValid)) {
				echo "<script>alert('yang anda upload bukan gambar.')</script>";
				return false;
			}

			if($ukuranFile > 1000000) {
				echo "<script>alert('ukuran gambar terlalu besar.')</script>";
				return false;
			}

			// generate nama gambar
			$namaFileBaru = uniqid();
			$namaFileBaru .= '.';
			$namaFileBaru .= $ektensiGambar;

			// replace gambar
			$gambarLama = $_POST["gambarLamaMulti"];
			$path = "../gambar/dosen/" . $gambarLama;
			if(file_exists($path)) {
				unlink($path);
			}

			move_uploaded_file($tmpName, "../gambar/dosen/" . $namaFileBaru);
			return $namaFileBaru;
					
		}

		mysqli_query($conn, "UPDATE tb_dosen SET nama_dosen = '$nama_dosen', nidn = '$nidn', keahlian = '$keahlian', jenis_kelamin = '$jenis_kelamin', gambar = '$gambar'") or die(mysqli_error($conn));
		
	}
	return mysqli_affected_rows($conn);
}
