<?php
$server="localhost";
$username="root";
$password="";
$database="laundry";


$link=mysqli_connect($server,$username,$password,$database);

if(!$link){
    die("Connection to database failed!:" .mysqli_connect_error());
}


?>