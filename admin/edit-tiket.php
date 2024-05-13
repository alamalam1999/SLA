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
            <?php
            $kd = $_GET['id'];
            $sql = mysqli_query($koneksi, "SELECT * FROM tiket WHERE id_tiket='$kd'");
            if (mysqli_num_rows($sql) == 0) {
              header("Location: tiket.php");
            } else {
              $row = mysqli_fetch_assoc($sql);
            }
            if (isset($_POST['update'])) {
              $waktu = $row['waktu'];
              $id_tiket  = $_POST['id_tiket'];
              $tanggal   = $_POST['tanggal'];
              $no_hp     = $_POST['no_hp'];
              $nama      = $_POST['nama'];
              $email     = $_POST['email'];
              $departemen = $_POST['departemen'];
              $problem   = $_POST['problem'];
              $penanganan = $_POST['penanganan'];
              $status    = $_POST['status'];
              $filename = $_POST['filename'];
              $pic        = $_POST['pic'];
              $fotopengerjaan        = $_FILES['choosefile']["name"];
              $tempname              = $_FILES["choosefile"]["tmp_name"];


              $folder = "images/" . $fotopengerjaan;

              $laporan = "<h4><b>Tiket Status : $waktu</b></h4>";
              $laporan .= "<br/>";
              $laporan .= "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"0\">";
              $laporan .= "<tr>";
              $laporan .= "<td>Tanggal</td><td>:</td><td>$tanggal</td>";
              $laporan .= "</tr>";
              $laporan .= "<tr>";
              $laporan .= "<td>PC NO</td><td>:</td><td>$no_hp</td>";
              $laporan .= "</tr>";
              $laporan .= "<tr>";
              $laporan .= "<td>Nama</td><td>:</td><td>$nama</td>";
              $laporan .= "</tr>";
              $laporan .= "<tr>";
              $laporan .= "<td>Departemen</td><td>:</td><td>$departemen</td>";
              $laporan .= "</tr>";
              $laporan .= "<tr>";
              $laporan .= "<td>Problem</td><td>:</td><td>$problem</td>";
              $laporan .= "</tr>";
              $laporan .= "<tr>";
              $laporan .= "<td>Penanganan</td><td>:</td><td>$penanganan</td>";
              $laporan .= "</tr>";
              $laporan .= "<tr>";
              $laporan .= "<td>Status</td><td>:</td><td>$status</td>";
              $laporan .= "</tr>";
              $laporan .= "<tr>";
              $laporan .= "<td>Filename</td><td>:</td><td>$filename</td>";
              $laporan .= "</tr>";
              $laporan .= "<tr>";
              $laporan .= "<td>Pic</td><td>:</td><td>$pic</td>";
              $laporan .= "</tr>";


              require_once("../phpmailer/class.phpmailer.php");
              require_once("../phpmailer/class.smtp.php");

              $sendmail = new PHPMailer(true);
              $sendmail->isSMTP();                                            // Send using SMTP
              $sendmail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
              $sendmail->SMTPAuth   = true;                                   // Enable SMTP authentication
              $sendmail->Username   = 'ypap@sekolah-avicenna.sch.id';                     // SMTP username
              $sendmail->Password   = 'ypap@123';                               // SMTP password
              $sendmail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
              $sendmail->setFrom('ypap@sekolah-avicenna.sch.id', 'YPAP');
              $sendmail->addAddress("$email", "$nama"); //email tujuan
              $sendmail->addReplyTo('ypap@sekolah-avicenna.sch.id', 'YPAP');
              $sendmail->isHTML(true);                                  // Set email format to HTML
              $sendmail->Subject = "Tiket IT Helpdesk $waktu"; //subjek email
              $sendmail->Body = $laporan; //isi pesan dalam format laporan

              if (!$sendmail->Send()) {
                echo "Email gagal dikirim : " . $sendmail->ErrorInfo;
              } else {

                $update = mysqli_query($koneksi, "UPDATE tiket SET tanggal='$tanggal', no_hp='$no_hp', nama='$nama', email='$email', departemen='$departemen', problem='$problem', penanganan='$penanganan', status='$status', pic='$pic', fotopengerjaan='$fotopengerjaan' WHERE id_tiket='$kd'") or die(mysqli_error());
                if ($update) {
                  move_uploaded_file($tempname, $folder);
                  echo '<script>sweetAlert({
                                                     title: "Berhasil!", 
                                                        text: "Tiket Berhasil di update!", 
                                                        type: "success"
                                                        });</script>';
                } else {
                  echo '<script>sweetAlert({
                                                     title: "Gagal!", 
                                                        text: "Tiket Gagal di update, silahakan coba lagi!", 
                                                        type: "error"
                                                        });</script>';
                }
              }
            }
            ?>
            <div class="col s8 m8 l6">
              <div class="card-panel">
                <h4 class="mb-3">Edit Status Tiket Helpdeks</h4>
                <div class="row">
                  <div class="col">
                    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="col s12">
                      <input class="form-control" id="id_tiket" name="id_tiket" value="<?php echo $row['id_tiket']; ?>" type="text" readonly="readonly">
                      <label for="Id Tiket">Id Tiket</label>

                      <input class="form-control" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" type="text" readonly="readonly">
                      <label for="Tanggal">Tanggal</label>

                      <input class="form-control" id="no_hp" name="no_hp" value="<?php echo $row['no_hp']; ?>" type="text" readonly="readonly">
                      <label for="PC No">Number Phone</label>

                      <input class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" type="text" readonly="readonly">
                      <label for="Nama">Nama</label>

                      <input class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" type="email" readonly="readonly">
                      <label for="Email">Email</label>


                      <input class="form-control" id="departemen" name="departemen" value="<?php echo $row['departemen']; ?>" type="text" readonly="readonly">
                      <label for="Departemen">Departemen</label>


                      <textarea class="form-control" id="problem" name="problem" class="materialize-textarea validate" length="120" readonly="readonly"><?php echo $row['problem']; ?></textarea>
                      <label for="Problem">Problem</label>

                      <a href="/tiket/image/<?php echo $row['filename']; ?>" style="color:#eee; text-align: center;" data-toggle="tooltip" title="Edit" class="btn btn-primary">view</a>



                      <textarea class="form-control" id="penanganan" name="penanganan" class="materialize-textarea validate" length="120"></textarea>
                      <label for="Penanganan">Penanganan</label>

                      <?php
                      if ($row['fotopengerjaan'] == null && $row['fotopengerjaan'] == '') {
                      ?>
                        <label for="fotoperbaikan">Foto Perbaikan</label>
                        <input class="form-control" type="file" name="choosefile" value="">
                      <?php } else { ?>
                        <label for="fotoperbaikan">Foto Perbaikan</label>
                        <a href="/tiket/admin/images/<?php echo $row['fotopengerjaan'] ?>" style="color:#eee; text-align: center;" data-toggle="tooltip" title="Edit" class="btn btn-primary">view</a>
                        <input class="form-control" type="file" name="choosefile" value="<?php echo $row['fotopengerjaan']; ?>" />
                      <?php } ?>

                      <select class="form-control" name="status" id="status" required>
                        <option value="<?php echo $row['status']; ?>"> <?php echo $row['status']; ?></option>
                        <option value="New">New</option>
                        <option value="Proses">Proses</option>
                        <option value="Close">Close</option>
                      </select>
                      <label for="Status">Status</label>

                      <select class="form-control" name="pic" id="pic" required>
                        <option value="<?php echo $row['pic']; ?>"> <?php echo $row['pic']; ?></option>
                        <?php
                        $user = mysqli_query($koneksi, "SELECT * from user");
                        while ($row = mysqli_fetch_array($user)) {
                        ?>
                          <option value="<?php echo $row['username'] ?>"><?php echo $row['username'] ?></option>
                        <?php } ?>
                      </select>
                      <label for="Pic">PIC yang menangani</label>
                      <button class="btn btn-primary" type="submit" name="update" id="update">Submit
                        <i class="mdi-content-send right"></i>
                      </button>
                    </form>
                  </div>
                </div>


              </div>
            </div>
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
      $(document).ready(function() {
        var dataTable = $('#lookup').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax": {
            url: "ajax-grid-data1.php", // json datasource
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