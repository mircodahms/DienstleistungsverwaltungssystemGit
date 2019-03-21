<?php
require "../static/Login-Check.php";
   
    include('../Classes/DatabaseFunction.php');
    $obj=new DatabaseFunction();
	$rs=$obj->showDienste();

	if(isset($_GET['del']))
    {
          $obj->del_course(intval($_GET['del']));
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
                            Diensteübersicht
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Dienstleistungsbezeichnung</th>
                                            <th>Abteilung</th>
                                            <th>Erstellungsdatum</th>
                                            <th>Aktionen</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php while($res=$rs->fetch_object()){?>
                                        <tr class="odd gradeX">
                                            <td><?php echo htmlentities(strtoupper($res->Dienst_ID));?></td>
                                            <td><?php echo htmlentities(strtoupper($res->Dienstleistungsbezeichnung));?></td>
                                            <td><?php echo htmlentities(strtoupper($res->Abteilung));?></td>
                                            <td><?php echo htmlentities($res->Erstellungsdatum);?></td>
                                            <td>&nbsp;<a href="Edit_Dienst.php?cid=<?php echo htmlentities($res->Dienst_ID);?>"> <p class="fa fa-edit"></p></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="Dienstetabelle.php?del=<?php echo htmlentities($res->Dienst_ID); ?>"> <p class="fa fa-times-circle"></p></a>
                                                  <form action="Nutzerdaten.php" method="POST"><input  type="hidden" name="dienstname" <?php echo "value='$res->Dienstleistungsbezeichnung'>";?>
                                                  <div class="form-group"><input type="submit" class="btn btn-primary" name="submit" value="Nutzer"></button>
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
            </div>
            <!-- /.row -->
           
            
           
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

</body>
</html>