<?php
namespace App\Controllers;
use Slim\Http\UploadedFile;
use Slim\Http\Request;
use Slim\Http\Response;

class NewsController extends Controller {
    protected $db;
    protected $conn;
    public function index($request,$response){

        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ){

            if($_SESSION['userGName'] == 1) {

                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();
                $data = $this->db->getAllDatawithCondition('brand_news', $this->conn->conn, 'active', 1);
                $array = array();
                return $this->getview->render($response, 'base_list.twig', [
                    'title' => 'Brand News',
                    'link' => 'brand_news',
                    'collectionNames' => array('Title', 'Description', 'Start Date', 'End Date','Actions'),
                    'collectionValues' => $data,
                    'values_selection' => array(5, 6, 2, 3),
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
                $delete = $this->db->delete('brand_news',$this->conn->conn,'ad_id',$id);
                return $response->withRedirect('/public/brand_news');
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

                    $fileaneme1 = $this->moveUploadedFile($_FILES["ad_img1"]);
                    $fileaneme2 = $this->moveUploadedFile($_FILES["ad_img2"]);
                    $fileaneme3 = $this->moveUploadedFile($_FILES["ad_img3"]);

                    //echo $fileaneme3;
                    //die();
                    date_default_timezone_set("Africa/Cairo");

                    $data = array();

                    $data['brand_id'] = $request->getParam('brand_id');

                    $data['start_date'] = $request->getParam('start_date');
                    $data['end_date'] = $request->getParam('end_date');

                    $data['active'] = $request->getParam('active');
                    $data['ad_title'] = $request->getParam('ad_title');
                    $data['ad_desc1'] = $request->getParam('ad_desc1');

                    $data['ad_img1'] = $fileaneme1;
                    $data['ad_img2'] = $fileaneme2;
                    $data['ad_img3'] = $fileaneme3;


                    $this->db->add('brand_news',$data,$this->conn->conn);

                    return $response->withRedirect('/public/brand_news');
                }else{
                    //'ad_title', 'ad_desc1', 'start_date', 'end_date'


                    $BrandsData = $this->db->getAllDatawithCondition('lo_brands',$this->conn->conn,"active",1);
                    $brandsarr = array();
                    foreach($BrandsData as $Brand){
                        $brandsarr[$Brand['brand_id']] = $Brand['brand_name'];
                    }

                    return $this->getview->render($response,'base_add.twig', [
                        'title' => 'Add Brand News',
                        'options'=> $brandsarr,
                        'updateAttrutesName' => array(
                            'Brand'=> 'brand_id:select:required',
                            'Start Date' => 'start_date:date:required',
                            'End Date' => 'end_date:date:required',
                            'Active' => 'active',
                            'Title' => 'ad_title:text:required',
                            'Description' => 'ad_desc1:text:required',
                            'Image 1' => 'ad_img1:file:required',
                            'Image 2' => 'ad_img2:file:required',
                            'Image 3' => 'ad_img3:file:required'
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

                $row = $this->db->checkFieldExistance('brand_news',$this->conn->conn,'ad_id',$id);

                if($request->getMethod() == 'POST'){

                    $data = array();

                    if($_FILES["ad_img1"]['name']){

                        $fileaneme1 = $this->moveUploadedFile($_FILES["ad_img1"]);
                        $data['ad_img1'] = $fileaneme1;

                    }

                    if($_FILES["ad_img2"]['name']){

                        $fileaneme1 = $this->moveUploadedFile($_FILES["ad_img2"]);
                        $data['ad_img2'] = $fileaneme1;

                    }

                    if($_FILES["ad_img3"]['name']){

                        $fileaneme1 = $this->moveUploadedFile($_FILES["ad_img3"]);
                        $data['ad_img3'] = $fileaneme1;

                    }

                    $data['brand_id'] = $request->getParam('brand_id');
                    $data['start_date'] = $request->getParam('start_date');
                    $data['end_date'] = $request->getParam('end_date');
                    $data['active'] = $request->getParam('active');
                    $data['ad_title'] = $request->getParam('ad_title');
                    $data['ad_desc1'] = $request->getParam('ad_desc1');

                    //var_dump($data);
                    //die();

                    $this->db->update('brand_news',$data,'ad_id',$id,$this->conn->conn);

                    $row = $this->db->checkFieldExistance('brand_news',$this->conn->conn,'ad_id',$id);

                    $BrandsData = $this->db->getAllDatawithCondition('lo_brands',$this->conn->conn,"active",1);

                    $brandsarr = array();
                    foreach($BrandsData as $Brand){
                        $brandsarr[$Brand['brand_id']] = $Brand['brand_name'];
                    }

                    //ddd
                    return $this->getview->render($response,'base_update.twig', [
                        'title' => 'Update Brand News',
                        'options'=> $brandsarr,
                        'updateAttrutesName' => array(
                            'Brand'=> 'brand_id:select',
                            'Start Date' => 'start_date:text:required',
                            'End Date' => 'end_date:text:required',
                            'Active' => 'active',
                            'Title' => 'ad_title:text:required',
                            'Description' => 'ad_desc1:text:required',
                            'Image 1' => 'ad_img1:file',
                            'Image 2' => 'ad_img2:file',
                            'Image 3' => 'ad_img3:file'
                        ),
                        'data' => $row,
                        'success' => 'Updated Succefully',
                        'link' => 'brand_news',

                    ]);

                    //return $response->withRedirect('/public/brand_news');

                }else{
                    if($row){

                        $BrandsData = $this->db->getAllDatawithCondition('lo_brands',$this->conn->conn,"active",1);
                        $row = $this->db->checkFieldExistance('brand_news',$this->conn->conn,'ad_id',$id);
                        $brandsarr = array();
                        foreach($BrandsData as $Brand){
                            $brandsarr[$Brand['brand_id']] = $Brand['brand_name'];
                        }

                        return $this->getview->render($response,'base_update.twig', [
                            'title' => 'Update Brand News',
                            'options'=> $brandsarr,
                            'updateAttrutesName' => array(
                                'Brand'=> 'brand_id:select',
                                'Start Date' => 'start_date:text:required',
                                'End Date' => 'end_date:text:required',
                                'active' => 'active',
                                'Title' => 'ad_title:text:required',
                                'Description' => 'ad_desc1:text:required',
                                'First Image' => 'ad_img1:file',
                                'Second Image' => 'ad_img2:file',
                                'Third Image' => 'ad_img3:file'
                            ),
                            'data' => $row,
                            'link' => 'brand_news',
                        ]);
                    }else{
                        return $response->withRedirect('/public/brand_news');
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