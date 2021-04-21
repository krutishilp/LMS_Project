
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
      	<a href="javascript:javascript:history.go(-1)"><i id="tg" class='fas fa-arrow-alt-circle-left' style='color:#d5d5d5;font-size: 30px;'></i></a>
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
 
<form action='#' method='POST' enctype='multipart/form-data' class="fc">
<input type="file" accept=".png, .jpg, .jpeg" name="fl"/><br><br>
<label for="write">Write Something:</label>
<textarea id="write" name="write"  rows="4" cols="50"><?php if(isset($_GET['blogtxt'])){echo $_GET['blogtxt'];} ?></textarea><br><br>
   <input type='submit' value='Post' name='postblog'><br>
</form>
<?php
if(isset($_GET['blogid'])){
  $name = $_GET['name'];
  $email =$_GET['email'];
  
  $blogdate = $_GET['subdate'];
                $path =  $_GET['imgpath'];
                $path1 =explode("/",$path);
  $imgpath = $path1[2] ;
  $blogid = $_GET['blogid'];
  $currenttime=date('Y-m-d');
  if(isset($_POST['postblog'])){
    $blogtxt = $_GET['blogtxt'];  
    $text=$_POST['write'];
    $filename=$_FILES['fl']['name'];
    $currenttime=date('Y-m-d');
    $dir="blogs/images/";
    $target_file=$dir.$_FILES['fl']['name'];
   
    if($target_file === null){
      $target_file = $path;
    }

    if(move_uploaded_file($_FILES['fl']['tmp_name'],$target_file)){
      $query = 'UPDATE blog SET submission_date = "'.$currenttime.'" ,imagepath = "'.$target_file.'" ,blogtext = "'.$text.'"
      WHERE blog_id = '.(int)$blogid.'';
      if (mysqli_query($conn, $query)) {
      
        echo '<script type="text/javascript">alert("Blog Updated Successfully")</script>';
        echo '<script type="text/javascript">location.replace("blog.php?name='.$name.'")</script>';
      } else {
        echo '<script type="text/javascript">alert("Blog Not Updated '.$target_file.'")</script>';
      }
    }

  }}
  else{
    if(isset($_POST['postblog'])){
    $email =$_GET['email'];
    $name = $_GET['name'];
      $text=$_POST['write'];
      $filename=$_FILES['fl']['name'];
      $currenttime=date('Y-m-d');
      $dir="blogs/images/";
      $target_file=$dir.$_FILES['fl']['name'];
      if(move_uploaded_file($_FILES['fl']['tmp_name'],$target_file)){
  
          $que = "INSERT INTO blog (email,author,submission_date,imagepath,blogtext) VALUES
          ('$name','$currenttime','$target_file','$text')";
          if(mysqli_query($conn,$que))
          {
                echo '<script type="text/javascript">alert("Blog Posted")</script>';
                echo '<script type="text/javascript">location.replace("#")</script>';
          }
          else
          {
                echo '<script type="text/javascript">alert("Blog Not Uploaded")</script>';
  
          }   
      }
     
  }
  }
?>
</body>
</html>