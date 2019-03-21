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
	echo "<span style='color:red'> Course Short Name Already Exist .</span>";
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
	echo "<span style='color:red'> Course Short Name Already Exist .</span>";
}

if(!empty($_POST['Abteilung'])){
	$Abteilung=$_POST['Abteilung'];
	$result ="SELECT count(*) FROM Dienste WHERE Abteilung=?";
	$stmt = $mysqli->prepare($result);
	$stmt->bind_param('s',$Abteilung);
	$stmt->execute();
	$stmt->bind_result($count);
	$stmt->fetch();
	$stmt->close();
	if($count>0)
		echo "<span style='color:red'> Course Full Name Already Exist .</span>";
}

if(!empty($_POST['Abteilung1'])){
	$Abteilung=$_POST['Abteilung1'];
	$result ="SELECT count(*) FROM subject WHERE Abteilung=?";
	$stmt = $mysqli->prepare($result);
	$stmt->bind_param('s',$Abteilung);
	$stmt->execute();
	$stmt->bind_result($count);
	$stmt->fetch();
	$stmt->close();
	if($count>0)
		echo "<span style='color:red'> Course Full Name Already Exist .</span>";
}
?>

