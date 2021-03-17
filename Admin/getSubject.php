<?php 
include 'connection.php';
$result_array = array();
/* SQL query to get results from database */
// $sql = "SELECT FROM users ";
// $result = $conn->query($sql);
// /* If there are results from database push to result array */
// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         array_push($result_array, $row);
//     }
// }

if(isset($_GET['dept']))
{
   //echo '<script "text/javascript">console.log("hiiiii")</script>';
  // echo $_GET['dept'];
    $deptName = $_GET['dept'];
    
   // echo "<script>console.log(".$deptId.")</script>";
     $getsubs="SELECT subject FROM subjects where dept='$deptName'";
       if($run3=mysqli_query($conn,$getsubs))
       {
         while ($row=mysqli_fetch_assoc($run3))
          {
            array_push($result_array, $row);
          }
       }

// $result = $conn->query($dept);

// if ($result->num_rows > 0) {

//  while($row = $result->fetch_assoc()) {

//  $deptId = $row['dept_Id'];
//  /* send a JSON encded array to client */
// header('Content-type: application/json');
// echo json_encode($row);

//  }
//  $getsubs="SELECT subject FROM subjects where dept_Id='$deptId'";
//  $result1 = $conn->query($getsubs);

// if ($result1->num_rows > 0) {

//  while($row = $result->fetch_assoc()) {

//     array_push($result_array, $row);

//  }

// }
    
// }
/* send a JSON encded array to client */
header('Content-type: application/json');
echo json_encode($result_array);

}
?>