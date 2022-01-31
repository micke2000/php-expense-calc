<?php
session_start();
 include_once 'klasy/Baza.php';
 include_once 'klasy/User.php';
 include_once 'klasy/UserManager.php';
 $db = new Baza("localhost", "root", "", "projekt");
 $um = new UserManager();
 //kliknięto przycisk submit z name = zaloguj
 if($um->getLoggedInUser($db,session_id()) != -1){
    header("location:login.php");
    }
    else{
 if (filter_input(INPUT_POST, "submit")) {
 $userId=$um->login($db); //sprawdź parametry logowania
 if ($userId > 0) {
 header("location:login.php");
//  echo "<p>Poprawne logowanie.<br />";
//  echo "Zalogowany użytkownik o id=$userId <br />";
 //pokaż link wyloguj lub przekieruj
 // użytkownika na inną stronę dla zalogowanych
//  echo "<a href='processLogin.php?akcja=wyloguj' >
// Wyloguj</a> </p>";
 } else {
 $um->loginErrorForm(); //Pokaż formularz logowania
 }
 } else {
 //pierwsze uruchomienie skryptu processLogin
 $um->loginForm();
 }
}
 ?>