 <?php
include("connect.php");
class Data extends Connection
{
    public function insertData($uid, $message)
    {
        $check = $this->connect->prepare("SELECT * FROM test WHERE uid='$uid' ");
        $check->execute();
        $count = $check->rowCount();
        if ($count > 0) {
             $text = "Each account can only be taken once";
        } else {
            $data = $this->connect->prepare("INSERT INTO test(message,uid) VALUES('{$message}','{$uid}')");
            if ($data->execute()) {
                  $get = $this->connect->prepare("SELECT * FROM account WHERE status=0 LIMIT 1");
                  $get->execute();
                  $get->setFetchMode(PDO::FETCH_OBJ);
                  foreach($get as $rows){
                      $text = "Username :$rows->username \nPassword : $rows->password";
                      $update = $this->connect->prepare("UPDATE account SET status=1 WHERE username='$rows->username'");
                      $update->execute();
                  }
                  if($get->rowCount() == 0){
                      $text = "Empty account ! ";
                  }
            }
        }
                         $arr = array (
        'messages' =>
        array (
            0 =>
            array (
                'text' => $text,
            ),
        ),
    );
    echo json_encode($arr);
    }
}
?>
