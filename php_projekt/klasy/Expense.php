<?php
class Expense {
protected $name;
protected $amount;
protected $category;
protected $userId;
protected $date;
function __construct($name, $amount, $category,$userId){
    $this->name=$name;
    $this->amount=$amount;
    $this->category=$category;
    $this->userId = $userId;
    $this->date=date("Y-m-d");
    }
    function toArray(){
        $arr=[
        "name" => $this->name,
        "amount" => $this->amount,
        "category"=>$this->category,
        "userId" =>$this->userId,
        "date" => $this->date
        ];
        return $arr;
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
    $sql =  "INSERT INTO expenses VALUES(NULL, '$numeric[0]', $numeric[1], '$numeric[2]', $numeric[3],'$numeric[4]');";
    $bd->insert($sql);   
    }
    function editExpense($bd,$expenseId){
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
    $sql =  "UPDATE expenses SET name = '$numeric[0]', amount = $numeric[1], category ='$numeric[2]' WHERE id = $expenseId;";
    $bd->insert($sql);   
    }
    static function getAllUserExpenses($bd,$userId){
        $sql =  "select id,name,amount,category,date FROM expenses where userId = $userId";
        $pola = ["id", 
        "name",
        "amount",
        "category",
        "date"];
        $tresc = $bd->selectWithoutTags($sql,$pola);
        return $tresc;
    }
    static function getTotalMonthExpenses($bd,$userId,$currentMonth,$currentYear){
        $sql =  "select amount,date FROM expenses where userId = $userId";
        $pola = ["amount",'date'];
        $suma = 0.0;
        $allAmountsWithDate = explode("<br>", $bd->selectWithoutTags($sql,$pola));
        unset($allAmountsWithDate[count($allAmountsWithDate)-1]);
        for ($i=0; $i < count($allAmountsWithDate); $i++) 
        {
            $allAmountsWithDate[$i] = explode(",",$allAmountsWithDate[$i]);
            unset($allAmountsWithDate[$i][count($allAmountsWithDate[$i])-1]);
        }
        foreach($allAmountsWithDate as $expense){
            $expenseMonth = explode("-",$expense[1])[1];
            $expenseYear = explode("-",$expense[1])[0];
            if($expenseMonth == $currentMonth && $expenseYear == $currentYear){
                $suma += floatval($expense[0]);
            }
        }
        return $suma;
    }
    static function deleteExpense($bd,$id){
        $sql =  "DELETE FROM expenses WHERE id = $id";
        $bd->insert($sql);
    }
}