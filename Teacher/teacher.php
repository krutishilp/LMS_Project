<?php session_start() ?>
<?php
$email = $_SESSION['teacher_user_email'];
$name = $_SESSION['teacher_user_name'];
$pass = $_SESSION['teacher_user_pass'];
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
  <div id="sb">
    <!-- Teacher Profile  -->
    Hi <?php echo $name; ?>
    <hr>
    <ul style="list-style-type: none">
      <?php
      $getsubs = "SELECT subject FROM teachers WHERE email='$email'";
      $run = mysqli_query($conn, $getsubs);
      while ($row = mysqli_fetch_assoc($run)) {

        echo '<li>';
        $subid = $row['subject'] . 'id';
        //$subid=strval($subid);
        //$subid1='#'.$subid;
        $sub = $row['subject'];

        echo '<span onclick="tgllist(\'' . $subid . '\')">' . $row['subject'] . '</span>';
        echo '<div class="sub" id="' . $subid . '">';
        echo '<ul>';
        echo '<li>';
        $pdf = $row['subject'] . 'pdf';
        echo '<span onclick="tgllist(\'' . $pdf . '\')">PDF Notes</span>';
        echo  '<div class="sub" id="' . $pdf . '">';
        echo '<ul>';
        $getpdf = "SELECT * FROM pdfs WHERE author='$email' AND subject='$sub'";
        $rgetpdf = mysqli_query($conn, $getpdf);
        while ($pdfrow = mysqli_fetch_assoc($rgetpdf)) {
          echo '<li><a href="pdfs/' . $pdfrow['name'] . '">' . $pdfrow['name'] . '</a></li>';
        }
        echo '</ul>';
        echo  '</div>';
        echo '</li>';
        echo '<li>';
        $video = $row['subject'] . 'vid';
        echo '<span onclick="tgllist(\'' . $video . '\')">Videos</span>';
        echo  '<div class="sub" id="' . $video . '">';
        echo '<ul>';
        $getvid = "SELECT * FROM videos WHERE author='$email' AND subject='$sub'";
        $rgetvid = mysqli_query($conn, $getvid);
        while ($vidrow = mysqli_fetch_assoc($rgetvid)) {
          if ($vidrow['status'] == 1) {
            echo '<li style="color:green;"><span style="color:black !important;" onclick="playvid(\'videos/' . $vidrow['name'] . '\',1)">' . $vidrow['name'] . '</a></li>';
          } else {
            echo '<li><span onclick="playvid(\'videos/' . $vidrow['name'] . '\',0)">' . $vidrow['name'] . '</a></li>';
          }
        }
        echo '</ul>';
        echo  '</div>';
        echo '</li>';
        echo '<li>';
        $ppt = $row['subject'] . 'ppt';
        echo '<span onclick="tgllist(\'' . $ppt . '\')">PPT</span>';
        echo  '<div class="sub" id="' . $ppt . '">';
        echo '<ul>';
        $getppt = "SELECT * FROM ppts WHERE author='$email' AND subject='$sub'";
        $rgetppt = mysqli_query($conn, $getppt);
        while ($pptrow = mysqli_fetch_assoc($rgetppt)) {
          echo '<li><a href="ppts/' . $pptrow['name'] . '">' . $pptrow['name'] . '</a></li>';
        }
        echo '</ul>';

        echo  '</div>';
        echo '</li>';

        echo '<li>';
        $quizz = $row['subject'] . 'quizz';
        echo '<span onclick="tgllist(\'' . $quizz . '\')">Quizzes</span>';
        echo  '<div class="sub" id="' . $quizz . '">';
        echo '<ul>';
        $getquizz = "SELECT * FROM quizz WHERE subject='$sub'";
        
       
        
        $rgetquizz = mysqli_query($conn, $getquizz);
        while ($quizzrow = mysqli_fetch_assoc($rgetquizz)) {
              echo '<li><a href="quizz.php?eid=' . $quizzrow['exam_id'] . '&qno=' . $quizzrow['name'] . '&qsub=' . $quizzrow['subject'] . '&qstatus=' . $quizzrow['status'] . '">' . $quizzrow['name'] . '</a></li>';     
          }
          
        
        echo '</ul>';

        echo  '</div>';
        echo '</li>';
        echo '<li>';
        $assign = $row['subject'] . 'assign';
        echo '<span onclick="tgllist(\'' . $assign . '\')">Assignment Summary</span>';
        echo  '<div class="sub" id="' . $assign . '">';
        echo '<ul>';
        $getassign = "SELECT * FROM assignment WHERE Subject_Name='$sub'";
        $rgetassign = mysqli_query($conn, $getassign);
        while ($assignrow = mysqli_fetch_assoc($rgetassign)) {
          echo '<li><a href="submitted_ass.php?unit=' . $assignrow['Unit'] . '&desc='
            . $assignrow['Description'] . '&qsub=' . $assignrow['Subject_Name'] . '">' . $assignrow['Description'] . '</a></li>';
        }
        echo '</ul>';

        echo  '</div>';
        echo '</li>';


        echo '</ul>';
        echo '</div>';
        echo '</li>';
      }
    
      ?>
    </ul>
    <hr>
  </div>
  <nav class="navbar navbar-expand-lg navbar-info bg-info">
    <ul class="navbar-nav mr-auto ">
      <li class="nav-item active">
        <i id="tg" class='fas fa-arrow-alt-circle-right' style='color:#d5d5d5;font-size: 30px;'></i>
      </li>
    </ul>
    <a class="navbar-brand text-white" href="#">Learning Management System</a>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active"><?php echo '<a class=" nav-link text-white mr-3" href="../blog.php?name=' . $name . '&email=' . $email . '">Write a Blog</a>'; ?></li>
      <li class="nav-item active">
        <form method="post">
          <button type="submit" name='lgt' style="border:2px solid #d5d5d5; background-color: transparent;color: #d5d5d5;"><i class="fas fa-sign-out-alt"></i></button>
        </form>
      </li>
    </ul>
  </nav>
  <div>
    <div class="container-fluid">
      <div class="row pad">
        <div class="col-lg-6 sm-auto md-auto">
          <div class="fc" id='viddiv'>
            <h3 id="title">Video</h3><br>
            <video id='vidshow' style="width: 100%;" controls>
              <source id="srcvid" type="video/mp4">
            </video>
            <br>
            <form id="publish" style="display: none;" method="POST"><input type="hidden" name="vidname" id="vidpub"><input type="submit" name="publish" value="Publish" s></form>
          </div>
        </div>
        <br><br>
        <div class="col-lg-6 sm-auto md-auto">
          <div class="fc">
            <h3>Uploads</h3>
            <?php include 'upload-form.php'; ?>
          </div>
        </div>
      </div>
      <div class="row pad">
        <div class="col-lg-6 sm-auto md-auto">
          <div class="fc">
            <h3>Create Quiz/Assignment</h3>
            <label style="display: inline-block; " for="quiz">Quiz<input type="radio" id="quiz" name="ass_type" value="2" checked></label>
            <label style="display: inline-block;padding:10px;margin-left: 10px;" for="assign">Assignment<input type="radio" id="assign" name="ass_type" value="3"></label>
            <?php include 'create-quiz.php' ?>
          </div>
        </div>
        <div class="col-lg-6 sm-auto md-auto">
          <div class="fc">
            <h3>Post an Activity</h3>
            <label style="display: inline-block; " for="seminar">Seminar<input type="radio" id="seminar" name="act" value="2" checked></label>
            <label style="display: inline-block;padding:10px;margin-left: 10px;" for="feedback">Feedback<input type="radio" id="feedback" name="act" value="3"></label>
            <?php include 'addActivity.php' ?>
          </div>
        </div>
      </div>
      <br>
      <div class="row pad">
        <div class="col-lg-6 sm-auto md-auto">
          <div class="fc">
            <h3>Add Final Marks</h3>
            <p>This Marks used for final Result Analysis</p>
            <?php include 'addMarks.php' ?>
          </div>
        </div>
        <div class="col-lg-6 sm-auto md-auto">
          <div class="fc">
            <h2>Your Blogs</h2>
            <?php include 'yourblog.php' ?>
          </div>
        </div>
      </div>
    </div>
    <br><br><br>
    <div class="navbar navbar-expand-lg navbar-info bg-info" id="footer">
      <a class="navbar-brand mx-auto text-white">.....</a>
    </div>
</body>

</html>
<?php include '../sidebarJavaScript.php' ?>
<?php
if (isset($_POST['publish'])) {
  $vidname = $_POST['vidname'];
  $q = "UPDATE videos SET status=1 WHERE author='$email' and name='$vidname'";
  ($run = mysqli_query($conn, $q)); {
    echo  '<script type="text/javascript">alert("Video Published")</script>';
    echo  '<script type="text/javascript">location.replace("teacher.php")</script>';
  }
}
if (isset($_POST['lgt'])) {
  unset($_SESSION["teacher_user_email"]);
  unset($_SESSION["teacher_user_name"]);
  unset($_SESSION["teacher_user_pass"]);
  echo "<script type='text/javascript'>location.replace('../index.php')</script>";
}
?>