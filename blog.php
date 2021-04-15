<!-- <?php $name=$_GET['name'];
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
<title>Post Blog</title>
	<?php include 'links.php' ?>
  <?php include 'connection.php'; ?>
  <?php include 'style.php' ?>
  </head>
  <body>
<!-- Side Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      	<a href="teacher.php"><i id="tg" class='fas fa-arrow-alt-circle-left' style='color:#d5d5d5;font-size: 30px;'></i></a>
        </li>
    </ul>
   <a class="navbar-brand mx-auto" href="#">E-Learning</a>
   <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <form method="post">
        <button  type="submit" name='lgt' style="border:2px solid #d5d5d5; background-color: transparent;color: #d5d5d5;"><i class="fas fa-sign-out-alt"></i></button>
        </form>
      </li>
   </ul>		
  </nav>

<form action='?' method='POST' enctype='multipart/form-data' class="fc">
<input type="file" accept=".png, .jpg, .jpeg" name="fl"/><br><br>
<label for="write">Write Something:</label>
<textarea id="write" name="write" rows="4" cols="50"></textarea><br><br>
   <input type='submit' value='Post' name='postblog'><br>
</form>
</body>
</html>
<?php
echo $name;
if(isset($_POST['postblog'])){
    $text=$_POST['write'];
    $filename=$_FILES['fl']['name'];
    $currenttime=date('Y-m-d');
    $dir="../blogs/images/";
    $target_file=$dir.$_FILES['fl']['name'];
    if(move_uploaded_file($_FILES['fl']['tmp_name'],$target_file)){
         
        $query = "INSERT INTO blog(author,submission_date,imagepath,blogtext)
         VALUES('$name','$currenttime','$target_file','$text')";
        if(mysqli_query($conn,$query))
        {
              echo '<script type="text/javascript">alert("Blog Posted")</script>';
              echo '<script type="text/javascript">location.replace("?")</script>';
        }
        else
        {
              echo '<script type="text/javascript">alert("PDF Not Uploaded")</script>';

        }   
    }
   
}
?>