<?php
class User {
// const STATUS_USER = 1;
// const STATUS_ADMIN = 2;
protected $userName;
protected $passwd;
protected $email;
protected $data;
// protected $status;

function __construct($userName, $email, $passwd ){
$this->userName=$userName;
$this->passwd=password_hash($passwd,PASSWORD_DEFAULT);
$this->email=$email;
$this->data=date("Y-m-d");
}
public function setUserName($usrName){
    $this->userName=$usrName;
}
public function getUserName(){
    return $this->userName; 
}

public function show() {
    echo "<br>";
    echo "UserName: ".$this->userName."<br>";
    echo "Haslo: ".$this->passwd."<br>";
    echo "Email: ".$this->email."<br>";
    echo "Data zalozenia konta: ".$this->data."<br>";
}
public static function getAllUsers($plik){
    $tab = json_decode(file_get_contents($plik));
    foreach ($tab as $val){
    echo "<p>".$val->userName." ".$val->fullName." ".$val->date."</p>";
}
}
function toArray(){
    $arr=[
    "userName" => $this->userName,
    "email" => $this->email,
    "passwd"=>$this->passwd,
    "date" => $this->data
    ];
    return $arr;
   }

function save($plik){
    $tab = json_decode(file_get_contents($plik),true);
    array_push($tab,$this->toArray());
    file_put_contents($plik, json_encode($tab));
   }
function saveDB($bd){
    $pola = $this->toArray();
    $wartosci  = [];
    foreach($pola as $key=>$value){
        if($key != 'submit')
       {
          if(is_array($value))
          {
                  $k = join(",",$value);
                  array_push($wartosci,$k);
          }
        array_push($wartosci,htmlspecialchars(trim($value)));
      }
}
$numeric = array_values($wartosci);
$sql =  "INSERT INTO users VALUES(NULL, '$numeric[0]', '$numeric[2]', '$numeric[1]', '$numeric[3]')";
// echo $sql;
//i wywołaj metodę:
$bd->insert($sql);   
}
static function getAllUsersFromDB($bd){
        $bd = new Baza("localhost", "root", "", "projekt");
        $pola = [
            "userName" ,
            "email",
            "passwd",
            "date"
        ];
        $sql = "select userName,email,passwd,date
        from users";
    $tresc = $bd->select($sql,$pola);
    echo $tresc;
    }
static function getAllUsernamesFromDB($bd){
        $bd = new Baza("localhost", "root", "", "projekt");
        $pola = ["userName"];
        $sql = "select userName from users";
    $tresc = $bd->selectWithoutTags($sql,$pola);
    return $tresc;
    }
}   
