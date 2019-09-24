<?php
namespace App\Controllers\Api;
class Location extends  \App\Controllers\Controller {
  public $db;
  public $conn;
  public function getStores($request,$response){
    $encrypt = new \App\Models\Auth();
    $this->db = new \App\Models\db();
    $this->conn = \App\Models\db_connection::Instance();
    $stores = $this->db->getAllDatawithCondition('lo_brand_stores',$this->conn->conn,'active',1);
    try{
      if(!$stores){ #failed if false
        $message = '';
        $returnarray = array(
          'success' => false,
          'message' => 'Not found Stores',
        );
      }else{ #success
          $returnarray = array(
            'success' => true,
            'stores' => $stores,
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
    public function getMarkers($request,$response){
        $this->db = new \App\Models\db();
        $this->conn = \App\Models\db_connection::Instance();
        $stores = $this->db->getAllDatawithCondition('lo_brand_stores',$this->conn->conn,'active',1);
        $markers = array();
        foreach ($stores as $store){
            $markers[] = array(
                'key' => $store['store_no'],
                'title' => $store['store_name'],
                'coordinates' => array(
                    'latitude' => $store['store_loc_lat'],
                    'longitude' =>$store['store_loc_lon'],
                ),
            );
        }

        try{
            if(!$markers){ #failed if false
                $message = '';
                $returnarray = array(
                    'success' => false,
                    'message' => 'Not found Stores',
                );
            }else{ #success
                $returnarray = array(
                    'success' => true,
                    'markers' => $markers,
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
}
