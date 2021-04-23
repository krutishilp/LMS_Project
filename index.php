<?php session_start() ?>
<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<html>

<head>
  <title>Home</title>
  <?php include 'links.php'; ?>
  <?php include 'style.php'; ?>

</head>

<body> 
  <nav class="navbar navbar-expand-lg navbar-info bg-info " >
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand text-white" style="font-size: x-large;" href="#">Learning Management System</a>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active"><a class="nav-link text-white" href="#" id="about">About Us</a></li>
        <li class="nav-item active"><a class="nav-link text-white" href="#" id="blog">Blogs</a></li>
        <li class="nav-item active"><a class="nav-link text-white" href="#" id="signup">Sign Up</a></li>
        <li class="nav-item active"><a class="nav-link text-white" href="#" id="login">Login</a></li>
      </ul>
    </div>
  </nav>
  <div style="margin-top: 90px ; position: fixed;">
    <h1 class="text-white" style="font-family: Georgia, 'Times New Roman', Times, serif; "><i> Welcome to,</i><i><br></i></h1><h1 class="text-white" style="font-size: 75px; font-family: Georgia, 'Times New Roman', Times, serif; "><strong> Learning <i><br></i>Management <i><br></i>System.</strong></h1>
  </div>
  <div class="container-fluid pad2" >
    <div class="row pad">
      <div class="col-lg-6 offset-lg-3 sm-auto md-auto">
        <div class="row">
          <div class="col abtpad messagepop " id="pop1">
            <a id="close1" href="#"><i id="tg" class='fas fa-times' style='color:#d5d5d5;font-size: 30px;'></i></a>
            <form action="index.php" method="POST" class="fc">
              <h3>Sign-up</h3>
              <hr>
              <input type="text" name="name" placeholder="Full-Name" required><br><br>
              <input type="email" name="email" placeholder="Email" required><br><br>
              <input type="password" name="password" placeholder="Password" required><br><br>
              <select name="dept" id="dept">
                <option value="">Select Department</option>
                <option value="mech">Mechanical</option>
                <option value="comp">Computer</option>
                <option value="it">IT</option>
                <option value="entc">Electronics and telecomunication</option>
                <option value="civil">Civil</option>
                <option value="instru">Instrumentation & Control</option>
              </select><br><br>
              <select name="year" id="year">
                <option value="fe">FE</option>
                <option value="se">SE</option>
                <option value="te">TE</option>
                <option value="be">BE</option>
              </select><br><br>
              <input type="text" name="prn" placeholder="PRN No" required><br><br>
              <input type="submit" name="su" value="Sign-Up">
            </form>
          </div>
          <div class="col abtpad messagepop " id="pop2">
            <a id="close2" href="#"><i id="tg" class='fas fa-times' style='color:#d5d5d5;font-size: 30px;'></i></a>
            <form action="index.php" method="POST" class="fc">
              <h3>Login</h3>
              <hr>
              <input type="email" name="uemail" placeholder="Email"><br><br>
              <input type="password" name="upassword" placeholder="Password"><br><br>
              <select name="role" id="role">
                <option value="">Select</option>
                <option value="admin">Admin</option>
                <option value="teachers">Teacher</option>
                <option value="student">Student</option>
              </select><br><br>
              <input type="submit" name="lg" value="Log-in"><br><br>

            </form>
          </div>
          <div class="messagepop" id="pop4">
          <?php include 'showblog.php'; ?>
        </div>
        </div>
        <div class="abtpad">
          <div class="fc messagepop" id="pop3">
            <a id="close3" href="#"><i id="tg" class='fas fa-times' style='color:#d5d5d5;font-size: 30px;'></i></a>
            <h3>About</h3>
            <hr>
            <P>To create quality information technology professionals through superior academic environment.<br>
              To incorporate the IT fundamentals in students to be successful in their career.<br>
              To motivate the students for higher studies ,research and entrepreneurship.<br>
              To provide IT services to society .<br><br>
            </P>
            <h3>FAQ</h3>
            <hr>
            <p>
              1)<b>What is E-learning?</b><br>
              A platform for students of E-Learning to interact with teachers with help of usefull resources like PDF notes,Videos and PPTs.<br><br>
              2)<b>What will you get?</b><br>
              Helping students re-visit the lecture to revise and understand concepts aswell as provide necessary resources for exam prep.
              <br>Unit Wise:<br>
            <ul>
              <li>Video Lectures</li>
              <li>PDF Notes</li>
              <li>PPT's</li>
              <li>Quizzes</li>
            </ul>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <br><br><br>
  <nav class="navbar navbar-expand-lg navbar-info bg-info" id="footer">
    <a class="navbar-brand mx-auto text-white" href="#">...</a>
  </nav>
</body>

</html>

<?php
include 'connection.php';

