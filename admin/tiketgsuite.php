<?php
session_start();
if (empty($_SESSION['username'])) {
    header('location:../index.php');
} else {
    include "../conn.php";
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

            <!-- Main Content -->
            <div id="content">

                <!-- START HEADER -->
                <?php
                include "header-tiket.php";
                ?>
                <!-- END HEADER -->

                <div class="container-fluid">
                    <!--breadcrumbs start-->
                    <div id="breadcrumbs-wrapper" class=" grey lighten-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <h5 class="breadcrumbs-title">Helpdesk G-Suite</h5>
                                    <ol class="breadcrumb">
                                        <li><a href="index.php">Dashboard</a></li>
                                        <li><a href="tiket.php">Tiket</a></li>
                                    </ol>
                                </div>
                            </div>

                            <!-- main start -->
                            <?php
                            if (isset($_GET['aksi']) == 'delete') {
                                $id = $_GET['id'];
                                $cek = mysqli_query($koneksi, "SELECT * FROM tiket WHERE id_tiket='$id'");
                                if (mysqli_num_rows($cek) == 0) {
                                    echo '<script>sweetAlert({
	                                                   title: "Ups!", 
                                                        text: "Data tiket tidak ditemukan!", 
                                                        type: "error"
                                                        });</script>';
                                } else {
                                    $delete = mysqli_query($koneksi, "DELETE FROM tiket WHERE id_tiket='$id'");
                                    if ($delete) {
                                        echo '<script>sweetAlert({
	                                                   title: "Berhasil!", 
                                                        text: "Data Berhasil di hapus!", 
                                                        type: "success"
                                                        });</script>';
                                    } else {
                                        echo '<script>sweetAlert({
	                                                   title: "Gagal!", 
                                                        text: "Data gagal di hapus!", 
                                                        type: "error"
                                                        });</script>';
                                    }
                                }
                            }
                            ?>
                            <div id="table-datatables">
                                <!-- <a href="input-tiket.php" class="btn-floating btn-small waves-effect waves-light green darken-2" title="Tambah Tiket"><i class="mdi-content-add"></i></a>-->
                                <a href="tiket-export-xls.php" class="btn btn-primary mb-3" title="Export Excel"><i class="mdi-content-content-copy">Export</i></a>
                                <div class="row">
                                    <div class="col s12 m12">
                                        <table id="lookup" class="table" style="width:auto">
                                            <thead>
                                                <tr>
                                                    <th>Id Tiket</th>
                                                    <th>Tanggal</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Lokasi</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- main end -->
                        </div>
                    </div>
                    <!--breadcrumbs end-->
                </div>
            </div>
            <!-- END CONTENT -->
            <!-- START FOOTER -->
            <?php include "footer-menu.php"; ?>
            <!-- END FOOTER -->
        </div>
        <!-- END WRAPPER -->
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

        <!-- jQuery Library -->
        <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
        <!--materialize js-->
        <script type="text/javascript" src="js/materialize.js"></script>
        <!--prism-->
        <script type="text/javascript" src="js/prism.js"></script>
        <!--scrollbar-->
        <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <!-- data-tables -->
        <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>
        <!-- chartist -->
        <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>

        <!--plugins.js - Some Specific JS codes for Plugin Settings-->
        <script type="text/javascript" src="js/plugins.js"></script>

        <script>
            $(document).ready(function() {
                var dataTable = $('#lookup').DataTable({
                    "autoWidth": false,
                    "columnDefs": [{
                        "width": "60%",
                        "targets": 0
                    }],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        url: "ajax-grid-datagsuite.php", // json datasource
                        type: "post", // method  , by default get
                        error: function() { // error handling
                            $(".lookup-error").html("");
                            $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                            $("#lookup_processing").css("display", "none");
                        }
                    }
                });
            });
        </script>

    </body>

    </html>