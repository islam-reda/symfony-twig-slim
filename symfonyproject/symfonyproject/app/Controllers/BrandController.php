<?php
namespace App\Controllers;
class BrandController extends Controller {
    protected $db;
    protected $conn;
    public function index($request,$response){

        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ){

            if($_SESSION['userGName'] == 1) {
                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();
                $data = $this->db->getAllDatawithCondition('lo_brands', $this->conn->conn, 'active', 1);
                $array = array();
                return $this->getview->render($response, 'base_list.twig', [
                    'title' => 'Brands',
                    'link' => 'brands',
                    'collectionNames' => array('Brand Name', 'User', 'Date', 'Active', 'Actions'),
                    'collectionValues' => $data,
                    'values_selection' => array(1, 8, 5, 3),
                    'delete' => true,
                    'update' => true,
                    'addnew' => true,
                ]);

            }else {

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
                $delete = $this->db->delete('lo_brands',$this->conn->conn,'brand_id',$id);
                return $response->withRedirect('/public/brands');

            }
            else{
                return "Unauthorized User";

            }

        } else {
            return $response->withRedirect('/public/');

        }

    }

	public function json_decode($str){
		return json_decode($str);
	}

    public function new($request,$response, array $args){


        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ) {

            if ($_SESSION['userGName'] == 1) {

                $this->db = new \App\Models\db();
                //
                $validation = new \App\Models\core_validation();

                //var_dump($validation);
                //die;
                $this->conn = \App\Models\db_connection::Instance();
                if($request->getMethod() == 'POST'){

                    if($_FILES["brand_logofile"]['name']){

                        $fileaneme1 = $this->moveUploadedFile($_FILES["brand_logofile"]);

                    }


                    $brandNameValidation = $validation->_valid_required($request->getParam('brand_name'));
                    $brandLogFileValidation = $validation->_valid_required($fileaneme1);


                    if(!$brandNameValidation || !$brandLogFileValidation){
                        //return "False";


                        return $this->getview->render($response,'base_add.twig', [
                            'title' => 'Add Brand',
                            'updateAttrutesName' =>
                                array(
                                    'Brand Name'=> 'brand_name:text:required',
                                    'Logo' => 'brand_logofile:file:required',
                                    'Activation Code' => 'activation_code:text:required',
                                    'Active' => 'active'),
                            'error' => 'Please Fill the required Fields',

                        ]);

                    }

                    $data = array();
                    $data['brand_name'] = $request->getParam('brand_name');
                    $data['brand_logofile'] = $fileaneme1;
                    $data['activation_code'] = $request->getParam('activation_code');
                    $data['active'] = $request->getParam('active');
                    date_default_timezone_set("Africa/Cairo");
                    $data['created_date'] =  $date = date('Y-m-d H:i:s');
                    $data['user_id'] = $_SESSION['userId'];//sesson_id

                    //validation

                    $this->db->add('lo_brands',$data,$this->conn->conn);

                    //end validation

                    return $response->withRedirect('/public/brands');
                }else{
                    return $this->getview->render($response,'base_add.twig', [
                        'title' => 'Add Brand',
                        'updateAttrutesName' =>
                            array(
                                'Brand Name'=> 'brand_name:text:required',
                                'Logo' => 'brand_logofile:file:required',
                                'Activation Code' => 'activation_code:text:required',
                                'Active' => 'active',
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
                $row = $this->db->checkFieldExistance('lo_brands',$this->conn->conn,'brand_id',$id);
                if($request->getMethod() == 'POST'){

                    $data = array();

                    if($_FILES["brand_logofile"]['name']){

                        $fileaneme1 = $this->moveUploadedFile($_FILES["brand_logofile"]);
                        $data['brand_logofile'] = $fileaneme1;

                    }

                    //$fileaneme1 = $this->moveUploadedFile($_FILES["brand_logofile"]);

                    $data['brand_name'] = $request->getParam('brand_name');
                    $data['activation_code'] = $request->getParam('activation_code');
                    $data['active'] = $request->getParam('active');

                    $this->db->update('lo_brands',$data,'brand_id',$id,$this->conn->conn);

                    $row = $this->db->checkFieldExistance('lo_brands',$this->conn->conn,'brand_id',$id);

                    return $this->getview->render($response,'base_update.twig', [
                        'title' => 'Update Brand',
                        'updateAttrutesName' => array(
                            'Brand Name'=> 'brand_name:text:required',
                            'Logo' => 'brand_logofile:file',
                            'Activation Code' => 'activation_code',
                            'Active' => 'active'),
                        'data' => $row,
                        'success' => 'Updated Successfully',
                        'link' => 'brands',
                    ]);
                }

                else{
                    if($row){
                        return $this->getview->render($response,'base_update.twig', [
                            'title' => 'Update Brand',
                            'updateAttrutesName' =>
                                array(
                                    'Brand Name'=> 'brand_name:text:required',
                                    'Logo' => 'brand_logofile:file',
                                    'Activation Code' => 'activation_code',
                                    'Active' => 'active'),
                            'data' => $row,
                            'link' => 'brands',
                        ]);
                    }else{
                        return $response->withRedirect('/public/brands');
                    }
                }
            }
        }
        else {
            return $response->withRedirect('/public/');

        }

    }
}
