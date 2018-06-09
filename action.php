
Back (accesskey b)    Save (accesskey s)    	File: /deathcode.ga/htdocs/api/bots/action.php
 	Status: This file has not yet been saved

<?php
  include("model.php");
  switch($_GET['action']){
      case 'delete':
          if(isset($_GET['id'])){
             $id = $_GET['id'];
             $data = new Data();
             echo $data->deleteData($id);
          }
      break;
      case 'edit':
          if(isset($_GET['id'])){
              $id = $_GET['id'];
              $data = new Data();
              ?>
                <form method="POST">
                  <input type="text" name="code" value="<?php echo  $data->getDataId($id); ?>">
                  <button type="submit" name="update">Update</button>
                </form>
                <?php
                   if(isset($_POST['update'])){
                       $code = $_POST['code'];
                       echo $update = $data->editData($id,$code);
                   }
                ?>
              <?php
          }
      break;
  }
  
?>
