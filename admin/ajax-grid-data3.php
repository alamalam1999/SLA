<?php
/* Database connection start */
include "../database_konek.php";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
$requestData = $_REQUEST;


$columns = array(

    0 => 'username',
    1 => 'fullname',

);

// getting total number records without any search
$sql = "SELECT user_id, username, password, fullname, no_hp, level";
$sql .= " FROM user";
$query = mysqli_query($conn, $sql) or die("ajax-grid-data.php: get Tiket");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if (!empty($requestData['search']['value'])) {
    // if there is a search parameter
    $sql = "SELECT user_id, username, password, fullname, no_hp, level";
    $sql .= " FROM user";
    $sql .= " WHERE user_id LIKE '" . $requestData['search']['value'] . "%' ";    // $requestData['search']['value'] contains search parameter
    $sql .= " OR username LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR password LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR fullname LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR no_hp LIKE '" . $requestData['search']['value'] . "%' ";
    $sql .= " OR level LIKE '" . $requestData['search']['value'] . "%' ";
    $query = mysqli_query($conn, $sql) or die("ajax-grid-data.php: get Tiket");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query = mysqli_query($conn, $sql) or die("ajax-grid-data.php: get Tiket"); // again run query with limit

} else {
    $sql = "SELECT user_id, username, password, fullname, no_hp, level";
    $sql .= " FROM user";
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    $query = mysqli_query($conn, $sql) or die("ajax-grid-data.php: get Tiket");
}

$data = array();
while ($row = mysqli_fetch_array($query)) {
    // Prepare an array to hold row data
    $nestedData = array();

    // Add data to the nested array
    $nestedData[] = $row["user_id"];
    $nestedData[] = $row["username"];
    $nestedData[] = $row["fullname"];

    // Construct the form with a button for each row
    $nestedData[] = '<form action="permission-dashboard.php" method="POST" enctype="multipart/form-data">
                         <input type="hidden" name="id_chek" value="' . $row['user_id'] . '">
                         <button type="submit">Check</button>
                     </form>';

    // Add the nested array to the main data array
    $data[] = $nestedData;
}



$json_data = array(
    "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal"    => intval($totalData),  // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
