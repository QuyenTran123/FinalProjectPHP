<?php session_start(); 
  include('header2.php');
    include('connect.php');
    GLOBAL $totalprice;

     ?>
      <?php 
   // echo $_GET['id'];
    //$id = $_GET['id'];
  function changeQuantity($con, $id){
    //$id = $_GET['id'];
  $sql = "SELECT quantity FROM product WHERE id = '$id'";
  $result = $con->query($sql);
  if ($result) {
    $row=mysqli_fetch_array($result);
    $view = $row['quantity'];
  }
  $view--;
  $sql = "UPDATE product SET quantity = $view WHERE id = '$id'";
  if ($con->query($sql)) {
    
  }
}


 ?>
     
<center><h1>Shopping Cart</h1></center> 
<!-- <a href="index.php?page=product">Go back to products page</a>  -->
<form method="post" action="showproduct.php?page=cart">
<!-- <?php //print_r($_SESSION['cart']); ?>  -->
  <center>
  <table class="table" style="width: 90%"> 
    <tr> 
      <th>Name</th> 
      <th>Quantity</th> 
      <th>Price</th>
      <th>Images</th>
      <th>Delete Product</th>
    </tr> 
   

  <?php 
      if (isset($_SESSION['cart'])) {
        $k = 0;
      $sql="SELECT * FROM product WHERE id IN (";
      foreach($_SESSION['cart'] as $id => $value) { 
        $sql.=$id.",";
        $k = $id; 
      } 
      $sql=substr($sql, 0, -1).") ORDER BY prod_name ASC"; 
      $query=mysqli_query($con,$sql); 
      $totalprice=0;
      while($row=mysqli_fetch_array($query)){  
      changeQuantity($con, $row['id']);      
        $subtotal=$_SESSION['cart'][$row['id']]['quantity']*$row['price']; 
        $totalprice+=$subtotal;
      ?>
    <tr>
      <td><?php echo $row['prod_name'] ?></td> 
      <td><input type="text" name="quantity[<?php echo $row['id'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['id']]['quantity'] ?>" /></td> 
      <td><?php echo $row['price'] ?>$</td> 
      <td><?php echo "<img style='width: 200px; height: 140px;' src=". $row['image'] . ">"; ?></td>
    <td><a href="cart.php?id=<?php echo $row['id'];?>">Delete</a></td> 
    </tr> 
    <?php } ?>  
    <?php echo "</br>"; ?>
    <tr> 
      <td colspan="5" style="text-align:center;font-size: 20px">Total Price: <?php echo $totalprice ?></td> 
    </tr>
    <?php
    if (isset($_GET['id'])) {
      $xoa = $_GET['id'];
      unset($_SESSION['cart'][$xoa]);
    }

      }else{
        echo " <script>
                 alert('giỏ hàng trống');
               </script>";
      }
      
    
     ?> 
    
  </table> 
  <hr style="width:  90%">
  <tr>
    <td><button class="btn-info" type="submit" name="submit">Information</button></td> 
    <td><button class="btn-info" type="submit" name="pay">Checkout</button></td>
  </tr>
  <hr style="width: 90%">
  <br><br>
  <div class="star" style="float: center;width: 500px;background: #c4c6c7">
   <table>
    <br>
     <tr><p>Xin vui long đánh giá sản phẩm của chúng tôi (1-5 )<p> </tr>
     <tr>
       <form method='post' action=''>
           <label></label><input type="hidden" name="minstar" value="1">
           <label></label>
            <input type="hidden" name="maxstar" value="5">
            <label></label>
            <input type="text" name="rating" value="">
            <input type="submit" name="submit" value="submit">
          </form>
       </tr>
<?php 
if (isset($_SESSION['user'])) {
  if(isset($_POST['submit'])){
  $cfg_min_stars = $_POST['minstar'];
  $cfg_max_stars = $_POST['maxstar'];
  $temp_stars = $_POST['rating'];

  for($i=$cfg_min_stars; $i<=$cfg_max_stars; $i++) {
   
    if ($temp_stars >= 1) { 
      echo '<img src="images/Star (Full).png" width="40"/>';
      $temp_stars--; 
    }else {
      if ($temp_stars >= 0.5) { 
       echo '<img src="images/Star (Half Full).png" width="40"/>';
        $temp_stars -= 0.5;
      }else { 
        echo '<img src="Star (Empty).png" width="40"/>';
      }
    }
  }
}
}else{
  echo "<script>
            alert('Bạn chưa đăng nhập nên không thể bình luận');
          </script>";
          exit();
}

      ?>
   </table> 
  </div>
