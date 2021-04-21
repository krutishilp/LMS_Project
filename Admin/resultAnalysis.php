<?php session_start() ?>
<?php
include 'connection.php';
$email = $_SESSION['admin_user_email'];
$name = $_SESSION['admin_user_name'];
$pass = $_SESSION['admin_user_pass'];
?>
<!DOCTYPE html>
<html>

<head>
  <title>Admin</title>
  <?php include '../links.php'; ?>
  <?php include '../style.php'; ?>
</head>

<body>

  <div id="sb">
    Hi <?php echo $name; ?>
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
          <button type="submit" name='lgt' style="border:2px solid #d5d5d5; background-color: transparent;color: #d5d5d5;"><i class="fas fa-sign-out-alt"></i></button>
        </form>
      </li>
    </ul>
  </nav>


  <div class="container-fluid">
    <h2 style="text-align:center; ">Result Analysis</h2>
    <select style="text-align:center;" name="dept" id="dept">
                  <option value="">Select Department</option>
                  <option value="MECH" >Mechanical</option>
                  <option value="COMP" >Computer</option>
                  <option value="IT" >IT</option>
                  <option value="E&TC" >Electronics and telecomunication</option>
                  <option value="CIVIL" >Civil</option>
                  <option value="INSTRU">Instrumentation & Control</option>
                </select><br><br>
    <div class="row pad">
      <div class="col-lg-6 sm-auto md-auto">
        <div class="table-responsive">
          <h5><b>First Year </b></h5>
          <div>
            <input type="radio" id="sems1" name="semfe" value="1" checked><label for="sems1">SEM 1</label>
            <input type="radio" id="sems2" name="semfe" value="2"><label for="sems2">SEM 2</label>
          </div>
          <div id="semfe1" class="desc1">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $prn = "";
              $row=array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'FE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
               AND dept = 'IT' ORDER BY mark DESC";
                $run1 = mysqli_query($conn, $getrecords);
                if ($rrrow = mysqli_fetch_assoc($run1)) {
                  if (!$rrrow['mark'] == null) {
                    $row[$rrow['name']] = $rrrow['mark'];
                  }
                }
              }
              arsort($row);
              foreach ($row as $name => $marks) {
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
              }
              ?>
            </table>
            <h2>Top Five</h2>
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              // $prn = "";
              // $row=array();
              // $query = "SELECT DISTINCT student.name,student.prn FROM student
              // RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              // WHERE student.year = 'SE'";
              // $run = mysqli_query($conn, $query);
              // while ($rrow = mysqli_fetch_assoc($run)) {
              //   $prn = $rrow['prn'];
              //   //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
              //   $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
              //  AND dept = 'IT' ORDER BY mark DESC";
              //   $run1 = mysqli_query($conn, $getrecords);
              //   if ($rrrow = mysqli_fetch_assoc($run1)) {
              //     if (!$rrrow['mark'] == null) {
              //       $row[$rrow['name']] = $rrrow['mark'];
              //     }
              //   }
              // }
              arsort($row);
              $cnt=0;
              foreach ($row as $name => $marks) {
                if($cnt==2){
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
            


          </div>
          <div id="semfe2" class="desc1" style="display: none;">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $prn = "";
              $row=array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'FE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem2'
               AND dept = 'IT' ORDER BY mark DESC";
                $run1 = mysqli_query($conn, $getrecords);
                if ($rrrow = mysqli_fetch_assoc($run1)) {
                  if (!$rrrow['mark'] == null) {
                    $row[$rrow['name']] = $rrrow['mark'];
                  }
                }
              }
              arsort($row);
              foreach ($row as $name => $marks) {

                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
              }
              ?>
            </table>
            <h2>Top Five</h2>
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              // $prn = "";
              // $row=array();
              // $query = "SELECT DISTINCT student.name,student.prn FROM student
              // RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              // WHERE student.year = 'SE'";
              // $run = mysqli_query($conn, $query);
              // while ($rrow = mysqli_fetch_assoc($run)) {
              //   $prn = $rrow['prn'];
              //   //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
              //   $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
              //  AND dept = 'IT' ORDER BY mark DESC";
              //   $run1 = mysqli_query($conn, $getrecords);
              //   if ($rrrow = mysqli_fetch_assoc($run1)) {
              //     if (!$rrrow['mark'] == null) {
              //       $row[$rrow['name']] = $rrrow['mark'];
              //     }
              //   }
              // }
              arsort($row);
              $cnt=0;
              foreach ($row as $name => $marks) {
                if($cnt==2){
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-6 sm-auto md-auto">
        <div class="table-responsive">
          <h5><b>Second Year </b></h5>
          <div>

            <input type="radio" id="sems3" name="semse" value="1" checked><label for="sems3">SEM 1</label>
            <input type="radio" id="sems4" name="semse" value="2"><label for="sems4">SEM 2</label>
          </div>
          <div id="semse1" class="desc2">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $prn = "";
              $row=array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'SE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
               AND dept = 'IT' ORDER BY mark DESC";
                $run1 = mysqli_query($conn, $getrecords);
                if ($rrrow = mysqli_fetch_assoc($run1)) {
                  if (!$rrrow['mark'] == null) {
                    $row[$rrow['name']] = $rrrow['mark'];
                  }
                }
              }
              arsort($row);
              foreach ($row as $name => $marks) {
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
              }
              ?>
            </table>

            <h2>Top Five</h2>
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              // $prn = "";
              // $row=array();
              // $query = "SELECT DISTINCT student.name,student.prn FROM student
              // RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              // WHERE student.year = 'SE'";
              // $run = mysqli_query($conn, $query);
              // while ($rrow = mysqli_fetch_assoc($run)) {
              //   $prn = $rrow['prn'];
              //   //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
              //   $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
              //  AND dept = 'IT' ORDER BY mark DESC";
              //   $run1 = mysqli_query($conn, $getrecords);
              //   if ($rrrow = mysqli_fetch_assoc($run1)) {
              //     if (!$rrrow['mark'] == null) {
              //       $row[$rrow['name']] = $rrrow['mark'];
              //     }
              //   }
              // }
              arsort($row);
              $cnt=0;
              foreach ($row as $name => $marks) {
                if($cnt==2){
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
          </div>
          <div id="semse2" class="desc2" style="display: none;">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $prn = "";
              $row=array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'SE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem2'
               AND dept = 'IT' ORDER BY mark DESC";
                $run1 = mysqli_query($conn, $getrecords);
                if ($rrrow = mysqli_fetch_assoc($run1)) {
                  if (!$rrrow['mark'] == null) {
                    $row[$rrow['name']] = $rrrow['mark'];
                  }
                }
              }
              arsort($row);
              foreach ($row as $name => $marks) {
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
              }
              ?>
            </table>
            <h2>Top Five</h2>
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              // $prn = "";
              // $row=array();
              // $query = "SELECT DISTINCT student.name,student.prn FROM student
              // RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              // WHERE student.year = 'SE'";
              // $run = mysqli_query($conn, $query);
              // while ($rrow = mysqli_fetch_assoc($run)) {
              //   $prn = $rrow['prn'];
              //   //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
              //   $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
              //  AND dept = 'IT' ORDER BY mark DESC";
              //   $run1 = mysqli_query($conn, $getrecords);
              //   if ($rrrow = mysqli_fetch_assoc($run1)) {
              //     if (!$rrrow['mark'] == null) {
              //       $row[$rrow['name']] = $rrrow['mark'];
              //     }
              //   }
              // }
              arsort($row);
              $cnt=0;
              foreach ($row as $name => $marks) {
                if($cnt==2){
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
          </div>
        </div>
      </div>

      <div class="col-lg-6 sm-auto md-auto">
        <div class="table-responsive">
          <h5><b>Third Year </b></h5>
          <div>
            <input type="radio" id="sems5" name="semte" value="1" checked><label for="sems5">SEM 1</label>
            <input type="radio" id="sems6" name="semte" value="2"><label for="sems6">SEM 2</label>
          </div>
          <div id="semte1" class="desc3">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $prn = "";
              $row=array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'TE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
               AND dept = 'IT' ORDER BY mark DESC";
                $run1 = mysqli_query($conn, $getrecords);
                if ($rrrow = mysqli_fetch_assoc($run1)) {
                  if (!$rrrow['mark'] == null) {
                    $row[$rrow['name']] = $rrrow['mark'];
                  }
                }
              }
              arsort($row);
              foreach ($row as $name => $marks) {
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
              }
              ?>
            </table>
            <h2>Top Five</h2>
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              // $prn = "";
              // $row=array();
              // $query = "SELECT DISTINCT student.name,student.prn FROM student
              // RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              // WHERE student.year = 'SE'";
              // $run = mysqli_query($conn, $query);
              // while ($rrow = mysqli_fetch_assoc($run)) {
              //   $prn = $rrow['prn'];
              //   //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
              //   $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
              //  AND dept = 'IT' ORDER BY mark DESC";
              //   $run1 = mysqli_query($conn, $getrecords);
              //   if ($rrrow = mysqli_fetch_assoc($run1)) {
              //     if (!$rrrow['mark'] == null) {
              //       $row[$rrow['name']] = $rrrow['mark'];
              //     }
              //   }
              // }
              arsort($row);
              $cnt=0;
              foreach ($row as $name => $marks) {
                if($cnt==2){
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
          </div>
          <div id="semte2" class="desc3" style="display: none;">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $prn = "";
              $row=array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'TE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem2'
               AND dept = 'IT' ORDER BY mark DESC";
                $run1 = mysqli_query($conn, $getrecords);
                if ($rrrow = mysqli_fetch_assoc($run1)) {
                  if (!$rrrow['mark'] == null) {
                    $row[$rrow['name']] = $rrrow['mark'];
                  }
                }
              }
              arsort($row);
              foreach ($row as $name => $marks) {
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
              }
              ?>
            </table>
            <h2>Top Five</h2>
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              // $prn = "";
              // $row=array();
              // $query = "SELECT DISTINCT student.name,student.prn FROM student
              // RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              // WHERE student.year = 'SE'";
              // $run = mysqli_query($conn, $query);
              // while ($rrow = mysqli_fetch_assoc($run)) {
              //   $prn = $rrow['prn'];
              //   //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
              //   $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
              //  AND dept = 'IT' ORDER BY mark DESC";
              //   $run1 = mysqli_query($conn, $getrecords);
              //   if ($rrrow = mysqli_fetch_assoc($run1)) {
              //     if (!$rrrow['mark'] == null) {
              //       $row[$rrow['name']] = $rrrow['mark'];
              //     }
              //   }
              // }
              arsort($row);
              $cnt=0;
              foreach ($row as $name => $marks) {
                if($cnt==2){
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
          </div>
        </div>



      </div>
      <div class="col-lg-6 sm-auto md-auto">
        <div class="table-responsive">
          <h5><b>Final Year </b></h5>
          <div>

            <input type="radio" id="sems7" name="sembe" value="1" checked><label for="sems7">SEM 1</label>
            <input type="radio" id="sems8" name="sembe" value="2"><label for="sems8">SEM 2</label>
          </div>
          <div id="sembe1" class="desc4">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $prn = "";
              $row=array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'BE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
               AND dept = 'COMP' ORDER BY mark DESC";
                $run1 = mysqli_query($conn, $getrecords);
                if ($rrrow = mysqli_fetch_assoc($run1)) {
                  if (!$rrrow['mark'] == null) {
                    $row[$rrow['name']] = $rrrow['mark'];
                  }
                }
              }
              arsort($row);
              foreach ($row as $name => $marks) {
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
              }
              ?>
            </table>
            <h2>Top Five</h2>
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              // $prn = "";
              // $row=array();
              // $query = "SELECT DISTINCT student.name,student.prn FROM student
              // RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              // WHERE student.year = 'SE'";
              // $run = mysqli_query($conn, $query);
              // while ($rrow = mysqli_fetch_assoc($run)) {
              //   $prn = $rrow['prn'];
              //   //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
              //   $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
              //  AND dept = 'IT' ORDER BY mark DESC";
              //   $run1 = mysqli_query($conn, $getrecords);
              //   if ($rrrow = mysqli_fetch_assoc($run1)) {
              //     if (!$rrrow['mark'] == null) {
              //       $row[$rrow['name']] = $rrrow['mark'];
              //     }
              //   }
              // }
              arsort($row);
              $cnt=0;
              foreach ($row as $name => $marks) {
                if($cnt==2){
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
          </div>
          <div id="sembe2" class="desc4" style="display: none;">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $prn = "";
              $row=array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'BE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem2'
               AND dept = 'COMP' ORDER BY mark DESC";
                $run1 = mysqli_query($conn, $getrecords);
                if ($rrrow = mysqli_fetch_assoc($run1)) {
                  if (!$rrrow['mark'] == null) {
                    $row[$rrow['name']] = $rrrow['mark'];
                  }
                }
              }
              arsort($row);
              foreach ($row as $name => $marks) {
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
              }
              ?>
            </table>
            <h2>Top Five</h2>
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              // $prn = "";
              // $row=array();
              // $query = "SELECT DISTINCT student.name,student.prn FROM student
              // RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              // WHERE student.year = 'SE'";
              // $run = mysqli_query($conn, $query);
              // while ($rrow = mysqli_fetch_assoc($run)) {
              //   $prn = $rrow['prn'];
              //   //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
              //   $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
              //  AND dept = 'IT' ORDER BY mark DESC";
              //   $run1 = mysqli_query($conn, $getrecords);
              //   if ($rrrow = mysqli_fetch_assoc($run1)) {
              //     if (!$rrrow['mark'] == null) {
              //       $row[$rrow['name']] = $rrrow['mark'];
              //     }
              //   }
              // }
              arsort($row);
              $cnt=0;
              foreach ($row as $name => $marks) {
                if($cnt==2){
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
          </div>
        </div>
      </div>

      <!-- <div class="col-lg-6 sm-auto md-auto">
        <div class="table-responsive">
        <h5><b>Top 5 Students.</b></h5>
                <table class="table table-striped table-bordered" style="width:100%">
                  <tr><th>Name</th><th>Score</th></tr>
                  <?php
                  // $getrecords = "SELECT * FROM";
                  // $rungetr=mysqli_query($conn,$getrecords);
                  // while($rrow=mysqli_fetch_assoc($rungetr))
                  // {
                  //   echo "<tr><td>".$rrow['stud_name']."</td><td>".$rrow['score']."</td></tr>";
                  // }
                  ?>
                </table>
        </div>
      </div> -->


    </div>
  </div><br><br><br><br>
  <div class="navbar navbar-expand-lg navbar-dark bg-dark" id="footer">
    <a class="navbar-brand mx-auto">...</a>
  </div>
</body>

</html>

<?php
if (isset($_POST['lgt'])) {
  unset($_SESSION["admin_user_email"]);
  unset($_SESSION["admin_user_name"]);
  unset($_SESSION["admin_user_pass"]);
  echo "<script type='text/javascript'>location.replace('../index.php')</script>";
}

?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  $(document).ready(function() {
    $("input[name$='semfe']").click(function() {
      var t = $(this).val();
      $("div.desc1").hide();

      $("#semfe" + t).show();

      //    $("#quiz" + test).css("display","block");
    });
  });
  $(document).ready(function() {
    $("input[name$='semse']").click(function() {
      var t = $(this).val();
      $("div.desc2").hide();

      $("#semse" + t).show();

      //    $("#quiz" + test).css("display","block");
    });
  });
  $(document).ready(function() {
    $("input[name$='semte']").click(function() {
      var t = $(this).val();
      $("div.desc3").hide();

      $("#semte" + t).show();

      //    $("#quiz" + test).css("display","block");
    });
  });
  $(document).ready(function() {
    $("input[name$='sembe']").click(function() {
      var t = $(this).val();
      $("div.desc4").hide();

      $("#sembe" + t).show();

      //    $("#quiz" + test).css("display","block");
    });
  });
</script>