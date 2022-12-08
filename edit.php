<?php
include('dbcon.php');

$values=mysqli_query($link,"SELECT * from customer where cid='$_GET[id]'");
while($row=mysqli_fetch_array($values)){
    $name=$row['cname'];
    $coupan=$row['coupan'];
    $delicate=$row['delicate'];
    $heavy=$row['heavy'];
    $kids=$row['kids'];
    $other=$row['other'];
    $service=$row['service'];
    $staff=$row['staff'];
    $phone=$row['phone'];
    $address=$row['address'];
    $cid=$row['cid'];
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <title>Customer Edit</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin panel</a>
        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">me-auto</span>
          </button> -->
        <!-- <div class="collapse navbar-collapse" id="navbarText"> -->
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="customer.php">Customer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="employee.php">Employee</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Bill</a>
          </li>
        </ul>
        <!-- </div> -->
      </div>
    </nav>
<div class="container">
      <form method='post' action="" >
        <h2 style="text-align: center;margin:20px;">Editing Customer Details</h2>
        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="inputEmail3" value="<?php echo $name; ?>" />
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputPassword3" class="col-sm-2 col-form-label"
            >Coupan ID</label
          >
          <small>Note: The Coupan ID should be number only</small>
          <div class="col-sm-10">
            <input type="number" name="coupan" class="form-control" id="inputPassword3" value="<?php echo $coupan; ?>"/>
          </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label"
            >Staffs</label
          >
          <select class="form-select" name="staff" aria-label="Default select example" value="<?php echo $staff; ?>">
          <?php
$staff=mysqli_query($link,"SELECT * from employee");
while($row=mysqli_fetch_array($staff)){
  echo '<option>'.$row['name'] .'</option>';
}
    ?>
          </select>
          
        </div>
        <div class="row mb-3">
          <label for="inputPassword3" class="col-sm-2 col-form-label"
            >Delicate clothes</label
          >
          <div class="col-sm-10">
            <input type="number" name="delicate" class="form-control" id="inputPassword3" value="<?php echo $delicate; ?>"/>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputPassword3" class="col-sm-2 col-form-label"
            >Heavy clothes</label
          >
          <div class="col-sm-10">
            <input type="number" name="heavy" class="form-control" id="inputPassword3" value="<?php echo $heavy; ?>"/>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputPassword3" class="col-sm-2 col-form-label"
            >Kids clothes</label
          >
          <div class="col-sm-10">
            <input type="number" name="kids" class="form-control" id="inputPassword3" value="<?php echo $kids; ?>"/>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputPassword3" class="col-sm-2 col-form-label"
            >Other clothes</label
          >
          <div class="col-sm-10">
            <input type="number" name="other" class="form-control" id="inputPassword3" value="<?php echo $other; ?>"/>
          </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label"
            >Services</label
          >
          <select class="form-select" name="service" aria-label="Default select example" value="<?php echo $service; ?>">
            <option value="Dry wash">Dry wash</option>
            <option value="Lacromat">Lacromat</option>
            <option value="Wash & Iron">Wash & Iron</option>
            <option value="Only Iron">Only Iron</option>
          </select>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label"
              >Phone No.</label
            >
            <div class="col-sm-10">
              <input name="phone" type="number" class="form-control" id="inputPassword3" value="<?php echo $phone; ?>"/>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label"
              >Address</label
            >
            <div class="col-sm-10">
              <input name="address" type="text" class="form-control" id="inputPassword3" value="<?php echo $address; ?>"/>
            </div>
          </div>
          <div class="row">
              <input name="update" type="submit" value="UPDATE" class="form-control btn btn-success" id="inputPassword3" />
              <br><br>
          </div>
          <br>
          <br>
          </div>
      </form>
    </div>



<?php
  if(isset($_POST['update'])){
  $update=mysqli_query($link,"UPDATE `customer` SET `coupan`='$_POST[coupan]',`cname`='$_POST[name]',`delicate`='$_POST[delicate]',
  `heavy`='$_POST[heavy]',`kids`='$_POST[kids]',`other`='$_POST[other]',`service`='$_POST[service]',`staff`='$_POST[staff]',
  `phone`='$_POST[phone]',`address`='$_POST[address]' WHERE cid='$_GET[id]'");

  ?>
<script>

window.location.href='customer.php';

</script>

<?php
  }
?>



</body>


</html>
