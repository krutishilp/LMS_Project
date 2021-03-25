<?php
include 'connection.php';
$result = array("K"=>112);

if(isset($_GET['qstatus'])){
  
 // echo json_encode($result);
    
   $query = "";
   $eid=$_GET['eid'];
  $status=$_GET['qstatus'];
  if($_GET['qstatus'] == '0'){
    $query = "UPDATE quizz SET status = 1 WHERE exam_id = '$eid'";
    $rungetr=mysqli_query($conn,$query);
    echo json_encode($rungetr);

  }else if($_GET['qstatus'] == '1'){
    $query = "UPDATE quizz set status = 0 WHERE exam_id = '$eid'";
    $rungetr=mysqli_query($conn,$query);
    echo json_encode($rungetr);
  }
 }
 
?>