<?php include 'links.php' ?>
  <?php include 'connection.php'; ?>
  <?php include 'style.php' ?>
<?php
    $currenttime=date('Y-m-d');
    $query = "SELECT * FROM assignment WHERE Assignment_Deadline <= '".$currenttime."'";
    $query1 = "SELECT * FROM seminar WHERE seminar_date > '".$currenttime."'";
    $query2 = "SELECT * FROM feedback WHERE feedback_date > '".$currenttime."'";
    $query3 = "SELECT * FROM youtube_videos";
    $newtab = "_blank";
    $ass=mysqli_query($conn,$query);
    $sem=mysqli_query($conn,$query1);
    $feed=mysqli_query($conn,$query2);
    $vlink=mysqli_query($conn,$query3);
    echo '<marquee height="150px" direction = "up" onmouseover="this.stop();" onmouseout="this.start();"><ul>';

    while( $row3 =mysqli_fetch_assoc($vlink)){
        echo '<li><a href="'.$row3['videolink'].'"> Youtube Video Link for Subject '.$row3['subject'].' </a></li><br>'; 
    }
    while($row=mysqli_fetch_assoc($ass)){
        echo '<li><a href="">'.$row['Description'].'     Deadline on '.$row['Assignment_Deadline'].'</a></li><br>';
       
    }
    while( $row1 =mysqli_fetch_assoc($sem)){
            echo '<li><a href="'.$row1['notice'].'">'.$row1['title'].'  on '.$row1['seminar_date'].'</a></li><br>'; 
    }
    while( $row2 =mysqli_fetch_assoc($feed)){
        echo '<li><a href="'.$row2['link'].'"> Fill Feedback form for '.$row2['title'].'  before '.$row2['feedback_date'].'</a></li><br>'; 
    }
    while( $row3 =mysqli_fetch_assoc($vlink)){
         echo '<li><a  href="'.$row3['videolink'].'" target="_blank"> Youtube Video Link for Subject '.$row3['subject'].' </a></li><br>'; 
    }


    echo '</ul></marquee>';

?>

