<?php

namespace App\Controllers;
use Slim\Http\UploadedFile;
use Slim\Http\Request;
use Slim\Http\Response;

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

use \DateTime;


class CustomersController extends Controller {
    protected $db;
    protected $conn;
    protected $success;

    public function __construct($container){
        $this->container = $container;
        parent::__construct($container);

        //$_SESSION['success']="";
        if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
              $this->container['view']['success']=$_SESSION['success'];
        }

    }

    public function index($request,$response){
        $_SESSION['success']="";

        if(isset($_SESSION['userEmail']) && isset($_SESSION['userGName']) ){

            if($_SESSION['userGName'] == 1) {

                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();
                $data = $this->db->getAllDatawithCondition('loyalty_customers', $this->conn->conn, 'active', 1);
                $array = array();
                return $this->getview->render($response, 'base_list.twig', [
                    'title' => 'Customer',
                    'link' => 'customers',
                    'collectionNames' => array('Email', 'Phone', 'Created Date','Action'),
                    'collectionNamesHidden' => array('active'),
                    'collectionValues' => $data,
                    'values_selection' => array(14, 0, 3),
                    'values_selectionHidden' => array(1),
                    'delete' => true,
                    'update' => true,
                    'addnew' => true,
                    'uploadExcel' => true,

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
                $delete = $this->db->delete('loyalty_customers',$this->conn->conn,'customer_phone',$id);
                return $response->withRedirect('/public/customers');
            }
            else{
                return "Unauthorized User";
            }

        } else {
            return $response->withRedirect('/public/');

        }

   }

   public function export(){
       // Connection

       $this->db = new \App\Models\db();
       $this->conn = \App\Models\db_connection::Instance();


       $filename = "Customers.xls"; // File Name

       // Download file

       header("Content-Disposition: attachment; filename=\"$filename\"");
       header("Content-Type: application/vnd.ms-excel");

       $user_query  = $this->db->getAllDatawithCondition('loyalty_customers', $this->conn->conn, 'active', 1);

       // Write data to file

       $flag = false;
       //$data = array();

       foreach ($user_query as $row) {

           $data = array(
               'customer_phone' => $row['customer_phone'],
               'active' => $row['active'],
               'activation_code' => $row['activation_code'],
               'active_program_id' => $row['active_program_id'],
               'prog_accm_points' => $row['prog_accm_points'],
               'prog_accm_value' => $row['prog_accm_value'],
               'prog_rdm_points' => $row['prog_rdm_points'],
               'prog_rdm_value' => $row['prog_rdm_value'],
               'last_up_invc_datetime' => $row['last_up_invc_datetime'],
               'last_up_invc_sid' => $row['last_up_invc_sid'],
               'last_rdm_invc_datetime' => $row['last_rdm_invc_datetime'],
               'last_rdm_invc_sid' => $row['last_rdm_invc_sid'],
               'brand_id' => $row['brand_id'],
               'email' => $row['email'],
               'created_date' => $row['created_date'],
           );

           if (!$flag) {

               // display field/column names as first row
               echo implode("\t", array_keys($data)) . "\r\n";
               $flag = true;
           }
           echo implode("\t", array_values($data)) . "\r\n";
       }

   }

    public function import($request,$response, array $args){


        if (!empty($_FILES['file']['name'])) {

            // Get File extension eg. 'xlsx' to check file is excel sheet


            $pathinfo = pathinfo($_FILES["file"]["name"]);

            // check file has extension xlsx, xls and also check
            // file is not empty
            if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls')
                && $_FILES['file']['size'] > 0 ) {


                //die;
                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();


                $session= new \App\Models\session();
                $session->start();

                $data = array();
                // Temporary file name
                $inputFileName = $_FILES['file']['tmp_name'];


                // Read excel file by using ReadFactory object.

                $reader = ReaderFactory::create(Type::XLSX);

                try{

                    $reader->open($inputFileName);


                }catch (\Exception $e){

                    //var_dump($e);

                    $_SESSION['success']= "Please Import proper Excel file (.xlsx).";

                    return $response->withRedirect('/public/customers');

                }

                $count = 1;
                $addCount = 0;
                $updateCount = 0;

                // Number of sheet in excel file
                foreach ($reader->getSheetIterator() as $sheet) {

                    // Number of Rows in Excel sheet
                    foreach ($sheet->getRowIterator() as $row) {

                        // It reads data after header. In the my excel sheet,
                        // header is in the first row.
                        if ($count > 1) {

                            //date('Y-m-d H:i:s',$row[8])
                            // Data of excel sheet

                            $string = (string) $row[0];                 // a

                            $s= substr($string, 0, 1);

                            //echo $row[0];  // bcd

                            //die();

                            if($s != 0){

                                $data['customer_phone'] = "0".$row[0];


                            }else{

                                $data['customer_phone'] = $row[0];

                            }



                            $data['active'] = $row[1];
                            $data['activation_code'] = $row[2];
                            date_default_timezone_set("Africa/Cairo");

                            $data['created_date'] = date('Y-m-d H:i:s');

                            $data['active_program_id'] = $row[3];
                            $data['prog_accm_points'] = $row[4];
                            $data['prog_accm_value'] = $row[5];

                            $data['prog_rdm_points'] = $row[6];
                            $data['prog_rdm_value'] = $row[7];

                            //$date = new \DateTime();
                            //$string = $date->format( 'Y-m-d-H-i-s',$row[8]);



                            $date1 = date_format($row[8],"Y-m-d H:i:s");

                            $data['last_up_invc_datetime'] =$date1;

                            $data['last_up_invc_sid'] = $row[9];

                            $date2 = date_format($row[10],"Y-m-d H:i:s");


                            $data['last_rdm_invc_datetime'] = $date2;
                            $data['last_rdm_invc_sid'] = $row[11];
                            $data['brand_id'] = $row[12];
                            $data['email'] = $row[13];

                            //Here, You can insert data into database.

                            //print_r($data);
                            if($row[0]){

                                try{
                                    $checkExistence = $this->db->checkFieldExistance('loyalty_customers',$this->conn->conn,'customer_phone',$data['customer_phone']);

                                    if(!$checkExistence){
                                      //  die();

                                        $this->db->add('loyalty_customers',$data,$this->conn->conn);
                                        $addCount++;

                                    }else{
                                        unset($data['created_date']);
                                        //$this->db->update('lo_brands',$data,'brand_id',$id,$this->conn->conn);
                                        $this->db->update('loyalty_customers',$data,'customer_phone',$data['customer_phone']
                                            ,$this->conn->conn);

                                        $updateCount++;
                                    }

                                }catch (\Exception $exception){
                                    var_dump($exception);
                                }

                                //print_r($row);

                            }else{
                                continue;
                            }


                        }
                        $count++;
                    }
                }


                // Close excel file

                $temp =$addCount ." new rows and ".$updateCount ." updated rows ";
                $temp .= "Successfully Uploaded.";
                $_SESSION['success']= $temp;
                $reader->close();

                return $response->withRedirect('/public/customers');


            } else {

               //echo "Please Select Valid Excel File";

                return $response->withRedirect('/public/customers');
            }

        } else {

            echo "Please Select Valid Excel File";

            return $response->withRedirect('/public/customers');

        }

    }


}







