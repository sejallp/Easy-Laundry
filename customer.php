<?php
include('dbcon.php');
include('navbar.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-dByWAgbS_9OR_-I5F3lv3mzrobuutzXElQ&usqp=CAU" type="image/icon type">

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <title>Customer</title>
  </head>
  <body>
    

    <div class="container">
    <form class="row g-3" method="post" action="">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Coupan</label>
    <input type="number" name="coupan" placeholder="Numbers only" class="form-control" id="inputEmail4">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="inputPassword4">
  </div>
  <div class="col-8">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="col-4">
    <label for="inputAddress2" class="form-label">Phone</label>
    <input type="text" maxlength="10" name="phone" class="form-control" id="inputAddress2" placeholder="No country code needed">
  </div>
  <div class="col-md-6">
    <label for="inputServe" class="form-label">Service</label>
          <select class="form-select" id="inputServe" name="service"  aria-label="Default select example">
            <option value="Dry wash">Dry wash</option>
            <option value="Lacromat">Lacromat</option>
            <option value="Wash & Iron">Wash & Iron</option>
            <option value="Only Iron">Only Iron</option>
          </select> 
  </div>

  <div class="col-md-6">
    <label for="inputState" class="form-label">Staff</label>
    <select id="inputState" name="staff" class="form-select">
          <?php
            $staff=mysqli_query($link,"SELECT `name` from employee");
            while($row=mysqli_fetch_array($staff)){
              echo '<option>'.$row['name'] .'</option>';
            }
          ?>
    </select>
  </div>

  <div class="col-md-3">
    <label for="inputZip" class="form-label">Delicate clothes</label>
    <input value="0" type="number" name="delicate" class="form-control" id="inputPassword3" />
  </div>
  <div class="col-md-3">
    <label for="inputZip" class="form-label">Heavy clothes</label>
    <input value="0" type="number" name="heavy" class="form-control" id="inputPassword3" />
  </div>
  <div class="col-md-3">
    <label for="inputZip" class="form-label">Kids clothes</label>
    <input value="0" type="number" name="kids" class="form-control" id="inputPassword3" />
  </div>
  <div class="col-md-3">
    <label for="inputZip" class="form-label">Other</label>
    <input value="0" type="number" name="other" class="form-control" id="inputPassword3" />
  </div>
  <!-- <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div> -->
  <div class="col-12">
  <input name="submit" type="submit" value="SUBMIT" class="form-control btn btn-primary" id="inputPassword3" />
  </div>
</form>
    </div>



    <div class="container-fluid" style="margin-top: 30px;">
      <div class="alert alert-success ml-4"  style="text-align: center;">
          <label>Currently stored customer details are listed below</label>
      </div>

     
<?php

$customers=mysqli_query($link,"SELECT * from customer");
$prices=mysqli_query($link,"SELECT * from price");
while($row=mysqli_fetch_array($prices)){
  $h=$row['heavy'];
  $k=$row['kids'];
  $d=$row['delicate'];
  $o=$row['other'];
}
echo "<table class='table table-dark'>
<tr>
<th scope='col'>Name</th>
<th scope='col'>Coupan ID</th>
<th scope='col'>Staff</th>
<th scope='col'>Heavy</th>
<th scope='col'>Delicate</th>
<th scope='col'>Kids</th>
<th scope='col'>Other</th>
<th scope='col'>Service</th>
<th scope='col'>Phone</th>
<th scope='col'>Address</th>
<th scope='col'></th> 
<th scope='col'></th> 
</tr>";

while($row=mysqli_fetch_array($customers)){
  echo "<tr>";
  echo "<td>"; echo $row['cname'];echo "</td>";
  echo "<td>"; echo $row['coupan'];echo "</td>";
  echo "<td>"; echo $row['staff'];echo "</td>";
  echo "<td>"; echo $row['delicate'];echo "</td>";
  echo "<td>"; echo $row['heavy'];echo "</td>";
  echo "<td>"; echo $row['kids'];echo "</td>";
  echo "<td>"; echo $row['other'];echo "</td>";
  echo "<td>"; echo $row['service'];echo "</td>";
  echo "<td>"; echo $row['phone'];echo "</td>";
  echo "<td>"; echo $row['address'];echo "</td>";
  
  echo "<td>"; ?><a href="edit.php?id=<?php echo $row["cid"]; ?>"> <button type="text/javascript" class='btn btn-primary'>Edit</button><?php echo "</td>" ;
  echo "<td>"; ?><a href="delete.php?id=<?php echo $row["cid"]; ?>"> <button type="text/javascript" class='btn btn-danger'>Delete</button><?php echo "</td>" ;

  echo "</tr>";
}


//Inserting customer data to database

$date=date("Y/m/d");

if(isset($_POST['submit'])){
  $staff_id=mysqli_query($link,"SELECT eid from employee where `name`='$_POST[staff]'");
while($row=mysqli_fetch_array($staff_id)){
  $eid=$row['eid'];
}
$check=mysqli_query($link,"SELECT coupan from customer where coupan='$_POST[coupan]'");
$num=mysqli_num_rows($check);
if($num>0){
  echo "<script>alert('Coupan already present!');</script>";
}
else{

$customer=mysqli_query($link,"INSERT INTO `customer`(`cid`, `coupan`,`eid`,`cname`, `delicate`, `heavy`, `kids`, `other`, `service`,`phone`, `address`, `date`,`staff`) 
VALUES (NULL,'$_POST[coupan]','$eid','$_POST[name]','$_POST[delicate]','$_POST[heavy]','$_POST[kids]','$_POST[other]','$_POST[service]','$_POST[phone]','$_POST[address]','$date','$_POST[staff]')");

$query=mysqli_query($link,"SELECT cid from customer where coupan='$_POST[coupan]' ");
while($fetch_cid=mysqli_fetch_array($query)){
  $cid=$fetch_cid['cid'];
}

$hvy=$h * $_POST['heavy'];
$del=$d * $_POST['delicate'];
$kid=$k * $_POST['kids'];
$oth=$o * $_POST['other'];

$total= $hvy + $del +$kid + $oth;

$bill=mysqli_query($link,"INSERT INTO `bill`(`bill_id`,`cid`, `heavy`, `delicate`, `kids`, `other`, `total`) 
VALUES ( NULL,'".$cid."','".$hvy."', '".$del."','".$kid."','".$oth."','".$total."' ) ");

// $pid=mysqli_query($link,"SELECT `pid` FROM `price`");

$query=mysqli_query($link,"SELECT `pid` FROM `price`");
while($fetch_pid=mysqli_fetch_array($query)){
  $pid=$fetch_pid['pid'];
}

$cust_view=mysqli_query($link,"INSERT INTO `user_view`(`cid`, `pid`, `coupan`,`name`, `heavy`, `delicate`, `kids`, `other`, `t_amount`) 
VALUES ('".$cid."','".$pid."','$_POST[coupan]','$_POST[name]','$_POST[heavy]','$_POST[delicate]','$_POST[kids]','$_POST[other]','".$total."')");

?>
<script>
window.location.href='customer.php';
</script>  
<?php
}
}

?>

  </body>
</html>
