<?php
//Database Klassen
require('Database.php');

//Funktionen zur Datenverwaltung
class DatabaseFunction
{

    function login($loginid, $password)
    {

        //Authentifizierungsdaten sind falsch
        if (!ctype_alpha($loginid) || !ctype_alpha($password)) {

            echo "<script>alert('E-Mail Adresse oder Passwort ist nicht korrekt')</script>";

        } //Verbindungsaufbau
        else {
            $db = Database::getInstance();
            $mysqli = $db->getConnection();
            $query = "SELECT loginid, password FROM user where loginid=? and password=? ";
            $stmt = $mysqli->prepare($query);
            if (false === $stmt) {

                trigger_error("Verbindungserror: " . mysqli_connect_error(), E_USER_ERROR);
            } else {

                $stmt->bind_param('ss', $loginid, $password);
                $stmt->execute();
                $stmt->bind_result($loginid, $password);
                $rs = $stmt->fetch();
                if (!$rs) {
                    echo "<script>alert('Invalide Details')</script>";
                    header('location:Login.php');
                } else {
                    //Verbindung erfolgreich: Weiterleitung zum Dashboard
                    header('location:Dashboard.php');
                }
            }

        }

    }

    //neue Dienstleistung erstellen
    function create_dienst($Dienstleistungsbezeichnung, $Abteilung, $Erstellungsdatum)
    {

        if ($Dienstleistungsbezeichnung == "") {

            echo "<script>alert('Wählen Sie den Namen der Dienstleistung')</script>";

        } else if ($Abteilung == "") {

            echo "<script>alert('Welche Abteilung verwaltet diese Dienstleistung')</script>";

        } else {

            $db = Database::getInstance();
            $mysqli = $db->getConnection();
            $query = "insert into Dienste(Dienstleistungsbezeichnung,Abteilung,Erstellungsdatum)values(?,?,?)";
            $stmt = $mysqli->prepare($query);
            $sql = "CREATE TABLE $Dienstleistungsbezeichnung (ID INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                              Organisationseinheit VARCHAR (255))";
            $mysqli->query($sql);
            $sql = "INSERT INTO $Dienstleistungsbezeichnung (Organisationseinheit) VALUES ('Test')";
            $mysqli->query($sql);


            if (false === $stmt) {

                trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
            } else {

                $stmt->bind_param('sss', $Dienstleistungsbezeichnung, $Abteilung, $Erstellungsdatum);
                $stmt->execute();
                //$erg = self::query("CREATE TABLE `diensteverwaltung`.`$Dienstleistungsbezeichnung`  (`ID` INT(10) NOT NULL AUTO_INCREMENT)");


                echo "<script>alert('Dienst wurde erfolgreich hinzugefügt!')</script>";
            }
            $mysqli->close();
        }
    }

    //Dienstleistungen anzeigen
    function showDienste()
    {

        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM Dienste ";
        $stmt = $mysqli->query($query);
        return $stmt;

    }

    //Dienstleistung mit ausgewählter ID
    function showDienstewithID($Dienst_ID)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM Dienste where Dienst_ID='" . $Dienst_ID . "'";
        $stmt = $mysqli->query($query);
        return $stmt;
    }

    //Dienstleistungen anzeigen
    function showData($dienstname)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        //$query = "SHOW FIELDS FROM $dienstname";
        //$stmt =  $stmt = $mysqli->query($query);
        $query = "SELECT * FROM $dienstname";
        $stmt = $mysqli->query($query);
        return $stmt;
    }

    function showNutzerwithID($dienstname, $id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM $dienstname where ID='" . $id . "'";
        $stmt = $mysqli->query($query);
        return $stmt;
    }


    function showSession()
    {

        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM session  ";
        $stmt = $mysqli->query($query);
        return $stmt;

    }


    function edit_dienst($dienstname, $abteilung, $Update, $dienstold, $id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        //echo $Dienstleistungsbezeichnung.$Abteilung.$Update.$id;exit;
        $query = "ALTER Table $dienstold RENAME $dienstname";
        $mysqli->query($query);
        var_dump($query);
        $query = "UPDATE Dienste set Dienstleistungsbezeichnung = ' " . $dienstname . " ', Abteilung = ' " . $abteilung . " ' where Dienst_ID = " . $id . " ";
        $mysqli->query($query);
        var_dump($query);
        $mysqli->close();
        echo '<script>';
        echo 'alert("Dienst wurde erfolgreich geupdatet.")';
        echo '</script>';
        header('location:Dienstetabelle.php');

    }

    function new_Att($dienstname, $Attribut)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "ALTER TABLE $dienstname ADD $Attribut char(255); ";
        $mysqli->query($query);
        $mysqli->close();
        echo '<script>';
        echo 'alert("Dienst wurde erfolgreich geupdatet.")';
        echo '</script>';
        header("location:Nutzerdaten.php?dienstname=$dienstname");

    }

    function new_Nutzer($dienstname, $key, $array)
    {

        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "INSERT INTO $dienstname Kostenstelle VALUES $key ";
        $mysqli->query($query);
        $mysqli->close();
        echo '<script>';
        echo 'alert("Dienst wurde erfolgreich geupdatet.")';
        echo '</script>';
        header('location:Dienstetabelle.php');

    }


    function del_course($id)
    {

        //  echo $id;exit;
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "delete from Dienste where Dienst_ID=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        echo "<script>alert('Dienst wurde erfolgreich gelöscht')</script>";
        echo "<script>window.location.href=Dienstetabelle.php'</script>";
    }

    function del_Nutzer($dienstname, $ID)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "delete from $dienstname where ID=$ID";
        $mysqli->query($query);
        $mysqli->close();
        echo "<script>alert('Nutzungsdaten wurden erfolgreich gelöscht.')</script>";
        header("location:Nutzerdaten.php?dienstname=$dienstname");
    }

    function showDiensteAttribute($dienstname)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * from $dienstname";
        $mysqli->query($query);
        $stmt = $mysqli->query($query);
        return $stmt;
    }
}
?>