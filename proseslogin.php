<?php
include("conn.php");
date_default_timezone_set('Asia/Jakarta');

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

//$username = mysqli_real_escape_string($username);
//$password = mysqli_real_escape_string($password);

if (empty($username) && empty($password)) {
	header('location:index.php?error1');
} else if (empty($username)) {
	header('location:index.php?error=2');
} else if (empty($password)) {
	header('location:index.php?error=3');
}


if ($koneksi->connect_error) {
	die("Connection failed: " . $mysqli->connect_error);
}

$stmt = $koneksi->prepare("SELECT user_id, password FROM user WHERE username = ?");
$stmt->bind_param("s", $username);


$stmt->execute();
$stmt->store_result();


if ($stmt->num_rows > 0) {

	// Bind the result to variables 
	$stmt->bind_result($user_id, $hashed_password);

	// Fetch the result 
	$stmt->fetch();

	// Verify the password 
	if (password_verify($password, $hashed_password)) {

		$_SESSION['user_id'] = $user_id;
		$_SESSION['username'] = $username;
		$_SESSION['fullname'] = $row['fullname'];
		$_SESSION['level'] = $row['level'];
		$_SESSION['gambar'] = $row['gambar'];

		header('location:admin/index.php');
		exit;
	} else {
		header('location:admin/index.php');
	}
} else {
	echo "User not found!";
}

// Close the connection 
$stmt->close();
$mysqli->close();
