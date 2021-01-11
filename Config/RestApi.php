<?php
    require_once("JWT.php");
    require_once("Rest.php");
    class RestApi extends Rest{
        public $service;
        
        public function __construct($typeService){
            parent::__construct(); 
            $this->service = new Service($typeService); 
        }

        /**El metodo generar token se utliza para generar un token valido
         * el cual permitira realizar transacciones con la base de datos durante cierto periodo
         * en este caso se utilizan 20 min
        */

        public function generateToken(){
            $username = $this->validateParameter('username',$this->param["username"],STRING);
            $password = $this->validateParameter('password',$this->param["password"],STRING);
                  
            $usuario = $this->service->getByField("usuario",$username);

            try{
                $payload = [
                    'iat' => time(),
                    'iss' => 'localhost',
                    'exp' => time()+(20*60), //son segundo para que no se olvide
                    'userId' => $usuario->idUsuario
                ];

                $token = JWT::encode($payload,SECRET_KEY);
                $data = ['token' => $token];
                $this->returnResponse(SUCESS_RESPONSE,$data);
            }catch(Exception $e){
                $this->throwError(JWT_PROCESSING_ERROR, $e->getMessage());
            }
        }

    }

    
?>