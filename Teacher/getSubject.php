<?php 
include 'connection.php';
$result_array = array();

if(isset($_GET['dept'])){
   
    $deptName = $_GET['dept'];
    $sem = $_GET['sem'];
     $getsubs="SELECT subject FROM subjects where dept='$deptName' AND sem='$sem'";
      if($run3=mysqli_query($conn,$getsubs))
      {
        while ($row=mysqli_fetch_assoc($run3))
        {
          array_push($result_array, $row);
        }
      }
/* send a JSON encded array to client */
header('Content-type: application/json');
echo json_encode($result_array);

}
