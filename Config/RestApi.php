<?php
    class RestApi extends Rest{
        public function __construct(){
            parent::__construct();  
        }

        public function generateToken($user){
            try{
                
                if(!is_object($user)){
                    $this->returnResponse(INVALID_USER_PASS,"email or password is incorrect. ");
                }

                if($user->is_active == 0){
                    $this->returnResponse(USER_NOT_ACTIVE,"The user not active.");
                }

                $payload = [
                    'iat' => time(),
                    'iss' => 'localhost',
                    'exp' => time()+(5*60), //son segundo para que no se olvide
                    'userId' => $user->id
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