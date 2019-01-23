
<?php 
session_start();
include('connect.php') ?>
<div class="form">
       <form method="post" enctype="multipart/form-data">
               <div>
                   <textarea name="comment" rows="10" cols="30">
                       </textarea>
               </div>
           <input name="submit" type="submit" value="Submit" /></p></center>
       </form>
   </div>

   <?php
   if ($con) {
     	if(isset($_POST['submit'])){
   $comment=$_REQUEST['comment'];
  	$user_name = $_SESSION['user'];
  	echo $_REQUEST['comment'];
   $ins_query="INSERT into comments (cus_name, comment) values ('$user_name', '$comment');";
   mysqli_query($con,$ins_query) or die(mysql_error());        
} 
     }else{
     	echo "ko connect";
     }  
 
  ?>

