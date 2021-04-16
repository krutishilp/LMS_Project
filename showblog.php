<!-- 
echo $name; // session_start()?> -->
<?php
    // $Id = $_SESSION['student_Id'];
    // $email=$_SESSION['student_user_email'];
    // $studname=$_SESSION['student_user_name'];
    // $pass=$_SESSION['student_user_pass'];
    // $year = $_SESSION['student_user_year'];
    // $dept = $_SESSION['student_user_dept'];
?>
<html>
<head>
<title>Blogs</title>
	<?php include 'links.php' ?>
  <?php include 'connection.php'; ?>
  <?php include 'style.php' ?>
  </head>
  <body>

<?php

        $query = "select * from blog";
        $showblog=mysqli_query($conn,$query);
        while($run=mysqli_fetch_assoc($showblog))
        {
            ?>
            
            <dl>
            <dt><?php echo "<img src='".$run['imagepath']."'/>\t".$run['author']."\t".$run['submission_date']."\t";?></dt>
            <dd>- <?php echo $run['blogtext'];?></dd>
            </dl>

            <?php 
        }
?>


  </body>
</html>