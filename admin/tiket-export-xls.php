<?php
include("../conn.php");
session_start();
if (empty($_SESSION)) {
	header("Location: ../index.php");
}
?>
<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=datatiket.xls");

// Tampilkan isi table
$sqlshow = mysqli_query($koneksi, "SELECT * FROM tiket ORDER BY id_tiket ASC");
?>

<h3>Adi Alam</h3>
<table>
	<tr>
		<td width="0px">Tanggal : <?php echo date("d-m-Y") ?></td>
	</tr>
</table>
<table bordered="1">
	<thead bgcolor="eeeeee" align="center">
		<tr bgcolor="eeeeee">
			<th>Nomor</th>
			<th>Id Tiket</th>
			<th>Tanggal</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Departemen</th>
			<th>Masalah</th>
			<th>Penanganan</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$nomor = 0;
		while ($rowshow = mysqli_fetch_assoc($sqlshow)) {
			$nomor++;
			echo '<tr>';
			echo '<td>' . $nomor . '</td>';
			echo '<td>' . $rowshow['id_tiket'] . '</td>';
			echo '<td>' . $rowshow['tanggal'] . '</td>';
			echo '<td>' . $rowshow['nama'] . '</td>';
			echo '<td>' . $rowshow['email'] . '</td>';
			echo '<td>' . $rowshow['departemen'] . '</td>';
			echo '<td>' . $rowshow['problem'] . '</td>';
			echo '<td>' . $rowshow['penanganan'] . '</td>';
			echo '<td>' . $rowshow['status'] . '</td>';
			echo '</tr>';
		}
		?>
	</tbody>
</table>