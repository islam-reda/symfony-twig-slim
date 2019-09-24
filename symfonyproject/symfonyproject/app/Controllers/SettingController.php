<?php
namespace App\Controllers;
use Slim\Http\UploadedFile;
use Slim\Http\Request;
use Slim\Http\Response;

class SettingController extends Controller {
    protected $db;
    protected $conn;
    public function index($request,$response){

        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ){

            if($_SESSION['userGName'] == 1) {

                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();
                $data = $this->db->getAllData('lo_setting', $this->conn->conn);
                $array = array();
                return $this->getview->render($response, 'base_list.twig', [
                    'title' => 'Setting',
                    'link' => 'setting',
                    'collectionNames' => array('key', 'value','Action'),
                    'collectionValues' => $data,
                    'values_selection' => array(1, 2),
                    'delete' => true,
                    'update' => true,
                    'addnew' => true,
                ]);

            }
            else {

                return "Unauthorized User";
            }

        }
        else {
            return $response->withRedirect('/public/');

        }
    }

    public function delete($request,$response, array $args){

        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ){

            if($_SESSION['userGName'] == 1) {
                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();
                $id = $args['id'];
                $delete = $this->db->delete('lo_setting',$this->conn->conn,'id',$id);
                return $response->withRedirect('/public/setting');
            }
            else{
                return "Unauthorized User";
            }

        } else {
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
                    $data['config_key'] = $request->getParam('config_key');
                    $data['value'] = $request->getParam('value');
                    $data['active'] = $request->getParam('active');
                    $key_exist = $this->db->checkFieldExistance('lo_setting',$this->conn->conn,'config_key',$request->getParam('config_key'));
                    if(!$key_exist){
                        $this->db->add('lo_setting',$data,$this->conn->conn);
                    }else{
                      $message = 'Not added There is same key found';
                    }
                    return $response->withRedirect('/public/setting');
                }else{
                    return $this->getview->render($response,'base_add.twig', [
                        'title' => 'Setting',
                        'updateAttrutesName' => array(
                            'config_key'=> 'config_key:text:required',
                            'value'=> 'value:text:required',
                            'active'=> 'active',
                        ),
                    ]);
                }
            }
        }
        else {
            return $response->withRedirect('/public/');
        }
    }
    public function update($request,$response, array $args){

        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ) {

            if ($_SESSION['userGName'] == 1) {
                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();
                $id = $args['id'];

                $row = $this->db->checkFieldExistance('lo_setting',$this->conn->conn,'id',$id);

                if($request->getMethod() == 'POST'){

                    $data = array();

                    $data['config_key'] = $request->getParam('config_key');
                    $data['value'] = $request->getParam('value');
                    $data['active'] = $request->getParam('active');

                    $this->db->update('lo_setting',$data,'id',$id,$this->conn->conn);

                    $row = $this->db->checkFieldExistance('lo_setting',$this->conn->conn,'id',$id);

                    return $this->getview->render($response,'base_update.twig', [
                        'title' => 'Update Setting',
                        'updateAttrutesName' => array(
                            'config_key'=> 'config_key:text:required',
                            'Value'=> 'value:text:required',
                            'Active' => 'active',
                        ),
                        'data' => $row,
                        'success' => 'Updated Succefully',
                        'link' => 'setting',

                    ]);
                }else{
                    if($row){

                        $row = $this->db->checkFieldExistance('lo_setting',$this->conn->conn,'id',$id);
                        return $this->getview->render($response,'base_update.twig', [
                            'title' => 'Update Setting',
                            'updateAttrutesName' => array(
                              'config_key'=> 'config_key:text:required',
                              'Value'=> 'value:text:required',
                              'Active' => 'active',
                            ),
                            'data' => $row,
                            'link' => 'setting',
                        ]);
                    }else{
                        return $response->withRedirect('/public/setting');
                    }
                    //
                }
            }
        }
        else {
            return $response->withRedirect('/public/');

        }

    }
}
