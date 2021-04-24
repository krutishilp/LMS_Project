<?php 
include 'connection.php';
$result_array = array();

if(isset($_GET['dept'])){
   
    $deptName = $_GET['dept'];
     $getsubs="SELECT subject FROM subjects where dept='$deptName'";
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