</center><br />
</form><br />


<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
<?php 
if (isset($_SESSION['cart'])){
  if(isset($_POST['submit'])){
    $user = $_SESSION['user'];
    $query = "SELECT user_name,address, sdt, email FROM users WHERE user_name = '$user'; ";
    $result1 = mysqli_query($con,$query);
    while($row = mysqli_fetch_assoc($result1)) {
      echo "<tr>";
      echo "<td>".$row["user_name"]."</td>";
      echo "<td>".$row["address"]."</td>";
      echo "<td>".$row["sdt"]."</td>";
      echo "<td>".$row["email"]."</td>";
      echo "<tr>";
    }
  }
}
?> 
</tbody>
</table>

<h3>Bình luận</h3>
<div class="form">
       <form method="post" enctype="multipart/form-data">
               <div>
                   <textarea name="comment" rows="10" cols="30">
                       </textarea>
               </div>
           <input name="submit1" type="submit" value="Submit" /></p></center>
       </form>
   </div>

   <?php
   if ($con) {
      if(isset($_POST['submit1'])){
   $comment=$_REQUEST['comment'];
    $user_name = $_SESSION['user'];
    echo $_REQUEST['comment'];
   $ins_query="INSERT into comments (cus_name, comment) values ('$user_name', '$comment');";
   mysqli_query($con,$ins_query) or die(mysql_error());
   $sql = "SELECT * FROM comments";
   $result1 = mysqli_query($con,$sql) or die(mysql_error());
   while($row = mysqli_fetch_assoc($result1)) {
      echo $row['cus_name'];
      echo "<br>";
      echo $row['comment'];
   } 

} 
     }else{
      echo "ko connect";
}  
     ?>

<?php 
if (isset($_SESSION['user'])) {
  if (isset($_SESSION['cart'])){
     if(isset($_POST['pay'])){
    $user = $_SESSION['user'];
    foreach ($_SESSION['cart'] as $key => $value) {     
      $query = "SELECT * FROM users WHERE user_name = '$user' ";
      $result1 = mysqli_query($con,$query);
      while($row = mysqli_fetch_assoc($result1)) {
        $cus_id = $row['id'];
        insert_orders($con,$cus_id,$key,$value['quantity']);
        //echo $row['quantity'];
      }
    }
    echo "<script>
            alert('Thank you');
          </script>";
        unset($_SESSION['cart']);
  }
}else{
  echo "giỏ hàng trống"; 
}
}else{
  echo "<script>
          alert('Vui lòng đăng nhập để mua được hàng');
        </script>";
  exit();
}
?>


<?php
function insert_orders($con,$cus_id,$prod_id, $quantity) {
  $sql = "INSERT INTO orders(cus_id, date) VALUES ('$cus_id',current_date())";
  if (mysqli_multi_query($con,$sql)) {
    //echo "haaa";
    $order_id = $con->insert_id;
    $sql1 = "INSERT INTO prod_orders(prod_id,order_id,quantity) VALUES ('$prod_id','$order_id','$quantity')";
    mysqli_multi_query($con,$sql1);
    return $con->insert_id;
    // $query = "SELECT `product`.`prod_name`, `prod_orders`.`quantity` FROM product, prod_orders WHERE `prod_orders`.`$prod_id` = `product`.`id`;";
    // $result1 = mysqli_query($con,$query);
    // while( $row = mysqli_fetch_assoc($result1)) {
    //         echo "<tr>";
    //         echo "<td>".$row["prod_name"]."</td>";
    //         echo "<td>".$row["quantity"]."</td>";
    //         echo "<tr>";
    //   }
  } else {
            echo "Error: " . $sql . "<br>" . $con->error;
  }
}
?>

<?php include('footer.php'); ?>
