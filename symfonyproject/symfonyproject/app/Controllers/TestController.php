<?php
namespace App\Controllers;

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;


class TestController extends Controller {
    protected $db;
    protected $conn;
    public function index($request,$response){

        //echo "Testing";

         //check file name is not empty
        if (!empty($_FILES['file']['name'])) {

            // Get File extension eg. 'xlsx' to check file is excel sheet
            $pathinfo = pathinfo($_FILES["file"]["name"]);

            // check file has extension xlsx, xls and also check
            // file is not empty
            if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls')
                && $_FILES['file']['size'] > 0 ) {


                $this->db = new \App\Models\db();
                $this->conn = \App\Models\db_connection::Instance();


                $data = array();
                // Temporary file name
                $inputFileName = $_FILES['file']['tmp_name'];

                // Read excel file by using ReadFactory object.
                $reader = ReaderFactory::create(Type::XLSX);

                // Open file
                $reader->open($inputFileName);
                $count = 1;

                // Number of sheet in excel file
                foreach ($reader->getSheetIterator() as $sheet) {

                    // Number of Rows in Excel sheet
                    foreach ($sheet->getRowIterator() as $row) {

                        // It reads data after header. In the my excel sheet,
                        // header is in the first row.
                        if ($count > 1) {


                            //date('Y-m-d H:i:s',$row[8])
                            // Data of excel sheet
                            $data['customer_phone'] = $row[0];
                            $data['active'] = $row[1];
                            $data['activation_code'] = $row[2];
                            date_default_timezone_set("Africa/Cairo");

                            $data['created_date'] = date('Y-m-d H:i:s');

                            $data['active_program_id'] = $row[3];
                            $data['prog_accm_points'] = $row[4];
                            $data['prog_accm_value'] = $row[5];

                            $data['prog_rdm_points'] = $row[6];
                            $data['prog_rdm_value'] = $row[7];

                            $data['last_up_invc_datetime'] = $row[8];

                            $data['last_up_invc_sid'] = $row[9];
                            $data['last_rdm_invc_datetime'] = $row[10];
                            $data['last_rdm_invc_sid'] = $row[11];
                            $data['brand_id'] = $row[12];
                            $data['email'] = $row[13];

                            //Here, You can insert data into database.

                            //print_r($data);
                            //die();
                            if($row[0]){
                                try{
                                    $check = $this->db->checkFieldExistance('loyalty_customers',$this->conn->conn,'customer_phone',$row[0]);

                                        if(!$check){
                                        $this->db->add('loyalty_customers',$data,$this->conn->conn);

                                    }else{
                                        unset($data['created_date']);
                                        //$this->db->update('lo_brands',$data,'brand_id',$id,$this->conn->conn);
                                        $this->db->update('loyalty_customers',$data,'customer_phone',$data['customer_phone'],$this->conn->conn);
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

                $reader->close();

                return $this->getview->render($response,'uploadexcel.twig', [
                    'title' => 'Update Brand',
                    'updateAttrutesName' => array(
                        'Brand Name'=> 'brand_name:text:required',
                        'Logo' => 'brand_logofile:file',
                        'Activation Code' => 'activation_code',
                        'Active' => 'active'),
                    'data' => $row,
                    'success' => 'Customer Imported Successfully',
                    'link' => 'brands',
                ]);

            } else {

               // echo "Please Select Valid Excel File";

                return $this->getview->render($response,'uploadexcel.twig', [
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

        } else {

            return $this->getview->render($response,'uploadexcel.twig', [
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
