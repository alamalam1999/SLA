<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!--  start sidebar -->
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
        <!-- end sidebar  -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!--  Top Bar start -->
                <?php
                include "header-tiket.php";
                ?>
                <!-- Top Bar end -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Ticket</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <?php $tampil = mysqli_query($koneksi, "select * from tiket where status='new'");
                                            $total = mysqli_num_rows($tampil);
                                            ?>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tiket Baru</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total; ?></div>
                                        </div>
                                        <div class="card-action  red darken-2">
                                            <div id="clients-bar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <?php $tampil1 = mysqli_query($koneksi, "select * from tiket where status='proses'");
                                            $total1 = mysqli_num_rows($tampil1);
                                            ?>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Ticket Process</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total1 ?></div>
                                        </div>
                                        <div class="card-action green darken-2">
                                            <div id="sales-compositebar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <?php $tampil2 = mysqli_query($koneksi, "select * from tiket where status='close'");
                                            $total2 = mysqli_num_rows($tampil2);
                                            ?>
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ticket Done</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total2; ?></div>
                                        </div>
                                        <div class="card-action blue darken-2">
                                            <div id="profit-tristate"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <?php $tampil3 = mysqli_query($koneksi, "select * from tiket order by id_tiket");
                                            $total3 = mysqli_num_rows($tampil3);
                                            ?>
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Ticket</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total3; ?></div>
                                        </div>
                                        <div class="card-action deep-purple darken-2">
                                            <div id="bar-chart-sample"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">New Ticket Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <ul id="projects-collection" class="collection">
                                        <li class="collection-item avatar">
                                            <i class="mdi-alert-error circle red darken-2"></i>
                                            <span class="collection-header">Tiket Baru</span>
                                            <p>Status <b style="color: red;">New</b></p>
                                            <!-- <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>-->
                                        </li>
                                        <?php


                                        $tanggal = date("Y-m-d");
                                        $query = "SELECT * FROM tiket WHERE status='new' and departemen in('" . implode("','", $test->$group()) . "') ORDER BY tanggal DESC limit 7";
                                        $tampil = mysqli_query($koneksi, $query);


                                        ?>
                                        <?php
                                        $no = 0;
                                        while ($data = mysqli_fetch_array($tampil)) {
                                            $no++; ?>
                                            <li class="collection-item">
                                                <div class="row">
                                                    <div class="col s9">
                                                        <p class="collections-title"><?php echo $no; ?>. <?php echo $data['nama']; ?> | <?php echo $data['departemen']; ?></p>
                                                        <p class="collections-content">Problem : <?php echo $data['problem']; ?></p>
                                                    </div>
                                                    <div class="col s3">
                                                        <?php if ($data['status'] == "new") {
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
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Process Ticket</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <ul id="projects-collection" class="collection">
                                        <li class="collection-item avatar">
                                            <i class="mdi-av-play-circle-fill circle green darken-2"></i>
                                            <span class="collection-header">Tiket Proses</span>
                                            <p>Status <b style="color: green;">Process</b></p>
                                            <!-- <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>-->
                                        </li>
                                        <?php
                                        $tanggal = date("Y-m-d");
                                        $query = "SELECT * FROM tiket WHERE status='proses' limit 7";
                                        $tampil = mysqli_query($koneksi, $query) or die(mysqli_error());
                                        ?>
                                        <?php
                                        $no = 0;
                                        while ($data = mysqli_fetch_array($tampil)) {
                                            $no++; ?>
                                            <li class="collection-item">
                                                <div class="row">
                                                    <div class="col s9">
                                                        <p class="collections-title"><?php echo $no; ?>. <?php echo $data['nama']; ?> | <?php echo $data['departemen']; ?></p>
                                                        <p class="collections-content">Problem : <?php echo $data['problem']; ?></p>
                                                    </div>
                                                    <div class="col s3">
                                                        <?php if ($data['status'] == "proses") {
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
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Ticket Complete</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <ul id="issues-collection" class="collection">
                                        <li class="collection-item avatar">
                                            <i class="mdi-toggle-check-box circle light-blue darken-2"></i>
                                            <span class="collection-header">Tiket Selesai</span>
                                            <p>Status <b style="color: blue;">Close</b></p>
                                            <!-- <a href="#" class="secondary    -content"><i class="mdi-action-grade"></i></a> -->
                                        </li>
                                        <?php
                                        $tanggal = date("Y-m-d");
                                        $query1 = "SELECT * FROM tiket WHERE status='close' limit 7";
                                        $tampil1 = mysqli_query($koneksi, $query1) or die(mysqli_error());
                                        ?>
                                        <?php
                                        $no = 0;
                                        while ($data1 = mysqli_fetch_array($tampil1)) {
                                            $no++; ?>
                                            <li class="collection-item">
                                                <div class="row">
                                                    <div class="col s9">
                                                        <p class="collections-title"><?php echo $no; ?>. <?php echo $data1['nama']; ?> | <?php echo $data1['departemen']; ?></p>
                                                        <p class="collections-content">Problem : <?php echo $data1['problem']; ?></p>
                                                        <p class="collections-content">Penanganan : <?php echo $data1['penanganan']; ?></p>
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
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include "footer-menu.php";
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

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


    </body>

    </html>