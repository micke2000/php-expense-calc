<?php
 include_once 'klasy/User.php';
 include_once 'klasy/RegistrationForm.php';
 include_once 'klasy/Baza.php'; 
    $bd = new Baza("localhost", "root", "", "projekt");
    $form = new RegistrationForm();
    if (filter_input(INPUT_GET, "message")=="user_exist") {
        include $_SERVER['DOCUMENT_ROOT'].'/php_projekt/signup_form_error_exists.html';
        }
        else{
            include $_SERVER['DOCUMENT_ROOT'].'/php_projekt/signup_form.html';
        }
    if (filter_input(INPUT_POST, 'submit',FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
        $akcja = filter_input(INPUT_POST, "submit");
                $user = $form->checkUser(); 
                if ($user === NULL)
                header("location:index.php");
                else{
                    $allUsernames = explode(",", strip_tags(User::getAllUsernamesFromDB($bd)));
                    if(in_array($user->getUserName(),$allUsernames)){
                        header("location:index.php?message=user_exist");
                    }
                    else{
                    $user->saveDB($bd);
                    header("location:login.php");
                    }
                }
 }
 ?>