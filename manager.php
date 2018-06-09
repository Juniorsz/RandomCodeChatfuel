<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
         rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
       <script>
     $(document).ready(function() {
    $('#example').DataTable();
} );
   </script>
<div id="wrap" style="width:1000px;margin:auto;">
<h3>Add new record</h3>
<form method="POST">
   Code : <input type="text" name="code">
   <button type="submit" name="add">OK</button>
</form>
<?php
  include("model.php");
  $data = new Data();
  if(isset($_POST['add'])){
      $username = $_POST['code'];
      echo $add = $data->addData($username);
  }
?>
<h3>Manager</h3>
<table id="example" class="table table-striped table-bordered" style="width:100%">
 <thead>
            <tr>
                <th>Code</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
<?php
  echo $display = $data->displayData();
?>
</tbody>
 </table>
 </div>
