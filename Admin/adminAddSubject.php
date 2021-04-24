
<?php
if (isset($_POST['addsub'])) {
  $nm = $_POST['sub'];
  $dept = $_POST['dept'];
  $year = $_POST['year'];
  $sem = $_POST['sem'];
  $q = "INSERT INTO `subjects`(`subject`,`dept`,`year`,`sem`) VALUES ('$nm','$dept','$year','$sem')";
  if ($run = mysqli_query($conn, $q)) {
    echo '<script type="text/javascript">alert("Done")</script>';
    echo '<script type="text/javascript">window.location.replace("admin.php")</script>';
  } else {
    echo '<script type="text/javascript">alert("Not Done. PLease Try Again")</script>';
  }
}
?>