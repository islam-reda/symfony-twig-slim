<?php
namespace App\Controllers;
use Slim\Http\UploadedFile;
use Slim\Http\Request;
use Slim\Http\Response;

class VouchersController extends Controller {
    protected $db;
    protected $conn;
    public function index($request,$response){

        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ){

            if($_SESSION['userGName'] == 1) {

                //die();

                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();


                $data = $this->db->getAllData('lo_vouchers', $this->conn->conn);

                //die();
                $array = array();
                return $this->getview->render($response, 'base_list.twig', [
                    'title' => 'Voucher',
                    'link' => 'vouchers',
                    'collectionNames' => array('Data Code', 'Type', 'ALl Customers', 'Discount Percentage','Discount Value','Actions'),
                    'collectionValues' => $data,
                    'values_selection' => array(1, 2, 7, 3, 4),
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

                    $data['vou_code'] = $request->getParam('vou_code');

                    $data['vou_type'] = $request->getParam('vou_type');
                    $data['disc_per'] = $request->getParam('disc_per');

                    $data['disc_value'] = $request->getParam('disc_value');
                    $data['active_fdate'] = $request->getParam('active_fdate');
                    $data['active_tdate'] = $request->getParam('active_tdate');

                    $data['all_cust'] = $request->getParam('all_cust');
                    $data['forcust_phone'] = $request->getParam('forcust_phone');

                    //var_dump($data);


                    $this->db->add('lo_vouchers',$data,$this->conn->conn);

                    return $response->withRedirect('/public/vouchers');

                }else{
                    //'ad_title', 'ad_desc1', 'start_date', 'end_date'
                    $yesno = array( 1=>"Yes",0=>"No");

                    return $this->getview->render($response,'base_add.twig', [
                        'title' => 'Add Voucher',
                        'options'=>$yesno,
                        'updateAttrutesName' => array(
                            'Voucher Code'=> 'vou_code:text:required',
                            'Voucher Type' => 'vou_type:select:required',
                            'Discount Percentage' => 'disc_per:number:required',
                            'Discount Value' => 'disc_value:number:required',
                            'Active Start Date' => 'active_fdate:date:required',
                            'Active to  date' => 'active_tdate:date:required',
                            'All Customers' => 'all_cust:select:required',
                            'Forecast Phone' => 'forcust_phone:number:required',
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

                $row = $this->db->checkFieldExistance('lo_vouchers',$this->conn->conn,'vou_id',$id);

                if($request->getMethod() == 'POST'){


                    $data = array();

                    $data['vou_code'] = $request->getParam('vou_code');
                    $data['vou_type'] = $request->getParam('vou_type');
                    $data['disc_per'] = $request->getParam('disc_per');
                    $data['disc_value'] = $request->getParam('disc_value');
                    $data['active_fdate'] = $request->getParam('active_fdate');
                    $data['active_tdate'] = $request->getParam('active_tdate');
                    $data['all_cust'] = $request->getParam('all_cust');
                    $data['forcust_phone'] = $request->getParam('forcust_phone');




                    $this->db->update('lo_vouchers',$data,'vou_id',$id,$this->conn->conn);

                    $row = $this->db->checkFieldExistance('lo_vouchers',$this->conn->conn,'vou_id',$id);

                    //ddd

                    $yesno = array( 1=>"Yes",0=>"No");
                    return $this->getview->render($response,'base_update.twig', [
                        'title' => 'Update Voucher',
                        'options' => $yesno,
                        'updateAttrutesName' => array(
                            'Voucher Code'=> 'vou_code:text:required',
                            'Voucher Type' => 'vou_type:select:required',
                            'Discount Percentage' => 'disc_per:number:required',
                            'Discount Value' => 'disc_value:number:required',
                            'Active Start Date' => 'active_fdate:text:required',
                            'Active to  date' => 'active_tdate:text:required',
                            'All Customers' => 'all_cust:select',
                            'Forecast Phone' => 'forcust_phone:number:required',
                        ),
                        'data' => $row,
                        'success' => 'Updated Succefully',
                        'link' => 'vouchers',
                    ]);

                    //return $response->withRedirect('/public/brand_news');

                }else{
                    if($row){

                        $yesno = array( 1=>"Yes",0=>"No");

                        return $this->getview->render($response,'base_update.twig', [
                            'title' => 'Update Voucher',
                            'options' => $yesno,
                            'updateAttrutesName' => array(
                                'Voucher Code'=> 'vou_code:text:required',
                                'Voucher Type' => 'vou_type:select:required',
                                'Discount Percentage' => 'disc_per:number:required',
                                'Discount Value' => 'disc_value:number:required',
                                'Active Start Date' => 'active_fdate:text:required',
                                'Active to  date' => 'active_tdate:text:required',
                                'All Customers' => 'all_cust:select:required',
                                'Forecast Phone' => 'forcust_phone:number:required',
                            ),
                            'data' => $row,
                            'link' => 'vouchers',
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

                $delete = $this->db->delete('lo_vouchers',$this->conn->conn,'vou_id',$id);

                return $response->withRedirect('/public/vouchers');

            }
            else{
                return "Unauthorized User";

            }

        } else {
            return $response->withRedirect('/public/');

        }

    }
}
