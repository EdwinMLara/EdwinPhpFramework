<?php
    class Encrytation{
        public function __construct(){
        }

        public function encrypt(string $data, string $key, string $method): string{
            $ivSize = openssl_cipher_iv_length($method);
                $iv = openssl_random_pseudo_bytes($ivSize);
                $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
            $encrypted = strtoupper(implode(null, unpack('H*', $encrypted)));
            return $encrypted;
        }
        
        public function decrypt(string $data, string $key, string $method): string{
            $data = pack('H*', $data);
            $ivSize = openssl_cipher_iv_length($method);  
                $iv = $iv = openssl_random_pseudo_bytes($ivSize);
            $decrypted = openssl_decrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv); 
            return trim($decrypted);
        }
    }
?>