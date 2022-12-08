<?php
include('dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-dByWAgbS_9OR_-I5F3lv3mzrobuutzXElQ&usqp=CAU" type="image/icon type">

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <title>Employee</title>
</head>
<body>
<?php include('navbar.php'); ?>

      <div class="container" style="margin:20px;">
        <form method="post" action="">
          <h2 style="text-align: center;margin:20px;">Employee Details</h2>
          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input name="name" type="text" class="form-control" id="inputEmail3" />
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Phone No.</label>
            <div class="col-sm-10">
              <input name="phone" type="text" maxlength="10" class="form-control" id="inputEmail3" />
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
              <input  name="address" type="text" class="form-control" id="inputEmail3" />
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Salary</label>
            <div class="col-sm-10">
              <input name="salary" type="text" class="form-control" id="inputEmail3" />
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Gender</label>
            <select name="gender" class="form-select" aria-label="Default select example">
                <option selected>Male</option>
                <option>Female</option>
              </select>
          </div>
          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Age</label>
            <div class="col-sm-10">
              <input name="age" type="number" class="form-control" id="inputEmail3" />
            </div>
          </div>
          <div class="row">
              <input name="submit" type="submit" value="SUBMIT" class="form-control btn btn-primary" id="inputPassword3" />
            </div>
        </form>
      </div>

      <div class="container-fluid" style="margin-top: 30px;">
        <div class="alert alert-success ml-4"  style="text-align: center;">
            <label>Currently working Employees are listed below </label>
        </div>

      </div>


<?php

if(isset($_POST['submit'])){
$employee=mysqli_query($link,"INSERT INTO `employee`(`eid`, `name`, `phone`, `address`, `salary`, `gender`, `age`) 
                        VALUES (NULL,'$_POST[name]','$_POST[phone]','$_POST[address]','$_POST[salary]','$_POST[gender]','$_POST[age]')");

?>
<script>
window.location.href='employee.php';
</script>
<?php
}



echo "<table class='table table-dark container '>
<tr>
<th scope='col'>Name</th>
<th scope='col'>Phone No.</th>
<th scope='col'>Address</th>
<th scope='col'>Salary</th>
<th scope='col'>Gender </th>
<th scope='col'>Age</th>
<th scope='col'>Edit</th>
<th scope='col'>Delete</th>

</tr>";
$emp=mysqli_query($link,"SELECT * from employee");

while($row=mysqli_fetch_array($emp)){
  echo "<tr>";
  echo "<td>"; echo $row['name'];echo "</td>";
  echo "<td>"; echo $row['phone'];echo "</td>"; 
  echo "<td>"; echo $row['address'];echo "</td>";
  echo "<td>"; echo $row['salary'];echo "</td>";
  echo "<td>"; echo $row['gender'];echo "</td>";
  echo "<td>"; echo $row['age'];echo "</td>";

  echo "<td>"; ?><a href="emp_edit.php?id=<?php echo $row["eid"]; ?>"> <button type="text/javascript" class='btn btn-primary'>Edit</button><?php echo "</td>" ;
  echo "<td>"; ?><a href="emp_delete.php?id=<?php echo $row["eid"]; ?>"> <button type="text/javascript" class='btn btn-danger'>Delete</button><?php echo "</td>" ;

  echo "</tr>";
}





?>


</body>
</html>
