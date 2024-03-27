<!DOCTYPE html>
<html lang="en">

<?php
include "head/head_dashboard.php";
?>

<body class="text-center" style="background-image: url('image/rm380-14.jpg'); background-size: 1430px 1100px;">
    <?php
    include "conn.php";

    if (isset($_POST['input'])) {

        $id_tiket  = $_POST['id_tiket'];
        $waktu     = $_POST['waktu'];
        $tanggal   = $_POST['tanggal'];
        $pc_no     = $_POST['pc_no'];
        $nama      = $_POST['nama'];
        $email     = $_POST['email'];
        $departemen = $_POST['departemen'];
        $problem   = $_POST['problem'];
        $filename  = $_FILES["choosefile"]["name"];
        $tempname  = $_FILES["choosefile"]["tmp_name"];
        $none      = "";
        $open      = "new";

        $folder = "image/" . $filename;

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




    <form method="POST" enctype="multipart/form-data" action="dashboard.php">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div>
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-md-9 col-lg-6 col-xl-8">
                            <img src="image/gsuite1.png" class="img-fluid" alt="Sample image">
                            <button onclick="location.href='https://sekolah-avicenna.sch.id/tiketgsuite/'" class="btn btn-lg btn-block btn-primary mb-2" style="font-size:13px; background-color: #15bee8;" type="submit"><strong> MASUK PELAYANAN G-SUITE SEKOLAH AVICENNA </strong> </button>
                        </div>
                    </div>
                </div>
                <fieldset>


                    <div class="h1 text-gray-800">
                        <h1>Ticketing Helpdesk</h1>
                    </div>

                    <div class="h3 mb-0 text-gray-800"> Isi Ticket dengan baik agar jelas informasi permasalahan.</div>
                    <div class="h3 mb-0 text-gray-800">Ticket diselesaikan oleh Tim Maintenance berdasarkan urutan antrian</div>
                    <div class="h3 mb-0 text-gray-800">Ticket wajib di isi.</div>

                    <div class="container">
                        <input type="hidden" name="id_tiket" value="<?php echo date("dmYHis"); ?>" id="id_ticket" />
                        <input type="hidden" name="waktu" value="<?php echo date("d.m.Y.H.i.s"); ?>" id="waktu" />
                        <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>" id="tanggal" />

                        <div class="input-group mb-3">
                            <label class="cd-label">Nama Kendala</label>
                            <input class="form-control" type="text" name="pc_no" id="pc_no" autocomplete="off" required="required">
                        </div>

                        <div class="input-group mb-3">
                            <label class="cd-label">Nama</label>
                            <input class="form-control" type="text" name="nama" id="nama" autocomplete="off" required="required">
                        </div>

                        <div class="input-group mb-3">
                            <label class="cd-label">Email</label>
                            <input class="form-control " type="email" name="email" id="email" autocomplete="off" required="email">
                        </div>


                        <div class="input-group mb-3">
                            <label class="cd-label">Departemen</label>
                            <select class="form-control " name="departemen" id="departemen" required>
                                <option value=""></option>
                                <option value="Research and Development">Research and Development</option>
                                <option value="Human Resources">Human Resources</option>
                                <option value="General Affair">General Affair</option>
                                <option value="Accounting & Tax">Accounting & Tax</option>
                                <option value="Finance">Finance</option>
                                <option value="Building Maintenance">Building & Maintenance</option>
                                <option value="Building Maintenance">Branding & Marketing</option>
                                <option value="Transformasi Digital">Transformasi Digital (IT)</option>
                                <option value="KB Avicenna Pamulang">KB Avicenna Pamulang</option>
                                <option value="TK Avicenna Jagakarsa">TK Avicenna Jagakarsa</option>
                                <option value="SD Avicenna Jagakarsa">SD Avicenna Jagakarsa</option>
                                <option value="SMP Avicenna Jagakarsa">SMP Avicenna Jagakarsa</option>
                                <option value="SMA Avicenna Jagakarsa">SMA Avicenna Jagakarsa</option>
                                <option value="SD Avicenna Cinere">SD Avicenna Cinere</option>
                                <option value="SMP Avicenna Cinere">SMP Avicenna Cinere</option>
                                <option value="SMA Avicenna Cinere">SMA Avicenna Cinere</option>
                            </select>
                        </div>


                        <div class="input-group mb-3">
                            <label class="cd-label">Permasalahan</label>
                            <textarea class="form-control " name="problem" id="problem" required></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <label class="">Foto atau Screenshot masalah</label>
                            <input name="choosefile" type="file" class="form-control " id="customFile" />
                        </div>

                        <div class="mt-3">
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
                </fieldset>

            </div>
            <div class="col"></div>
        </div>
    </form>
    <center style="font-size:18px">Copyright &copy; <a href="#">2022 Transformasi Digital- BPS YPAP</a></center><br /><br />
    <script src="js/main.js"></script> <!-- Resource jQuery -->

    <!-- <script>
  sweetAlert("Hello world!");
  </script> -->


    <script>
        $(document).ready(function() {
            if (Notification.permission !== "granted")
                Notification.requestPermission();
        });

        function notifikasi() {
            if (!Notification) {
                alert('Browsermu tidak mendukung Web Notification.');
                return;
            }
            if (Notification.permission !== "granted")
                Notification.requestPermission();
            else {
                var notifikasi = new Notification('IT Helpdesk Tiket', {
                    icon: 'img/logo.jpg',
                    body: "Tiket Baru dari <?php echo $nama; ?>",
                });
                notifikasi.onclick = function() {
                    window.open("http://tsuchiya-mfg.com");
                };
                setTimeout(function() {
                    notifikasi.close();
                }, 1000);
            }
        };
    </script>
</body>

</html>