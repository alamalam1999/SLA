<?php
session_start();
if (empty($_SESSION['username'])) {
    header('location:../index.php');
} else {

?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    // start head
    include "head/head_dashboard.php";
    // end head
    ?>

    <body id="page-top">
        <!-- START MAIN -->
        <div id="wrapper">
            <!-- START LEFT SIDEBAR NAV-->
            <?php include "menu-tiket.php"; ?>
            <?php
            $timeout = 10; // Set timeout minutes
            $logout_redirect_url = "../index.php"; // Set logout URL

            $timeout = $timeout * 60; // Converts minutes to seconds
            if (isset($_SESSION['start_time'])) {
                $elapsed_time = time() - $_SESSION['start_time'];
                if ($elapsed_time >= $timeout) {
                    session_destroy();
                    echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
                }
            }
            $_SESSION['start_time'] = time();
            ?>
        <?php } ?>
        <!-- END LEFT SIDEBAR NAV-->
        <!-- START CONTENT -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- START HEADER -->
                <?php
                include "header-tiket.php";
                ?>
                <div class="container-fluid">
                    <div id="isi">
                        <?php
                        $id_check = "";
                        if (isset($_POST['id_chek'])) {
                            $id_check = $_POST['id_chek'];
                        } elseif (isset($_GET['id_chek'])) {
                            $id_check = $_GET['id_chek'];
                        }
                        ?>
                        <h3>Id = <?php echo $id_check; ?></h3>
                    </div>
                    <div class="card-body">
                        <!-- <form action="process_save_rule.php" method="POST" enctype="multipart/form-data"> -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Display</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tampil = mysqli_query($koneksi, "SELECT * FROM permissions");
                                $count = mysqli_num_rows($tampil);
                                while ($row = mysqli_fetch_array($tampil)) {
                                    echo "<tr>";
                                    echo "<input type='hidden' name='permission_" . $row['id'] . "' value='" . $row['id'] . "' >
                                        <th scope='row'>" . $no++ . "</th>";
                                    echo "<td>" . $row['display_name'] . "</td>";
                                    echo "
                                        <input type='hidden' name='id_" . $row['id'] . "' value='" . $row['id'] . "' >
                                        <td>" . $row['name'] . "</td>";
                                    $active = "";
                                    $check_active = mysqli_query($koneksi, "SELECT * FROM permission_user where user_id = '" . $id_check . "' and permission_id = '" . $row['id'] . "'   ");
                                    if ($check_active !== false) {
                                        $glow = mysqli_fetch_assoc($check_active);
                                        if ($glow !== null) {
                                            $active = "warning";
                                            $desc = "Active";
                                        } else {
                                            $active = "primary";
                                            $desc = "Not Active";
                                        }
                                    }
                                    echo "<td><form action='process_save_line.php' method='POST' enctype='multipart/form-data'>      
                                    <div class='form-check form-switch'>
                                    <input type='hidden' name='id_user' value='" .  $id_check . "'>
                                    <input type='hidden' name='check_line' value='" . $row['id'] . "'>
                                    <button class='btn btn-$active ' id=''>" . $desc . "</button>
                                    </form></div></td>";
                                    echo "</tr>";
                                }
                                // $total = mysqli_num_rows($tampil);
                                ?>
                            </tbody>
                        </table>
                        <form action="process_save_rule.php" method="POST" enctype="multipart/form-data">
                            <div>
                                <input type="hidden" name="type_check" value="centang_semua">
                                <input type="hidden" name="id_user" value="<?php echo $id_check ?>">
                                <input type="hidden" name="count" value="<?php echo $count ?>">
                                <button type="submit" class="btn btn-warning">Centang Semua</button>
                            </div>
                        </form>

                        <form action="process_save_rule.php" method="POST" enctype="multipart/form-data">
                            <div class="mt-3">
                                <input type="hidden" name="type_check" value="hapus_semua">
                                <input type="hidden" name="id_user" value="<?php echo $id_check ?>">
                                <input type="hidden" name="count" value="<?php echo $count ?>">
                                <button type="submit" class="btn btn-danger">Hapus Semua</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- END MAIN -->

            <!-- START FOOTER -->
            <?php include "footer-menu.php"; ?>
            <!-- END FOOTER -->
        </div>
        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="../logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

        <!-- sparkline -->
        <script type="text/javascript" src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script type="text/javascript" src="js/plugins/sparkline/sparkline-script.js"></script>

        <script>
            var mohonid = $('#check_value').val();

            $.ajax({
                type: "POST",
                url: "process_permission.php",
                data: {
                    mohonid: mohonid
                },
                cache: false,
                success: function(data) {

                    var jsonObjectcheck = JSON.parse(data);

                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        </script>
    </body>

    </html>