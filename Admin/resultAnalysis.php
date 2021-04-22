<?php session_start(); ?>
<?php

include 'connection.php';
$email = $_SESSION['admin_user_email'];
$name = $_SESSION['admin_user_name'];
$pass = $_SESSION['admin_user_pass'];
$row = array();

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
    <form action="resultAnalysis.php" method='POST' enctype='multipart/form-data'>
      <select style="text-align:center;" name="dept" id="dept">
        <option value="">Select Department</option>
        <option value="MECH">Mechanical</option>
        <option value="COMP">Computer</option>
        <option value="IT">IT</option>
        <option value="E&TC">Electronics and telecomunication</option>
        <option value="CIVIL">Civil</option>
        <option value="INSTRU">Instrumentation & Control</option>
      </select> <input type="submit" name="getdept" value="Submit">
      <br><br>
    </form>

    <?php
    $deptval = "";
    if (isset($_POST['getdept'])) {
      $deptval = $_POST['dept'];
      echo '<script type="text/javascript">console.log("hi = ' . $deptval . '")</script>';
    } ?>
    <div class="row pad">
      <div class="col-lg-6 sm-auto md-auto" id="resultsFE">
        <div class="table-responsive">
          <h5><b>First Year </b></h5> <button onclick="printDiv('resultsFE')">Download Result</button>
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
          
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'FE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  cc
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
               AND dept = '$deptval' ORDER BY mark DESC";
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
              $cnt = 0;
              foreach ($row as $name => $marks) {
                if ($cnt == 5) {
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
            <div>
            <h5><b>Analysis: </b></h5>
            <div id="chartdivfe1"></div>
            <table class="table table-striped table-bordered" style="width:100%">
              <?php
              $percentagefe1 = 0;
              $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'FE'";      
              $count = 0;
              foreach ($row as $name => $marks) {
               if($marks>=35.00)
               {  echo '<script type="text/javascript">console.log("hi = '.$name.' '.$marks.'")</script>';  
                $count++;
               }
              }      
             // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
              $tstud = mysqli_query($conn, $totalstud);
              while ($srow = mysqli_fetch_assoc($tstud)) {
                if ($srow['Total'] != 0) {
                  $percentagefe1 = ($count / $srow['Total']) * 100;
                }
              }
              $row=array();
              ?>
            </table>
          </div>


          </div>
          <div id="semfe2" class="desc1" style="display: none;">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $prn = "";
           //   $row = array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'FE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem2'
               AND dept = '$deptval' ORDER BY mark DESC";
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
              $cnt = 0;
              foreach ($row as $name => $marks) {
                if ($cnt == 5) {
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
            <div>
            <h5><b>Analysis: </b></h5>
            <div id="chartdivfe2"></div>
            <table class="table table-striped table-bordered" style="width:100%">
              <?php
              $percentagefe2 = 0;
              $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'FE'";      
              $count = 0;
              foreach ($row as $name => $marks) {
               if($marks>=35.00)
               {  echo '<script type="text/javascript">console.log("hi = '.$name.' '.$marks.'")</script>';  
                $count++;
               }
              }      
             // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
              $tstud = mysqli_query($conn, $totalstud);
              while ($srow = mysqli_fetch_assoc($tstud)) {
                if ($srow['Total'] != 0) {
                  $percentagefe2 = ($count / $srow['Total']) * 100;
                }
              }
              $row=array();
              ?>
            </table>
          </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 sm-auto md-auto" id="resultsSE">
        <div class="table-responsive">
          <h5><b>Second Year </b></h5> <button onclick="printDiv('resultsSE')">Download Result</button>
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
           //   $row = array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'SE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
               AND dept = '$deptval' ORDER BY mark DESC";
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
              $cnt = 0;
              foreach ($row as $name => $marks) {
                if ($cnt == 5) {
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
            <div>
            <h5><b>Analysis: </b></h5>
            <div id="chartdivse1"></div>
            <table class="table table-striped table-bordered" style="width:100%">
              <?php
              $percentagese1 = 0;
              $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'SE'";      
              $count = 0;
              foreach ($row as $name => $marks) {
               if($marks>=35.00)
               {  echo '<script type="text/javascript">console.log("hi = '.$name.' '.$marks.'")</script>';  
                $count++;
               }
              }      
             // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
              $tstud = mysqli_query($conn, $totalstud);
              while ($srow = mysqli_fetch_assoc($tstud)) {
                if ($srow['Total'] != 0) {
                  $percentagese1 = ($count / $srow['Total']) * 100;
                }
              }
              $row = array();
              ?>
            </table>
          </div>
          </div>
          <div id="semse2" class="desc2" style="display: none;">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $prn = "";
            //  $row = array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'SE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem2'
               AND dept = '$deptval' ORDER BY mark DESC";
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
              
              arsort($row);
              $cnt = 0;
              foreach ($row as $name => $marks) {
                if ($cnt == 5) {
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
            <div>
            <h5><b>Analysis: </b></h5>
            <div id="chartdivse2"></div>
            <table class="table table-striped table-bordered" style="width:100%">
              <?php
              $percentagese2 = 0;
              $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'SE'";      
              $count = 0;
              foreach ($row as $name => $marks) {
               if($marks>=35.00)
               {  echo '<script type="text/javascript">console.log("hi = '.$name.' '.$marks.'")</script>';  
                $count++;
               }
              }      
             // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
              $tstud = mysqli_query($conn, $totalstud);
              while ($srow = mysqli_fetch_assoc($tstud)) {
                if ($srow['Total'] != 0) {
                  $percentagese2 = ($count / $srow['Total']) * 100;
                }
              }
              $row = array();
              ?>
            </table>
          </div>
          </div>
          
        </div>
      </div>

      <div class="col-lg-6 sm-auto md-auto" id="resultsTE">
        <div class="table-responsive">
          <h5><b>Third Year </b></h5> <button onclick="printDiv('resultsTE')">Download Result</button>
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
          //    $row = array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'TE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
               AND dept = '$deptval' ORDER BY mark DESC";
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
              $cnt = 0;
              foreach ($row as $name => $marks) {
                if ($cnt == 2) {
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
            <div>
            <h5><b>Analysis: </b></h5>
            <div id="chartdivte1"></div>
            <table class="table table-striped table-bordered" style="width:100%">
              <?php
              $percentagete1 = 0;
              $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'TE'";      
              $count = 0;
              foreach ($row as $name => $marks) {
               if($marks>=35.00)
               {  echo '<script type="text/javascript">console.log("hi = '.$name.' '.$marks.'")</script>';  
                $count++;
               }
              }      
             // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
              $tstud = mysqli_query($conn, $totalstud);
              while ($srow = mysqli_fetch_assoc($tstud)) {
                if ($srow['Total'] != 0) {
                  $percentagete1 = ($count / $srow['Total']) * 100;
                }
              }
              $row=array();
              ?>
            </table>
          </div>
          </div>
          <div id="semte2" class="desc3" style="display: none;">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $prn = "";
         //     $row = array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'TE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem2'
               AND dept = '$deptval' ORDER BY mark DESC";
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
              $cnt = 0;
              foreach ($row as $name => $marks) {
                if ($cnt == 5) {
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
            <div>
            <h5><b>Analysis: </b></h5>
            <div id="chartdivte2"></div>
            <table class="table table-striped table-bordered" style="width:100%">
              <?php
              $percentagete2 = 0;
              $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'TE'";      
              $count = 0;
              foreach ($row as $name => $marks) {
               if($marks>=35.00)
               {  echo '<script type="text/javascript">console.log("hi = '.$name.' '.$marks.'")</script>';  
                $count++;
               }
              }      
             // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
              $tstud = mysqli_query($conn, $totalstud);
              while ($srow = mysqli_fetch_assoc($tstud)) {
                if ($srow['Total'] != 0) {
                  $percentagete2 = ($count / $srow['Total']) * 100;
                }
              }
              $row=array();
              ?>
            </table>
          </div>
          </div>
        </div>



      </div>
      <div class="col-lg-6 sm-auto md-auto" id="resultsBE">
        <div class="table-responsive">
          <h5><b>Final Year </b></h5> <button onclick="printDiv('resultsBE')">Download Result</button>
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
              //     $row = array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'BE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem1'
               AND dept = '$deptval' ORDER BY mark DESC";
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
              $cnt = 0;
              foreach ($row as $name => $marks) {
                if ($cnt == 5) {
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
            <div>
            <h5><b>Analysis: </b></h5>
            <div id="chartdivbe1"></div>
            <table class="table table-striped table-bordered" style="width:100%">
              <?php
              $percentagebe1 = 0;
              $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'BE'";      
              $count = 0;
              foreach ($row as $name => $marks) {
               if($marks>=35.00)
               {  echo '<script type="text/javascript">console.log("hi BE  = '.$name.' '.$marks.'")</script>';  
                $count++;
               }
              }      
             // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
              $tstud = mysqli_query($conn, $totalstud);
              while ($srow = mysqli_fetch_assoc($tstud)) {
                if ($srow['Total'] != 0) {
                  $percentagebe1 = ($count / $srow['Total']) * 100;
                }
              }
              $row = array();
              ?>
            </table>
          </div>
          </div>
          <div id="sembe2" class="desc4" style="display: none;">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $prn = "";
                //        $row = array();
              $query = "SELECT DISTINCT student.name,student.prn FROM student
              RIGHT JOIN final_result ON student.prn = final_result.stud_prn
              WHERE student.year = 'BE'";
              $run = mysqli_query($conn, $query);
              while ($rrow = mysqli_fetch_assoc($run)) {
                $prn = $rrow['prn'];
                //  echo '<script type="text/javascript">alert("hi = '.$prn.'")</script>';
                $getrecords = "SELECT stud_prn,AVG(marks) as mark FROM `final_result` WHERE stud_prn = '$prn' AND sem ='sem2'
               AND dept = '$deptval' ORDER BY mark DESC";
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
              $cnt = 0;
              foreach ($row as $name => $marks) {
                if ($cnt == 5) {
                  break;
                }
                echo "<tr><td>" . $name . "</td><td>" . $marks . "</td></tr>";
                $cnt++;
              }
              ?>
            </table>
            <div>
            <h5><b>Analysis: </b></h5>
            <div id="chartdivbe2"></div>
            <table class="table table-striped table-bordered" style="width:100%">
              <?php
              $percentagebe2 = 0;
              $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'BE'";      
              $count = 0;
              foreach ($row as $name => $marks) {
               if($marks>=35.00)
               {  echo '<script type="text/javascript">console.log("hi = '.$name.' '.$marks.'")</script>';  
                $count++;
               }
              }      
             // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
              $tstud = mysqli_query($conn, $totalstud);
              while ($srow = mysqli_fetch_assoc($tstud)) {
                if ($srow['Total'] != 0) {
                  $percentagebe2 = ($count / $srow['Total']) * 100;
                }
              }
              $row=array();
              ?>
            </table>
          </div>
          </div>
        </div>
        
      </div>





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
<script type="text/javascript">
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  }
</script>
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdivse1", am4charts.PieChart);

// Add data
chart.data = [ {
  "Result": "Passed",
  "val": <?php echo $percentagese1?>
}, {
  "Result": "Failed",
  "val": <?php echo 100 - $percentagese1?>
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "val";
pieSeries.dataFields.category = "Result";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdivse2", am4charts.PieChart);

// Add data
chart.data = [ {
  "Result": "Passed",
  "val": <?php echo $percentagese2?>
}, {
  "Result": "Failed",
  "val": <?php echo 100 - $percentagese2?>
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "val";
pieSeries.dataFields.category = "Result";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>

<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdivbe1", am4charts.PieChart);

// Add data
chart.data = [ {
  "Result": "Passed",
  "val": <?php echo $percentagebe1?>
}, {
  "Result": "Failed",
  "val": <?php echo 100 - $percentagebe1?>
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "val";
pieSeries.dataFields.category = "Result";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>

<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdivbe2", am4charts.PieChart);

// Add data
chart.data = [ {
  "Result": "Passed",
  "val": <?php echo $percentagebe2?>
}, {
  "Result": "Failed",
  "val": <?php echo 100 - $percentagebe2?>
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "val";
pieSeries.dataFields.category = "Result";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>



<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdivte2", am4charts.PieChart);

// Add data
chart.data = [ {
  "Result": "Passed",
  "val": <?php echo $percentagete2?>
}, {
  "Result": "Failed",
  "val": <?php echo 100 - $percentagete2?>
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "val";
pieSeries.dataFields.category = "Result";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script> 


<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdivte1", am4charts.PieChart);

// Add data
chart.data = [ {
  "Result": "Passed",
  "val": <?php echo $percentagete1?>
}, {
  "Result": "Failed",
  "val": <?php echo 100 - $percentagete1?>
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "val";
pieSeries.dataFields.category = "Result";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>


<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdivfe2", am4charts.PieChart);

// Add data
chart.data = [ {
  "Result": "Passed",
  "val": <?php echo $percentagefe2?>
}, {
  "Result": "Failed",
  "val": <?php echo 100 - $percentagefe2?>
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "val";
pieSeries.dataFields.category = "Result";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>


<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdivfe1", am4charts.PieChart);

// Add data
chart.data = [ {
  "Result": "Passed",
  "val": <?php echo $percentagefe1?>
}, {
  "Result": "Failed",
  "val": <?php echo 100 - $percentagefe1?>
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "val";
pieSeries.dataFields.category = "Result";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>