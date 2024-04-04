<?php

include "../conn.php";

$kd = $_SESSION['user_id'];
$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$kd'");

$row = mysqli_fetch_assoc($sql);


$myObj = new stdClass();
$myObj->user_id = $row['user_id'];
$myObj->fullname = $row['fullname'];
$myObj->username = $row['username'];
$myObj->password = $row['password'];
$myObj->level = $row['level'];
$myObj->no_hp = $row['no_hp'];

$myJSON = json_encode($myObj);

echo json_encode($myJSON);
