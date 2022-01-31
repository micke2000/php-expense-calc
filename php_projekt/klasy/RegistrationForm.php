<?php
class RegistrationForm {
 protected $user;
 function __construct()
 {}
 function checkUser(){ // podobnie jak metoda validate z lab4
 $args = [
 'user_name' =>  ['filter' => FILTER_VALIDATE_REGEXP,
 'options' => ['regexp' => "/^[a-zA-Z0-9_.-]*$/"]
 ],
 'password' => ['filter' => FILTER_VALIDATE_REGEXP,
 'options' => ['regexp' => "/^(?=.*?[0-9])(?=.*?[a-zA-Z]).{8,}$/"]
 ],
 'email' => FILTER_VALIDATE_EMAIL
 ];
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
 $this->user=new User($dane['user_name'], $dane['email'], $dane['password']);
 } else {
 $this->user = NULL;
 }
 return $this->user;
 }
}
