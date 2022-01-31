<?php
session_start();
include_once 'klasy/Baza.php';
include_once 'klasy/User.php';
include_once 'klasy/UserManager.php';
$db = new Baza("localhost", "root", "", "projekt");
$um = new UserManager();
if($um->getLoggedInUser($db,session_id()) != -1){
        $um->logout($db);
}
header("location:processLogin.php");
?>