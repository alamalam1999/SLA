<?php
include "../conn.php";

$hce = $_POST['id_user'];

$checkdot = $_POST['count'];

$type_check = $_POST['type_check'];
$check_permission = mysqli_query($koneksi, "SELECT * FROM permissions");
$totalData = mysqli_num_rows($check_permission);

$nestedData = array();
while ($row = mysqli_fetch_array($check_permission)) {
    $nestedData[] = array(
        "id" => $row["id"],
        "name" => $row["name"]
    );
}

if ($type_check == "centang_semua") {
    for ($y = 0; $y < $totalData; $y++) {
        $check_value = mysqli_query($koneksi, "SELECT * FROM permission_user WHERE permission_id = " . $nestedData[$y]['id'] . " AND user_id = " . $hce);
        $row = mysqli_fetch_assoc($check_value);
        if ($row) {
            echo "Permission ID: " . $nestedData[$y]['id'] . ", Permission Name: " . $nestedData[$y]['name'] . " - Found, ID: " . $row['id'] . "<br>";
        } else {
            echo "Permission ID: " . $nestedData[$y]['id'] . ", Permission Name: " . $nestedData[$y]['name'] . " - Not found<br>";
            mysqli_query($koneksi, "INSERT INTO permission_user (permission_id,user_id) VALUES (" . $nestedData[$y]['id'] . "," . $hce . ")");
            echo "Berhasil";
        }
    }
} else {
    for ($y = 0; $y < $totalData; $y++) {
        $check_value = mysqli_query($koneksi, "SELECT * FROM permission_user WHERE permission_id = " . $nestedData[$y]['id'] . " AND user_id = " . $hce);
        $row = mysqli_fetch_assoc($check_value);
        if ($row) {
            mysqli_query($koneksi, "DELETE FROM permission_user WHERE id = " . $row['id']);
            echo "Berhasil";
        }
    }
}

// Retrieve the previous page URL
$previous_page = 'permission-dashboard.php';

// Append query parameters to the previous page URL

$redirect_url = "";
if ($redirect_url !== '') {
    // Variable is not empty, do something
    $redirect_url = $previous_page;
} else {
    // Variable is empty, do something else
    $redirect_url = $previous_page . '?id_chek=' . $hce;
}


// Redirect to the previous page with variables
header("Location: $redirect_url");
exit();
