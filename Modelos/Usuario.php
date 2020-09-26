<?php
    class Usuario{
        public static $tablename = "usuario";
        public String $idUsuario = "autoincrement";
        public String $username;
        public String $password;

        public function __construct(){
            $listArgs = func_get_args();
            $numArgs = count($listArgs);

            switch($numArgs){
                case 0:
                    $this->__construct1();
                    break;
                case 2:
                    $this->__construct2($listArgs[0],$listArgs[1]);
                    break;
                case 3:
                    $this->__construct3($listArgs[0],$listArgs[1],$listArgs[2]);
                    break;
            }
        }

        public function __construct1(){}
        
        public function __construct2($username,$password){
            $this->username = $username;
            $this->password = $password;
        }
        public function __construct3($idUsuario,$username,$password){
            $this->idUsuario = $idUsuario;
            $this->username = $username;
            $this->password = $password;
        }

    }
?>