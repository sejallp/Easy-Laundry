<?php
include('dbcon.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-dByWAgbS_9OR_-I5F3lv3mzrobuutzXElQ&usqp=CAU" type="image/icon type">

    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <title>Dashboard</title>
  </head>
  <body>
    <!-- <section class="dashboard">
           <div class="navbar">
               <ul>
                   <li>Customer</li>
                   <li>Employee</li>
                   <li>Bill</li>
               </ul>
           </div>
       </section> -->
<?php

$query1=mysqli_query($link,"SELECT sum(total) as total from bill ");
$today = date("Y-m-d");
$query2=mysqli_query($link,"SELECT count(*) as count from customer where `date` = '$today'  ");
$query3=mysqli_query($link,"SELECT count(*) as count from user_view where L_status='Done' and P_status='Paid' ");
$t=mysqli_fetch_array($query1);
$total=$t['total'];

$num= mysqli_num_rows($query2);
if($num >0){
  $c=mysqli_fetch_array($query2);
  $cust=$c['count'];
  
}

$cl=mysqli_fetch_array($query3);
$claim=$cl['count'];

?>

<?php include('./navbar.php'); ?>

<div class="container d-flex flex-row justify-content-around">
<div class="alert alert-success ">
      <p>
        <b><large>Total Transactions</large></b>
      </p>
      <hr />
      <p class="text-right">
        <b
          ><large>
         <?="₹" . $total ?>
          </large></b
        >
      </p>
    </div>
    <div class="alert alert-danger">
      <p>
        <b><large>Total Today's Customers</large></b>
      </p>
      <hr />
      <p class="text-right">
        <b
          ><large>
   <?=$cust; ?>
          </large></b
        >
      </p>
    </div>
    <div class="alert alert-primary">
      <p>
        <b><large>Total Paid and Claimed Laundries</large></b>
        <form action="" method="post">
          <button name="clear" class="clear-btn" type="submit">Clear</button>
        </form>
      </p>
      <hr />
      <p class="text-right">
        <b
          ><large>
  <?=$claim; ?> 
          </large></b
        >
      </p>
    </div>
</div>

<?php

if(isset($_POST['clear'])){
  mysqli_query($link,"DELETE from customer where  cid in(select cid from user_view where L_status='Done' and P_status='Paid') ");
}
?>


<?php
try{
$prices=mysqli_query($link,"SELECT * from price");
while($row=mysqli_fetch_array($prices)){
  $h=$row['heavy'];
  $k=$row['kids'];
  $d=$row['delicate'];
  $o=$row['other'];
}
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}

?>
<hr>
<form action="" method="post">
  <br><br>
  <div class="container col-md-4">
  <h2>Set the Prices:</h2>
<div class="input-group mb-3 ">
  <div class="input-group-prepend">
    <span class="input-group-text">For Delicate ₹</span>
  </div>
  <input type="number"  name="delicate" required class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="For Delicate" value="<?php echo $d;  ?>" >
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div> 


<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">For Kids ₹</span>
  </div>
  <input type="number" name="kids" required class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="For Kids" value="<?php echo $k;  ?>" >
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div>


<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">For Heavy ₹</span>
  </div>
  <input type="number" name="heavy" required class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="For Heavy"  value="<?php echo $h;  ?>" >
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div>

<div class="input-group mb-3">

  <div class="input-group-prepend">
    <span class="input-group-text">For Other ₹</span>
  </div>
  <input type="number" name="other" required class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="For Other" value="<?php echo $o;  ?>" >
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div>
<input type="submit" name="set" value="SET PRICE" class="btn btn-primary" />
  </div>
  <br><br>
</form>
    <br><br>
<?php


if(isset($_POST['set'])){
  $price=mysqli_query($link,"UPDATE price set heavy='$_POST[heavy]',delicate='$_POST[delicate]',kids='$_POST[kids]',other='$_POST[other]' where pid=1 ");
  ?>
  <script>
  window.location.href='dashboard.php';
  </script>
  <?php
  
}

?>

<style>
  .clear-btn{
    position: absolute;
    right: 2%;
    bottom: 5%;
    border: none;
    outline: none;
    background: red;
    color: #fff;
    font-weight: 600;
    border-radius: 5px;
    box-shadow: 0 0 3px 2px #555;
  }
</style>
<?php include('footer.php'); ?>
  </body>
</html>
