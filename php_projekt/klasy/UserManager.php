<?php
class UserManager {
function loginForm() {
    include $_SERVER['DOCUMENT_ROOT'].'/php_projekt/login_form.html';
}
function loginErrorForm(){
    include $_SERVER['DOCUMENT_ROOT'].'/php_projekt/login_form_error.html';
}
function getLoggedInUser($db, $sessionId)
    {
        $sql = "SELECT userId FROM logged_in_users where sessionId = '$sessionId'";
        $w = strip_tags($db->select($sql,['userId']));
        if(strlen($w) != 0){
            $wynik = $db->select($sql,['userId']);
            return $wynik;
        }
        return -1;
    }
function login($db)
{
    $args = ['user_name' => FILTER_SANITIZE_STRING, 'password' => FILTER_SANITIZE_STRING];
        $dane = filter_input_array(INPUT_POST,$args);
        $login = $dane["user_name"];
        $passwd = $dane["password"];
        // echo $passwd;
        $userId = $db->selectUser($login, $passwd, "users");
        if ($userId >= 0)
        { 
            session_start();
            $sql = "DELETE * FROM logged_in_users where userId = '$userId'";
            $date  = date("Y-m-d H:i:s");
            $sessionId = session_id();
            $sql = "INSERT INTO logged_in_users VALUES('$sessionId',$userId,'$date')";
            $db->insert($sql);
        }
        return $userId;
    }
    function logout($db)
    {
        //pobierz id bieżącej sesji (pamiętaj o session_start()
        //usuń sesję (łącznie z ciasteczkiem sesyjnym)
        //usuń wpis z id bieżącej sesji z tabeli logged_in_users
        session_start();
        $sessionId = session_id();
        if ( isset($_COOKIE[session_name()]) ) {
            setcookie(session_name(),'', time() - 42000, '/');
           }
        session_destroy();
        $sql = "DELETE FROM logged_in_users where sessionId = '$sessionId'";
        $db->insert($sql);
    }
    
}

