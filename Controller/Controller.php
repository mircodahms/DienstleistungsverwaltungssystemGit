<?php

class Controller extends Database {

    //Überprüfung, ob der Nutzer eingeloggt ist
    public static function isLogin ()   {
        session_start();
        if (!isset($_SESSION['userid'])) {
            die('Sie müssen sich <a href="index.php">einloggen</a>, um auf die Diensteverwaltung zuzugreifen.');
        }

        //Abfrage der Nutzer ID vom Login
        $userid = $_SESSION['userid'];
        //echo "Hallo User: " . $userid;
    }

    //Erstellung der Ansicht
    public static function CreateView($viewName) {
        require_once("./Views/$viewName.php");
    }

}


