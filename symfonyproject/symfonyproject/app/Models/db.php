<?php
namespace App\Models;
use \PDO;
class db{

    public function getAllData($table,$conn){

        //die;
        $stmt = $conn->prepare("SELECT * FROM ".$table." ");
        $stmt->execute();
        $row = $stmt->fetchAll();
        return  $row;
    }

    public function GeTDateBetweenNow($table,$conn,$fdate,$tdate,$field,$value){

      date_default_timezone_set("Africa/Cairo");
      $now = date('Y-m-d H:i:s');
      $q = "SELECT * FROM ".$table." WHERE ".$fdate." <= :from AND ".$tdate." > :to AND ".$field." = :value";
      $stmt = $conn->prepare($q);
      $stmt->bindParam(':value', $value);
      $stmt->bindParam(':from', $now);
      $stmt->bindParam(':to', $now);
      $stmt->execute();
      //var_dump($stmt);die();
      $result = $stmt->fetchAll();
      return  $result;
    }

    public function getAllDatawithCondition($table,$conn,$field,$value){
      $q = "SELECT * FROM ".$table." WHERE ".$field." = :value";
      $stmt = $conn->prepare($q);
      $stmt->bindParam(':value', $value);
      $stmt->execute();
      //var_dump($stmt);die();
      $result = $stmt->fetchAll();
      return  $result;
    }

    public function CustomerLogin($table,$conn,$phone){
        $stmt = $conn->prepare("SELECT * FROM ".$table." WHERE customer_phone = :phone");
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row){
            return $row;
        }
        return false;
    }

    public function Login($table,$conn,$email,$password){
        $stmt = $conn->prepare("SELECT * FROM ".$table." WHERE email = :email AND  password = :pass and active = 1");

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $password);

        $stmt->execute();
        $row = $stmt->fetch();

        if($row){
            return $row;
        }

        return false;
    }
    public function checkFieldExistance($table,$conn,$field,$value){
        $stmt = $conn->prepare("SELECT * FROM ".$table." WHERE ".$field." = :value");
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        $row = $stmt->fetch();

        if($row){
            return $row;
        }
        return false;
    }


    public function add($table,$data,$conn){
      try{
        $q = "INSERT INTO ".$table."";
        $q .= "(";


        foreach ($data as $key => $ff){
            $q .= $key.",";
        }
        $q = rtrim($q,",");
        $q .= ") VALUES (";
        foreach ($data as $key => $value){
            if(is_string($value)){
                $q .= '"'.$value.'"'.",";
            }else{
                $q .= $value.",";
            }
        }
        $q = rtrim($q,"',");
        $q .= ")";

        //echo $q;
        //die;

        $conn->exec($q);
        return true;
      }catch(Exception $e){
        return false;
      }
    }

    public function update($table,$data,$field,$valuecondition,$conn){
        $q = "UPDATE ".$table." SET ";

        foreach ($data as $key => $val){
            $value = "";
            if(is_string($val)){
                $value .= "'".$val."'";
            }else{
                $value .= $val;
            }
            $q .= $key.' = '.$value.',';
        }
        $q = rtrim($q,",");
        $q .= " WHERE ".$field.' = '.$valuecondition;
        //$this->pprint($q);

        $conn->exec($q);
    }
    public function delete($table,$conn,$field,$value){
      $q = "DELETE FROM ".$table." WHERE ".$field." = :value";
      $stmt = $conn->prepare($q);
      $stmt->bindParam(':value', $value);
      $stmt->execute();
      return  true;
    }

    public function zend_Debug($obj){
        ?><pre> <?php
         var_dump($obj);
        ?></pre><?php
    }
}
