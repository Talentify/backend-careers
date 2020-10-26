<?php
namespace Source\Controllers;
use Source\FirebaseCore;
    
class AuthController{

        private $key = '123456';
        private $timeStampNow;
        private $instaceFirebase;

        public function login($dataPost)
        {
            $this->instaceFirebase = new FirebaseCore();
            $this->instaceFirebase->setTable('users');

            if(!array_key_exists('email', $dataPost) && empty($dataPost['email'])){
                echo json_encode(['msg' => "Campo Email Não enviado", 'status' => 'error']);
                exit();
            }

            if(!array_key_exists('password', $dataPost) && empty($dataPost['password'])){
                echo json_encode(['msg' => "Campo Pasword Não informado", 'status' => 'error']);
                exit();
            }

            if(!filter_var($dataPost['email'], FILTER_SANITIZE_EMAIL)){
                echo json_encode(['msg' => "Email com Caracteres Inválidos", 'status' => 'error']);
                exit();
            }

            $email    = $dataPost['email'];
            $password = $dataPost['password'];
            if ($this->instaceFirebase->getLoginUser($email, $password)) {

                //Header Token
                $header = [
                    'typ' => 'JWT',
                    'alg' => 'HS256'
                ];

                //Payload - Token Expira em 30Minutos
                $payload = [
                    'exp'   => ((new \DateTime('now'))->add(new \DateInterval('PT30M')))->getTimestamp(),
                    'name'  => 'Thales Ruppenthal',
                    'email' => $_POST['email'],
                ];

                //JSON
                $header  = json_encode($header);
                $payload = json_encode($payload);

                $header  = $this->base64urlEncode($header);
                $payload = $this->base64urlEncode($payload);

                $sign  = hash_hmac('sha256', $header . "." . $payload, $this->key, true);
                $sign  = $this->base64urlEncode($sign);

                $token  = $header . '.' . $payload . '.' . $sign;
                $decode = $this->base64url_decode($sign);

                echo json_encode(['jtw_token' => $token]);
                exit();
            }
            
            echo json_encode(['msg' => 'Usuário Inválido', 'dataPost' => $dataPost]);
            exit();

        }

        public static function checkAuth()
        {
            $headerHttp = apache_request_headers();
            $tokenJwt   = explode(' ', $headerHttp['authorization'])[1];
            if (!empty($tokenJwt)) {
                $return = self::setObjectHeaderJWT($tokenJwt);

                //Conferir Assinatura
                $valid = hash_hmac('sha256', $return->header . "." . $return->payload, '123456', true);
                $valid = self::base64urlEncode($valid);

                if ($return->sing === $valid) {
                    $payload = self::setPayloadTokenJWT($return->payload);
                    return self::checkTimeTokenJWT($payload->exp);
                }

                return self::setPayloadTokenJWT($return->payload);

            }

            return false;
        }

        public function setObjectHeaderJWT($tokenJwt)
        {
            return (object)array_combine(['header', 'payload', 'sing'], explode('.', $tokenJwt));
        }

        public function checkTimeTokenJWT($startTimeStamp)
        {
            $limitExpiration         = (new \DateTime('now'))->format('Y-m-d H:i:s');
            $startTimeToken          = date('Y-m-d H:i:s', $startTimeStamp);
            $validateExpirationToken = $limitExpiration > $startTimeToken ? false : true;
            return $validateExpirationToken;
        }

        public function setPayloadTokenJWT($token)
        {
            $payload = json_decode(base64_decode($token));
            return $payload;
        }
        
        /*Criei os dois métodos abaixo, pois o jwt.io agora recomenda o uso do 'base64url_encode' no lugar do 'base64_encode'*/
        private function base64urlEncode($data)
        {
            return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
        }

                    
        private function base64url_decode($data, $strict = false)
        {
            // Convert Base64URL to Base64 by replacing “-” with “+” and “_” with “/”
            $b64 = strtr($data, '-_', '+/');

            // Decode Base64 string and return the original data
            return base64_decode($b64, $strict);
        }
}
