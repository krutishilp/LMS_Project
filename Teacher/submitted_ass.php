<?php session_start() ?>
<?php
$unit = $_GET['unit'];
$desc = $_GET['desc'];
$qsub = $_GET['qsub'];
$email = $_SESSION['teacher_user_email'];
$name = $_SESSION['teacher_user_name'];
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
          <button type="submit" name='lgt' style="border:2px solid #d5d5d5; background-color: transparent;color: #d5d5d5;"><i class="fas fa-sign-out-alt"></i></button>
        </form>
      </li>
    </ul>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="table-responsive" id="results">
          <h1> Submitted Assignment Data</h1>
          <h5><b>Description <?php echo $desc; ?></b></h5>
          <h5><b>Subject-Name: <?php echo $qsub; ?></b></h5>
          <h5><b>Unit: <?php echo $unit; ?></b></h5>
          <br>
          <table class="table table-striped table-bordered">
            <tr>
              <th>Student ID</th>
              <th>Student Name</th>
              <th>Submitted On</th>
              <th>Submission Status</th>
            </tr>
            <?php
            $getrecords = "SELECT * FROM `assignment_submission` WHERE subject_name='$qsub' AND unit = '$unit' ";
            $rungetr = mysqli_query($conn, $getrecords);
            while ($rrow = mysqli_fetch_assoc($rungetr)) {
              echo "<tr><td>" . $rrow['student_Id'] . "</td><td><a href=" . $rrow['filepath'] . ">" . $rrow['student_name'] . "</a></td><td>" . $rrow['submission_date'] . "</td><td>" . $rrow['submitted'] . "</td></tr>";
            }

            ?>
          </table>
          <?php

          ?>
        </div>
        <br>
      </div>
    </div>
  </div>
  <br><br><br><br>


  <div class="navbar navbar-expand-lg navbar-dark bg-dark" id="footer">
    <a class="navbar-brand mx-auto">Made by Nishad Raisinghani</a>
  </div>
</body>

</html>
<?php
if (isset($_POST['lgt'])) {
  session_destroy();
  echo "<script type='text/javascript'>location.replace('../index.php')</script>";
}
?>