//namespace App\Controllers;
//class CustomersController extends Controller {
//  protected $db;
//  protected $conn;
//  public function index($request,$response){
//    return $this->getview->render($response,'home.twig', [
//        'title' => 'Home'
//    ]);
//  }
//  public function list($request,$response){
//    $this->db = new \App\Models\db();
//    $this->conn = \App\Models\db_connection::Instance();
//    $auth = new \App\Models\Auth();
//    $name = $request->getParam('name');
//    $token = array(
//        "name" => $name,
//        "website" => "http://imi.com",
//    );
//    $cName = $auth->encrypt($token);
//    $dName = $auth->decrypt($cName);
//    //$encrypt = $this->encrypt($name);
//    $data = $this->db->getAllData('customers',$this->conn->conn);
//    return json_encode($dName).' '.$cName;
//  }
//}
//
//
//
//
//
//
//
//
//
//
//
//// class CustomersController {
////   protected $db;
////   protected $conn;
////   protected $view;
////   public function __construct(View $view){
////     $this->db = new \App\Models\db();
////     $this->conn = new \App\Models\connection();
////     $this->view = $view;
////   }
////   public function index($request,$response){
////     return $this->view->render($response,'profile.html');
////   }
////   public function list($request,$response){
////     $name = $request->getParam('name');
////     $data = $this->db->getAllData('customers',$this->conn->conn);
////     return 'bye bye '.$name . json_encode($data);
////   }
//// }
//// $app->get('/api/customers', function () {
////   $db = new \App\Models\db();
////   $conn = new \App\Models\connection();
////   header('Content-Type: application/json');
////   $data = $db->getAllData('customers',$conn->conn);
////   var_dump($data);
//// });
