<?php
namespace App\Controllers;
class LoginController extends Controller {
    protected $db;
    protected $conn;

    public function index($request,$response){



        if(!isset($_SESSION['userEmail']) || !isset($_SESSION['userGName']) ) {

            if($request->getMethod() == 'GET'){

                //testing

                //$this->conn = \App\Models\db_connection::Instance();
                //$this->db = new \App\Models\db();
                //$data = $this->db->login('lo_admin_users',$this->conn->conn,"eslam@yahoo.com",md5(123));
                // var_dump($data['g_name']);
                //die;
                //$session->name = "dd";
                //var_dump($_SESSION);

                return $this->getview->render($response,'login.twig', [
                    'title' => 'Login'
                ]);

            }elseif($request->getMethod() == 'POST'){

                // $request->getParams()
                $email = $request->getParam('email');
                $password = md5($request->getParam('password'));
                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();
                $session= new \App\Models\session();
                $data = $this->db->login('lo_admin_users',$this->conn->conn,$email,$password);

                //var_dump($data ["user_id"]);
                //die;

                $user_level = $data['user_level'];

                //session
                if($data){

                    $session->start();
                    $session->userEmail = $email;
                    $session->userGName = $user_level;
                    //$this->setglobal($email);
                    $session->userId = $data["user_id"];

                    return $response->withRedirect('/public/brands');

                }else{


                    return $this->getview->render($response,'login.twig', [
                        'title' => 'Login',
                        'error' => 'Email or Password invalid , please try again later',
                    ]);


                    //echo $_SESSION['userEmail'];
                }
            }


        }
        else{

            return $response->withRedirect('/public/brands');

        }


    }

    public function logout($request,$response){


        $session= new \App\Models\session();

        $session->kill();

        return $response->withRedirect('/public/');

    }


}
