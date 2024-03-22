<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['username'])){
	header('location:../index.php');	
} else {
	include "../conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 1.0
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<?php include "head.php"; ?>

<body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START HEADER -->
    <?php include "header.php"; ?>
    <!-- END HEADER -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">

            <!-- START LEFT SIDEBAR NAV-->
            <?php include "menu.php"; ?>
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

            <!-- //////////////////////////////////////////////////////////////////////////// -->

            <!-- START CONTENT -->
            <section id="content">

               <!--card stats start-->
                    <div id="card-stats">
                        <div class="row">
                        <?php $tampil=mysqli_query($koneksi, "select * from tiket where status='new'");
                        $total=mysqli_num_rows($tampil);
                        ?>
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content  red white-text">
                                        <p class="card-stats-title"><i class="mdi-social-group-add"></i> Tiket Baru</p>
                                        <h4 class="card-stats-number"><?php echo $total; ?></h4>
                                        <p class="card-stats-compare"><!-- <i class="mdi-hardware-keyboard-arrow-up"></i> --> <span class="green-text text-lighten-5">Belum Ditangani</span>
                                        </p>
                                    </div>
                                    <div class="card-action  red darken-2">
                                        <div id="clients-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <?php $tampil1=mysqli_query($koneksi, "select * from tiket where status='proses'");
                        $total1=mysqli_num_rows($tampil1);
                        ?>
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content green white-text">
                                        <p class="card-stats-title"><i class="mdi-social-group-add"></i> Tiket Proses</p>
                                        <h4 class="card-stats-number"><?php echo $total1 ?></h4>
                                        <p class="card-stats-compare"><!-- <i class="mdi-hardware-keyboard-arrow-up"></i> --> <span class="purple-text text-lighten-5">Sedang Ditangani</span>
                                        </p>
                                    </div>
                                    <div class="card-action green darken-2">
                                        <div id="sales-compositebar"></div>

                                    </div>
                                </div>
                            </div>
                            <?php $tampil2=mysqli_query($koneksi, "select * from tiket where status='close'");
                        $total2=mysqli_num_rows($tampil2);
                        ?>
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content blue white-text">
                                        <p class="card-stats-title"><i class="mdi-action-trending-up"></i> Tiket Selesai</p>
                                        <h4 class="card-stats-number"><?php echo $total2; ?></h4>
                                        <p class="card-stats-compare"><!-- <i class="mdi-hardware-keyboard-arrow-up"></i> --> <span class="blue-grey-text text-lighten-5">Sudah Ditangani</span>
                                        </p>
                                    </div>
                                    <div class="card-action blue darken-2">
                                        <div id="profit-tristate"></div>
                                    </div>
                                </div>
                            </div>
                            <?php $tampil3=mysqli_query($koneksi, "select * from tiket order by id_tiket");
                        $total3=mysqli_num_rows($tampil3);
                        ?>
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content deep-purple white-text">
                                        <p class="card-stats-title"><i class="mdi-editor-insert-drive-file"></i> Total Tiket Masuk</p>
                                        <h4 class="card-stats-number"><?php echo $total3; ?></h4>
                                        <p class="card-stats-compare"><!-- <i class="mdi-hardware-keyboard-arrow-down"></i> 3% --><span class="deep-purple-text text-lighten-5">Jumlah Permasalahan</span>
                                        </p>
                                    </div>
                                    <div class="card-action  deep-purple darken-2">
                                        <div id="invoice-line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--card stats end-->

                    <!-- //////////////////////////////////////////////////////////////////////////// -->

                    <!--card widgets start-->
         <!--           <div id="card-widgets">
                        <div class="row">

                            <div class="col s12 m4 14">
                                <ul id="task-card" class="collection with-header">
                                    <li class="collection-header cyan">
                                        <h4 class="task-card-title">My Task</h4>
                                        <p class="task-card-date">March 26, 2015</p>
                                    </li>
                                    <li class="collection-item dismissable">
                                        <input type="checkbox" id="task1" />
                                        <label for="task1">Create Mobile App UI. <a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                                        </label>
                                        <span class="task-cat teal">Mobile App</span>
                                    </li>
                                    <li class="collection-item dismissable">
                                        <input type="checkbox" id="task2" />
                                        <label for="task2">Check the new API standerds. <a href="#" class="secondary-content"><span class="ultra-small">Monday</span></a>
                                        </label>
                                        <span class="task-cat purple">Web API</span>
                                    </li>
                                    <li class="collection-item dismissable">
                                        <input type="checkbox" id="task3" checked="checked" />
                                        <label for="task3">Check the new Mockup of ABC. <a href="#" class="secondary-content"><span class="ultra-small">Wednesday</span></a>
                                        </label>
                                        <span class="task-cat pink">Mockup</span>
                                    </li>
                                    <li class="collection-item dismissable">
                                        <input type="checkbox" id="task4" checked="checked" disabled="disabled" />
                                        <label for="task4">I did it !</label>
                                        <span class="task-cat cyan">Mobile App</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="col s12 m4 14">
                                <ul id="task-card" class="collection with-header">
                                    <li class="collection-header cyan">
                                        <h4 class="task-card-title">My Task</h4>
                                        <p class="task-card-date">March 26, 2015</p>
                                    </li>
                                    <li class="collection-item dismissable">
                                        <input type="checkbox" id="task1" />
                                        <label for="task1">Create Mobile App UI. <a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                                        </label>
                                        <span class="task-cat teal">Mobile App</span>
                                    </li>
                                    <li class="collection-item dismissable">
                                        <input type="checkbox" id="task2" />
                                        <label for="task2">Check the new API standerds. <a href="#" class="secondary-content"><span class="ultra-small">Monday</span></a>
                                        </label>
                                        <span class="task-cat purple">Web API</span>
                                    </li>
                                    <li class="collection-item dismissable">
                                        <input type="checkbox" id="task3" checked="checked" />
                                        <label for="task3">Check the new Mockup of ABC. <a href="#" class="secondary-content"><span class="ultra-small">Wednesday</span></a>
                                        </label>
                                        <span class="task-cat pink">Mockup</span>
                                    </li>
                                    <li class="collection-item dismissable">
                                        <input type="checkbox" id="task4" checked="checked" disabled="disabled" />
                                        <label for="task4">I did it !</label>
                                        <span class="task-cat cyan">Mobile App</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="col s12 m4 l4">
                                <div id="profile-card" class="card">
                                    <div class="card-image waves-effect waves-block waves-light">
                                        <img class="activator" src="images/user-bg.jpg" alt="user background">
                                    </div>
                                    <div class="card-content">
                                        <img src="images/avatar.jpg" alt="" class="circle responsive-img activator card-profile-image">
                                        <a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right">
                                            <i class="mdi-editor-mode-edit"></i>
                                        </a>

                                        <span class="card-title activator grey-text text-darken-4">Roger Waters</span>
                                        <p><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Project Manager</p>
                                        <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> +1 (612) 222 8989</p>
                                        <p><i class="mdi-communication-email cyan-text text-darken-2"></i> mail@domain.com</p>

                                    </div>
                                    <div class="card-reveal">
                                        <span class="card-title grey-text text-darken-4">Roger Waters <i class="mdi-navigation-close right"></i></span>
                                        <p>Here is some more information about this card.</p>
                                        <p><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Project Manager</p>
                                        <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> +1 (612) 222 8989</p>
                                        <p><i class="mdi-communication-email cyan-text text-darken-2"></i> mail@domain.com</p>
                                        <p><i class="mdi-social-cake cyan-text text-darken-2"></i> 18th June 1990</p>
                                        <p><i class="mdi-device-airplanemode-on cyan-text text-darken-2"></i> BAR - AUS</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>-->
                    <!--card widgets end-->

                    <!-- //////////////////////////////////////////////////////////////////////////// -->

                    <!--work collections start-->
                    <!--<div id="work-collections">-->
                    <!--    <div class="row">-->
                            
                            
                         <div id="work-collections">
                        <div class="row">
                            <div class="col s12 m12 l4">
                                <ul id="projects-collection" class="collection">
                                    <li class="collection-item avatar">
                                        <i class="mdi-alert-error circle red darken-2"></i>
                                        <span class="collection-header">Tiket Baru</span>
                                        <p>Status <b style="color: red;">New</b></p>
                                        <!-- <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>-->
                                    </li>
                                    <?php
                    $tanggal = date("Y-m-d");
                    $query= "SELECT * FROM tiket WHERE status='new' limit 7";
                    $tampil=mysqli_query($koneksi, $query) or die(mysqli_error());
                    ?>
                    <?php 
                    $no=0;
                    while($data=mysqli_fetch_array($tampil))
                    { $no++; ?>
                                    <li class="collection-item">
                                        <div class="row">
                                            <div class="col s9">
                                                <p class="collections-title"><?php echo $no; ?>. <?php echo $data['nama']; ?> | <?php echo $data['departemen']; ?></p>
                                                <p class="collections-content">Problem : <?php echo $data['problem']; ?></p>
                                            </div>
                                            <div class="col s3">
                                            <?php if($data['status'] == "new" ){
                                                 echo "<span class='task-cat pink'>Tiket $data[status]</span>";
                                                 } else if ($data['status'] == "close"){
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
                            <div class="col s12 m12 l4">
                                <ul id="projects-collection" class="collection">
                                    <li class="collection-item avatar">
                                        <i class="mdi-av-play-circle-fill circle green darken-2"></i>
                                        <span class="collection-header">Tiket Proses</span>
                                        <p>Status <b style="color: green;">Process</b></p>
                                        <!-- <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>-->
                                    </li>
                                    <?php
                    $tanggal = date("Y-m-d");
                    $query= "SELECT * FROM tiket WHERE status='proses' limit 7";
                    $tampil=mysqli_query($koneksi, $query) or die(mysqli_error());
                    ?>
                    <?php 
                    $no=0;
                    while($data=mysqli_fetch_array($tampil))
                    { $no++; ?>
                                    <li class="collection-item">
                                        <div class="row">
                                            <div class="col s9">
                                                <p class="collections-title"><?php echo $no; ?>. <?php echo $data['nama']; ?> | <?php echo $data['departemen']; ?></p>
                                                <p class="collections-content">Problem : <?php echo $data['problem']; ?></p>
                                            </div>
                                            <div class="col s3">
                                            <?php if($data['status'] == "proses" ){
                                                 echo "<span class='task-cat pink'>Tiket $data[status]</span>";
                                                 } else if ($data['status'] == "close"){
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
                            
                            
                            <div class="col s12 m12 l4">
                                <ul id="issues-collection" class="collection">
                                    <li class="collection-item avatar">
                                        <i class="mdi-toggle-check-box circle light-blue darken-2"></i>
                                        <span class="collection-header">Tiket Selesai</span>
                                        <p>Status <b style="color: blue;">Close</b></p>
                                        <!-- <a href="#" class="secondary    -content"><i class="mdi-action-grade"></i></a> -->
                                    </li>
                    <?php
                    $tanggal = date("Y-m-d");
                    $query1= "SELECT * FROM tiket WHERE status='close' limit 7";
                    $tampil1=mysqli_query($koneksi, $query1) or die(mysqli_error());
                    ?>
                    <?php 
                    $no=0;
                    while($data1=mysqli_fetch_array($tampil1))
                    { $no++; ?>
                                    <li class="collection-item">
                                        <div class="row">
                                            <div class="col s9">
                                                <p class="collections-title"><?php echo $no; ?>. <?php echo $data1['nama']; ?> | <?php echo $data1['departemen']; ?></p>
                                                <p class="collections-content">Problem :    <?php echo $data1['problem']; ?></p>
                                                <p class="collections-content">Penanganan : <?php echo $data1['penanganan']; ?></p>
                                            </div>
                                            <div class="col s3">
                                            <?php if($data1['status'] == "open" ){
                                                 echo "<span class='task-cat pink'>Tiket $data1[status]</span>";
                                                 } else if ($data1['status'] == "close"){
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
                <!--end container-->
            </section>
            <!-- END CONTENT -->

            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- START RIGHT SIDEBAR NAV-->
            <aside id="right-sidebar-nav">
                <ul id="chat-out" class="side-nav rightside-navigation">
                    <li class="li-hover">
                    <a href="#" data-activates="chat-out" class="chat-close-collapse right"><i class="mdi-navigation-close"></i></a>
                    <div id="right-search" class="row">
                        <form class="col s12">
                            <div class="input-field">
                                <i class="mdi-action-search prefix"></i>
                                <input id="icon_prefix" type="text" class="validate">
                                <label for="icon_prefix">Search</label>
                            </div>
                        </form>
                    </div>
                    </li>
                    <li class="li-hover">
                        <ul class="chat-collapsible" data-collapsible="expandable">
                        <li>
                            <div class="collapsible-header teal white-text active"><i class="mdi-social-whatshot"></i>Recent Activity</div>
                            <div class="collapsible-body recent-activity">
                                <div class="recent-activity-list chat-out-list row">
                                    <div class="col s3 recent-activity-list-icon"><i class="mdi-action-add-shopping-cart"></i>
                                    </div>
                                    <div class="col s9 recent-activity-list-text">
                                        <a href="#">just now</a>
                                        <p>Jim Doe Purchased new equipments for zonal office.</p>
                                    </div>
                                </div>
                                <div class="recent-activity-list chat-out-list row">
                                    <div class="col s3 recent-activity-list-icon"><i class="mdi-device-airplanemode-on"></i>
                                    </div>
                                    <div class="col s9 recent-activity-list-text">
                                        <a href="#">Yesterday</a>
                                        <p>Your Next flight for USA will be on 15th August 2015.</p>
                                    </div>
                                </div>
                                <div class="recent-activity-list chat-out-list row">
                                    <div class="col s3 recent-activity-list-icon"><i class="mdi-action-settings-voice"></i>
                                    </div>
                                    <div class="col s9 recent-activity-list-text">
                                        <a href="#">5 Days Ago</a>
                                        <p>Natalya Parker Send you a voice mail for next conference.</p>
                                    </div>
                                </div>
                                <div class="recent-activity-list chat-out-list row">
                                    <div class="col s3 recent-activity-list-icon"><i class="mdi-action-store"></i>
                                    </div>
                                    <div class="col s9 recent-activity-list-text">
                                        <a href="#">Last Week</a>
                                        <p>Jessy Jay open a new store at S.G Road.</p>
                                    </div>
                                </div>
                                <div class="recent-activity-list chat-out-list row">
                                    <div class="col s3 recent-activity-list-icon"><i class="mdi-action-settings-voice"></i>
                                    </div>
                                    <div class="col s9 recent-activity-list-text">
                                        <a href="#">5 Days Ago</a>
                                        <p>Natalya Parker Send you a voice mail for next conference.</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header light-blue white-text active"><i class="mdi-editor-attach-money"></i>Sales Repoart</div>
                            <div class="collapsible-body sales-repoart">
                                <div class="sales-repoart-list  chat-out-list row">
                                    <div class="col s8">Target Salse</div>
                                    <div class="col s4"><span id="sales-line-1"></span>
                                    </div>
                                </div>
                                <div class="sales-repoart-list chat-out-list row">
                                    <div class="col s8">Payment Due</div>
                                    <div class="col s4"><span id="sales-bar-1"></span>
                                    </div>
                                </div>
                                <div class="sales-repoart-list chat-out-list row">
                                    <div class="col s8">Total Delivery</div>
                                    <div class="col s4"><span id="sales-line-2"></span>
                                    </div>
                                </div>
                                <div class="sales-repoart-list chat-out-list row">
                                    <div class="col s8">Total Progress</div>
                                    <div class="col s4"><span id="sales-bar-2"></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header red white-text"><i class="mdi-action-stars"></i>Favorite Associates</div>
                            <div class="collapsible-body favorite-associates">
                                <div class="favorite-associate-list chat-out-list row">
                                    <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                                    </div>
                                    <div class="col s8">
                                        <p>Eileen Sideways</p>
                                        <p class="place">Los Angeles, CA</p>
                                    </div>
                                </div>
                                <div class="favorite-associate-list chat-out-list row">
                                    <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                                    </div>
                                    <div class="col s8">
                                        <p>Zaham Sindil</p>
                                        <p class="place">San Francisco, CA</p>
                                    </div>
                                </div>
                                <div class="favorite-associate-list chat-out-list row">
                                    <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                                    </div>
                                    <div class="col s8">
                                        <p>Renov Leongal</p>
                                        <p class="place">Cebu City, Philippines</p>
                                    </div>
                                </div>
                                <div class="favorite-associate-list chat-out-list row">
                                    <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                                    </div>
                                    <div class="col s8">
                                        <p>Weno Carasbong</p>
                                        <p>Tokyo, Japan</p>
                                    </div>
                                </div>
                                <div class="favorite-associate-list chat-out-list row">
                                    <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                                    </div>
                                    <div class="col s8">
                                        <p>Nusja Nawancali</p>
                                        <p class="place">Bangkok, Thailand</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <!-- LEFT RIGHT SIDEBAR NAV-->

        </div>
        <!-- END WRAPPER -->

    </div>
    <!-- END MAIN -->



    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START FOOTER -->
    <?php include "footer.php"; ?>
    <!-- END FOOTER -->


    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
       

    <!-- chartist -->
    <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>   

    <!-- chartjs -->
    <script type="text/javascript" src="js/plugins/chartjs/chart.min.js"></script>
    <script type="text/javascript" src="js/plugins/chartjs/chart-script.js"></script>

    <!-- sparkline -->
    <script type="text/javascript" src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="js/plugins/sparkline/sparkline-script.js"></script>
    
    <!--jvectormap-->
    <script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="js/plugins/jvectormap/vectormap-script.js"></script>
    
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.js"></script>
    <!-- Toast Notification -->
    <script type="text/javascript">
    // Toast Notification
    $(window).load(function() {
        setTimeout(function() {
            Materialize.toast('<span>Hiya! I am a toast.</span>', 1500);
        }, 3000);
        setTimeout(function() {
            Materialize.toast('<span>You can swipe me too!</span>', 3000);
        }, 5500);
        setTimeout(function() {
            Materialize.toast('<span>You have new order.</span><a class="btn-flat yellow-text" href="#">Read<a>', 3000);
        }, 18000);
    });
    
    </script>
</body>

</html>