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
            $sql = mysqli_query($koneksi, "SELECT * FROM tiket_gsuite WHERE id_tiket='$kd'");
            if (mysqli_num_rows($sql) == 0) {
              header("Location: tiket.php");
            } else {
              $row = mysqli_fetch_assoc($sql);
            }
            if (isset($_POST['update'])) {
              $id_tiket  = $_POST['id_tiket'];
              $name           = $_POST['name'];
              $email          = $_POST['email'];
              $firstname      = $_POST['firstname'];
              $lastname       = $_POST['lastname'];
              $no_hp          = $_POST['nohp'];
              $status         = $_POST['status'];
              $password       = $_POST['password'];
              $email_sekolah  = $_POST['email_sekolah'];
              if ($firstname != '' && $password != '' && $email_sekolah != '') {
                $laporan = "Kepada $firstname . $lastname";
                $laporan .= "<br/>";
                $laporan .= "Terima kasih atas partisipasi anda dalam G-Suite Sekolah Avicenna. berikut kami lampirkan data G-Suite atas nama $firstname  $lastname";
                $laporan .= "<br/>";

                $laporan .= "Username     : $firstname.$lastname@sekolah-avicenna.sch.id";
                $laporan .= "<br/>";
                $laporan .= "Pass Default : $password";
                $laporan .= "<h4><b>Tiket Status : $id_tiket</b></h4>";
                $laporan .= "<br/>";
                $laporan .= "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"0\">";
                $laporan .= "<tr>";
                $laporan .= "<td>Tanggal</td><td>:</td><td>$tanggal</td>";
                $laporan .= "</tr>";
                $laporan .= "<tr>";
                $laporan .= "<td>Nama</td><td>:</td><td>$name</td>";
                $laporan .= "</tr>";
                $laporan .= "<tr>";
                $laporan .= "<td>Status</td><td>:</td><td>$status</td>";
                $laporan .= "</tr>";
                $laporan .= "<tr>";
                $laporan .= "<td>Nama Depan</td><td>:</td><td>$firstname</td>";
                $laporan .= "</tr>";
                $laporan .= "<tr>";
                $laporan .= "<td>Nama Belakang</td><td>:</td><td>$lastname</td>";
                $laporan .= "</tr>";
                $laporan .= "<tr>";
                $laporan .= "<td>No Handphone</td><td>:</td><td>$no_hp</td>";
                $laporan .= "</tr>";
                $laporan .= "<tr>";
                $laporan .= "<td>Email</td><td>:</td><td>$email</td>";
                $laporan .= "</tr>";
                $laporan .= "<tr>";
                $laporan .= "<td>Email Sekolah</td><td>:</td><td>$email_sekolah</td>";
                $laporan .= "</tr>";
              } else {
                $laporan = "Username     : $email";
                $laporan .= "<br/>";
                $laporan .= "Pass Default : $password";
              }


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
              $sendmail->addAddress("$email", "$name"); //email tujuan
              $sendmail->addReplyTo('ypap@sekolah-avicenna.sch.id', 'YPAP');
              $sendmail->isHTML(true);                                  // Set email format to HTML
              $sendmail->Subject = "Ticket: Pembuatan Akun G-Suite atas nama $firstname . $lastname"; //subjek email
              $sendmail->Body = $laporan; //isi pesan dalam format laporan
              if (!$sendmail->Send()) {
                echo "Email gagal dikirim : " . $sendmail->ErrorInfo;
              } else {

                $update = mysqli_query($koneksi, "UPDATE tiket_gsuite SET tanggal='$tanggal', name='$name', email='$email', status='$status', email_sekolah='$email_sekolah',password='$password' WHERE id_tiket='$kd'") or die(mysqli_error());
                if ($update) {
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
                <h4 class="header2">Edit Status Tiket Helpdeks</h4>
                <div class="row">
                  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="col s12">
                    <!-- <i class="mdi-action-assignment-ind prefix"></i> -->
                    <input class="form-control" id="id_tiket" name="id_tiket" value="<?php echo $row['id_tiket']; ?>" type="text" readonly="readonly">
                    <label for="Id Tiket">Id Tiket</label>

                    <input class="form-control" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" type="text" readonly="readonly">
                    <label for="Tanggal">Tanggal</label>

                    <input class="form-control" id="nama" name="name" value="<?php echo $row['name']; ?>" type="text" readonly="readonly">
                    <label for="Nama">Name</label>

                    <input class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" type="email" readonly="readonly">
                    <label for="Email">Email</label>


                    <input class="form-control" id="email" name="firstname" value="<?php echo $row['firstname']; ?>" type="email" readonly="readonly">
                    <label for="Email">First Name</label>


                    <input class="form-control" id="email" name="lastname" value="<?php echo $row['lastname']; ?>" type="email" readonly="readonly">
                    <label for="Email">Last Name</label>

                    <input class="form-control" id="email" name="nohp" value="<?php echo $row['no_hp']; ?>" type="email" readonly="readonly">
                    <label for="Email">No Hp</label>

                    <input class="form-control" id="lokasi" name="lokasi" value="<?php echo $row['lokasi']; ?>" type="text" readonly="readonly">
                    <label for="lokasi">Lokasi</label>

                    <input class="form-control" id="text" name="password" value="<?php echo $row['password']; ?>" type="text">
                    <label for="text">Password</label>

                    <input class="form-control" id="text" name="email_sekolah" value="<?php echo $row['email_sekolah']; ?>" type="text">
                    <label for="text">Email Sekolah</label>

                    <select class="form-control" name="status" id="status" required>
                      <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
                      <option value="Open">New</option>
                      <option value="Close">Selesai</option>
                    </select>

                    <button class="btn btn-primary mt-4" type="submit" name="update" id="update">Submit
                      <i class="mdi-content-send right"></i>
                    </button>
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