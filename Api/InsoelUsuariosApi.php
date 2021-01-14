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

        /**Este método se utiliza para agregar un usuario nuevo a la base de datos
         * primero se validan los parametros utlizando el metodo de la clase rest, con la finalidad 
         * de que ambos parametros sean del tipo cadena
         * 
         * como segundo se encrypta la constraseña para ser almacenada en la base de datos 
         */

        public function addUser(){
            /**Se obtienen  los parametros obtenidos del cuerpo de la petecion los cuales,
             * estan dentro del arrelgo de parametros
             */
            $username = $this->validateParameter('username',$this->param["username"],STRING);
            $password = $this->validateParameter('password',$this->param["password"],STRING);
            $typeCount = $this->validateParameter('typeCount',$this->param["typeCount"],INTEGER);

            /**se encrypta el password utilizando funciones de openssl */
            $encrytedPassword = Encrytation::encrypt($password,$this->key);

            /**Se crea un arreglo de parámetros ya que la funcion lo necesita para poder
             * crear un objeto de tipo usuario en este caso
            */
            $arguments = array($username,$encrytedPassword,$typeCount);
            if($this->service->create($arguments)){
                $this->returnResponse('SUCESS_RESPONSE',"An user has been created.");
            }else{
                $this->throwError('CREATED_ERROR',"An has been ocurred to create the object.");
            }
        }

        public function getUsers(){
            /**Este método retorna un array de objectos del tipo usuario*/
            $usuarios = $this->service->getAll();
            $this->returnResponse('SUCCES_RESPONSE',$usuarios);
        }

        public function updateUser(){
            $id_usuario = $this->validateParameter('id_usuario',$this->param["id_usuario"],INTEGER);
            $username = $this->validateParameter('username',$this->param["username"],STRING);
            $password = $this->validateParameter('password',$this->param["password"],STRING);
            $typeCount = $this->validateParameter('typeCount',$this->param["typeCount"],INTEGER);
               
            $encrytedPassword = Encrytation::encrypt($password,$this->key);
            $arguments = array($id_usuario,$username,$encrytedPassword,$typeCount);
            /**La función update utiliza un array con los nuevos argumentos 
             * y el id del usuario a actualizar
            */

            if($this->service->update($arguments,$id_usuario)){
                $this->returnResponse('SUCESS_RESPONSE',"The user has been updated sucessfully.");
            }else{
                $this->throwError('UPDATE_ERROR',"An has been ocurred to update the user.");
            }
        }

        public function deleteUser(){
            $id_usuario = $this->validateParameter('id_usuario',$this->param["id_usuario"],INTEGER);
            if($this->service->delete("id_usuario",$id_usuario)){
                $this->returnResponse('SUCESS_RESPONSE',"The user has been deleted sucessfully.");
            }else{
                $this->throwError('UPDATE_ERROR',"An has been ocurred to deleted the user.");
            }
        }
    }
?>