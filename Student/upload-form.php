  
    <form action='student.php' method='POST' enctype='multipart/form-data' class="fc">
        <input type='file'  name='fl'><br><br>
   <select name="subs" id="subs">
    <option value="" disabled selected>Select Subject</option>
    <?php
  
      foreach( $SubjectsInAssignment as $item){
            echo '<option value="'.$item.'">'.$item.'</option>';
      }
                              
    ?>   
   </select><br><br>
   <div id="getUnits" ></div>

 
   </select><br><br>
   
   <input type='submit' value='Upload' name='upld'><br>
  </form>

  <?php
    if(isset($_POST['upld']))
{
  $sub=$_POST['subs'];
 // $type=$_POST['type'];
  $unit=$_POST['units'];
  $flname=$_FILES['fl']['name'];

  // if($type=='vid')
  // {
  //  $dir="videos/";
  //  $target_file=$dir.$_FILES['fl']['name'];
  // if(move_uploaded_file($_FILES['fl']['tmp_name'],$target_file))
  //             {
  //             $cmd=" ffmpeg -i  videos/".$name." -vframes 1 -an -s 400x222 -ss 30 thumbnail/".$name."_thumbnail.jpg";
  //             echo (shell_exec($cmd." 2<&1"));
  //             $query = "INSERT INTO student_videos(name,subject,unit,author,status) VALUES('$name','$sub','$unit','$email',0)";
  //             if(mysqli_query($conn,$query))
  //             {
  //                   echo '<script type="text/javascript">alert("Video Uploaded")</script>';
  //                   echo '<script type="text/javascript">window.location.replace("teacher.php")</script>';
  //             }
  //             else
  //             {
  //                   echo '<script type="text/javascript">alert("Video Not Uploaded")</script>';

  //             }
              
  //           }
  // }
 
    $assno = 0;
    $deadline;
    $currenttime=date('Y-m-d');
   $dir="../teacher/Assignment_Submitted/";
   $target_file=$dir.$_FILES['fl']['name'];
   if(move_uploaded_file($_FILES['fl']['tmp_name'],$target_file)){
              // Insert record
              $getassigno="SELECT * FROM assignment WHERE Subject_Name='$sub' AND Unit ='$unit'";
              $rgetassign=mysqli_query($conn,$getassigno);
                           if($assignrow=mysqli_fetch_assoc($rgetassign))
                                { 
                                        $assno = $assignrow['Assignment_No'];  
                                        $deadline = $assignrow['Assignment_Deadline'];          
                                }
              $status = "";
              if($deadline > $currenttime){
                $status = "On Time";
              }
              else{
                $status = "Late";
              }

              $query = "INSERT INTO assignment_submission(student_Id,student_name,subject_name,unit,submission_date,assignment_no,filepath,submitted
              ) VALUES('$Id','$name','$sub','$unit','$currenttime','$assno','$target_file','$status')";
              if(mysqli_query($conn,$query))
              {
                    echo '<script type="text/javascript">alert("PDF Uploaded")</script>';
                    echo '<script type="text/javascript">location.replace("student.php")</script>';
              }
              else
              {
                    echo '<script type="text/javascript">alert("PDF Not Uploaded")</script>';

              }
              
            }
  
  // else if($type=='ppt')
  // {
  //  $dir="ppts/";
  //  $target_file=$dir.$_FILES['fl']['name'];
  //   if(move_uploaded_file($_FILES['fl']['tmp_name'],$target_file)){

  //             // Insert record
  //             $query = "INSERT INTO student_ppt(name,subject,author,unit) VALUES('$name','$sub','$email','$unit')";
  //             if(mysqli_query($conn,$query))
  //             {
  //                   echo '<script type="text/javascript">alert("PPT Uploaded")</script>';
  //                   echo '<script type="text/javascript">location.replace("teacher.php")</script>';

  //             }
  //             else
  //             {
  //                   echo '<script type="text/javascript">alert("PPT Not Uploaded")</script>';

  //             }
              
  //           } 
 
  // }

  
}

  ?>
   <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
   
   <script type="text/javascript"> 
       $(function(){ 
         $("#subs").on('change',function(){ 
       //    alert("getUnits.php?subs="+ $("#subs").val());    
         $.ajax({ 
           method: "GET", 
        
           url: "getUnits.php?subs="+ $("#subs").val(),
         }).done(function( data ) { 
       //     console.log("hiiiii");
           var result =data; 
           var string=`<select name='units'>
                           <option value="" disabled selected>Select Unit Number</option>`;

          /* from result create a string of data and append to the divsss */
         
         console.log(data);
           $.each( result, function( key, value ) {
             string += `<option value="`+value['Unit']+`">`+value['Unit']+`</option>`; 
                 }); 
                string += '</select>'; 
             $("#getUnits").html(string); 
          }); 
       }); 
   }); 
   </script>       