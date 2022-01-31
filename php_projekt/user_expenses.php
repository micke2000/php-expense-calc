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
$allExpenses = Expense::getAllUserExpenses($db,$id);
// $allExpenses = str_replace("</tr>","<br>",Expense::getAllUserExpenses($db,$id));
// $allExpenses = str_replace("</td>",",",$allExpenses);
// $allExpenses = strip_tags($allExpenses,'<br>');
// echo($allExpenses);
$expenses = explode("<br>",$allExpenses);
unset($expenses[count($expenses)-1]);
for ($i=0; $i < count($expenses); $i++) { 
    $expenses[$i] = explode(",", $expenses[$i]);
    unset($expenses[$i][count($expenses[$i])-1]);
}
$expenses = json_encode($expenses);
echo $expenses;
// var_dump( json_decode(json_encode($expenses)));
}   
else{
    header("location:login.php");
}
