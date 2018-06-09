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
                      $text = "$rows->code";
                      $update = $this->connect->prepare("UPDATE account SET status=1 WHERE code='$rows->code'");
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
    public function addData($code){
        $result = $this->connect->prepare("INSERT INTO account(code,status) VALUES('{$code}',0)");
        if($result->execute()){
            echo "Successfully !!!";
        }
        else{
            echo "Fail :(";
        }
    }
    public function displayData(){
        $result = $this->connect->prepare("SELECT * FROM account");
        $result->execute();
        $result->setFetchMode(PDO::FETCH_OBJ);
        foreach($result as $rows){
            ?>
               <tr>
                 <td><?php echo $rows->code; ?></td>
                 <td><?php echo $rows->status == 0 ? "Live <i class='fas fa-check'></i>" : " Sold <i class='fas fa-times-circle'></i>"; ?></td>
                 <td><a href="action.php?action=edit&id=<?php echo $rows->id ?>">Edit</a></td>
                 <td><a href="action.php?action=delete&id=<?php echo $rows->id ?>">Delete</a></td>
               </tr>
            <?php
        }
    }
    public function deleteData($id){
        $result = $this->connect->prepare("DELETE FROM account WHERE id=$id");
        if($result->execute()){
            header("Location: manager.php");
        }
        else{
            echo "Fail !!!";
        }
    }
    public function editData($id,$code){
        $result = $this->connect->prepare("UPDATE account SET code='{$code}' WHERE id=$id");
        if($result->execute()){
            header("Location: manager.php");
        }
        else{
            echo "Fail !!!";
        }
    }
    public function getDataId($id){
        $result = $this->connect->prepare("SELECT * FROM account WHERE id=$id");
        $result->execute();
        $result->setFetchMode(PDO::FETCH_OBJ);
        foreach($result as $rows){
            $rows->code;
        }
        return $rows->code;
    }
}
?>
