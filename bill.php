<?php
include('dbcon.php'); 
include('navbar.php'); 
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
    <title>Bill</title>
</head>
<body>
  <?php
    $sql = mysqli_query($link,"SELECT count(*) as count  from customer where `service`= 'Wash & Iron' ");
    $wni = mysqli_fetch_array($sql);

    $sql2 = mysqli_query($link,"SELECT count(*) as count  from customer where `service`= 'Dry wash' ");
    $dry = mysqli_fetch_array($sql2);

    $sql3 = mysqli_query($link,"SELECT count(*) as count  from customer where `service`= 'Lacromat' ");
    $lac = mysqli_fetch_array($sql3);

    $sql4 = mysqli_query($link,"SELECT count(*)  as count from customer where `service`= 'Only Iron' ");
    $iron = mysqli_fetch_array($sql4);

    $tot = $wni['count'] + $dry['count'] + $lac['count'] + $iron['count'];

    $wash = $wni['count'] / $tot * 100; 
    $drywash = $dry['count'] / $tot * 100; 
    $lacro = $lac['count'] / $tot * 100; 
    $irononly = $iron['count'] / $tot * 100; 


  ?>
  <div class="container">
  <div class="progress">
  <div class="progress-bar bg-warning" role="progressbar" style="width: <?=$wash;?>%" aria-valuenow="<?=$wash;?>" aria-valuemin="0" aria-valuemax="100"><?=$wash;?>%</div>
  <div class="progress-bar bg-success" role="progressbar" style="width: <?=$drywash;?>%" aria-valuenow="<?=$drywash;?>" aria-valuemin="0" aria-valuemax="100"><?=$drywash;?>%</div>
  <div class="progress-bar bg-info" role="progressbar" style="width: <?=$lacro;?>%" aria-valuenow="<?=$lacro;?>" aria-valuemin="0" aria-valuemax="100"><?=$lacro;?>%</div>
  <div class="progress-bar bg-danger" role="progressbar" style="width: <?=$irononly;?>%" aria-valuenow="<?=$irononly;?>" aria-valuemin="0" aria-valuemax="100"><?=$irononly;?>%</div>
</div>
  </div>

<div class="container-fluid" style="margin-top: 30px;">
        <div class="alert alert-success ml-4"  style="text-align: center;">
            <label>Bills of all <?=$tot;?> customers are listed below:</label>
        </div>

      </div>
<?php
$bill=mysqli_query($link,"SELECT c.cid,c.cname,c.coupan,b.heavy,b.delicate,b.kids,b.other,b.total,`service` from bill b,customer c  where c.cid=b.cid");



echo "<table class='table table-dark container'>
<tr>
<th scope='col'>Name</th>
<th scope='col'>Heavy</th>
<th scope='col'>Delicate</th>
<th scope='col'>Kids</th>
<th scope='col'>Other</th>
<th scope='col'>Total price</th>
<th scope='col'>Service</th>
<th scope='col'> Status</th>
<th scope='col'>Payment</th>
</tr>";

$user_view=mysqli_query($link,"SELECT * from `user_view`");

while($row=mysqli_fetch_array($bill)){
  $name=$row['cname'];
  $h=$row['heavy'];
  $k=$row['kids'];
  $d=$row['delicate'];
  $o=$row['other'];
  $total=$row['total'];
  $service = $row['service'];


 
  
  echo "<tr>";
    echo "<td>"; echo $name;echo "</td>";
    echo "<td>"; echo $h;echo "</td>";
    echo "<td>"; echo $d;echo "</td>";
    echo "<td>"; echo $k;echo "</td>";
    echo "<td>"; echo $o;echo "</td>";
    echo "<td>"; echo $total;echo "</td>";
  

    $r=mysqli_fetch_array($user_view);
      $L_status=$r['L_status'];
      $P_status=$r['P_status'];
    
    
    echo "<td>";?><button class="btn 
    <?php 

        if($service=='Dry wash'){
          echo "btn-success";
        }
        else if($service=='Lacromat'){
          echo "btn-info";
        }
        else if($service=='Only Iron'){
          echo "btn-danger";
        }
        else{
          echo "btn-warning";
        }

    ?>"><?=$service;?></button><?php echo "</td>";
    echo "<td>"; ?><a href="set_status.php?id=<?php echo $row["cid"]; ?>">  
    <button type="text/javascript" class="btn <?php if($L_status=='Done')
    {
      echo 'btn-outline-success';
    }
     else{
       echo 'btn-outline-warning';
      } ?>"><?php echo $L_status;  ?></button></a><?php echo "</td>" ;
    echo "<td>"; ?> <a href="set_payment.php?id=<?php echo $row["cid"]; ?>"> <button type="text/javascript" class="btn 
    <?php 
    if($P_status=='Paid'){
      echo 'btn-outline-success';
    }
    else{
      echo 'btn-outline-danger';
    }
    ?>"><?php echo $P_status;  ?></button></a><?php echo "</td>" ;

    echo "</tr>";
  
  
}

// $query=mysqli_query($link,"SELECT cid from bill where ");
// while($fetch_cid=mysqli_fetch_array($query)){
//   $cid=$fetch_cid['cid'];
// }



?>
<style>
  .progress{
    height: 2rem;
    border-radius: 20px;
    box-shadow: 0 0 6px 1px #666;
    cursor: pointer;
  }
  .progress-bar{
    font-weight: 900;
  }
</style>


</body>
</html>
