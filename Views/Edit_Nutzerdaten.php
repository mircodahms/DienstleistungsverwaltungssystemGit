<?php
//Nutzerdaten bearbeiten
require "../static/Login-Check.php";

include('../Classes/DatabaseFunction.php');

$obj=new DatabaseFunction();
$dienstname = $_POST['dienstname'];
$id = $_POST['ID'];
$rs=$obj->showNutzerwithID($dienstname, $id);
$res=$rs->fetch_object();
//Objekt in Array umwandeln
$array = json_decode(json_encode($res), True);

if(isset($_POST['submit'])){
    // Create connection
    $conn = new mysqli("localhost", "root", "", "diensteverwaltungssystem");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    foreach ($array as $key => $value) {
        $value = $_POST[$key];
        $sql = "UPDATE $dienstname SET $key = '$value' WHERE ID = '" . $id . "'";
        $conn->query($sql);
        //$conn->close();
    };
        $conn->close();
        header("location:Nutzerdaten.php?dienstname=$dienstname");
}
?>

<!DOCTYPE html>
<html lang="deu">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Nutzungsdaten bearbeiten</title>
    <link href="../Style_Sources/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Style_Sources/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../static/css/sb-admin-2.css" rel="stylesheet">
    <link href="../Style_Sources/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<form method="post" >
	<div id="wrapper">
	<!--left !-->
    <?php include('Navigation_links.php') ?>;
	 

		<div id="page-wrapper">
			<!-- /.row -->
			<div class="row">
			        <div class="panel panel-default">
			            <div class="panel-heading">Nutzungsdaten bearbeiten</div>
			                <div class="panel-body">
			                    <div class="row">
			                        <div class="col-lg-10">
			                            <div class="form-group">
                                                <?php
                                                foreach ($array as $key => $value) {?>
                                                        <div class="col-lg-4">
                                                            <label><?php echo $key;?><span id="" style="font-size:11px;color:red"></span></label>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" name="<?php echo $key;?>" id="Dienstleistungsbezeichnung"  value="<?php echo $res->$key;?>" required="required">
                                                            <span style="font-size:12px;"></span>
                                                        </div>
                                                        <br><br>
                                               <?php } ?>
                                                      <input  type="hidden" name="dienstname" <?php echo "value='$dienstname'>";?>
                                                      <input  type="hidden" name="ID" <?php echo "value='$id'>";?>
                                                      <div class="form-group">
                                                           <div class="col-lg-4">
                                                           </div>
                                                           <div class="col-lg-6"><br><br>
                                                               <input type="submit" class="btn btn-primary" name="submit" value="Update"></button>
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
            jQuery.ajax({
                url: "Dienst_availability.php",
                data:'Dienstleistungsbezeichnung='+$("#Dienstleistungsbezeichnung").val(),
                type: "POST",
                success:function(data){
                    $("#dienst-availability-status").html(data);
                }, error:function (){}
            });
        }
    </script>
</form>

</body>
</html>
