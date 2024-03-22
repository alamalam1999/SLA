<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Helpdesk BPS - YPAP</title>
    <!--<link rel="icon" href="/images/favicon/favicon-32x32.png" sizes="32x32">-->
    <link rel="icon" href="img/favicon-32x32.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="css/mdb.min.css" />

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body id="bodytemplate">
    <!-- your project is here -->
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10 col-md-5 col-lg-4 col-xl-3">

                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="mb-3 mt-3">
                            <div class="container text-center">
                                <h4>SLA (Service Level Agreement)</h4>
                            </div>
                        </div>
                        <p align="center">
                            <img src="image/avicenna-helpdesk.png" style="max-width: 90%">
                        </p>
                        <div class="card-body text-center">
                            <h5 class="mb-4">Select the Problem</h5>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown button
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a onclick="location.href='dashboard.php'" class="dropdown-item">User</a>
                                    <a onclick="location.href='login.html'" class="dropdown-item">Admin</a>
                                    <a onclick="location.href='login.html'" class="dropdown-item">Anything Else</a>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="datatiket.php">
                                    Tracking Nomor Ticket
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