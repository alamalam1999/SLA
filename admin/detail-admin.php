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

        <!--start container-->
        <div class="container-fluid">
          <?php
          $query = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$_GET[id]'");
          $data  = mysqli_fetch_array($query);
          ?>
          <div class="row">
            <div class="col s12 m12 l6">

              <div class="table table-responsive">
                <table id="example" class="table table-hover table-bordered">
                  <tr>
                    <td>User Id</td>
                    <td><?php echo $data['user_id']; ?></td>
                    <td rowspan="6">
                      <div class="pull-right image">
                        <img src="<?php echo $data['gambar']; ?>" class="img-rounded" height="300" width="250" alt="User Image" style="border: 3px solid #666; border-radius: 2px;" />
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td width="250">Username</td>
                    <td width="565" colspan="1"><?php echo $data['username']; ?></td>
                  </tr>
                  <tr>
                    <td>Password</td>
                    <td><?php echo $data['password']; ?></td>
                  </tr>
                  <tr>
                    <td>Fullname</td>
                    <td><?php echo $data['fullname']; ?></td>
                  </tr>
                  <tr>
                    <td>No HP</td>
                    </td>
                    <td><?php echo $data['no_hp']; ?></td>
                  </tr>
                  <tr>
                    <td>Level</td>
                    <td><?php echo $data['level']; ?></td>
                  </tr>
                </table>
                <div class="text-right">
                  <a href="admin.php" class="btn btn-sm btn-warning">Kembali <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <!--end container-->
        </div>
        <!-- END CONTENT -->

      </div>
      <!-- END WRAPPER -->
      <!-- START FOOTER -->
      <?php include "footer-menu.php"; ?>
      <!-- END FOOTER -->
    </div>
    <!-- END WRAPPER -->
    </div>

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
          "processing": true,
          "serverSide": true,
          "ajax": {
            url: "ajax-grid-data2.php", // json datasource
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