<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['username'])) {
    header('location:../index.php');
} else {
    class team
    {
        public static function checkpermission()
        {
            include "../conn.php";
            $output = '';
            $permission_result = '';

            $tampil = "test";
            $username = $_SESSION['username'];
            $query = "SELECT * FROM user where username = '$username'";
            $tampil = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_array($tampil)) {
                $user_id = $row['user_id'];
                // $username = $row['username'];
                // $fullname = $row['fullname'];
                $output .= $user_id;
            }

            $permission_user = "SELECT * FROM `permission_user` as c
            inner join permissions
            where c.permission_id = permissions.id
            and user_id = '$output'";
            // $permission_user = "SELECT * FROM permission_user where user_id = '$output'";
            $permission_user_check = mysqli_query($koneksi, $permission_user) or die(mysqli_error());
            $data = array();
            while ($row = mysqli_fetch_array($permission_user_check)) {
                // $nestedData = array();
                // $id = $row['id'];
                $data[] = $row['name'];
                // $user_id = $row['user_id'];
                // $data[] = $nestedData;
            }

            $permission_rules = "SELECT * FROM permissions where id = '$permission_result'";
            $permission_rules_check = mysqli_query($koneksi, $permission_rules) or die(mysqli_error());

            // $data = array();
            // while ($row = mysqli_fetch_array($permission_rules_check)) {

            //     $nestedData = array();
            //     // $id = $row['id'];
            //     $nestedData[] = $row['name'];
            //     // $display_name = $row['display_name'];
            //     // $sort = $row['sort'];
            //     // $status = $row['status'];
            //     // $created_by = $row['created_by'];
            //     // $updated_by = $row['created_at'];
            //     // $updated_at = $row['updated_at'];
            //     // $deleted_at = $row['deleted_at'];
            //     // $akhir_result .= $name;
            //     $data[] = $nestedData;
            // }

            // $json_data = array("data" => $data);

            return $data;
        }
    }
}


// if ($test->$group()) {
//     echo "ada";
// } else {
//     echo "tidak ada";
// }

// echo '<pre>';
// print_r($test->$group());
// echo '</pre>';

// $ele = array();
// for ($i = 0; $i < 2; $i++) {
//     $ele[] =  $test->$group()[$i];
// }

// $ele = array("Rolex", "Fastrack", "Titan");

// print_r($ele);

// $stageCodes = [];
// foreach ($test->$group() as $item) {
//     array_push($stageCodes, $item->enum_value);
// }

// while ($row = mysqli_fetch_array($test->$group())) {
//     echo "test" . $row['permission_id'];
// }

// echo  mysqli_num_rows($test->$group());