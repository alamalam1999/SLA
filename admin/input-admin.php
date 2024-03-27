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

      <div id="content">
        <!-- START HEADER -->
        <?php
        include "header-tiket.php";
        ?>
        <div class="container-fluid">
          <!--start container-->
          <div class="container">
            <?php
            if (isset($_POST['input'])) {
              $namafolder = "gambar_admin/"; //tempat menyimpan file

              if (!empty($_FILES["nama_file"]["tmp_name"])) {
                $jenis_gambar = $_FILES['nama_file']['type'];
                // $user_id = $_POST['user_id'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $password = password_hash($password, PASSWORD_DEFAULT);

                $fullname = $_POST['fullname'];
                $no_hp = $_POST['no_hp'];
                $level = $_POST['level'];

                if ($jenis_gambar == "image/jpeg" || $jenis_gambar == "image/jpg" || $jenis_gambar == "image/gif" || $jenis_gambar == "image/x-png") {
                  $gambar = $namafolder . basename($_FILES['nama_file']['name']);
                  if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
                    $sql = "INSERT INTO user (username,password,fullname,no_hp,level,gambar) VALUES
            ('$username','$password','$fullname','$no_hp','$level','$gambar')";
                    $res = mysqli_query($koneksi, $sql) or die(mysqli_error());
                    //echo "Gambar berhasil dikirim ke direktori".$gambar;
                    echo '<script>sweetAlert({
	                                                   title: "Berhasil!", 
                                                        text: "Data Berhasil ditambahkan!", 
                                                        type: "success",
                                                        });</script>';
                  } else {
                    echo '<script>sweetAlert({
	                                                   title: "Gagal!", 
                                                        text: "Data Gagal ditambahkan!", 
                                                        type: "error",
                                                        });</script>';
                  }
                } else {
                  echo '<script>sweetAlert({
	                                                   title: "Gagal!", 
                                                        text: "Format Gambar Harus JPG!", 
                                                        type: "error",
                                                        });</script>';
                }
              } else {
                echo '<script>sweetAlert({
	                                                   title: "Gagal!", 
                                                        text: "Gambar belum di pilih!", 
                                                        type: "error",
                                                        });</script>';
              }
            }

            ?>
            <div class="col s8 m8 l6">
              <div class="card-body">
                <h4 class="mb-4">Input Data Admin</h4>
                <div class="row">
                  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="col s12">


                    <input class="form-control" id="username" name="username" type="text" autocomplete="off" required="required">
                    <label for="Username">Username</label>


                    <input class="form-control" id="password" name="password" type="text" autocomplete="off" required="required">
                    <label for="Password">Password</label>


                    <input class="form-control" id="fullname" name="fullname" type="text" autocomplete="off" required="required">
                    <label for="Nama">Nama</label>


                    <input class="form-control" id="no_hp" name="no_hp" type="text" autocomplete="off" required="required">
                    <label for="No Hp">No HP</label>



                    <select class="form-control" name="level" id="level" required>
                      <option value="">Pilih Level Akses</option>
                      <option value="Admin">Admin</option>
                      <option value="User">User</option>
                    </select>
                    <label for="level">Level</label>

                    <input class="form-control" type="file" name="nama_file" id="nama_file" required="required" placeholder="Pilih Foto">
                    <label for="fhoto">Fhoto</label>

                    <div class="mt-3">
                      <button class="btn btn-primary" type="submit" name="input" id="update">Submit
                        <i class="mdi-content-send right"></i>
                      </button>
                    </div>

                </div>
                </form>
              </div>
            </div>
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


  </body>

  </html>