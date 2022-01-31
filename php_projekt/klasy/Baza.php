<?php
class Baza
{
        private $mysqli; //uchwyt do BD
        public function __construct($serwer, $user, $pass, $baza)
        {
                $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
                /* sprawdz połączenie */
                if ($this->mysqli->connect_errno) {
                        printf(
                                "Nie udało sie połączenie z serwerem: %s\n",
                                $this->mysqli->connect_error
                        );
                        exit();
                }
                /* zmien kodowanie na utf8 */
                if ($this->mysqli->set_charset("utf8")) {
 //udało sie zmienić kodowanie
                }
        } //koniec funkcji konstruktora
        function __destruct()
        {
                $this->mysqli->close();
        }
        public function select($sql, $pola)
        {
 //parametr $sql – łańcuch zapytania select
 //parametr $pola - tablica z nazwami pol w bazie 
 //Wynik funkcji – kod HTML tabeli z rekordami (String)
                $tresc = "";
                if ($result = $this->mysqli->query($sql)) {
                        $ilepol = count($pola); //ile pól
                        $ile = $result->num_rows; //ile wierszy
    // pętla po wyniku zapytania $results
                        $tresc .= "<table><tbody>";
                        while ($row = $result->fetch_object()) {
                                $tresc .= "<tr>";
                                for ($i = 0; $i < $ilepol; $i++) {
                                        $p = $pola[$i];
                                        $tresc .= "<td>" . $row->$p . "</td>";
                                }
                                $tresc .= "</tr>";
                        }
                        $tresc .= "</table></tbody>";
                        $result->close();
                        /* zwolnij pamięć */
                }
                return $tresc;
        }
        public function selectWithoutTags($sql, $pola)
        {
 //parametr $sql – łańcuch zapytania select
 //parametr $pola - tablica z nazwami pol w bazie 
 //Wynik funkcji – kod HTML tabeli z rekordami (String)
                $tresc = "";
                if ($result = $this->mysqli->query($sql)) {
                        $ilepol = count($pola); //ile pól
                        $ile = $result->num_rows; //ile wierszy
    // pętla po wyniku zapytania $results
                        $tresc .= "";
                        while ($row = $result->fetch_object()) {
                                for ($i = 0; $i < $ilepol; $i++) {
                                        $p = $pola[$i];
                                        $tresc .= $row->$p.',';
                                }
                                $tresc .= "<br>";
                        }
                        $result->close();
                        /* zwolnij pamięć */
                }
                return $tresc;
        }
        
        public function delete($sql) {
                
        }
        public function insert($sql)
        {
                if ($this->mysqli->query($sql)) return true;
                else return false;
        }
        public function getMysqli()
        {
                return $this->mysqli;
        }
        // public function selectUser($login, $passwd, $tabela){
        //         $sql = "select login,passwd from '$tabela'";
        //         $result = $this->mysqli->query($sql);
        //         echo $result['login']
        //         echo $result['passwd']
                
        // }
        public function selectUser($login, $passwd, $tabela) {
                //parametry $login, $passwd , $tabela – nazwa tabeli z użytkownikami
                //wynik – id użytkownika lub -1 jeśli dane logowania nie są poprawne
                $id = -1;
                $sql = "SELECT * FROM $tabela WHERE username='$login'";
                if ($result = $this->mysqli->query($sql)) {
                $ile = $result->num_rows;
                if ($ile == 1) {
                $row = $result->fetch_object(); //pobierz rekord z użytkownikiem
                var_dump($row);
                $hash = $row->password; //pobierz zahaszowane hasło użytkownika
                //sprawdź czy pobrane hasło pasuje do tego z tabeli bazy danych:
                // echo password_verify($passwd, $hash);
                echo strlen($hash);
                if (password_verify($passwd, $hash))
                $id = $row->id; //jeśli hasła się zgadzają - pobierz id użytkownika
                // echo "SDad";
                }
                }
                return $id; //id zalogowanego użytkownika(>0) lub -1
               }
} //koniec klasy Baza