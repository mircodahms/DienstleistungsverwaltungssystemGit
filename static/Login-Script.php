<?php
session_start();
if(isset($_POST['submit'])){

    include('../Classes/DatabaseFunction.php');
    $obj=new DatabaseFunction();
    $_SESSION['login']=$_POST['id'];
    $obj->login($_POST['id'],$_POST['password']);
}
?>