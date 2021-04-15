           <div id="faculty" style="display: none;">
            <h3>Faculty</h3>
            <hr>
            <div class="row">
              <div class="col adminpad">
                <h3>Add Faculty</h3>
                    <form method='POST' action='admin.php' class="fc">
                        <input type="text" name="name" placeholder="Name"><br><br>
                        <input type="email" name="email" placeholder="Email"><br><br>
                          <select name="dept" id="dept">
                            <option value="">Select Department</option>
                            <option value="MECH" >Mechanical</option>
                            <option value="COMP" >Computer</option>
                            <option value="IT" >IT</option>
                            <option value="E&TC" >Electronics and telecomunication</option>
                            <option value="CIVIL" >Civil</option>
                            <option value="INSTRU">Instrumentation & Control</option>
                          </select><br><br>
              <div id="getsubjects"></div>
                                    
                        <input type="submit" name="addfaculty" value="Add">&nbsp;&nbsp;&nbsp;
                     </form>
    
              </div>
        
              <div class="col adminpad">
                <h3>Remove Faculty</h3>
                    <form method='POST' action='admin.php' class="fc">
                        <input type="text" name="name" placeholder="Name"><br><br>
                        <input type="email" name="email" placeholder="Email"><br><br>
                        <input type="password" name="password" placeholder="Your password"><br><br>
                        <input type="submit" name="delfaculty" value="Delete">
                     </form>        
              </div>

              <div class="col adminpad">
                <h3>Search Faculty</h3>
                    <div class="fc" style="height: 88%;">
                    <form method='POST' action='admin.php'>
                        <input type="text" name="name" placeholder="Name"><br><br>
                        <input type="email" name="email" placeholder="Email" id="find"><br><br><br>
                        <br><br>
                        <input type="submit" name="findteacher" value="find">
                    </form>
                      </div>
              </div>
              <?php 
              if(isset($_POST['findteacher'])){
                  $email = $_POST['email'];
             
                  $query = "SELECT * from teachers where email= '$email'";
                  $run=mysqli_query($conn,$query);
               if($row=mysqli_fetch_assoc($run))
               {
                // echo '"Faculty found '.$row['teacher_Id'].' 
                // '.$row['email'].' '.$row['name'].' '.$row['dept_Id'].'"';
             }}
              ?>
              <div class="col adminpad">
                <h3>Bulk Add Faculty</h3>
                    <form method='POST' action='admin.php' class="fc" style="height: 88%;" enctype='multipart/form-data'>
                        <input type="file" name="fl"><br><br>
                        <input type="password" name="password" placeholder="Your password"><br><br>
                        <input type="submit" name="bulkaddfaculty" value="Bulk Add">
                     </form> 
              </div>
         </div>
          <div class="table-responsive pad">
          <table class="table table-bordered  table-striped">
            <tr class="thead-dark"><th>Name</th><th>Email</th><th>Password</th></tr>
            <?php
               $q="SELECT * FROM user WHERE pos='T' ORDER BY name asc";
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

        <div class="row pad" style="width: 100%; ">
            <div class="col-lg-4 sm-12 md-12 pad">
            <span><h3>Make admin:</h3></span>
            <form class="fc" method="post" action="admin.php"><input type="email" name="email" placeholder="Faculty Email"><br><br><input type="submit" name="mkadmin" value="Make Admin"></form>  </div>
            <div class="col-lg-4 sm-12 md-12 pad">
            
            <span><h3>Add Subject:</h3></span>
            <form class="fc" method="post" action="admin.php">
              <input type="text" name="sub" placeholder="Subject Name">
              <select name="dept" id="dept">
                  <option value="">Select Department</option>
                  <option value="MECH" >Mechanical</option>
                  <option value="COMP" >Computer</option>
                  <option value="IT" >IT</option>
                  <option value="E&TC" >Electronics and telecomunication</option>
                  <option value="CIVIL" >Civil</option>
                  <option value="INSTRU">Instrumentation & Control</option>
              </select>
              
              <select name="year" id="year">
                <option value="" disabled selected>Select Year</option>
                <option value="FE">FE</option>
                <option value="SE">SE</option>
                <option value="SE">TE</option>
                <option value="SE">BE</option>
            </select>
            <select name="sem" id="sem">
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
              <input type="submit" name="addsub" value="Add">
            </form>  </div>
            <div class="col-lg-4 sm-12 md-12 pad">
            <span><h3>Delete Subject:</h3></span>
            <form class="fc" method="post" action="admin.php"><input type="text" name="sub" placeholder="Subject Name"><br><br><input type="submit" name="delsub" value="Delete"></form>  </div>
          </div>

       <div class="table-responsive pad">
          <table class="table table-bordered  table-striped">
            <tr class="thead-dark"><th>Subject Name</th></tr>
            <?php
               $q="SELECT * FROM subjects";
               $run=mysqli_query($conn,$q);
               while($row=mysqli_fetch_assoc($run))
               {

               echo "<tr><td>".$row['subject']."</td>";
               }
            ?>
          </table>
        </div>

        </div>
      </div>
<?php include 'adminAddFaculty.php'?>
<?php include 'adminDeleteFaculty.php'?>
<?php include 'adminBulkAddFaculty.php'?>
<?php include 'adminMakeFacultyAdmin.php'?>
<?php include 'adminAddSubject.php'?>
<?php include 'adminDeleteSubject.php'?>


    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
   
   <script type="text/javascript"> 
       $(function(){ 
         $("#dept").on('change',function(){ 
         $.ajax({ 
           method: "GET", 
        
           url: "getSubject.php?dept="+ $("#dept").val(),
         }).done(function( data ) { 
           var result =data; 
           var string=`<select name='tsub'>
                           <option value="" disabled selected>Select Subject Taught</option>`;

          /* from result create a string of data and append to the divsss */
         
         console.log(data);
           $.each( result, function( key, value ) {
             string += `<option value="`+value['subject']+`">`+value['subject']+`</option>`; 
                 }); 
                string += '</select>'; 
             $("#getsubjects").html(string); 
          }); 
       }); 
   }); 
   </script>             
