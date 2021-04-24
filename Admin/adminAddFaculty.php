 <?php

  if (isset($_POST['addfaculty'])) {
    $uname = $_POST['name'];
    $email = $_POST['email'];

    $sub = $_POST['tsub'];
    $deptName = $_POST['dept'];
    $dept = "select dept_Id from departments where name='$deptName'";
    $deptId = 0;
    if ($run3 = mysqli_query($conn, $dept)) {
      while ($row = mysqli_fetch_assoc($run3)) {
        $deptId = $row['dept_Id'];
      }
    }

    $fullname = explode(" ", $uname);

    $fname = $fullname[0] . '123';

    $signup = "INSERT INTO teachers (name, email, subject, dept_Id,password) VALUES ('$uname','$email','$sub','$deptId','$fname')";
    if ($run = mysqli_query($conn, $signup)) {

      echo '<script type="text/javascript">alert("Done")</script>';
    } else {
      echo '<script type="text/javascript">alert("Not Done. Please Try Again.")</script>';
      echo mysqli_error($conn);
    }

    echo "<script type='text/javascript'>location.replace('admin.php')</script>";
  }

  ?>