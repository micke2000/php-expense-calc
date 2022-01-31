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
    $sql = "SELECT username FROM users WHERE id = $userId";
    $username = explode(",",$db->selectWithoutTags($sql,["username"]))[0];
    $totalExpenses = Expense::getTotalMonthExpenses($db,$userId,date('m'),date('Y'));
    $data = ['username'=>$username,'totalMonthExpenses'=>round($totalExpenses,2)];
    echo json_encode($data);
    }
?>