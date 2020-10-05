<?php
    require_once("Config/RestApi.php");
    require_once("Config/Service.php");
    require_once("Config/Encryptation.php");

    class InsoelUsuariosApi extends RestApi{
        public $service;
        private $key;
        public function __construct(){
            parent::__construct();
            $this->activeToken = false;
            $this->service = new Service("usuario");
            $this->key = "insoelUserApiKey";
        }

        public function addUser(){
            $username = $this->validateParameter('username',$this->param["username"],STRING);
            $password = $this->validateParameter('password',$this->param["password"],STRING);
 
            $encrytedPassword = Encrytation::encrypt($password,$this->key);
            $this->returnResponse('SUCESS_RESPONSE',$encrytedPassword);


        }
    }
?>