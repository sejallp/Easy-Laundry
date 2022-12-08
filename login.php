<?php
include('dbcon.php');
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-dByWAgbS_9OR_-I5F3lv3mzrobuutzXElQ&usqp=CAU" type="image/icon type">
    <title>Login</title>
</head>
<body>
<div class="wrapper">
    <div class="logo"> <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-dByWAgbS_9OR_-I5F3lv3mzrobuutzXElQ&usqp=CAU" alt="Logo"> </div>
    <div class="text-center mt-4 name"> Laundry </div>
    <br>
    <form class="p-3 mt-3" method="post" action="">
        <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input required type="text" name="userName" value="" id="userName" placeholder="Username"> </div>
        <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input required type="password" name="password" id="pwd" placeholder="Password"> </div> 
        <button class="btn mt-3" type="submit" name="login">Login</button>
    </form>
    <br>
    <div class="text-center fs-6"><a href="./signup.php">Sign up</a> </div>
</div>


<?php

if(isset($_POST['login'])){
    if (empty($_POST['userName'])) {
        $_POST['userName'] = 'Admin';
    }
    $user=$_POST['userName'];

    $sql=mysqli_query($link,"SELECT pass from admins where username='$user' ");
    $hpass = mysqli_fetch_array($sql);
    if(password_verify($_POST['password'],$hpass['pass'])){
        $uss=ucfirst($_POST['userName']);
        $_SESSION['user']=$uss;
        header("location: dashboard.php");
    }
    else{
        echo "<h3 class='text-center'>Login Failed!</h3>";
    }
}



?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}

body {
    background: #ecf0f3
}

.wrapper {
    max-width: 350px;
    min-height: 500px;
    margin: 80px auto;
    padding: 40px 30px 30px 30px;
    background-color: #ecf0f3;
    border-radius: 15px;
    box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff
}
.text-center{
    text-align: center;
}
.logo {
    width: 80px;
    margin: auto
}

.logo img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0px 0px 3px #5f5f5f, 0px 0px 0px 5px #ecf0f3, 8px 8px 15px #a7aaa7, -8px -8px 15px #fff
}

.wrapper .name {
    font-weight: 600;
    font-size: 1.4rem;
    letter-spacing: 1.3px;
    padding-left: 10px;
    color: #555
}

.wrapper .form-field input {
    width: 100%;
    display: block;
    border: none;
    outline: none;
    background: none;
    font-size: 1.2rem;
    color: #666;
    padding: 10px 15px 10px 10px
}

.wrapper .form-field {
    padding-left: 10px;
    margin-bottom: 20px;
    border-radius: 20px;
    box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff
}

.wrapper .form-field .fas {
    color: #555
}

.wrapper .btn {
    box-shadow: none;
    width: 100%;
    height: 40px;
    background-color: #03A9F4;
    color: #fff;
    border-radius: 25px;
    box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
    letter-spacing: 1.3px
}

.wrapper .btn:hover {
    background-color: #039BE5
}

.wrapper a {
    text-decoration: none;
    font-size: 0.8rem;
    color: #03A9F4
}

.wrapper a:hover {
    color: #039BE5
}

@media(max-width: 380px) {
    .wrapper {
        margin: 30px 20px;
        padding: 40px 15px 15px 15px
    }
}
button{
    outline: none;
    border: none;
}
h3{
    text-shadow: 0 0 1px #555;
}
</style>
</body>
</html>