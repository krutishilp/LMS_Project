
  
  <?php

  $query = "SELECT * FROM blog WHERE email = '$email'";
  $showblog = mysqli_query($conn, $query);
  while ($run = mysqli_fetch_assoc($showblog)) {
    $name = $run['author'];
    $email = $run['email'];
    $blogid = $run['blog_id'];
    $blogtxt = $run['blogtext'];
    $imgpath = $run['imagepath'];
    $subdate = $run['submission_date'];
  ?>

    <div class="card shadow p-3 mb-5 bg-white rounded" style="border: 1px solid gray; background-color:#F8F8F8;">
      <?php echo '<img src="../' . $imgpath . '" width="150" height="100"/>' . $name . '  '
        . $run['submission_date'] . '    '; ?>
      <div class="card-body">
        <p class="card-text">
          <?php echo $run['blogtext']; ?>
        </p>
        <?php echo '<a class="btn btn-success" href="../blog.php?imgpath=' . $imgpath . '&imgpath=' . $imgpath . '
            &name=' . $name . '
            &email=' . $email . '
            &blogid=' . $blogid . '
            &blogtxt=' . $blogtxt . '
            &subdate=' . $subdate . '">Edit</a>';
      echo '  <a class="btn btn-danger" href="student.php?blogs_id=' . $blogid . '"">Delete</a>' ?>
      </div>

    </div>
  <?php
  }
  // if($_POST['action'] == 'call_this') {

  if (isset($_GET['blogs_id'])) {

    $dque = 'DELETE FROM blog WHERE blog_id = ' . (int)$_GET['blogs_id'] . '';
    if (mysqli_query($conn, $dque)) {
      echo '<script type="text/javascript">alert("Blog Deleted")</script>';
      echo '<script type="text/javascript">location.replace("student.php")</script>';
    } else {
      echo '<script type="text/javascript">alert("Unable to delete blog having id = ' . $_GET['blogs_id'] . '")</script>';
    }
  }
  // }

  ?>
