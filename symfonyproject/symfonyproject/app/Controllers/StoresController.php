<?php
namespace App\Controllers;
use Slim\Http\UploadedFile;
use Slim\Http\Request;
use Slim\Http\Response;

class StoresController extends Controller {
    protected $db;
    protected $conn;
    public function index($request,$response){



        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ){

            if($_SESSION['userGName'] == 1) {

                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();
                $data = $this->db->getAllDatawithCondition('lo_brand_stores', $this->conn->conn, 'active', 1);
                $array = array();
                return $this->getview->render($response, 'base_list.twig', [
                    'title' => 'Stores',
                    'link' => 'stores',
                    'collectionNames' => array('Store Number', 'Code', 'Name', 'Region','Actions'),
                    'collectionValues' => $data,
                    'values_selection' => array(0, 2, 3, 7),
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



    public function new($request,$response, array $args){


        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ) {

            if ($_SESSION['userGName'] == 1) {
                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();
                if($request->getMethod() == 'POST'){

                    date_default_timezone_set("Africa/Cairo");

                    $data = array();

                    $data['brand_id'] = $request->getParam('brand_id');

                    $data['store_code'] = $request->getParam('store_code');
                    $data['store_name'] = $request->getParam('store_name');

                    $data['store_loc_lat'] = $request->getParam('store_loc_lat');
                    $data['store_loc_lon'] = $request->getParam('store_loc_lon');
                    $data['active'] = $request->getParam('active');

                    $data['store_region'] = $request->getParam('store_region');
                    $data['store_addr1'] = $request->getParam('store_addr1');

                    //var_dump($data);


                    $this->db->add('lo_brand_stores',$data,$this->conn->conn);
                    //die;

                    return $response->withRedirect('/public/stores');

                }else{
                    //'ad_title', 'ad_desc1', 'start_date', 'end_date'


                    $BrandsData = $this->db->getAllDatawithCondition('lo_brands',$this->conn->conn,"active",1);
                    $brandsarr = array();
                    foreach($BrandsData as $Brand){
                        $brandsarr[$Brand['brand_id']] = $Brand['brand_name'];
                    }

                    return $this->getview->render($response,'store_add.twig', [
                        'title' => 'Add Stores',
                        'options'=> $brandsarr,
                        'updateAttrutesName' => array(
                            'Brand'=> 'brand_id:select',
                            'Store Code' => 'store_code:text:required:5',
                            'Store Name' => 'store_name:text:required',
                            'Active' => 'active',
                            'store_region' => 'store_region:text:required',
                            'Store Address' => 'store_addr1:text:required',
                            'Store Location Latitude' => 'store_loc_lat:text:required',
                            'Store Location Lon' => 'store_loc_lon:text:required',
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

                $row = $this->db->checkFieldExistance('lo_brand_stores',$this->conn->conn,'store_no',$id);

                if($request->getMethod() == 'POST'){

                    $data = array();

                    $data['brand_id'] = $request->getParam('brand_id');

                    $data['store_code'] = $request->getParam('store_code');
                    $data['store_name'] = $request->getParam('store_name');

                    $data['store_loc_lat'] = $request->getParam('store_loc_lat');
                    $data['store_loc_lon'] = $request->getParam('store_loc_lon');
                    $data['active'] = $request->getParam('active');

                    $data['store_region'] = $request->getParam('store_region');
                    $data['store_addr1'] = $request->getParam('store_addr1');

                   // var_dump($data);
                    //die();

                    $this->db->update('lo_brand_stores',$data,'store_no',$id,$this->conn->conn);

                    $row = $this->db->checkFieldExistance('lo_brand_stores',$this->conn->conn,'store_no',$id);

                    $BrandsData = $this->db->getAllDatawithCondition('lo_brands',$this->conn->conn,"active",1);

                    $brandsarr = array();
                    foreach($BrandsData as $Brand){
                        $brandsarr[$Brand['brand_id']] = $Brand['brand_name'];
                    }

                    //ddd
                    return $this->getview->render($response,'store_update.twig', [
                        'title' => 'Update Store',
                        'options'=> $brandsarr,
                        'updateAttrutesName' => array(
                            'Brand'=> 'brand_id:select',
                            'Store Code' => 'store_code:text:required:5',
                            'Store Name' => 'store_name:text:required',
                            'Active' => 'active',
                            'store_region' => 'store_region:text:required',
                            'Store Address' => 'store_addr1:text:required',
                            'Store Location Latitude' => 'store_loc_lat:text:required',
                            'Store Location Lon' => 'store_loc_lon:text:required',
                        ),
                        'data' => $row,
                        'success' => 'Updated Successfully',
                        'link' => 'stores',
                    ]);

                    //return $response->withRedirect('/public/brand_news');

                }else{
                    if($row){
                        $row = $this->db->checkFieldExistance('lo_brand_stores',$this->conn->conn,'store_no',$id);

                        $BrandsData = $this->db->getAllDatawithCondition('lo_brands',$this->conn->conn,"active",1);

                        $brandsarr = array();
                        foreach($BrandsData as $Brand){
                            $brandsarr[$Brand['brand_id']] = $Brand['brand_name'];
                        }

                        return $this->getview->render($response,'store_update.twig', [
                            'title' => 'Update Stores',
                            'options'=> $brandsarr,
                            'updateAttrutesName' => array(
                                'Brand'=> 'brand_id:select',
                                'Store Code' => 'store_code:text:required:5',
                                'Store Name' => 'store_name:text:required',
                                'Active' => 'active',
                                'store_region' => 'store_region:text:required',
                                'Store Address' => 'store_addr1:text:required',
                                'Store Location Latitude' => 'store_loc_lat:text:required',
                                'Store Location Lon' => 'store_loc_lon:text:required',
                            ),
                            'data' => $row,
                            'link' => 'stores',
                        ]);
                    }else{
                        return $response->withRedirect('/public/stores');
                    }
                }
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

                $delete = $this->db->delete('lo_brand_stores',$this->conn->conn,'store_no',$id);

                return $response->withRedirect('/public/stores');

            }
            else{
                return "Unauthorized User";

            }

        } else {
            return $response->withRedirect('/public/');

        }

    }
}
