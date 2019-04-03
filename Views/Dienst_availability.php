<?php
$dbuser="root";
$dbpass="";
$host="localhost";
$dbname = "diensteverwaltungssystem";
$mysqli = new mysqli($host, $dbuser, $dbpass, $dbname);
if(!empty($_POST['Dienstleistungsbezeichnung'])){
$Dienstleistungsbezeichnung=$_POST['Dienstleistungsbezeichnung'];
$result ="SELECT count(*) FROM Dienste WHERE Dienstleistungsbezeichnung=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('s',$Dienstleistungsbezeichnung);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();
if($count>0)
	echo "<span style='color:red'> Dienstname existiert bereits .</span>";
}
if(!empty($_POST['Dienstleistungsbezeichnung1'])){
$Dienstleistungsbezeichnung=$_POST['Dienstleistungsbezeichnung1'];
$result ="SELECT count(*) FROM  subject WHERE Dienstleistungsbezeichnung=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('i',$Dienstleistungsbezeichnung);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();
if($count>0)
	echo "<span style='color:red'> Dienstname existiert bereits .</span>";
}




