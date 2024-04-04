<!DOCTYPE html>
<html lang="en">

<?php
include "head/head.php";
?>

<body id="bodytemplate" class="bg-gradient-primary">
    <?php
    include "conn.php";

    if (isset($_POST['input'])) {

        $id_tiket  = $_POST['id_tiket'];
        $kendala_tata_usaha = $_POST['departemen']; //done
        $waktu     = $_POST['waktu'];
        $pc_no     = "KOSONG";
        $tanggal   = $_POST['tanggal'];
        $no_hp     = $_POST['no_hp']; //done
        $nama      = $_POST['nama']; //done
        $email     = $_POST['email']; //done
        $departemen = $_POST['departemen'];
        $problem   = $_POST['problem']; //done
        $filename  = $_FILES["choosefile"]["name"]; //done
        $tempname  = $_FILES["choosefile"]["tmp_name"]; //done
        $none      = "";
        $open      = "new";

        $folder = "" . $filename;

        $laporan = "<h4><b>Tiket Baru : $waktu</b></h4>";
        $laporan .= "<br/>";
        $laporan .= "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"0\">";
        $laporan .= "<tr>";
        $laporan .= "<td>Tanggal</td><td>:</td><td>$tanggal</td>";
        $laporan .= "</tr>";
        $laporan .= "<tr>";
        $laporan .= "<td>PC NO</td><td>:</td><td>$pc_no</td>";
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
        $laporan .= "<td>Status/td><td>:</td><td>$open</td>";
        $laporan .= "</tr>";


        require_once("phpmailer/class.phpmailer.php");
        require_once("phpmailer/class.smtp.php");

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
            echo "Email berhasil terkirim!";
            $cek = mysqli_query($koneksi, "SELECT * FROM tiket WHERE id_tiket='$id_tiket'");
            echo "HASIL = " . mysqli_num_rows($cek);
            if (mysqli_num_rows($cek) == 0) {
                echo "masuk kesini";
                $insert = mysqli_query($koneksi,  "INSERT INTO tiket(id_tiket,tanggal,waktu,pc_no,nama, email, departemen, problem ,penanganan, status, filename) 
                                                    VALUES('$id_tiket','$tanggal','$waktu','$pc_no','$nama','$email','$departemen','$problem','$none','$open','$filename')");
                echo $insert;
                if ($insert) {

                    echo $tempname;
                    move_uploaded_file($tempname, $folder);
                    echo '<script>sweetAlert({
	                                                   title: "Keluhan berhasil dikirim!", 
                                                        text: "Cek email anda untuk mengetahui nomor tiket!", 
                                                        type: "success"
                                                        });</script>';
                } else {
                    echo '<script>sweetAlert({
	                                                   title: "Gagal!", 
                                                        text: "Keluhan Gagal di kirim, silahakan coba lagi!", 
                                                        type: "error"
                                                        });</script>';
                }
            } else {
                echo '<script>sweetAlert({
	                                                   title: "Gagal!", 
                                                        text: "Tiket Sudah ada Sebelumnya!", 
                                                        type: "error"
                                                        });</script>';
            }
        }
    }
    ?>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <form method="POST" enctype="multipart/form-data" action="tata_usaha_dashboard.php">
                                        <div class="container">
                                            <div class="row">
                                                <div class="">
                                                    <img src="image/logo_baru.png" class="img-fluid" alt="Sample image">
                                                    <div class="h1 text-gray-800">
                                                        <h1></h1>
                                                    </div>
                                                    <div class="container">
                                                        <input type="hidden" name="id_tiket" value="<?php echo date("dmYHis"); ?>" id="id_ticket" />
                                                        <input type="hidden" name="waktu" value="<?php echo date("d.m.Y.H.i.s"); ?>" id="waktu" />
                                                        <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>" id="tanggal" />
                                                        <input type="hidden" name="departemen" value="psikolog" id="departemen" />

                                                        <div class="form-input mb-2">
                                                            <strong><label class="cd-label left-text">Nama</label></strong>
                                                            <input class="form-control" type="text" name="nama" id="nama" autocomplete="off" required>
                                                        </div>

                                                        <div class="form-input mb-2">
                                                            <strong><label class="cd-label left-text">Email</label></strong>
                                                            <input class="form-control " type="email" name="email" id="email" autocomplete="off" required>
                                                        </div>

                                                        <div class="form-input mb-2">
                                                            <strong><label class="cd-label text-left">Nomor Handphone</label></strong>
                                                            <input class="form-control " type="no_hp" name="no_hp" id="no_hp" autocomplete="off" required>
                                                        </div>

                                                        <div class="form-input mb-2">
                                                            <strong><label class="cd-label">Kendala</label></strong>
                                                            <select class="form-control " name="kendala_tatausaha" id="kendala_tatausaha" required>
                                                                <option value="" selected>Pilih</option>
                                                                <option value="Test 1">Test 1</option>
                                                                <option value="Test 2">Test 2</option>
                                                                <option value="Test 3">Test 3</option>
                                                                <option value="Test 4">Test 4</option>
                                                                <option value="Test 5">Test 5</option>
                                                                <option value="Test 6">Test 6</option>
                                                                <option value="Test 7">Test 7</option>
                                                            </select>
                                                        </div>

                                                        <div class="input-input mb-2">
                                                            <strong><label class="cd-label text-left">Detail kendala</label></strong>
                                                            <textarea class="form-control " name="problem" id="problem" required></textarea>
                                                        </div>

                                                        <div class="input-input mb-2">
                                                            <strong><label class="">Foto atau Screenshot masalah</label></strong>
                                                            <input name="choosefile" type="file" class="form-control " id="customFile" />
                                                        </div>

                                                        <div class="mt-3 text-center">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <input class=" btn btn-primary" type="submit" onclick="notifikasi()" name="input" id="input" value="Send Message">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col"></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <a href="datatiket.php">Data Ticket</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <!-- <a class="small" href="forgot-password.html">Forgot Password?</a> -->
                                    </div>
                                    <div class="text-center">
                                        <!-- <a class="small" href="register.html">Create an Account!</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

    <script>
        var _img = document.getElementById('bodytemplate');
        $("#bodytemplate").css("background-image", "url('image/SLA-Image.jpg')");
        $("#bodytemplate").css("background-size", "auto auto");
        console.log(_img);
    </script>

</body>

</html>