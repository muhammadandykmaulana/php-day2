<?php
	// delete.php
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

		$sql = "DELETE
			FROM buku 
			WHERE id=".$_GET["id"];
		if (mysqli_query($conn,$sql)) {
			echo "berhasil hapus 1 baris";
		} else {
			echo "error ". mysqli_error($conn);
		}
		mysqli_close($conn);	
	} else {
		echo "klik edit dari list <br>";
	}

	
?>
	<a href="list.php">back</a>