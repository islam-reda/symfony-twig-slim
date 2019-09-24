<?php
namespace App\Controllers;
class UserController extends Controller {
  protected $db;
  protected $conn;

  public function index($request,$response){

      //die;
      if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ) {
          if ($_SESSION['userGName'] == 1) {
              $this->db = new \App\Models\db();
              $this->conn = \App\Models\db_connection::Instance();
              $data = $this->db->getAllDatawithCondition('lo_admin_users',$this->conn->conn,'active',1);
              $array = array();
              return $this->getview->render($response,'base_list.twig', [
                  'title' => 'Users',
                  'link' => 'users',
                  'collectionNames' => array('Email','Password','Active','Actions'),
                  'collectionValues' => $data,
                  'values_selection' => array(1,2,3),
                  'delete' => true,
                  'update' => true,
                  'addnew' => true,
              ]);
          }
          else{

              return "Unauthorized User";

          }
      }
      else{
          return $response->withRedirect('/public/');

      }


  }

    public function new($request,$response, array $args){

        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ) {
            if ($_SESSION['userGName'] == 1) {
                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();
                if($request->getMethod() == 'POST'){


                    $data = array();
                    $data['email'] = $request->getParam('email');
                    $data['password'] = md5($request->getParam('password'));
                    $data['active'] = $request->getParam('active');
                    $data['user_level'] = $request->getParam('user_level');

                    $this->db->add('lo_admin_users',$data,$this->conn->conn);
                    return $response->withRedirect('/public/users');
                }
                else{

                    $userTypeData = $this->db->getAllData('lo_user_level',$this->conn->conn);

                    $userTypeArray = array();

                    foreach($userTypeData as $userType){
                        $userTypeArray[$userType['level_id']] = $userType['g_name'];
                    }


                    return $this->getview->render($response,'base_add.twig', [
                        'title' => 'Add User',
                        'options'=> $userTypeArray,
                        'updateAttrutesName' =>
                            array(
                                'Email'=> 'email:email:required',
                                'Password' => 'password:password:required',
                                'Active' => 'active',
                                'Type' =>  'user_level:select',

                            ),
                    ]);
                }

            }
            else{
                return "Unauthorized User";

            }
        }
        else{
            return $response->withRedirect('/public/');
        }

    }

    public function update($request,$response, array $args){

        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ) {
            if ($_SESSION['userGName'] == 1) {
                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();
                $id = $args['id'];
                $row = $this->db->checkFieldExistance('lo_admin_users',$this->conn->conn,'user_id',$id);

                if($request->getMethod() == 'POST'){

                    $data = array();
                    $data['email'] = $request->getParam('email');
                    if($request->getParam('password')){
                        $data['password'] = md5($request->getParam('password'));
                    }
                    $data['active'] = $request->getParam('active');

                    $data['user_level'] = $request->getParam('user_level');

                    $this->db->update('lo_admin_users',$data,'user_id',$id,$this->conn->conn);

                    $row = $this->db->checkFieldExistance('lo_admin_users',$this->conn->conn,'user_id',$id);

                    unset($row['password']);

                    $userTypeData = $this->db->getAllData('lo_user_level',$this->conn->conn);

                    $userTypeArray = array();

                    foreach($userTypeData as $userType){
                        $userTypeArray[$userType['level_id']] = $userType['g_name'];
                    }

                    return $this->getview->render($response,'base_update.twig', [
                        'title' => 'Update User',
                        'options'=> $userTypeArray,
                        'updateAttrutesName' => array(
                            'Email'=> 'email:required:required',
                            'Password' => 'password:password:required',
                            'Active' => 'active',
                            'Type' =>  'user_level:select',
                        ),
                        'data' => $row,
                        'success' => 'Updated Successfully',
                        'link' => 'users',
                    ]);

                }else{
                    if($row){

                        unset($row['password']);

                        $userTypeData = $this->db->getAllData('lo_user_level',$this->conn->conn);

                        $userTypeArray = array();

                        foreach($userTypeData as $userType){
                            $userTypeArray[$userType['level_id']] = $userType['g_name'];
                        }

                        return $this->getview->render($response,'base_update.twig', [
                            'title' => 'Update User',
                            'options'=> $userTypeArray,
                            'updateAttrutesName' => array(
                                'Email'=> 'email:email:required',
                                'Password' => 'password:password:required',
                                'Active' => 'active',
                                'Type' =>  'user_level:select',
                            ),
                            'data' => $row,
                            'link' => 'users',
                        ]);
                    }else{
                        return $response->withRedirect('/public/users');
                    }
                }

            }else{
                return "Unauthorized User";

            }
        }else{
            return $response->withRedirect('/public/');

        }

    }

    public function delete($request,$response, array $args){
        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ) {
            if ($_SESSION['userGName'] == 1) {

                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();
                $id = $args['id'];
                $delete = $this->db->delete('lo_admin_users',$this->conn->conn,'user_id',$id);
                return $response->withRedirect('/public/users');

            }else{

                return "Unauthorized User";

            }
        }else{
            return $response->withRedirect('/public/');

        }


    }




}
