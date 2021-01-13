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
            $this->key = "insoelKey";
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
            $typeCount = $this->validateParameter('typeCount',$this->param["typeCount"],INTEGER);

            $encrytedPassword = Encrytation::encrypt($password,$this->key);
            $arguments = array($username,$encrytedPassword,$typeCount);
            if($this->service->create($arguments)){
                $this->returnResponse('SUCESS_RESPONSE',"An user has been created");
            }else{
                $this->throwError('CREATED_ERROR',"An has been ocurred to create the object");
            }

        }

        public function getUsers(){
            $usuarios = $this->service->getAll();
            $this->returnResponse('SUCCES_RESPONSE',$usuarios);
        }

        public function updateUser(){}

        public function deleteUser(){}
    }
?>