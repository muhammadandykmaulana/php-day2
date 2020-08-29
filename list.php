<form method="get" action="list.php">
	judul: <input type="text" name="judul">
	<input type="submit" name="cari">
	<a href="list.php">clear</a>
</form>

<?php
	// list.php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "perpustakaan";
	$baris = 3;

	$conn = mysqli_connect($host,$user,$pass,$db);
	if (!$conn) {
		die("gagal koneksi ". mysqli_connect_error());
	}

	$judul = "";
	if(isset($_GET["judul"])){
		$judul = $_GET["judul"];
	}

	$hal = "1";
	if(isset($_GET["hal"])){
		$hal = $_GET["hal"];
	}


	$sql = "SELECT id, judul, pengarang, tahun
		FROM buku
		WHERE judul LIKE '%".$judul."%' 
		LIMIT ". $baris ."
		OFFSET ". ($hal-1)*$baris ." 
		";

	// hal 1 2 3 4
	// off 0 3 6 9
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)>0) {
		echo "<table border=1>";
		echo "<tr>";
		echo "<td>id</td>";			
		echo "<td>judul</td>";			
		echo "<td>pengarang</td>";			
		echo "<td>tahun</td>";			
		echo "<td>tindakan</td>";			
		echo "</tr>";

		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>" . $row["id"] . "</td>";
			echo "<td>" . $row["judul"] . "</td>";
			echo "<td>" . $row["pengarang"] . "</td>";
			echo "<td>" . $row["tahun"] . "</td>";
			echo "<td>"
			. " <a href='update.php?id=".$row["id"]."'>edit</a>" 
			. " <a href='delete.php?id=".$row["id"]."'>hapus</a>" 
			. "</td>";

			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "kosong";
	}

	$sql = "SELECT * FROM buku
		WHERE judul LIKE '%".$judul."%'";
	$result = mysqli_query($conn,$sql);
	for($i=1; $i<=ceil(mysqli_num_rows($result)/$baris); $i++){
		echo " <a href='list.php?judul=$judul&hal=$i'>$i</a> ";
	}
?>
<br><a href="insert.php">tambah</a></br>
