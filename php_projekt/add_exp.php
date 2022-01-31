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
    include $_SERVER['DOCUMENT_ROOT'].'/php_projekt/add_exp.html';
    if (filter_input(INPUT_POST, "submit")) {
        $args = [
        'name' => ['filter' => FILTER_VALIDATE_REGEXP,
        'options' => ['regexp' => "/^[a-zA-Z0-9_.-]*$/"]
        ], 
        'amount' => ['filter' => FILTER_VALIDATE_REGEXP,
        'options' => ['regexp' => "/^\d+.\d+$/"]
        ],
        'category' => FILTER_SANITIZE_STRING];
        $dane = filter_input_array(INPUT_POST,$args);
        $errors = "";
         foreach ($dane as $key => $val) 
        {
            if ($val === false or $val === NULL) 
            {
                $errors .= $key."<br>";
            }
        }
        if ($errors === "") {
        $name = $dane["name"];
        $amount = $dane["amount"];
        $category = $dane["category"];
        $expense = new Expense($name,$amount,$category,$id);
        $expense->saveDB($db);
        }
    }
    }
    else{
        header("location:processLogin.php");
    }
?>