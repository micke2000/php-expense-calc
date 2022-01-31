<?php
session_start();
 include_once 'klasy/Baza.php';
 include_once 'klasy/User.php';
 include_once 'klasy/UserManager.php';
 include_once 'klasy/Expense.php';
$db = new Baza("localhost", "root", "", "projekt");
$um = new UserManager();
if($um->getLoggedInUser($db,session_id()) != -1){
$userId = strip_tags($um->getLoggedInUser($db,session_id()));
$sql = "SELECT id FROM users WHERE id = $userId";
$id = strip_tags($db->select($sql,["id"]));
 include $_SERVER['DOCUMENT_ROOT'].'/php_projekt/main_panel.html';
}
else{
    header("location:processLogin.php");
}
?>