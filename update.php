<?php
	// update.php
	if (isset($_POST["kirim"])) {
		$host = "localhost";
		$user = "root";
		$pass = "";
		$db = "perpustakaan";

		$conn = mysqli_connect($host,$user,$pass,$db);
		if (!$conn) {
			die("gagal koneksi ". mysqli_connect_error());
		}

		$sql = "UPDATE buku SET
			judul = '".$_POST["judul"]."',
			pengarang = '".$_POST["pengarang"]."',
			tahun = ".$_POST["tahun"]."
			WHERE id=".$_POST["id"];
		if (mysqli_query($conn,$sql)) {
			echo "berhasil edit 1 baris <br>";
		} else {
			echo "error ". mysqli_error($conn);
		}
		mysqli_close($conn);	
	}

	// cek id yg dikirim
	if (isset($_GET["id"])) {
		$host = "localhost";
		$user = "root";
		$pass = "";
		$db = "perpustakaan";

		$conn = mysqli_connect($host,$user,$pass,$db);
		if (!$conn) {
			die("gagal koneksi ". mysqli_connect_error());
		}

		$sql = "SELECT id, judul, pengarang, tahun
			FROM buku 
			WHERE id=".$_GET["id"];
		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_assoc($result);
?>

	<form method="post" action="update.php">
		id:
		<input type="text" name="id"
			value="<?php echo $row["id"]; ?>" readonly><br>
		judul:
		<input type="text" name="judul"
			value="<?php echo $row["judul"]; ?>"><br>
		pengarang:
		<input type="text" name="pengarang"
			value="<?php echo $row["pengarang"]; ?>"><br>
		tahun:
		<input type="text" name="tahun"
			value="<?php echo $row["tahun"]; ?>"><br>
		<input type="submit" name="kirim">
	</form>

<?php
		} else {
			echo "id tidak ditemukan <br>";
		}
		mysqli_close($conn);	
	} else {
		echo "klik edit dari list <br>";
	}

	
?>
	<a href="list.php">back</a>