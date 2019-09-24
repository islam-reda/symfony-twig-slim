<?php
namespace App\Models;
use \SessionHandler;
define('SESSION_SAVE_PATH',dirname(realpath($_SERVER['DOCUMENT_ROOT'])).DIRECTORY_SEPARATOR.'html'.DIRECTORY_SEPARATOR.'sessions');

class session extends SessionHandler {


    private $sessionName  =  'MYAPPSESS';

    private $sessionMaxLife = 66;

    private $sessionSSL = false;

    private $sessionHTTPOnly = true;
    private $sessionPath = '/';  //
    private $sessionDomain = '.localhost/session_tutorial';

    private $sessionSavePath = SESSION_SAVE_PATH;

    private $sessionCipherAlgo = MCRYPT_BLOWFISH;
    private $sessionCipherMode =   MCRYPT_MODE_ECB ;
    private $sessionCipherKey = 'WYCRYPT0KY@2016';

    private $cipher = "aes-128-gcm";

    private $tag;

    //private $iv = iv;
    //private $ivlen = ivlen;

    private $value;



    private $ttl = 1;

    //private sessionStartTime = 1;

//$key = "WYCRYPT0K3Y@2016";



    public function __construct(){


//        $this->ivlen = openssl_cipher_iv_length($this->cipher);
//        $this->iv = openssl_random_pseudo_bytes($this->ivlen);


        //ini_set('session.use_cookies',1);
        //ini_set('session.use_only_cookies',1);
        //ini_set('session.use_trans_sid',0);
        //ini_set('session.save_handler','files');
        //ini_set('session.cookie_secure','On');

        //session_name($this->sessionName);

        session_save_path($this->sessionSavePath);


        session_set_cookie_params(
            $this->sessionMaxLife, $this->sessionPath,
            $this->sessionDomain, $this->sessionSSL,
            $this->sessionHTTPOnly
        );

        session_set_save_handler($this,true);
    }

    public function __set($name, $value)
    {
        $_SESSION[$name]  = $value;
    }

    public function __get($name)
    {

        return false !== $_SESSION[$name] ? $_SESSION[$name] :false;
    }

    public function __isset($name)
    {
        return isset($_SESSION[$name]) ? true : false;
    }

    public function read($session_id)
    {

        //$this->value =  openssl_decrypt(parent::read($session_id),$this->cipher,$this->sessionCipherKey, OPENSSL_RAW_DATA,$iv,$this->tag);
        //return openssl_decrypt(parent::read($session_id),$this->cipher,$this->sessionCipherKey,1,$this->iv,$this->tag);

        return mcrypt_decrypt($this->sessionCipherAlgo,$this->sessionCipherKey,parent::read($session_id),$this->sessionCipherMode);


//            if($this->value != null){
//                return $this->value;
//            }else{
//
//                return "";
//            }


        //  return parent::read($session_id);
    }

    public function write($session_id, $session_data)
    {


        //return parent::write($session_id,$session_data);

        //return parent::write($session_id,
        // openssl_encrypt($session_data,$this->cipher,$this->sessionCipherKey,OPENSSL_RAW_DATA,$iv,$this->tag));

        return parent::write(
            $session_id,
            mcrypt_encrypt($this->sessionCipherAlgo,$this->sessionCipherKey,$session_data,$this->sessionCipherMode));

    }


    public function start(){

        if('' === session_id()){

            //return session_start();

            if(session_start()){

                $this->setSessionStartTime();


            }
        }
    }



    private function setSessionStartTime(){
        if(!isset($this->sessionStartTime)){
            $this->sessionStartTime = time();
            $this->checkSessionValidity();
        }

        return true;
    }

    private function checkSessionValidity()
    {
        if ( (time()- $this->sessionStartTime)  > ($this->ttl * 60) ){
            $this->renewSession();
            $this->generateFingerPrint();
        }

        return true;
    }



    private function renewSession()
    {
        $this->sessionStartTime = time();

        return session_regenerate_id(true);
    }

    public function kill(){
        session_unset();

        setcookie($this->sessionName,'',time()-1000,$this->sessionPath,$this->sessionDomain,$this->sessionSSL,
            $this->sessionHTTPOnly);

        session_destroy();
    }

    private function generateFingerPrint(){
        $userAgentId = $_SERVER['HTTP_USER_AGENT'];
        $this->cipherKey = mcrypt_create_iv(16);
        $sessionId = session_id();
        $this->fingerPrint = md5($userAgentId. $this->cipherKey.$sessionId);
    }

    public function isValidFingerPrint(){

        if(!isset($this->fingerPrint)){
            $this->generateFingerPrint();

        }

        $fingerPrint = md5($_SERVER['HTTP_USER_AGENT']. $this->cipherKey.session_id());

        if($fingerPrint === $this->fingerPrint){
            return true;
        }

        return false;


    }


}





