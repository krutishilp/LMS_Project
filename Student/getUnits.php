<?php 
include 'connection.php';
$result_array = array();

if(isset($_GET['subs'])){
   
    $subName = $_GET['subs'];
     $getsubs="SELECT Unit FROM assignment where Subject_Name='$subName'";
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
?>