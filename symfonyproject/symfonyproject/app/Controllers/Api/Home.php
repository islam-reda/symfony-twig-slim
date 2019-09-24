<?php
namespace App\Controllers\Api;
class Home extends  \App\Controllers\Controller {
  public $db;
  public $conn;
  public function news($request,$response){

    $encrypt = new \App\Models\Auth();
    $this->db = new \App\Models\db();
    $this->conn = \App\Models\db_connection::Instance();

    $news = $this->db->GeTDateBetweenNow('brand_news',$this->conn->conn,'start_date','end_date','active',1);

    $Newsarray = array();
    foreach ($news as $key => $new) {
      $brand = $this->db->checkFieldExistance('lo_brands',$this->conn->conn,'brand_id',$new['brand_id']);
      $new['logo'] = $brand['brand_logofile'];
      $new['brand_name'] = $brand['brand_name'];
      $Newsarray[] = $new;
    }
    try{
      if(!$Newsarray){ #failed if false
        $message = '';
        $returnarray = array(
          'success' => false,
          'message' => 'Not found News',
        );
      }else{ #success
          $returnarray = array(
            'success' => true,
            'news' => $Newsarray,
          );
      }
    }catch(Exception $e){
      $returnarray = array(
        'success' => false,
        'message' => 'There is an error occur',
      );
    }
    return $response->withJson($returnarray);
  }
  public function vouchers($request,$response){
    $encrypt = new \App\Models\Auth();
    $this->db = new \App\Models\db();
    $this->conn = \App\Models\db_connection::Instance();
    $cphone = $request->getParam('customer_phone');
    $params = $encrypt->decrypt($cphone);
    $phone = $params->customer_phone;
    $myVouchers = $this->db->GeTDateBetweenNow(
        'lo_vouchers',$this->conn->conn,'active_fdate','active_tdate','forcust_phone',$phone);
    $vouchers = $this->db->GeTDateBetweenNow('lo_vouchers',$this->conn->conn,'active_fdate','active_tdate','all_cust',1);
    try{
      if($myVouchers || $vouchers){ #failed if false
        $returnarray = array(
          'success' => true,
          'specificVouchers' => $myVouchers,
          'vouchers' => $vouchers,
        );
      }else{ #success
        $returnarray = array(
          'success' => false,
          'message' => 'Not found Vouchers',
        );
      }
    }catch(Exception $e){
      $returnarray = array(
        'success' => false,
        'message' => 'There is an error occur',
      );
    }
    $creturnarray = $encrypt->encrypt($returnarray);
    return $response->withJson($creturnarray);
  }
}
