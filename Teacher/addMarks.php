<form action="teacher.php" method="post">
  <input type="text" name="prn" placeholder="PRN NO of Student" required>
  <select name="dept" id="dept" required>
    <option value="">Select Department</option>
    <option value="MECH">Mechanical</option>
    <option value="COMP">Computer</option>
    <option value="IT">IT</option>
    <option value="E&TC">Electronics and telecomunication</option>
    <option value="CIVIL">Civil</option>
    <option value="INSTRU">Instrumentation & Control</option>
  </select>
  <select name="year" id="year" required>
    <option value="" disabled selected>Select Year</option>
    <option value="FE">FE</option>
    <option value="SE">SE</option>
    <option value="TE">TE</option>
    <option value="BE">BE</option>
  </select>
  <select name="sem" id="sem" required>
    <option value="" disabled selected>Select Semester</option>
    <option value="1">SEM 1</option>
    <option value="2">SEM 2</option>
    <option value="3">SEM 3</option>
    <option value="4">SEM 4</option>
    <option value="5">SEM 5</option>
    <option value="6">SEM 6</option>
    <option value="7">SEM 7</option>
    <option value="8">SEM 8</option>
  </select>
  <div id="getsubjects"></div>
  <input type="number" name="marks" placeholder="Enter Marks" required><br>
  <input type="submit" name="addMarks">
</form>
<script type="text/javascript">
  $(function() {
    $("#sem").on('change', function() {
      $.ajax({
        method: "GET",

        url: "getSubject.php?dept=" + $("#dept").val() + "&sem=" + $("#sem").val(),
      }).done(function(data) {
        var result = data;
        var string = `<select name='sub'>
                           <option value="" disabled selected>Select Subject Taught</option>`;

        /* from result create a string of data and append to the divsss */

        console.log(data);
        $.each(result, function(key, value) {
          string += `<option value="` + value['subject'] + `">` + value['subject'] + `</option>`;
        });
        string += '</select>';
        $("#getsubjects").html(string);
      });
    });
  });
</script>



<?php
if (isset($_POST['addMarks'])) {
  $nm = $_POST['sub'];
  $dept = $_POST['dept'];
  $year = $_POST['year'];
  $sem = (int)$_POST['sem'];
  $sem1 = "";
  if ($sem % 2 == 0) {
    $sem1 = "sem2";
  } else {
    $sem1 = "sem1";
  }

  $prn = $_POST['prn'];
  $marks = $_POST['marks'];
  $q = "INSERT INTO `final_result`(`stud_prn`,`subject`,`dept`,`year`,`sem`,`marks`) VALUES ('$prn','$nm','$dept','$year','$sem1','$marks')";
  if ($run = mysqli_query($conn, $q)) {
    echo '<script type="text/javascript">alert("Done")</script>';
    echo '<script type="text/javascript">window.location.replace("teacher.php")</script>';
  } else {
    echo '<script type="text/javascript">alert("Not Done. PLease Try Again")</script>';
  }
}
?>