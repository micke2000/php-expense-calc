<?php
session_start();
include_once 'klasy/Baza.php';
include_once 'klasy/User.php';
include_once 'klasy/UserManager.php';
include_once 'klasy/Expense.php';
$db = new Baza("localhost", "root", "", "projekt");
$um = new UserManager();
if($um->getLoggedInUser($db,session_id()) != -1){
    header("location:login.php");
}
else{
    include $_SERVER['DOCUMENT_ROOT'].'/php_projekt/home_page.html';
}