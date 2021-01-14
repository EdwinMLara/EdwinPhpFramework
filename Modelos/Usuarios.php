<?php
    class Usuarios{
        public static $tablename = "usuarios";
        public String $id_usuario = "autoincrement";
        public String $username;
        public String $password;
        public String $typeCount;
        public String $time = "now()";

        public function __construct(){
            $listArgs = func_get_args()[0];
            $numArgs = count($listArgs);

            switch($numArgs){
                case 0:
                    $this->__construct1();
                    break;
                case 3:
                    $this->__construct3($listArgs[0],$listArgs[1],$listArgs[2]);
                    break;
                case 4:
                    $this->__construct4($listArgs[0],$listArgs[1],$listArgs[2],$listArgs[3]);
                    break;
                case 5:
                    $this->__construct5($listArgs[0],$listArgs[1],$listArgs[2],$listArgs[3],$listArgs[4]);
                    break;
                default:
                    echo $numArgs." No hay constructor de este tipo";
            }
        }

        public function __construct1(){}
        
        public function __construct3($username,$password,$typeCount){
            $this->username = $username;
            $this->password = $password;
            $this->typeCount = $typeCount;
        }

        public function __construct4($id_usuario,$username,$password,$typeCount){
            $this->id_usuario = $id_usuario;
            $this->username = $username;
            $this->password = $password;
            $this->typeCount = $typeCount;
        }

        public function __construct5($id_usuario,$username,$password,$typeCount,$time){
            $this->id_usuario = $id_usuario;
            $this->username = $username;
            $this->password = $password;
            $this->typeCount = $typeCount;
            $this->time = $time;
        }

    }
?>