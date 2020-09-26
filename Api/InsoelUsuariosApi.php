<?php
    class InsoelUsuariosApi extends RestApi{
        public $service;
        public function __construct(){
            parent::__construct();
            $this->service = new Service("usuario");
        }

        public function addUser(){
            $username = $this->validateParameter('username',$this->param["username"],STRING);
            $password = $this->validateParameter('password',$this->param["password"],STRING);

            
            
        }
    }
?>