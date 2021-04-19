<?php session_start()?>
<?php
              include 'connection.php';
               $email=$_SESSION['admin_user_email'];
               $name=$_SESSION['admin_user_name'];
               $pass=$_SESSION['admin_user_pass'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
 <?php include '../links.php'; ?>  
 <?php include '../style.php';?>
</head>
<body>

<div id="sb">
    Hi <?php echo $name ;?>
    <hr>
    <br>
  </div>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
         <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a href="admin.php"><i id="tg" class='fas fa-arrow-alt-circle-left' style='color:#d5d5d5;font-size: 30px;'></i></a>
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


    <div class="container-fluid">
     <h2 style="text-align:center; ">Result Analysis</h2>
      <div class="row pad">
      <div class="col-lg-6 sm-auto md-auto">
            <div class="table-responsive" >
              <h5><b>First Year </b></h5>
            <div style="padding: 45px;">
                <h3>Overall Result</h3>
                <input type="radio" id="sems1" name="sem" value="1" checked><label for="sems1" >SEM 1</label>
                <input type="radio" id="sems2" name="sem" value="2" ><label for="sems2">SEM 2</label>
            </div>
    <div id="sem1" class="desc1">
                <table class="table table-striped table-bordered" >
                  <tr><th>Name</th><th>Score</th></tr>
                  <?php
                  $prn="";
                  $getrecords="SELECT `stud_prn`,avg(`marks`) as `mark` FROM `final_result` WHERE year='SE' ORDER BY marks DESC";
                  $rungetr=mysqli_query($conn,$getrecords);
                  while($rrow=mysqli_fetch_assoc($rungetr))
                  {
                    $prn=$rrow['stud_prn'];
                    $query = "SELECT * FROM `student` WHERE prn='$prn'";
                    $rungetr=mysqli_query($conn,$query);
                  if($rrrow=mysqli_fetch_assoc($rungetr))
                  {
                    echo "<tr><td>".$rrrow['name']."</td><td>".$rrow['mark']."</td></tr>";
                  }
                }
                  ?>
                </table>
            </div>
            <div id="sem2" class="desc1" style="display: none;">
                <table class="table table-striped table-bordered" >
                  <tr><th>Name</th><th>Score</th></tr>
                  <?php
                  $prn="";
                  $getrecords="SELECT `stud_prn`,avg(`marks`) as `mark` FROM `final_result` WHERE year='BE' ORDER BY marks DESC";
                  $rungetr=mysqli_query($conn,$getrecords);
                  while($rrow=mysqli_fetch_assoc($rungetr))
                  {
                    $prn=$rrow['stud_prn'];
                    $query = "SELECT * FROM `student` WHERE prn='$prn'";
                    $rungetr=mysqli_query($conn,$query);
                  if($rrrow=mysqli_fetch_assoc($rungetr))
                  {
                    echo "<tr><td>".$rrrow['name']."</td><td>".$rrow['mark']."</td></tr>";
                  }
                }
                  ?>
                </table>
            </div>
            </div>
        <div class="col-lg-6 sm-auto md-auto" >
            <h2>Second Year</h2>

              

        </div>
        <div class="col-lg-6 sm-auto md-auto" >
            <h2>Third Year</h2>

             

        </div>
        <div class="col-lg-6 sm-auto md-auto">
            <h2>Final Year</h2>
  

        </div>    
       </div> 
       
      <br><br>
      </div>
      <div class="navbar navbar-expand-lg navbar-dark bg-dark" id="footer">
        <a class="navbar-brand mx-auto">...</a>
      </div>
</body>
</html>

<?php
if (isset($_POST['lgt'])) 
 {
  unset($_SESSION["admin_user_email"]);
  unset($_SESSION["admin_user_name"]);
  unset($_SESSION["admin_user_pass"]);
  echo "<script type='text/javascript'>location.replace('../index.php')</script>";
 }

?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    $("input[name$='sem']").click(function() {
        var t = $(this).val();
        $("div.desc1").hide();
      
        $("#sem" + t).show();

    //    $("#quiz" + test).css("display","block");
    });
});
</script>
