<?php session_start() ?>
<?php
$eid = $_GET['eid'];
$aid = $_GET['qno'];
$sub = $_GET['qsub'];
$status = $_GET['qstatus'];
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
  <style>
    #chartdiv {
      width: 100%;
      height: 300px;
    }
  </style>
</head>

<body>
  <!-- Side Bar -->
  <nav class="navbar navbar-expand-lg navbar-info bg-info">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a href="teacher.php"><i id="tg" class='fas fa-arrow-alt-circle-left' style='color:#d5d5d5;font-size: 30px;'></i></a>
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
    <span style="margin-top:50px;">
      <h5><b>Exam Id: <?php echo $eid; ?></b></h5>
      <h5><b>Exam Name: <?php echo $aid; ?></b></h5>
      <h5><b>Exam Subject: <?php echo $sub; ?></b></h5>
      <button id="toggleStatus"></button>
    </span>
    <hr>
    <div class="row pad">
      <div class="col-lg-12 md-auto sm-auto pad">
        <?php include 'quiz-table.php'; ?>
        <div class="table-responsive">
          <h5><b>Add Questions: </b></h5>
          <table class="table table-striped table-bordered">
            <tr>
              <th>Q-ID</th>
              <th>Question</th>
              <th>Option 1</th>
              <th>Option 2</th>
              <th>Option 3</th>
              <th>Option 4</th>
              <th>Answer</th>
            </tr>
            <?php echo $tbl_html; ?>
          </table>
        </div>
        <hr>
        <h5><b>Delete Questions: </b></h5>
        <?php echo $del_html ?>
      </div>
    </div>
    <hr>

    <div class="container-fluid">
      <div style="margin:auto;text-align:center">
        <h1> Results </h1>
        <h6><b>Exam Id: <?php echo $eid; ?></b></h6>
        <h6><b>Exam Name: <?php echo $aid; ?></b></h6>
        <h6><b>Subject: <?php echo $sub; ?></b></h6>
        <br>
      </div>
      <div class="row" id="results">
        <div class="col">
          <div class="table-responsive">
            <h5><b>Overall Result: </b></h5>
            <table class="table table-striped table-bordered" style="width:100%">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $getrecords = "SELECT * FROM `assessment_records` WHERE exam_id='$eid' ORDER BY score DESC";
              $rungetr = mysqli_query($conn, $getrecords);
              while ($rrow = mysqli_fetch_assoc($rungetr)) {
                echo "<tr><td>" . $rrow['stud_name'] . "</td><td>" . $rrow['score'] . "</td></tr>";
              }
              ?>
            </table>
          </div>
        </div>
        <div class="col">
          <div class="table-responsive">
            <h5><b>Top 5 Students.</b></h5>
            <table class="table table-striped table-bordered" style="width:100%">
              <tr>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              $getrecords = "SELECT s.*
                  FROM assessment_records AS s
                    JOIN
                      ( SELECT DISTINCT score
                        FROM assessment_records
                        WHERE exam_id = '$eid' and score> 40
                        ORDER BY score DESC
                            LIMIT 5
                      ) AS lim
                      ON s.score = lim.score 
                  ORDER BY s.score DESC ;";
              $rungetr = mysqli_query($conn, $getrecords);
              while ($rrow = mysqli_fetch_assoc($rungetr)) {
                echo "<tr><td>" . $rrow['stud_name'] . "</td><td>" . $rrow['score'] . "</td></tr>";
              }
              ?>
            </table>
          </div>
        </div>
        <div class="w-100"></div>

        <div class="col">
          <div class="table-responsive">
            <h5><b>Analysis: </b></h5>
            <br><button onclick="printDiv('results')">Download Result</button>
            <div id="chartdiv"></div>
            <table class="table table-striped table-bordered" style="width:100%">
              <?php
              $percentage = 0;
              $getrecords = "select COUNT(score) as Passed,(select COUNT(*) from assessment_records WHERE exam_id= '$eid') as Total from assessment_records WHERE score>=50 and exam_id= '$eid'";
              $rungetr = mysqli_query($conn, $getrecords);
              while ($rrow = mysqli_fetch_assoc($rungetr)) {
                if ($rrow['Total'] != 0) {
                  $percentage = ($rrow['Passed'] / $rrow['Total']) * 100;
                }
              }
              ?>
            </table>
          </div>
        </div>

      </div>
      <br><br><br><br>


      <div class="navbar navbar-expand-lg navbar-info bg-info" id="footer">
        <a class="navbar-brand mx-auto text-white">....</a>
      </div>

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
    var chart = am4core.create("chartdiv", am4charts.PieChart);

    // Add data
    chart.data = [{
      "Result": "Passed",
      "val": <?php echo $percentage ?>
    }, {
      "Result": "Failed",
      "val": <?php echo 100 - $percentage ?>
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
<script type="text/javascript">
  $(document).ready(function() {
    var status = <?php echo "'$status'" ;?>;
    console.log(status)
    if (status == '0') {
      $("#toggleStatus").html('Deactivate');
    } else if (status == '1') {
      $("#toggleStatus").html('Activate');
    }
    $("#toggleStatus").on('click', function() {
      var status = <?php echo "'$status'"; ?>;
      if (status == '0' || status == '1') {

        $.ajax({
          method: "GET",

          url: 'toggleStatus.php?'.concat("<?php echo "eid=" . $eid . "&qstatus=" . $status . ""; ?>")
        }).done(function(data) {
          alert("Done");
          window.history.back();
        });
      }
    });
  });
</script>
</body>

</html>
<?php
if (isset($_POST['lgt'])) {
  session_destroy();
  echo "<script type='text/javascript'>location.replace('../index.php')</script>";
}
?>
