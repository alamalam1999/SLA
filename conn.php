<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "tiket_db";

$datas = '';

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
	echo 'Gagal melakukan koneksi ke Database : ' . mysqli_connect_error();
} else {
	$datas = "MASUK PAK EKO";
}
