<!DOCTYPE html>
<html lang="en">

<?php
include "head/head.php";
?>

<body id="bodytemplate">
    <!-- your project is here -->
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10 col-md-5 col-lg-4 col-xl-3">

                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="mb-2 mt-3">
                            <div class="container text-center">
                                <h4>SLA</h4>
                                <h6>(Service Level Agreement)</h6>
                            </div>
                        </div>
                        <p align="center">
                            <img src="image/avicenna-helpdesk.png" style="max-width: 90%">
                        </p>
                        <div class="card-body text-center">

                            <div class="dropdown">
                                <select style="
                                        border-width: 4px;
                                        border-color: rgba(50, 50, 50, 0.14);
                                        margin: 10px 10px 10px 0px;" class="form-control" aria-labelledby="dropdownMenuButton" name="forma" onchange="location = this.value;">
                                    <option value="tata_usaha_dashboard.php">Select..</option>
                                    <option value="tata_usaha_dashboard.php">Tata Usaha</option>
                                    <option value="humas_ppdb_dashboard.php">Humas & PPDB</option>
                                    <option value="kesiswaan_dashboard.php">Kesiswaan</option>
                                    <option value="kurikulum_dashboard.php">Kurikulum</option>
                                    <option value="psikolog_dashboard.php">Psikolog</option>
                                    <option value="bk_dashboard.php">BK</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <a href="datatiket.php">
                                    Tracking Ticket Number
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End your project here-->

    <!-- style="background-image: url('image/SLA Image.jpg'); background-size: auto auto;" -->
    <script>
        var _img = document.getElementById('bodytemplate');
        $("#bodytemplate").css("background-image", "url('image/SLA-Image.jpg')");
        $("#bodytemplate").css("background-size", "100%");
        console.log(_img);
    </script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>