//-------------------------------------------- Sign-Up ------------------------------------------	
if (isset($_POST['su'])) {

  $uname = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $dept = $_POST['dept'];
  $year = $_POST['year'];
  $prn = $_POST['prn'];
  //	$mname=$_POST['mname'];

  $signup = "INSERT INTO student (name,email,prn,year,dept,Password) VALUES ('$uname','$email','$prn','$year','$dept','$password')";
  if ($run = mysqli_query($conn, $signup)) {

    echo '<script type="text/javascript">alert("Done. Please Login.")</script>';
  } else {
    echo '<script type="text/javascript">alert("Not Done. Please Try Again.")</script>';
  }
}

//------------------------------------------------------------------------------------------------------
if (isset($_POST['lg'])) {

  $email = $_POST['uemail'];
  $password = $_POST['upassword'];
  $role = $_POST['role'];

  $login = "";
  if ($role == "admin") {
    $login = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
  } elseif ($role == "teachers") {
    $login = "SELECT * FROM teachers WHERE email='$email' AND password='$password'";
  } else {
    $login = "SELECT * FROM student WHERE email='$email' AND password='$password'";
  }

  if ($run2 = mysqli_query($conn, $login)) {
    $num = mysqli_num_rows($run2);
    if ($num == 1) {
      $row = mysqli_fetch_assoc($run2);
      if ($role == 'teachers') {
        $_SESSION['teacher_user_email'] = $email;
        $_SESSION['teacher_user_pass'] = $password;
        $_SESSION['teacher_user_name'] = $row['name'];
        echo "<script type='text/javascript'>location.replace('Teacher/teacher.php')</script>";
      } elseif ($role == 'admin') {
        $_SESSION['admin_user_email'] = $email;
        $_SESSION['admin_user_pass'] = $password;
        $_SESSION['admin_user_name'] = $row['name'];
        echo "<script type='text/javascript'>location.replace('Admin/admin.php')</script>";
      } else {

        $_SESSION['student_user_email'] = $email;
        $_SESSION['student_user_pass'] = $password;
        $_SESSION['student_Id'] = $row['student_Id'];
        $_SESSION['student_user_name'] = $row['name'];
        $_SESSION['student_user_year'] = $row['year'];
        $_SESSION['student_user_dept'] = $row['dept'];
        echo "<script type='text/javascript'>location.replace('Student/student.php')</script>";
      }
    } else {
      echo '<script type="text/javascript">alert("Email Or Password is wrong check again or contact admin.' . $login . '");</script>;';
    }
  } else {
    echo '<script type="text/javascript">alert("Email Or Password is wrong check again or contact admin.' . $login . '");</script>';
  }
}

?>

<script>
  function deselect1(e) {
    $('#pop1').slideFadeToggle(function() {
      e.removeClass('selected');
    });
  }

  $(function() {
    $('#signup').on('click', function() {

      if ($(this).hasClass('selected')) {
        deselect1($(this));

      } else {
        $(this).addClass('selected');
        $('#pop1').slideFadeToggle();
      }
      return false;
    });

    $('#close1').on('click', function() {
      deselect1($('#signup'));
      $(".row").css("filter", "none");
      return false;
    });
  });

  $.fn.slideFadeToggle = function(easing, callback) {
    return this.animate({
      opacity: 'toggle',
      height: 'toggle'
    }, 'fast', easing, callback);
  };
</script>

<script>
  function deselect2(e) {
    $('#pop2').slideFadeToggle(function() {
      e.removeClass('selected');
    });
  }

  $(function() {
    $('#login').on('click', function() {

      if ($(this).hasClass('selected')) {
        deselect2($(this));
      } else {
        $(this).addClass('selected');
        $('#pop2').slideFadeToggle();
      }
      return false;
    });

    $('#close2').on('click', function() {
      deselect2($('#login'));
      return false;
    });
  });

  $.fn.slideFadeToggle = function(easing, callback) {
    return this.animate({
      opacity: 'toggle',
      height: 'toggle'
    }, 'fast', easing, callback);
  };
</script>

<script>
  function deselect3(e) {
    $('#pop3').slideFadeToggle(function() {
      e.removeClass('selected');
    });
  }

  $(function() {
    $('#about').on('click', function() {

      if ($(this).hasClass('selected')) {
        deselect3($(this));
      } else {
        $(this).addClass('selected');
        $('#pop3').slideFadeToggle();
      }
      return false;
    });

    $('#close3').on('click', function() {
      deselect3($('#about'));
      return false;
    });
  });

  $.fn.slideFadeToggle = function(easing, callback) {
    return this.animate({
      opacity: 'toggle',
      height: 'toggle'
    }, 'fast', easing, callback);
  };
</script>

<script>
  function deselect4(e) {
    $('#pop4').slideFadeToggle(function() {
      e.removeClass('selected');
    });
  }

  $(function() {
    $('#blog').on('click', function() {

      if ($(this).hasClass('selected')) {
        deselect4($(this));
      } else {
        $(this).addClass('selected');
        $('#pop4').slideFadeToggle();
      }
      return false;
    });

    $('#close4').on('click', function() {
      deselect4($('#blog'));
      return false;
    });
  });

  $.fn.slideFadeToggle = function(easing, callback) {
    return this.animate({
      opacity: 'toggle',
      height: 'toggle'
    }, 'fast', easing, callback);
  };
</script>