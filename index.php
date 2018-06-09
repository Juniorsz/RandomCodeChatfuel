<?php
  include("model.php");
 if(isset($_GET['uid']) && isset($_GET['message'])){
    $uid = $_GET['uid'];
    $message = $_GET['message'];
    $data = new Data();
    echo $response = $data->insertData($uid,$message);
 }
 else{
     echo "No data";
 }
 
?>
