<?php
  
  class Connection{
      
      protected $servername = "";
      protected $username = "";
      protected $password = "";
      protected $dbname = "";
      protected $connect;
      
      function __construct(){
          try{
              $this->connect = new PDO("mysql:host=$this->servername;dbname=$this->dbname",$this->username,$this->password);
              $this->connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              $this->connect->exec("SET NAMES UTF8");
          }
          catch(PDOException $e){
              echo $e->getMessage();
          }
      }
      
      public function endConnection(){
          $this->connect = NULL;
      }
  }

?>
