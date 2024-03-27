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
                        <div class="mb-3 mt-3">
                            <div class="container text-center">
                                <h4>SLA</h4>
                                <h6>(Service Level Agreement)</h6>
                            </div>
                        </div>
                        <p align="center">
                            <img src="image/avicenna-helpdesk.png" style="max-width: 90%">
                        </p>
                        <div class="card-body text-center">
                            <h5 class="mb-4">Select the ...</h5>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Click Here
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a onclick="location.href='dashboard.php'" class="dropdown-item">Tata Usaha</a>
                                    <a onclick="location.href='dashboard.php'" class="dropdown-item">Humas & PPDB</a>
                                    <a onclick="location.href='dashboard.php'" class="dropdown-item">Kesiswaan</a>
                                    <a onclick="location.href='dashboard.php'" class="dropdown-item">Kurikulum</a>
                                    <a onclick="location.href='dashboard.php'" class="dropdown-item">Psikolog</a>
                                    <a onclick="location.href='dashboard.php'" class="dropdown-item">BK</a>
                                    <a onclick="location.href='login.html'" class="dropdown-item"></a>
                                    <a onclick="location.href='login.html'" class="dropdown-item"></a>
                                </div>
                            </div>
                            <div class="mt-3">
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
        $("#bodytemplate").css("background-size", "auto auto");
        console.log(_img);
    </script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>