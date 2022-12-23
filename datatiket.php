<html>
<head>
<title>IT Helpdesk System | www.hakkoblogs.com</title>
<meta name="author" content="Hakko Bio Richard"/>

<link rel="stylesheet" type="text/css" href="datatables/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css"/>
</head>
<body>
<h3><center>Data Ticket IT Helpdesk System</center></h3>
<div class="col-lg-12" style="margin-top: 40px;">

    <table id="lookup" class="table table-bordered table-hover">  
	<thead bgcolor="eeeeee" align="center">
      <tr>
	  
       <th>Id Tiket</th>
	   <th>Tanggal</th>
       <th>PC No</th>
       <th>Nama</th>
       <th>Email</th>
       <th>Departemen</th>
       <th>Problem</th>
       <th>Status</th>
	   
	  
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
				var dataTable = $('#lookup').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"ajax-grid-data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".lookup-error").html("");
							$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#lookup_processing").css("display","none");
							
						}
					}
				} );
			} );
        </script>
</body>
</html>