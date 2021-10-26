<?php
require PROJECT_ROOT_PATH.'/vendor/autoload.php';

class Database{
  
  public $conn;

  function __construct()
  {
    $servername = $_SERVER['SERVER'];
    $username = $_SERVER['USERNAME'];
    $password = $_SERVER['PASSWORD'];
    $db = $_SERVER['DB'];
    $this->conn = new mysqli($servername, $username, $password, $db);
    if($this->conn->connect_error){
      die("Connection failed: ".$this->conn->connect_error);
    }
  }
}