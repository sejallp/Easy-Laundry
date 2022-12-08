<?php session_start(); 
if(empty($_SESSION['user'])){
  ?>
  <script>
    window.location.href='login.php';
  </script>
  <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-dByWAgbS_9OR_-I5F3lv3mzrobuutzXElQ&usqp=CAU" type="image/icon type">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
  
      <div class="container-fluid">
        <a class="navbar-brand username " href="dashboard.php">Hi <?=$_SESSION['user'];?> </a>
        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">me-auto</span>
          </button> -->
        <!-- <div class="collapse navbar-collapse" id="navbarText"> -->
       
          <?php
            if(isset($_POST['logout'])){
              session_unset();
              ?>
              <script>
                window.location.href='index.php';
              </script>
              <?php
            }
          ?>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="customer.php">Customer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="employee.php">Employee</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bill.php">Bill</a>
          </li>
          <li class="nav-item">
        <form class="logout-form" action="" method="post">
            <button class="logout-btn nav-link" style="color:red;" type="submit" name="logout">Logout</button>
          </form>
        </li>
          <li class="ser nav-item">
          <form class="" method="post" action="">
              <input class="" type="search" name="val" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success " name="search" type="submit">Search</button>
          </form> 
          </li>
      
        </ul>
        <!-- </div> -->
      </div>
      
    </nav> 
    <?php

if(isset($_POST['search'])){
  include('dbcon.php');
  $qry = mysqli_query($link,"CALL `get_search`('$_POST[val]')");
  while($roww=mysqli_fetch_array($qry)){
    $cid=$roww['cid'];
    $coupan=$roww['coupan'];
    $cname=$roww['cname'];
    $phone=$roww['phone'];
    $address=$roww['address'];
    $t_amount=$roww['t_amount'];
  }
  echo "<table class='table navtable table-dark'>
      <tr>
      <th scope='col'>CID</th>
      <th scope='col'>Coupan #</th>
      <th scope='col'>Name</th>
      <th scope='col'>Phone</th>
      <th scope='col'>Address</th>
      <th scope='col'>Total price</th>
      </tr>";

      echo "<tr>";
      echo "<td>"; echo $cid;echo "</td>";
      echo "<td>"; echo $coupan;echo "</td>";
      echo "<td>"; echo $cname;echo "</td>";
      echo "<td>"; echo $phone;echo "</td>";
      echo "<td>"; echo $address;echo "</td>";
      echo "<td>"; echo $t_amount;echo "</td>";
      echo "</tr>";
}


?>
    <style>
      .ser input{
        outline: none;
        border: none;
        padding: 4px;
        border-radius: 5px;
        margin: 0 5px;
      }
      .ser form{
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .navtable{
        position: absolute;
        top: 8%;
      }
      .username{
        font-weight: 900;
        font-size: 20px;
      }
      table{
        box-shadow: 0 5px 7px 5px  #444;
      }
      .logout-btn{
        position: relative;
        background: transparent;
        border: none;
        outline: none;
        color: red;
      }
   

    </style>
</body>
</html>