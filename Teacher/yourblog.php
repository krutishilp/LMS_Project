<div>
  <h2>Your Blogs</h2>
<?php

        $query = "SELECT * FROM blog WHERE email = '$email'";
        $showblog=mysqli_query($conn,$query);
        while($run=mysqli_fetch_assoc($showblog))
        {
            $name = $run['author'];
            $email=$run['email'];
            $blogid=$run['blog_id'];
            $blogtxt=$run['blogtext'];
            $imgpath = $run['imagepath'];
            $subdate=$run['submission_date'];



            ?>
            
            <dl>
            <dt><?php echo '<img src="../'.$imgpath.'" width="150" height="100"/>'.$name.'  '
            .$run['submission_date'].'    ';
            echo '<a href="../blog.php?imgpath='.$imgpath.'&imgpath='.$imgpath.'
            &name='.$name.'
            &email='.$email.'
            &blogid='.$blogid.'
            &blogtxt='.$blogtxt.'
            &subdate='.$subdate.'">edit</a>';
            echo '  <a href="teacher.php?blogs_id='.$blogid.'"">delete</a>'?></dt>
            <dd>- <?php echo $run['blogtext'];?></dd>
            </dl>

            <?php 
        }
        // if($_POST['action'] == 'call_this') {
     
      if(isset($_GET['blogs_id'])){
        
        $dque = 'DELETE FROM blog WHERE blog_id = '.(int)$_GET['blogs_id'].''; 
        if (mysqli_query($conn, $dque)) {
          echo '<script type="text/javascript">alert("Blog Deleted")</script>';
          echo '<script type="text/javascript">location.replace("teacher.php")</script>';
        } else {
          echo '<script type="text/javascript">alert("Unable to delete blog having id = '.$_GET['blogs_id'].'")</script>';
        }
     
      }
    // }

?>
</div>


<!-- 
<script>

function myAjax() {
      $.ajax({
           type: "POST",
           url: "#?blogs_id='.<?php echo $blogid?>.'",
           data:{action:'call_this'},
           success:function(html) {
         
           }

      });
 }

</script> -->