<?php
namespace App\Models;
use \PDO;
class db_connection {
  protected $dsn;

  protected $user;

  protected $password;
  protected $options;
  public $conn;
  public static function Instance()
  {
      static $inst = null;
      if ($inst === null) {
          $inst = new db_connection();
      }
      return $inst;
  }
  private function __construct(){
    $this->dsn = 'mysql:host=localhost;dbname=loyalityapp';
    $this->user = 'root';
    $this->password = 'E83mq6BVnjBo97';
    $this->options=array(
        PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8 '
    );
    $this->connect();
  }
  function connect(){
    try {
      $conn = new \PDO($this->dsn ,$this->user,$this->password,$this->options);
      $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->conn = $conn;
    } catch (Exception $ex) {
        echo "not connected".$ex->getMessage();
    }
  }
}
