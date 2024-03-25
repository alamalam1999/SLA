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
                    <!--start container-->
                    <div class="container">
                        <!--card stats start-->
                        <div id="card-stats">
                            <div class="row">
                                <?php $tampil = mysqli_query($koneksi, "select * from tiket_gsuite where status='open'");
                                $total = mysqli_num_rows($tampil);
                                ?>
                                <div class="col s12 m6 l3">
                                    <div class="card">
                                        <div class="card-content  green white-text">
                                            <p class="card-stats-title"><i class="mdi-social-group-add"></i> Tiket Baru</p>
                                            <h4 class="card-stats-number"><?php echo $total; ?></h4>
                                            <p class="card-stats-compare"><!-- <i class="mdi-hardware-keyboard-arrow-up"></i> --> <span class="green-text text-lighten-5">Belum Ditangani</span>
                                            </p>
                                        </div>
                                        <div class="card-action  green darken-2">
                                            <div id="clients-bar"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php $tampil1 = mysqli_query($koneksi, "select * from tiket_gsuite where status='close'");
                                $total1 = mysqli_num_rows($tampil1);
                                ?>
                                <div class="col s12 m6 l3">
                                    <div class="card">
                                        <div class="card-content purple white-text">
                                            <p class="card-stats-title"><i class="mdi-social-group-add"></i> Tiket Selesai</p>
                                            <h4 class="card-stats-number"><?php echo $total1 ?></h4>
                                            <p class="card-stats-compare"><!-- <i class="mdi-hardware-keyboard-arrow-up"></i> --> <span class="purple-text text-lighten-5">Sudah Ditangani</span>
                                            </p>
                                        </div>
                                        <div class="card-action purple darken-2">
                                            <div id="sales-compositebar"></div>

                                        </div>
                                    </div>
                                </div>
                                <?php $tampil2 = mysqli_query($koneksi, "select * from tiket_gsuite order by id_tiket");
                                $total2 = mysqli_num_rows($tampil2);
                                ?>
                                <div class="col s12 m6 l3">
                                    <div class="card">
                                        <div class="card-content blue-grey white-text">
                                            <p class="card-stats-title"><i class="mdi-action-trending-up"></i> Tiket</p>
                                            <h4 class="card-stats-number"><?php echo $total2; ?></h4>
                                            <p class="card-stats-compare"><!-- <i class="mdi-hardware-keyboard-arrow-up"></i> --> <span class="blue-grey-text text-lighten-5">Total Tiket Masuk</span>
                                            </p>
                                        </div>
                                        <div class="card-action blue-grey darken-2">
                                            <div id="profit-tristate"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php $tampil3 = mysqli_query($koneksi, "select * from user order by user_id");
                                $total3 = mysqli_num_rows($tampil3);
                                ?>
                                <div class="col s12 m6 l3">
                                    <div class="card">
                                        <div class="card-content deep-purple white-text">
                                            <p class="card-stats-title"><i class="mdi-editor-insert-drive-file"></i> Admin</p>
                                            <h4 class="card-stats-number"><?php echo $total3; ?></h4>
                                            <p class="card-stats-compare"><!-- <i class="mdi-hardware-keyboard-arrow-down"></i> 3% --><span class="deep-purple-text text-lighten-5">Users</span>
                                            </p>
                                        </div>
                                        <div class="card-action  deep-purple darken-2">
                                            <div id="invoice-line"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="work-collections">
                            <div class="row">
                                <div class="col s12 m12 l6">
                                    <ul id="projects-collection" class="collection">
                                        <li class="collection-item avatar">
                                            <i class="mdi-action-bug-report circle red darken-2"></i>
                                            <span class="collection-header">Task Tiket</span>
                                            <?php
                                            echo $_SESSION['username'];
                                            ?>
                                            <p>Status <b style="color: red;">New</b></p>
                                            <!-- <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>-->
                                        </li>
                                        <?php
                                        $tanggal = date("Y-m-d");
                                        $query = "SELECT * FROM tiket_gsuite WHERE status='new' limit 5";
                                        $tampil = mysqli_query($koneksi, $query) or die(mysqli_error());
                                        ?>
                                        <?php
                                        $no = 0;
                                        while ($data = mysqli_fetch_array($tampil)) {
                                            $no++; ?>
                                            <li class="collection-item">
                                                <div class="row">
                                                    <div class="col s9">
                                                        <?php
                                                        $kind = '';
                                                        if ($data["name"] == 3) {
                                                            $kind = 'Pembuatan Akun G-Suite';
                                                        } else if ($data["name"] == 2) {
                                                            $kind = 'Lupa Password';
                                                        } else {
                                                            $kind = 'Akun Ditangguhkan';
                                                        }
                                                        ?>
                                                        <p class="collections-title"><?php echo $no; ?>. <?php echo $kind; ?> | <?php echo $data["tanggal"]; ?></p>
                                                        <p class="collections-content">Problem : <?php echo $data['email']; ?></p>
                                                    </div>
                                                    <div class="col s3">
                                                        <?php if ($data['status'] == "open") {
                                                            echo "<span class='task-cat pink'>Tiket $data[status]</span>";
                                                        } else if ($data['status'] == "close") {
                                                            echo "<span class='task-cat teal'>Tiket $data[status]</span>";
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="col s12 m12 l6">
                                    <ul id="issues-collection" class="collection">
                                        <li class="collection-item avatar">
                                            <i class="mdi-file-folder circle light-blue darken-2"></i>
                                            <span class="collection-header">Task Tiket</span>
                                            <p>Status <b style="color: blue;">Close</b></p>
                                            <!-- <a href="#" class="secondary    -content"><i class="mdi-action-grade"></i></a> -->
                                        </li>
                                        <?php
                                        $tanggal = date("Y-m-d");
                                        $query1 = "SELECT * FROM tiket_gsuite WHERE status='close' limit 7";
                                        $tampil1 = mysqli_query($koneksi, $query1) or die(mysqli_error());
                                        ?>
                                        <?php
                                        $no = 0;
                                        while ($data1 = mysqli_fetch_array($tampil1)) {
                                            $no++; ?>
                                            <li class="collection-item">
                                                <div class="row">
                                                    <div class="col s9">
                                                        <?php
                                                        $kind = '';
                                                        if ($data1["name"] == 3) {
                                                            $kind = 'Pembuatan Akun G-Suite';
                                                        } else if ($data1["name"] == 2) {
                                                            $kind = 'Lupa Password';
                                                        } else {
                                                            $kind = 'Akun Ditangguhkan';
                                                        }
                                                        ?>
                                                        <p class="collections-title"><?php echo $no; ?>. <?php echo $kind; ?> | <?php echo $data1['tanggal']; ?></p>
                                                        <p class="collections-content">Problem : <?php echo $data1['email']; ?></p>
                                                    </div>
                                                    <div class="col s3">
                                                        <?php if ($data1['status'] == "open") {
                                                            echo "<span class='task-cat pink'>Tiket $data1[status]</span>";
                                                        } else if ($data1['status'] == "close") {
                                                            echo "<span class='task-cat teal'>Tiket $data1[status]</span>";
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--work collections end-->

                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
            <!-- START FOOTER -->
            <?php include "footer-menu.php"; ?>
            <!-- END FOOTER -->
        </div>
        <!-- END WRAPPER -->
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
                        "width": "20%",
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