<?php
include "../conn.php";
$hce = $_POST['id_user'];

$permission_id = $_POST['check_line'];
$check_value = mysqli_query($koneksi, "SELECT * FROM permission_user WHERE permission_id = $permission_id AND user_id = $hce");
if ($check_value) {
    $row = mysqli_fetch_assoc($check_value);
    if ($row) {
        mysqli_query($koneksi, "DELETE FROM permission_user WHERE permission_id = $permission_id AND user_id = $hce");
    } else {
        mysqli_query($koneksi, "INSERT INTO permission_user (permission_id, user_id) VALUES ($permission_id, $hce)");
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
}
