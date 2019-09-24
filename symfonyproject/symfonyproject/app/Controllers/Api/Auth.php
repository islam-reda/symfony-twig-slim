<?php
namespace App\Controllers\Api;
class Auth extends  \App\Controllers\Controller {
  public function Login($request,$response){
    $cphone = $request->getParam('customer_phone');
    $encrypt = new \App\Models\Auth();
    $params = $encrypt->decrypt($cphone);
    $phone = $params->phone;
    $this->db = new \App\Models\db();
    $this->conn = \App\Models\db_connection::Instance();
    if($phone){
      try{
        $is_exist = $this->db->CustomerLogin('loyalty_customers',$this->conn->conn,$phone);
        if(!$is_exist){ #failed if false
          $message = '';
          $returnarray = array(
            'success' => false,
            'message' => 'That phone is not found in our system',
          );
        }else{ #success
        if(!$is_exist['active']){
          $activationarr = array(
            'activation_code' => rand(10000,99999),
          );
          $this->db->update('loyalty_customers',$activationarr,'customer_phone',$phone,$this->conn->conn);
        }
        $returnarray = array(
            'success' => true,
            'status' => ($is_exist['active']) ? true : false,
			      'phone' => $is_exist['customer_phone'],
          );
        }
      }catch(Exception $e){
        $returnarray = array(
          'success' => false,
          'message' => 'There is an error occur',
        );
      }
    }else{
      $returnarray = array(
        'success' => false,
        'message' => 'phone required',
      );
    }
    $Creturnarray = $encrypt->encrypt($returnarray);
    return $response->withJson($Creturnarray);
  }


  function register($request,$response){
    $email = $request->getParam('email');
    $customer_phone = $request->getParam('customer_phone');
    $this->db = new \App\Models\db();
    $this->conn = \App\Models\db_connection::Instance();
    // $name = $request->getParam('name');
    $array = array();
    $returnarray = array();
    if($email && $customer_phone){
      try{
        $existUserEmail = $this->db->getAllDatawithCondition("loyalty_customers",$this->conn->conn,"email",$email); // get user
        $existUserPhone = $this->db->getAllDatawithCondition("loyalty_customers",$this->conn->conn,"customer_phone",$customer_phone); // get user
        if(!$existUserEmail || !$existUserPhone){
          date_default_timezone_set("Africa/Cairo");
              $array = array(
                  'phone' => $customer_phone,
                  'email' => $email,
                  'active' => 0,
                  'created_at' => date('Y-m-d H:i:s'),
                  'activation_code' => rand(10000,99999),
                );
                try{
                  $is_added = $this->db->add('loyalty_customers',$array,$this->conn->conn);
                }catch(Exception $e){
                  $returnarray = array(
                    'success' => false,
                    'message' => 'There is an error occur',
                  );
                }
                if($is_added){
                  $is_exist = $this->db->CustomerLogin('loyalty_customers',$this->conn->conn,$customer_phone);
                  if(!$is_exist){ #failed if false
                    $message = '';
                    $returnarray = array(
                      'success' => false,
                      'message' => 'invalid operation',
                    );
                  }else{ #success
                      $returnarray = array(
                        'success' => true,
                        'user' => $is_exist,
                      );
                  }
                }else{
                  $returnarray = array(
                      'success' => false,
                      'message' => 'data is dosen`t added',
                  );
                }
        }else{
            $returnarray = array(
              'success' => false,
              'message' => 'phone or email Exist',
            );
        }
      }catch(Exception $e){
        $returnarray = array(
          'success' => false,
          'message' => 'There is an error occur',
        );
      }
    }else{
      $returnarray = array(
        'success' => false,
        'message' => 'data is required',
      );
    }
    // $Creturnarray = $encrypt->encrypt($returnarray);
    return $response->withJson($returnarray);
  }
  function verfyuser($request,$response){
    $data = $request->getParam('data');
    $encrypt = new \App\Models\Auth();
    $params = $encrypt->decrypt($data);
    $code = $params->code;
    $customer_phone = $params->customer_phone;
    $this->db = new \App\Models\db();
    $this->conn = \App\Models\db_connection::Instance();
    $returnarray = array();
    if($code && $customer_phone){
      try{
        $is_exist = $this->db->checkFieldExistance('loyalty_customers',$this->conn->conn,'customer_phone',$customer_phone);
        if($is_exist['activation_code'] != $code){ #failed if false
          $message = '';
          $returnarray = array(
            'success' => false,
            'status' => false,
            'message' => 'Invalid Code please find code in messages or try again later',
          );
        }else{ #success
            $activationarr = array(
              'active' => 1,
            );
            $this->db->update('loyalty_customers',$activationarr,'customer_phone',$customer_phone,$this->conn->conn);
      		  $returnarray = array(
              'success' => true,
      			  'phone' => $customer_phone,
      		  );
        }
      }catch(Exception $e){
        $returnarray = array(
          'success' => false,
          'message' => 'There is an error occur',
        );
      }
    }else{
      $returnarray = array(
        'success' => false,
        'message' => 'Code is required',
      );
    }
    $Creturnarray = $encrypt->encrypt($returnarray);
    return $response->withJson($Creturnarray);
  }
  function getuser($request,$response){
    $data = $request->getParam('customer_phone');
    $encrypt = new \App\Models\Auth();
    $params = $encrypt->decrypt($data);
    $customer_phone = $params->customer_phone;
    $this->db = new \App\Models\db();
    $this->conn = \App\Models\db_connection::Instance();
    $returnarray = array();
    if($customer_phone){
      try{
        $is_exist = $this->db->checkFieldExistance('loyalty_customers',$this->conn->conn,'customer_phone',$customer_phone);
        if(!$is_exist){ #failed if false
          $message = '';
          $returnarray = array(
            'success' => false,
            'status' => false,
          );
        }else{ #success
      		  $returnarray = array(
      			'success' => true,
            'user' => $is_exist,
      			'status' => ($is_exist['active']) ? true : false,
      		  );
        }
      }catch(Exception $e){
        $returnarray = array(
          'success' => false,
          'message' => 'There is an error occur',
        );
      }
    }else{
      $returnarray = array(
        'success' => false,
        'message' => 'Phone is required',
      );
    }
    $Creturnarray = $encrypt->encrypt($returnarray);
    return $response->withJson($Creturnarray);
  }
}
