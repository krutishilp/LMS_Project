<h3>Create Quizz/Assignment </h3>
      <form action="teacher.php" class="fc" method="post" enctype="multipart/form-data">
        <input type="radio" id="quiz" name="ass_type" value="quiz"><label for="male" style="width: 75%;">Quiz</label>
        <input type="radio" id="assign" name="ass_type" value="assign"><label for="female" style="width: 75%;">Assignment</label>
        <br><br>
        <input type="text" name="qname" placeholder="Description" style="width: 75%;"><br><br>
        <input type="text" name="qid" placeholder="Quiz/Assignment ID(same as in file uploaded)" style="width: 75%;"><br><br>
        <input type="number" name="duration" placeholder="Duration(minutes) Not mandatory for assignment" style="width: 75%"><br><br>
        <label for="deadline">Deadline date</label>
        <input type="date" name="deadline" placeholder="Deadline Date" style="width: 75%;"><br><br>
        <select name="subs" style="width: 75%">
        
    <option value="" disabled selected>Select Subject</option>
    <?php

   $getsubs="SELECT * FROM teachers WHERE email='$email'";
   if($rungetsub=mysqli_query($conn,$getsubs))
   {
   while ($row=mysqli_fetch_assoc($rungetsub))
   {
    echo '<option value="'.$row['subject'].'">'.$row['subject'].'</option>';
   }
   }                            
    ?>   
   </select><br><br>
   <select name='unit'>
    <option value="" disabled selected>Select Unit</option>
   <option value='1'>1</option>
   <option value='2'>2</option>
   <option value='3'>3</option>
   <option value='4'>4</option>
   <option value='5'>5</option>
   <option value='6'>6</option>
   </select><br><br>
   <label for="upfile">Assinment File</label>
   <input type="file"  name="fl"><br><br>
        <input type="submit" name="cq" value="Create"><br><br>
      </form>

<?php  

if(isset($_POST['cq']))
{
  $selection=$_POST['ass_type'];
  $qnm=$_POST['qname'];
  $id=$_POST['qid'];
  $dur=$_POST['duration'];
  $deadline=$_POST['deadline'];
  $currenttime=date('Y-m-d');
  $sub=$_POST['subs'];
  $unit = $_POST['unit'];
 
  $status=0;
  $teacher_id = 0;
  $getTeacherId="SELECT teacher_Id FROM teachers WHERE email='$email'";
   if($rungetsub=mysqli_query($conn,$getTeacherId))
   {
   while ($row=mysqli_fetch_assoc($rungetsub))
   {
    $teacher_id = $row['teacher_Id'];
   }
  }
  if($selection == "quiz"){
      $ins="INSERT INTO `quizz`(`name`, `exam_id`, `duration`, `status`,`subject`,`teacher_id`) VALUES ('$qnm','$id','$dur','$status','$sub','$teacher_id')";
      if($run=mysqli_query($conn,$ins))
      {
          echo '<script type="text/javascript">alert("Done")</script>';
        
      }
  }
  elseif ($selection == "assign") {
    $filename=$_FILES['fl']['name'];
    $dir="pdfs/";
    $target_file=$dir.$_FILES['fl']['name'];
    if(move_uploaded_file($_FILES['fl']['tmp_name'],$target_file)){
    $ins="INSERT INTO `assignment`(`Description`,`Subject_Name`,`Unit`,`Teacher_ID`,`Assignment_Deadline`,`Assignment_Given_On`,`filename`) 
    VALUES ('$qnm','$sub','$unit','$teacher_id','$deadline','$currenttime','$target_file')";

    if($run=mysqli_query($conn,$ins))
    {
        echo '<script type="text/javascript">alert("Done")</script>';
      
    }
  }
  }
  else
  {
          echo mysqli_error($conn);
    
  }
}


?>      