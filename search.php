<?php
include "conn.php";

if (isset($_GET['id_tiket']) && !empty($_GET['id_tiket'])) {
    $id_tiket = $_GET['id_tiket'];
    $query = "SELECT * FROM tiket WHERE id_tiket = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_tiket);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $response = [
            'nama' => $row['nama'],
            'email' => $row['email'],
            'departemen' => $row['departemen'],
            'problem' => $row['problem'],
            'detail_kendala' => $row['detail_kendala'],
            'tanggal' => $row['tanggal'],
            'status' => $row['status'],
            'penanganan' => $row['penanganan'],
            'waktu' => $row['waktu'],
            'pic' => $row['pic']
        ];
        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'No data found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
