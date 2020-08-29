<?php
	// insert.php
	if (isset($_POST["kirim"])) {
		$host = "localhost";
		$user = "root";
		$pass = "";
		$db = "perpustakaan";

		$conn = mysqli_connect($host,$user,$pass,$db);
		if (!$conn) {
			die("gagal koneksi ". mysqli_connect_error());
		}

		$sql = "insert into buku (judul,pengarang,tahun)
			values(
			'".$_POST["judul"]."',
			'".$_POST["pengarang"]."',
			".$_POST["tahun"].")";
		if (mysqli_query($conn,$sql)) {
			echo "berhasil masuk 1 baris";
		} else {
			echo "error ". mysqli_error($conn);
		}
		mysqli_close($conn);	
	}
	
?>
	<form method="post" action="insert.php">
		judul:
		<input type="text" name="judul"><br>
		pengarang:
		<input type="text" name="pengarang"><br>
		tahun:
		<input type="text" name="tahun"><br>
		<input type="submit" name="kirim">
	</form>
	<a href="list.php">back</a>