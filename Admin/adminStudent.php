<div id="student" style="display: none;">
            <h3>Student</h3>
            <hr>
            <div class="row">
              <div class="col adminpad">
                <h3>Add Student</h3>
                    <form method='POST' action='admin.php' class="fc">
                        <input type="text" name="name" placeholder="Name"><br><br>
                        <input type="email" name="email" placeholder="Email"><br><br>
                        <input type="text" name="prn" placeholder="PRN No"><br><br>
                        <select name="year" id="year">
                          <option value="">Select</option>
                          <option value="fe">FE</option>
                          <option value="se">SE</option>
                          <option value="te">TE</option>
                          <option value="be">BE</option>
                        </select><br><br>
                        <select name="dept" id="dept">
                  <option value="">Select Department</option>
                  <option value="MECH" >Mechanical</option>
                  <option value="COMP" >Computer</option>
                  <option value="IT" >IT</option>
                  <option value="E&TC" >Electronics and telecomunication</option>
                  <option value="CIVIL" >Civil</option>
                  <option value="INSTRU">Instrumentation & Control</option>
                </select><br><br>
                        <input type="submit" name="addstud" value="Add"><br>
                     </form>
    
              </div>
        
              <div class="col adminpad">
                <h3>Remove Student</h3>
                    <form method='POST' action='admin.php' class="fc">
                        <input type="email" name="email" placeholder="Email"><br><br>
                        <input type="password" name="password" placeholder="Your password"><br><br>
                        <input type="submit" name="delstud" value="Delete">
                     </form>        
              </div>

              <div class="col adminpad">
                <h3>Search Student</h3>
                  
                    <form method='POST' action='' class="fc">
                        <input type="text" name="name" placeholder="Name"><br><br>
                        <input type="email" name="semail" placeholder="Email" id="sfind"><br><br>
                        <input type="submit" name="findstud" value="find">
                    </form>
               </div>
              <?php 
              if(isset($_POST['findstud'])){
                  $email = $_POST['semail'];
                
                  $query = "SELECT * from student where email= '$email'";
                  $run=mysqli_query($conn,$query);
               if($row=mysqli_fetch_assoc($run))
               {
                // echo '"Student found '.$row['student_Id'].' 
                // '.$row['email'].' '.$row['name'].' '.$row['prn'].' '.$row['year'].' '.$row['dept'].'"';
             }}
              ?>

              <div class="col adminpad">
                <h3>Bulk Add Student</h3>
                    <form method='POST' action='admin.php' class="fc" enctype='multipart/form-data'>
                        <input type="file" name="bulk"><br><br>
                        <input type="password" name="password" placeholder="Your password"><br><br>
                        <input type="submit" name="bulkaddstud" value="Bulk Add">
                     </form> 
              </div>

                <div class="table-responsive">
          <table class="table table-bordered  table-striped">
            <tr class="thead-dark"><th>Name</th><th>Email</th><th>Password</th></tr>
            <?php
               $q="SELECT * FROM user WHERE pos='S' ORDER BY name asc";
               $run=mysqli_query($conn,$q);
               while($row=mysqli_fetch_assoc($run))
               {

               echo "<tr><td>".$row['name']."</td>
               <td>".$row['email']."</td>
               <td>".$row['pass']."</td>
                <input type='hidden' name='em' value='".$row['email']."'>";
             }
            ?>
          </table>
        </div>
</div>            
</div>
<?php include 'adminAddStudent.php'; ?>
<?php include 'adminDeleteStudent.php'; ?>
<?php include 'adminBulkAddStudent.php'; ?>