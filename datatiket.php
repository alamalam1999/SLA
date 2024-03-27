<html>

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

  <link rel="stylesheet" type="text/css" href="datatables/dataTables.bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css" />
</head>

<body id="bodytemplate">
  <h3>
    <center>Data Ticket IT Helpdesk System</center>
  </h3>
  <div class="col-lg-12" style="margin-top: 40px;">
    <table id="lookup" class="table table-bordered table-hover">
      <thead bgcolor="eeeeee" align="center">
        <tr>

          <th>Id Tiket</th>
          <th>Tanggal</th>
          <th>Nama Barang</th>
          <th>Nama</th>
          <th>Departemen</th>
          <th>Permasalahan</th>
          <th>Status</th>
          <th>Pic</th>
          <th>Penanganan</th>

        </tr>
      </thead>
      <tbody>


      </tbody>
    </table>
  </div>
  <center><a href="index.php">Kembali</a></center>

  <!-- Javascript Libs -->
  <script type="text/javascript" src="js/jquery-2.1.1.js"></script>
  <script type="text/javascript" src="datatables/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="datatables/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="dist/js/bootstrap.min.js"></script>


  <script>
    $(document).ready(function() {
      var dataTable = $('#lookup').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          url: "ajax-grid-data.php", // json datasource
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
  <script>
    var _img = document.getElementById('bodytemplate');
    $("#bodytemplate").css("background-image", "url('image/SLA-Image.jpg')");
    $("#bodytemplate").css("background-size", "auto auto");
    console.log(_img);
  </script>
</body>

</html>