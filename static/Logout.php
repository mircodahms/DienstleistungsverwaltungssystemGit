<?php

session_start();
session_destroy();

echo '<script type="text/javascript" language="Javascript"> alert("Sie haben sich erfolgreich ausgeloggt") </script>';
header('location:../Views/Login.php');
?>