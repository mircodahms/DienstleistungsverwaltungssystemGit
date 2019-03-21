<?php
require "../static/Login-Check.php";

include('../Classes/DatabaseFunction.php');
$obj=new DatabaseFunction();
$dienstname = $_POST['dienstname'];
$rs=$obj->showData($dienstname);
$res=$rs->fetch_object();
$rss=$obj->showData($dienstname);
//Objekt in Array umwandeln
$array = json_decode(json_encode($res), True);
//$objectToArray = (array)$res;
//var_dump($objectToArray);

if(isset($_POST['submitAtt'])){

    $obj->new_Att($_POST['dienstname'],$_POST['Attribut']);
}

if(isset($_POST['submitDelete'])){
    $obj->del_Nutzer($_POST['dienstname'],$_POST['ID']);
}

if(isset($_POST['submitNutzer'])) {

    //foreach ($array as $key => $value)
       // if ($key == 'ID') {}
       // ELSE {//$Spalte = $key;
        //$values = ($_POST[$key]);
            $Spalte = "Organisationseinheit, Kostenstelle, Speicherplatz";
                       //var_dump($Spalte);


                // Create connection
                $conn = new mysqli("localhost", "root", "", "diensteverwaltungssystem");
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $Spalten = array ();
                $i=0;
                foreach ($array as $key => $value) {
                     $ars = array ();
                     $ars[$i] = $key;
                     var_dump($ars[$i]);
                     $i++;
                     if ($key == 'ID')  {}
                     else if ($Spalten [] = $key);
                    };


                 $arr = array('Organisationseinheit', 'Kostenstelle', 'Speicherplatz', 'Test');
                 $value = "'zwanzig', 'zwei', 'sieben', 'vier'";
                 $i = count($arr);
                 switch ($i) {
                   case '1':
                       $sql = "INSERT INTO $dienstname ($arr[0]) VALUES ($value)";
                       break;
                   case '2':
                       $sql = "INSERT INTO $dienstname ($arr[0], $arr[1]) VALUES ($value)";
                       break;
                   case '3':
                       $sql = "INSERT INTO $dienstname ($arr[0], $arr[1], $arr[2]) VALUES ($value)";
                       break;
                   case '4':
                       $sql = "INSERT INTO $dienstname ($arr[0], $arr[1], $arr[2], $arr[3]) VALUES ($value)";
                       break;
                   case '5':
                       $sql = "INSERT INTO $dienstname ($arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5]) VALUES ($value)";
                       break;
                   case '6':
                       $sql = "INSERT INTO $dienstname ($arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5], $arr[6]) VALUES ($value)";
                       break;
                 }
                    $conn->query($sql);
                    var_dump($sql);
                    $conn->close();
                    header('location:Dienstetabelle.php');
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

    <title>Diensteübersicht</title>
    <link href="../Style_Sources/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Style_Sources/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../Style_Sources/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../Style_Sources/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="../static/css/sb-admin-2.css" rel="stylesheet">
    <link href="../Style_Sources/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="wrapper">
    <!-- Navigation -->
    <?php include('Navigation_links.php') ?>;


    <nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Nutzerdaten: <?php echo $dienstname; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        <?php
                                                if ($array == 'NULL') {}
                                                else foreach ($array as $key => $value) {
                                                     print ("<th>" . $key . "</th>");};
                                                     print ("<th> Methoden </th>")?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php while($ress=$rss->fetch_object()){?>
                                    <tr class="odd gradeX">
                                        <?php
                                                foreach ($array as $key => $value) {echo "<td>" . htmlentities(strtoupper($ress->$key));}?>
                                                    <td><form action="Edit_Nutzerdaten.php" method="POST">
                                                        <input  type="hidden" name="dienstname" <?php echo "value='$dienstname'>";?>
                                                        <input  type="hidden" name="ID" value="<?php echo htmlentities($res->ID); ?>">
                                                        <div class=col-md-4><input type="submit" class="btn btn-primary" name="submitEdit" value="Ä"></button></div></form>
                                                    <form method="POST">
                                                        <input  type="hidden" name="dienstname" <?php echo "value='$dienstname'>";?>
                                                        <input  type="hidden" name="ID" value="<?php echo htmlentities($res->ID); ?>">
                                                        <div class=col-md-4><input type="submit" class="btn btn-primary" name="submitDelete" value="L"></button>
                                                        </div></form></td>
                                        <?php }?>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <!-- /.col-lg-12 -->
                <form method="post" >
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Neuen Nutzer hinzufügen
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-lg-4">
                                        <label>Neuer Nutzer<span id="" style="font-size:11px;color:red">*</span>	</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <?php
                                               foreach ($array as $key => $value) {
                                                   if ($key == 'ID')  {}
                                                        else print ('<input type ="text" class="form-control" name="' . $key . '" placeholder="' . $key . '"><br>');
                                                        }; ?>
                                        <input  type="hidden" name="dienstname" <?php echo "value='$dienstname'>";?>
                                        <input type="submit" class="btn btn-primary" name="submitNutzer" value="Neuen Nutzer hinzufügen">
                                    </div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </form>

                <!-- /.col-lg-12 -->
            <form method="post" >
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Attribut ergänzen
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-lg-4">
                                    <label>Neues Attribut<span id="" style="font-size:11px;color:red">*</span>	</label>
                                </div>
                                <div class="col-lg-4">
                                    <input class="form-control" name="Attribut" type="text" id="Attribut"  <br>
                                </div>
                                <div class="col-lg-4">
                                    <input  type="hidden" name="dienstname" <?php echo "value='$dienstname'>";?>
                                    <input type="submit" class="btn btn-primary" name="submitAtt" value="Neues Attribut hinzufügen">
                                </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </form>



        </div>
        <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../Style_Sources/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../Style_Sources/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../Style_Sources/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../Style_Sources/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../Style_Sources/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../static/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

    </nav>
</body>
</html>