<?php
namespace App\Models;
use \Firebase\JWT\JWT;
class Auth {
  private $key;
  public function __construct(){
    $this->key = "7zuNsG5L6JYpZa477Y6YQR6NZ9kSqGm86EL8csJTZk7B6Zj3PdejavuyjQ2j8cgPtTMfa8YMhGYdh9SHYkzLv5UDislamredazFTSqgXaezy869XZ8FyHBXkVSQqYdN4CjM6jTF5K5eHLdwBWMZvezrZgS26VEY9zn6uRBpsgtZSg764wGaA6bbXT3EEheEGsmZ8yZrE428bJ455AQfwShjBaz75DnnUyYEGPUbHxUv6PbMZRS8zZ3MMtvtVGEGQuWnTG";
  }
  public function encrypt($token){
    $jwt = JWT::encode($token, $this->key, 'HS256');
    return $jwt;
  }
  public function decrypt($jwt){
    $decoded  = JWT::decode($jwt, $this->key, array('HS256'));
    return $decoded;
  }
}
