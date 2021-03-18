 <?php

if (isset($_POST['addstud'])) 
 {
  $uname=$_POST['name'];
  $email=$_POST['email'];
  $password=uniqid();
  $prn = $_POST['prn'];
  $year = $_POST['year'];
  $dept = $_POST['dept'];

  $signup="INSERT INTO student (name, email, prn, year,dept, password) VALUES ('$uname','$email','$prn','$year','$dept','$password')";
  if($run=mysqli_query($conn,$signup))
  {

     echo '<script type="text/javascript">alert("Done")</script>';
      echo "<script type='text/javascript'>location.replace('admin.php')</script>";    
  }
  else
  {
    echo '<script type="text/javascript">alert("Not Done. Please Try Again.")</script>';
    echo mysqli_error($conn);
  }

 
 }

 ?>