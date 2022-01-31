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
$id = $db->selectWithoutTags($sql,["id"]);
include $_SERVER['DOCUMENT_ROOT'].'/php_projekt/overwiev.html';
if (isset($_GET['id'])) {
$expenseId = $_GET["id"];
$sql = "select id,userId from expenses where id = $expenseId";
$deletedExpense = explode(",",$db->selectWithoutTags($sql,['id','userId']));
if($userId == $deletedExpense[1]){
Expense::deleteExpense($db,$expenseId,$userId);
header('location:overwiev.php');
}
else{
    header('location:overwiev.php');
}
}
if (filter_input(INPUT_POST, 'submit',FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    $dane = filter_input_array(INPUT_POST);
    $name = $dane["name"];
    $amount = $dane["amount"];
    $category = $dane["category"];
    $expenseId = $dane["expenseId"];
    $expense = new Expense($name,$amount,$category,$id);
    $sql = "select id,userId from expenses where id = $expenseId";
    $deletedExpense = explode(",",$db->selectWithoutTags($sql,['id','userId']));
    if($userId == $deletedExpense[1]){
        $expense->editExpense($db,$expenseId);
    }
}
}   
else{
    header("location:login.php");
}
