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
          <div class="text-center">
            <?php
            $kd = $_GET['id'];
            $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$kd'");
            if (mysqli_num_rows($sql) == 0) {
              header("Location: admin.php");
            } else {
              $row = mysqli_fetch_assoc($sql);
            }
            if (isset($_POST['update'])) {
              $user_id = $_POST['user_id'];
              $username = $_POST['username'];
              $password = $_POST['password'];
              $fullname = $_POST['fullname'];
              $no_hp = $_POST['no_hp'];
              $level = $_POST['level'];

              $password = password_hash($password, PASSWORD_DEFAULT);

              $update = mysqli_query($koneksi, "UPDATE user SET username='$username', password='$password', fullname='$fullname', no_hp='$no_hp', level='$level' WHERE user_id='$kd'");
              if ($update) {
                echo '<script>sweetAlert({
                                                     title: "Berhasil!", 
                                                        text: "Data Berhasil di update!", 
                                                        type: "success"
                                                        });</script>';

                header('refresh: 3');
              } else {
                echo '<script>sweetAlert({
                                                     title: "Gagal!", 
                                                        text: "Data Gagal di update, silahakan coba lagi!", 
                                                        type: "error"
                                                        });</script>';
              }
            }

            ?>
            <div class="col s8 m8 l6">
              <div class="card-body">
                <h4 class="header2">Edit Status Tiket Helpdeks</h4>
                <div class="row">
                  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="col s12">

                    <input class="form-control" id="user_id" name="user_id" type="text" value="<?php echo $row['user_id'] ?>" readonly="readonly">
                    <label for="User ID">User ID</label>


                    <input class="form-control" id="username" name="username" type="text" value="<?php echo $row['username'] ?>" autocomplete="off" required="required">
                    <label for="Username">Username</label>


                    <input class="form-control" id="password" name="password" type="text" value="<?php echo $row['password'] ?>" autocomplete="off" required="required">
                    <label for="Password">Password</label>


                    <input class="form-control" id="fullname" name="fullname" type="text" value="<?php echo $row['fullname'] ?>" autocomplete="off" required="required">
                    <label for="Nama">Nama</label>


                    <input class="form-control" id="no_hp" name="no_hp" type="text" value="<?php echo $row['no_hp'] ?>" autocomplete="off" required="required">
                    <label for="No Hp">No HP</label>

                    <select class="form-control" name="level" required>
                      <option id="level" value="<?php echo $row['level'] ?>"><?php echo $row['level'] ?></option>
                      <option value="Admin">Admin</option>
                      <option value="User">User</option>
                    </select>

                    <div class="mt-3">
                      <img src="<?php echo $row['gambar']; ?>" height="220" width="175" style="border: 3px solid #666; border-radius: 5px;" />
                    </div>

                    <div class="mt-3">
                      <button class="btn btn-primary cyan waves-effect waves-light right" type="submit" name="update" id="update">Submit</button>
                      <a href="admin.php" class="btn btn-warning orange waves-effect waves-light right" type="submit" name="input" id="update">Kembali</a>
                    </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="div_id">

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

    <!-- sparkline -->
    <script type="text/javascript" src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="js/plugins/sparkline/sparkline-script.js"></script>
  </body>

  <script>
    $.ajax({
      type: "GET",
      url: "process.php",
      dataType: "json",
      success: function(data) {
        var jsonObjectcheck = JSON.parse(data);
        $('#user_id').val(jsonObjectcheck.user_id);
        $('#username').val(jsonObjectcheck.username);
        $('#password').val(jsonObjectcheck.password);
        $('#fullname').val(jsonObjectcheck.fullname);
        $("#level").val(jsonObjectcheck.level).text(jsonObjectcheck.level);
        $('#no_hp').val(jsonObjectcheck.no_hp);
        alert('acumalaka');
      }
    });
  </script>

  </html>