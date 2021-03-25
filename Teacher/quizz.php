<?php session_start()?>
<?php
$eid=$_GET['eid'];
$aid=$_GET['qno'];
$sub=$_GET['qsub'];
$status=$_GET['qstatus'];
$email=$_SESSION['teacher_user_email'];
$name=$_SESSION['teacher_user_name'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Teacher Dashboard</title>
	<?php include '../links.php' ?>
	<?php include '../connection.php' ?>
  <?php include '../style.php' ?>
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
  <div class="container-fluid">
  <button id="toggleStatus"></button>
    <div class="row pad">
    	<div class="col-lg-12 md-auto sm-auto pad">
        <?php include 'quiz-table.php'; ?> 
        	<div class="table-responsive">
        		<table class="table table-striped table-bordered">
        			<tr><th>Q-ID</th><th>Question</th><th>Option 1</th><th>Option 2</th><th>Option 3</th><th>Option 4</th><th>Answer</th></tr>
        			<?php echo $tbl_html; ?>
        		</table>
        		
        	</div>
        	<?php echo $del_html?>
    	</div>
  	
    </div>
    <div class="row">
      <div class="col">
        <div class="table-responsive" id="results">
          <h1> Results </h1>
          <h5><b>Exam-iD: <?php echo $eid; ?></b></h5>
          <h5><b>Exam-Name: <?php echo $aid; ?></b></h5>
          <h5><b>Exam-Subject: <?php echo $sub; ?></b></h5>
          <br>
            <table class="table table-striped table-bordered">
              <tr><th>Email</th><th>Score</th></tr>
              <?php
               $getrecords="SELECT * FROM `assessment_records` WHERE exam_id='$eid'";
               $rungetr=mysqli_query($conn,$getrecords);
               while($rrow=mysqli_fetch_assoc($rungetr))
               {
                echo "<tr><td>".$rrow['email']."</td><td>".$rrow['score']."</td></tr>";
               }
              ?>
        </table>
      </div>
      <br><button onclick="printDiv('results')">Download Result</button>
      
    </div>
  </div>
  	<br><br><br><br>


  <div class="navbar navbar-expand-lg navbar-dark bg-dark" id="footer">
        <a class="navbar-brand mx-auto">....</a>
  </div>
</body>
</html>
<?php
if (isset($_POST['lgt'])) 
 {
  session_destroy();
  echo "<script type='text/javascript'>location.replace('../index.php')</script>";
 }
?>
<script type="text/javascript">
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

<script type="text/javascript"> 
       $(function(){
        var status = <?php echo "'$status'" ?> 
        console.log(status);
        if(status == '0'){
          $("#toggleStatus").html('Deactivate');
        } else if(status=='1'){
          $("#toggleStatus").html('Activate');
        }
         $("#toggleStatus").on('click',function(){
           var status = <?php echo "'$status'" ?> 
          if(status == '0' || status == '1'){
            
            $.ajax({ 
             method: "GET", 
        
             url: 'toggleStatus.php?'.concat("<?php 
            echo "eid=".$eid."&qstatus=".$status.""
           ?>")
         }).done(function( data ) { 
           alert("Done");
           window.history.back();
         });
          }
       }); 
   }); 
</script>     

 <?php/*
if (isset($GET['qstatus'])) 
 {
   $query = "";
  if($GET['qstatus'] == 0){
    $query = "UPDATE quizz SET status = '$status' WHERE exam_id = '$eid'";
    if(mysqli_query($conn,$query)){
      echo "<h2>ddddddddddddddd</h2>";
    }
  }else if($GET['qstatus'] == 1){
    $query = "UPDATE quizz set status = '$status' WHERE exam_id = 0";
    $rungetr=mysqli_query($conn,$query);
  }
 }
 */
?> 