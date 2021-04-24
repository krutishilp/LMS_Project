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


  <nav class="navbar navbar-expand-lg navbar-info bg-info sticky-top">
    <ul class="navbar-nav mr-auto text-white">
      <li class="nav-item active">
        <a href="admin.php"><i id="tg" class='fas fa-arrow-alt-circle-left' style='color:#d5d5d5;font-size: 30px;'></i></a>
      </li>
    </ul>
    <a class="navbar-brand mx-auto text-white" href="#">Learning Management System</a>
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
          <h2><b>First Year </b></h2> <button onclick="printDiv('resultsFE')">Download Result</button>
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
                  if ($marks >= 35.00) {
                    echo '<script type="text/javascript">console.log("hi = ' . $name . ' ' . $marks . '")</script>';
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

                ?>
              </table>
            </div>
            <div>
              <h5><b>Analysis of Grades: </b></h5>
              <div id="chartdivclassfe1"></div>
              <table class="table table-striped table-bordered" style="width:100%">
                <?php
                $distinctionfe1 = 0;
                $firstclassfe1 = 0;
                $secondclassfe1 = 0;
                $failfe1 = 0;
                $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'BE'";
                $countdistfe1 = 0;
                $countfcfe1 = 0;
                $countscfe1 = 0;
                $countfailedfe1 = 0;
                foreach ($row as $name => $marks) {
                  if ($marks >= 80.00) {  //echo '<script type="text/javascript">console.log("hi BE  = '.$name.' '.$marks.'")</script>';  
                    $countdistfe1++;
                  } elseif ($marks >= 65.00 && $marks < 80.00) {
                    $countfcfe1++;
                  } elseif ($marks >= 35.00 && $marks < 65.00) {
                    $countscfe1++;
                  } else {
                    $countfailedfe1++;
                  }
                }
                // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
                $tstud = mysqli_query($conn, $totalstud);
                while ($srow = mysqli_fetch_assoc($tstud)) {
                  if ($srow['Total'] != 0) {
                    $distinctionfe1 = ($countdistfe1 / $srow['Total']) * 100;
                    $firstclassfe1 = ($countfcfe1 / $srow['Total']) * 100;
                    $secondclassfe1 = ($countscfe1 / $srow['Total']) * 100;
                    $failfe1 = ($countfailedfe1 / $srow['Total']) * 100;
                  }
                }
                $row = array();
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
                  if ($marks >= 35.00) {
                    echo '<script type="text/javascript">console.log("hi = ' . $name . ' ' . $marks . '")</script>';
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

                ?>
              </table>
            </div>
            <div>
              <h5><b>Analysis of Grades: </b></h5>
              <div id="chartdivclassfe2"></div>
              <table class="table table-striped table-bordered" style="width:100%">
                <?php
                $distinctionfe2 = 0;
                $firstclassfe2 = 0;
                $secondclassfe2 = 0;
                $failfe2 = 0;
                $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'BE'";
                $countdistfe2 = 0;
                $countfcfe2 = 0;
                $countscfe2 = 0;
                $countfailedfe2 = 0;
                foreach ($row as $name => $marks) {
                  if ($marks >= 80.00) {  //echo '<script type="text/javascript">console.log("hi BE  = '.$name.' '.$marks.'")</script>';  
                    $countdistfe2++;
                  } elseif ($marks >= 65.00 && $marks < 80.00) {
                    $countfcfe2++;
                  } elseif ($marks >= 35.00 && $marks < 65.00) {
                    $countscfe2++;
                  } else {
                    $countfailedfe2++;
                  }
                }
                // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
                $tstud = mysqli_query($conn, $totalstud);
                while ($srow = mysqli_fetch_assoc($tstud)) {
                  if ($srow['Total'] != 0) {
                    $distinctionfe2 = ($countdistfe2 / $srow['Total']) * 100;
                    $firstclassfe2 = ($countfcfe2 / $srow['Total']) * 100;
                    $secondclassfe2 = ($countscfe2 / $srow['Total']) * 100;
                    $failfe2 = ($countfailedfe2 / $srow['Total']) * 100;
                  }
                }
                $row = array();
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 sm-auto md-auto" id="resultsSE">
        <div class="table-responsive">
          <h2><b>Second Year </b></h2> <button onclick="printDiv('resultsSE')">Download Result</button>
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
                  if ($marks >= 35.00) {
                    echo '<script type="text/javascript">console.log("hi = ' . $name . ' ' . $marks . '")</script>';
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
                ?>
              </table>
            </div>
            <div>
              <h5><b>Analysis of Grades: </b></h5>
              <div id="chartdivclassse1"></div>
              <table class="table table-striped table-bordered" style="width:100%">
                <?php
                $distinctionse1 = 0;
                $firstclassse1 = 0;
                $secondclassse1 = 0;
                $failse1 = 0;
                $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'BE'";
                $countdistse1 = 0;
                $countfcse1 = 0;
                $countscse1 = 0;
                $countfailedse1 = 0;
                foreach ($row as $name => $marks) {
                  if ($marks >= 80.00) {  //echo '<script type="text/javascript">console.log("hi BE  = '.$name.' '.$marks.'")</script>';  
                    $countdistse1++;
                  } elseif ($marks >= 65.00 && $marks < 80.00) {
                    $countfcse1++;
                  } elseif ($marks >= 35.00 && $marks < 65.00) {
                    $countscse1++;
                  } else {
                    $countfailedse1++;
                  }
                }
                // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
                $tstud = mysqli_query($conn, $totalstud);
                while ($srow = mysqli_fetch_assoc($tstud)) {
                  if ($srow['Total'] != 0) {
                    $distinctionse1 = ($countdistse1 / $srow['Total']) * 100;
                    $firstclassse1 = ($countfcse1 / $srow['Total']) * 100;
                    $secondclassse1 = ($countscse1 / $srow['Total']) * 100;
                    $failse1 = ($countfailedse1 / $srow['Total']) * 100;
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
                  if ($marks >= 35.00) {
                    echo '<script type="text/javascript">console.log("hi = ' . $name . ' ' . $marks . '")</script>';
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

                ?>
              </table>
            </div>

            <div>
              <h5><b>Analysis of Grades: </b></h5>
              <div id="chartdivclassse2"></div>
              <table class="table table-striped table-bordered" style="width:100%">
                <?php
                $distinctionse2 = 0;
                $firstclassse2 = 0;
                $secondclassse2 = 0;
                $failse2 = 0;
                $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'BE'";
                $countdistse2 = 0;
                $countfcse2 = 0;
                $countscse2 = 0;
                $countfailedse2 = 0;
                foreach ($row as $name => $marks) {
                  if ($marks >= 80.00) {  //echo '<script type="text/javascript">console.log("hi BE  = '.$name.' '.$marks.'")</script>';  
                    $countdistse2++;
                  } elseif ($marks >= 65.00 && $marks < 80.00) {
                    $countfcse2++;
                  } elseif ($marks >= 35.00 && $marks < 65.00) {
                    $countscse2++;
                  } else {
                    $countfailedse2++;
                  }
                }
                // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
                $tstud = mysqli_query($conn, $totalstud);
                while ($srow = mysqli_fetch_assoc($tstud)) {
                  if ($srow['Total'] != 0) {
                    $distinctionse2 = ($countdistse2 / $srow['Total']) * 100;
                    $firstclassse2 = ($countfcse2 / $srow['Total']) * 100;
                    $secondclassse2 = ($countscse2 / $srow['Total']) * 100;
                    $failse2 = ($countfailedse2 / $srow['Total']) * 100;
                  }
                }
                $row = array();
                ?>
              </table>
            </div>

          </div>

        </div>
      </div>
      <hr>
      <hr>
      <div class="col-lg-6 sm-auto md-auto" id="resultsTE">
        <div class="table-responsive">
          <h2><b>Third Year </b></h2> <button onclick="printDiv('resultsTE')">Download Result</button>
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
                  if ($marks >= 35.00) {
                    echo '<script type="text/javascript">console.log("hi = ' . $name . ' ' . $marks . '")</script>';
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

                ?>
              </table>
            </div>
            <div>
              <h5><b>Analysis of Grades: </b></h5>
              <div id="chartdivclasste1"></div>
              <table class="table table-striped table-bordered" style="width:100%">
                <?php
                $distinctionte1 = 0;
                $firstclasste1 = 0;
                $secondclasste1 = 0;
                $failte1 = 0;
                $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'BE'";
                $countdistte1 = 0;
                $countfcte1 = 0;
                $countscte1 = 0;
                $countfailedte1 = 0;
                foreach ($row as $name => $marks) {
                  if ($marks >= 80.00) {  //echo '<script type="text/javascript">console.log("hi BE  = '.$name.' '.$marks.'")</script>';  
                    $countdistte1++;
                  } elseif ($marks >= 65.00 && $marks < 80.00) {
                    $countfcte1++;
                  } elseif ($marks >= 35.00 && $marks < 65.00) {
                    $countscte1++;
                  } else {
                    $countfailedte1++;
                  }
                }
                // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
                $tstud = mysqli_query($conn, $totalstud);
                while ($srow = mysqli_fetch_assoc($tstud)) {
                  if ($srow['Total'] != 0) {
                    $distinctionte1 = ($countdistte1 / $srow['Total']) * 100;
                    $firstclasste1 = ($countfcte1 / $srow['Total']) * 100;
                    $secondclasste1 = ($countscte1 / $srow['Total']) * 100;
                    $failte1 = ($countfailedte1 / $srow['Total']) * 100;
                  }
                }
                $row = array();
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
                  if ($marks >= 35.00) {
                    echo '<script type="text/javascript">console.log("hi = ' . $name . ' ' . $marks . '")</script>';
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
                ?>
              </table>
            </div>
            <div>
              <h5><b>Analysis of Grades: </b></h5>
              <div id="chartdivclasste2"></div>
              <table class="table table-striped table-bordered" style="width:100%">
                <?php
                $distinctionte2 = 0;
                $firstclasste2 = 0;
                $secondclasste2 = 0;
                $failte2 = 0;
                $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'BE'";
                $countdistte2 = 0;
                $countfcte2 = 0;
                $countscte2 = 0;
                $countfailedte2 = 0;
                foreach ($row as $name => $marks) {
                  if ($marks >= 80.00) {  //echo '<script type="text/javascript">console.log("hi BE  = '.$name.' '.$marks.'")</script>';  
                    $countdistte2++;
                  } elseif ($marks >= 65.00 && $marks < 80.00) {
                    $countfcte2++;
                  } elseif ($marks >= 35.00 && $marks < 65.00) {
                    $countscte2++;
                  } else {
                    $countfailedte2++;
                  }
                }
                // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
                $tstud = mysqli_query($conn, $totalstud);
                while ($srow = mysqli_fetch_assoc($tstud)) {
                  if ($srow['Total'] != 0) {
                    $distinctionte2 = ($countdistte2 / $srow['Total']) * 100;
                    $firstclasste2 = ($countfcte2 / $srow['Total']) * 100;
                    $secondclasste2 = ($countscte2 / $srow['Total']) * 100;
                    $failte2 = ($countfailedte2 / $srow['Total']) * 100;
                  }
                }
                $row = array();
                ?>
              </table>
            </div>
          </div>
        </div>

      </div>
      <div class="col-lg-6 sm-auto md-auto" id="resultsBE">
        <div class="table-responsive">
          <h2><b>Final Year </b></h2> <button onclick="printDiv('resultsBE')">Download Result</button>
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
                  if ($marks >= 35.00) {
                    echo '<script type="text/javascript">console.log("hi BE  = ' . $name . ' ' . $marks . '")</script>';
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
                ?>
              </table>
            </div>

            <div>
              <h5><b>Analysis of Grades: </b></h5>
              <div id="chartdivclassbe1"></div>
              <table class="table table-striped table-bordered" style="width:100%">
                <?php
                $distinctionbe1 = 0;
                $firstclassbe1 = 0;
                $secondclassbe1 = 0;
                $failbe1 = 0;
                $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'BE'";
                $countdistbe1 = 0;
                $countfcbe1 = 0;
                $countscbe1 = 0;
                $countfailedbe1 = 0;
                foreach ($row as $name => $marks) {
                  if ($marks >= 80.00) {  //echo '<script type="text/javascript">console.log("hi BE  = '.$name.' '.$marks.'")</script>';  
                    $countdistbe1++;
                  } elseif ($marks >= 65.00 && $marks < 80.00) {
                    $countfcbe1++;
                  } elseif ($marks >= 35.00 && $marks < 65.00) {
                    $countscbe1++;
                  } else {
                    $countfailedbe1++;
                  }
                }
                // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
                $tstud = mysqli_query($conn, $totalstud);
                while ($srow = mysqli_fetch_assoc($tstud)) {
                  if ($srow['Total'] != 0) {
                    $distinctionbe1 = ($countdistbe1 / $srow['Total']) * 100;
                    $firstclassbe1 = ($countfcbe1 / $srow['Total']) * 100;
                    $secondclassbe1 = ($countscbe1 / $srow['Total']) * 100;
                    $failbe1 = ($countfailedbe1 / $srow['Total']) * 100;
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
                  if ($marks >= 35.00) {
                    echo '<script type="text/javascript">console.log("hi = ' . $name . ' ' . $marks . '")</script>';
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

                ?>
              </table>
            </div>
            <div>
              <h5><b>Analysis of Grades: </b></h5>
              <div id="chartdivclassbe2"></div>
              <table class="table table-striped table-bordered" style="width:100%">
                <?php
                $distinctionbe2 = 0;
                $firstclassbe2 = 0;
                $secondclassbe2 = 0;
                $failbe2 = 0;
                $totalstud = "SELECT COUNT(*) AS Total FROM student WHERE dept = '$deptval' AND year = 'BE'";
                $countdistbe2 = 0;
                $countfcbe2 = 0;
                $countscbe2 = 0;
                $countfailedbe2 = 0;
                foreach ($row as $name => $marks) {
                  if ($marks >= 80.00) {  //echo '<script type="text/javascript">console.log("hi BE  = '.$name.' '.$marks.'")</script>';  
                    $countdistbe2++;
                  } elseif ($marks >= 65.00 && $marks < 80.00) {
                    $countfcbe2++;
                  } elseif ($marks >= 35.00 && $marks < 65.00) {
                    $countscbe2++;
                  } else {
                    $countfailedbe2++;
                  }
                }
                // echo '<script type="text/javascript">alert("hi = '.$count..'")</script>';  
                $tstud = mysqli_query($conn, $totalstud);
                while ($srow = mysqli_fetch_assoc($tstud)) {
                  if ($srow['Total'] != 0) {
                    $distinctionbe2 = ($countdistbe2 / $srow['Total']) * 100;
                    $firstclassbe2 = ($countfcbe2 / $srow['Total']) * 100;
                    $secondclassbe2 = ($countscbe2 / $srow['Total']) * 100;
                    $failbe2 = ($countfailedbe2 / $srow['Total']) * 100;
                  }
                }
                $row = array();
                ?>
              </table>
            </div>
          </div>
        </div>

      </div>





    </div>
  </div><br><br><br><br>
  <div class="navbar navbar-expand-lg navbar-info bg-info" id="footer">
    <a class="navbar-brand mx-auto text-white">...</a>
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
    chart.data = [{
      "Result": "Passed",
      "val": <?php echo $percentagese1 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo 100 - $percentagese1 ?>
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
    chart.data = [{
      "Result": "Passed",
      "val": <?php echo $percentagese2 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo 100 - $percentagese2 ?>
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
    chart.data = [{
      "Result": "Passed",
      "val": <?php echo $percentagebe1 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo 100 - $percentagebe1 ?>
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
    chart.data = [{
      "Result": "Passed",
      "val": <?php echo $percentagebe2 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo 100 - $percentagebe2 ?>
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
    chart.data = [{
      "Result": "Passed",
      "val": <?php echo $percentagete2 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo 100 - $percentagete2 ?>
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
    chart.data = [{
      "Result": "Passed",
      "val": <?php echo $percentagete1 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo 100 - $percentagete1 ?>
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
    chart.data = [{
      "Result": "Passed",
      "val": <?php echo $percentagefe2 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo 100 - $percentagefe2 ?>
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
    chart.data = [{
      "Result": "Passed",
      "val": <?php echo $percentagefe1 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo 100 - $percentagefe1 ?>
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
    var chart = am4core.create("chartdivclassbe1", am4charts.PieChart);

    // Add data
    chart.data = [{
      "Result": "Distinction",
      "val": <?php echo $distinctionbe1 ?>
    }, {
      "Result": "First Class",
      "val": <?php echo $firstclassbe1 ?>
    }, {
      "Result": "Second Class",
      "val": <?php echo $secondclassbe1 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo $failbe1 ?>
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
    var chart = am4core.create("chartdivclassbe2", am4charts.PieChart);

    // Add data
    chart.data = [{
      "Result": "Distinction",
      "val": <?php echo $distinctionbe2 ?>
    }, {
      "Result": "First Class",
      "val": <?php echo $firstclassbe2 ?>
    }, {
      "Result": "Second Class",
      "val": <?php echo $secondclassbe2 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo $failbe2 ?>
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
    var chart = am4core.create("chartdivclassse1", am4charts.PieChart);

    // Add data
    chart.data = [{
      "Result": "Distinction",
      "val": <?php echo $distinctionse1 ?>
    }, {
      "Result": "First Class",
      "val": <?php echo $firstclassse1 ?>
    }, {
      "Result": "Second Class",
      "val": <?php echo $secondclassse1 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo $failse1 ?>
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
    var chart = am4core.create("chartdivclassse2", am4charts.PieChart);

    // Add data
    chart.data = [{
      "Result": "Distinction",
      "val": <?php echo $distinctionse2 ?>
    }, {
      "Result": "First Class",
      "val": <?php echo $firstclassse2 ?>
    }, {
      "Result": "Second Class",
      "val": <?php echo $secondclassse2 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo $failse2 ?>
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
    var chart = am4core.create("chartdivclasste2", am4charts.PieChart);

    // Add data
    chart.data = [{
      "Result": "Distinction",
      "val": <?php echo $distinctionte2 ?>
    }, {
      "Result": "First Class",
      "val": <?php echo $firstclasste2 ?>
    }, {
      "Result": "Second Class",
      "val": <?php echo $secondclasste2 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo $failte2 ?>
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
    var chart = am4core.create("chartdivclasste1", am4charts.PieChart);

    // Add data
    chart.data = [{
      "Result": "Distinction",
      "val": <?php echo $distinctionte1 ?>
    }, {
      "Result": "First Class",
      "val": <?php echo $firstclasste1 ?>
    }, {
      "Result": "Second Class",
      "val": <?php echo $secondclasste1 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo $failte1 ?>
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
    var chart = am4core.create("chartdivclassfe2", am4charts.PieChart);

    // Add data
    chart.data = [{
      "Result": "Distinction",
      "val": <?php echo $distinctionfe2 ?>
    }, {
      "Result": "First Class",
      "val": <?php echo $firstclassfe2 ?>
    }, {
      "Result": "Second Class",
      "val": <?php echo $secondclassfe2 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo $failfe2 ?>
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
    var chart = am4core.create("chartdivclassfe1", am4charts.PieChart);

    // Add data
    chart.data = [{
      "Result": "Distinction",
      "val": <?php echo $distinctionfe1 ?>
    }, {
      "Result": "First Class",
      "val": <?php echo $firstclassfe1 ?>
    }, {
      "Result": "Second Class",
      "val": <?php echo $secondclassfe1 ?>
    }, {
      "Result": "Failed",
      "val": <?php echo $failfe1 ?>
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