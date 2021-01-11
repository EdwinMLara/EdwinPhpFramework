<?php
    require_once("Config/RestApi.php");
    require_once("Config/Service.php");
    require_once("Config/Encryptation.php");
    require_once("Modelos/Usuarios.php");

    /**Se Crea una clase base para el control de la tabla Usuarios
     * en el constructor se declara la tabla a utilizar en la base de datos
     */

    class InsoelUsuariosApi extends RestApi{
        private $key;
        public function __construct(){
            parent::__construct("usuarios");
            $this->key = "insoelUserApiKey";
        }

        /**Este metodo se utiliza para agregar un usuario nuevo a la base de datos
         * primero se validan los parametros utlizando el metodo de la clase rest, con la finalidad 
         * de que ambos parametros sean del tipo cadena
         * 
         * como segundo se encrypta la constraseña para ser almacenada en la base de datos 
         */

        public function addUser(){
            $username = $this->validateParameter('username',$this->param["username"],STRING);
            $password = $this->validateParameter('password',$this->param["password"],STRING);
 
            $encrytedPassword = Encrytation::encrypt($password,$this->key);
            $this->returnResponse('SUCESS_RESPONSE',$encrytedPassword);

        }

        public function getUsers(){
            $usuarios = $service->getAll();
            echo json_encode($usuarios);
        }
    }
?>