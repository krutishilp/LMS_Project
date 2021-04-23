
<a id="close4" href="#"><i id="tg" class='fas fa-times' style='color:#d5d5d5;font-size: 30px;'></i></a>
      <h2>Blogs</h2>
<?php include 'connection.php'; ?>
  <?php

  $query = "select * from blog";
  $showblog = mysqli_query($conn, $query);
  while ($run = mysqli_fetch_assoc($showblog)) {
  ?>
    <div class="card shadow p-3 mb-5 bg-white rounded" style="border: 1px solid gray; background-color:#F8F8F8;">
      <?php echo "<img class='card-img-top' src='" . $run['imagepath'] . "' width='' height=''/>\t" . $run['author'] . "\t" . $run['submission_date'] . "\t"; ?>
      <div class="card-body">
        <p class="card-text"><?php echo $run['blogtext']; ?></p>
      </div>
    </div>
    <br>

  <?php
  }
  ?>