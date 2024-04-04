<?php
include "../conn.php";

$hce = $_POST['id_user'];

$checkdot = $_POST['count'];

// $check_line = ;

$test = array();
for ($i = 1; $i <= $checkdot; $i++) {
    $a = 'permission_' . $i;
    $check_value = mysqli_query($koneksi, "SELECT * FROM permission_user  WHERE permission_id = " . $_POST[$a] . " AND user_id = " . $hce);

    if ($check_value) {
        $row = mysqli_fetch_assoc($check_value);
        if ($row) {
            echo "User ID: " . $row['user_id'] . "<br>";
            echo "Permission ID: " . $row['permission_id'] . "<br>";
        } else {
            echo "No data found and insert.";
            $test[] = "('" . $_POST[$a] . "', '" . $hce . "') ";
        }
    } else {
        // Handle query error
        echo "Error executing query: " . mysqli_error($koneksi);
    }
}

echo  "test - " . $_POST['check_line'];

$tampil = mysqli_query($koneksi, "INSERT INTO permission_user (permission_id,user_id) VALUES " . implode(",", $test));
echo $tampil;
