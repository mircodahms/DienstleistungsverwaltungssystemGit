<?php
//Dienst hinzufügen
require "../static/Login-Check.php";

if(isset($_POST['submit'])){
	
	include('../Classes/DatabaseFunction.php');
	$obj=new DatabaseFunction();
	$obj->create_dienst($_POST['dienstname'],$_POST['abteilung'],$_POST['Erstellungsdatum']);
	
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<title>Weitere Dienstleistung hinzufügen</title>

<!-- Bootstrap Core CSS -->
<link href="../Style_Sources/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="../Style_Sources/metisMenu/dist/metisMenu.min.css"
	rel="stylesheet">

<!-- Custom CSS -->
<link href="../static/css/sb-admin-2.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="../Style_Sources/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<form method="post" >
	<div id="wrapper">

		<!-- Navigation -->
		<?php include('Navigation_links.php') ?>;

<!--nav-->
		<div id="page-wrapper">

			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Weitere Dienstleistung hinzufügen</div>
						<div class="panel-body">
							<div class="row">
						 	<div class="col-lg-10">
									
										<div class="form-group">
											<div class="col-lg-4">
                                                <label>Dienstleistungsbezeichnung<span id="" style="font-size:11px;color:red">*</span></label>
											</div>

											<div class="col-lg-6">
                                                <input class="form-control" name="dienstname" id="Dienstleistungsbezeichnung" required="required"  onblur="dienstAvailability()">
                                                <span id="dienst-availability-status" style="font-size:12px;"></span>
                                           </div>
										</div>  <br><br>
								
                                       <div class="form-group">
		                                    <div class="col-lg-4">
		                                        <label>Abteilung<span id="" style="font-size:11px;color:red">*</span></label>
		                                    </div>

		                                    <div class="col-lg-6">
		                                        <input class="form-control" name="abteilung" id="Abteilung" required="required"  onblur="abteilungAvail()">
                                                <span id="course-status" style="font-size:12px;"></span>
                                            </div>
                                       </div>  <br><br>
										
                                       <div class="form-group">
	                                        <div class="col-lg-4">
	                                            <label>Erstellungsdatum</label>
	                                        </div>
	                                        <div class="col-lg-6">
	                                        <input class="form-control" value="<?php echo date('d-m-Y');?>" readonly="readonly" name="Erstellungsdatum">
                                            </div>
                                       </div>
                            </div> <br><br>
		
							<div class="form-group">
											<div class="col-lg-4">
											</div>
											<div class="col-lg-6">  <br><br>
							                    <input type="submit" class="btn btn-primary" name="submit" value="Dienstleistung hinzufügen"></button>
											</div>
                            </div>
				</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
	
	<script src="../Style_Sources/jquery/dist/jquery.min.js"
		type="text/javascript"></script>
	
	<script src="../Style_Sources/bootstrap/dist/js/bootstrap.min.js"
		type="text/javascript"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="../Style_Sources/metisMenu/dist/metisMenu.min.js"
		type="text/javascript"></script>

	<!-- Custom Theme JavaScript -->
	<script src="../static/js/sb-admin-2.js" type="text/javascript"></script>
	
	<script>
        function dienstAvailability() {
	        $("#loaderIcon").show();
            jQuery.ajax({
            url: "Dienst_availability.php",
            data:'Dienstleistungsbezeichnung='+$("#Dienstleistungsbezeichnung").val(),
            type: "POST",
            success:function(data){
            $("#dienst-availability-status").html(data);
            $("#loaderIcon").hide();
        },
        error:function (){}
    });
}

    </script>
</form>

</body>
</html>
