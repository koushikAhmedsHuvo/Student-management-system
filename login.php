<?php

$invalid=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    include 'connect.php';
    
    $userType=$_POST['userType'];
    $ID=$_POST['ID'];
    $password=$_POST['password'];

  if($userType!='student'){
    $sql="SELECT * from employee_t where employeeID='$ID' and password='$password'";
    $result=mysqli_query($con,$sql);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
          $invalid=0;
            session_start();

            $_SESSION['user_type']='employee';

            $_SESSION['ID']=$ID;
            header('location:dashboard.php');
        }
     }
  }    

  else if($userType=='student'){
    $sql="SELECT * from student_t where studentID='$ID' and password='$password'";
    $result=mysqli_query($con,$sql);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
          $invalid=0;
            session_start();
            $_SESSION['user_type']='student';
            $_SESSION['ID']=$ID;
            header('location:dashboard.php');
        }
     }
  }    

        else{
            $invalid=1;
        }
  }
  ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="spms.css">

    <title>Login page</title>

    <style>
      html {
  height: 100%;
}
body {
  margin:0;
  padding:0;
  font-family: sans-serif;
  background-color:#1c96ca;
}

.login-box {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  padding: 40px;
  transform: translate(-50%, -50%);
  background: rgba(0,0,0,.5);
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
  border-radius: 10px;
}

.login-box h2 {
  margin: 0 0 30px;
  padding: 0;
  color: #fff;
  text-align: center;
}

.login-box .user-box {
  position: relative;
}

.login-box .user-box input {
  width: 100%;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  margin-bottom: 30px;
  border: none;
  border-bottom: 1px solid #fff;
  outline: none;
  background: transparent;
}
.login-box .user-box label {
  position: absolute;
  top:0;
  left: 0;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  pointer-events: none;
  transition: .5s;
}

.login-box .user-box input:focus ~ label,
.login-box .user-box input:valid ~ label {
  top: -20px;
  left: 0;
  color: #03e9f4;
  font-size: 12px;
}

.submitButton {
	background-color: #34166e;
  color: white;
  border: none;
  border-radius: 10px;
  padding: 12px 24px;
  font-size: 16px;
  text-align: center;
  box-shadow: 0 0 0 rgba(28,150,202,0.7);
  animation: pulse 2s infinite;
}

.submitButton:hover{
    background:linear-gradient(90deg,#34166e,#40179f);
    
   }

@keyframes pulse {
  0% {
    box-shadow: 0 0 0 0 rgba(28,150,202,0.7);
  }
  70% {
    box-shadow: 0 0 0 15px rgba(28,150,202,0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(28,150,202,0);
  }
}

.login-box form .user-type-box select {
  width: 50%;
  padding: 10px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  background: #2b2250;
  text-transform: uppercase;
  color: #03e9f4;
}


    </style>


  </head>
  <body>

 <?php
 if($invalid==1){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong></strong> Invalid credentials!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  ?>





<div class="login-box">
  <h2>Login</h2>
  <form action="login.php" method="post">
    <div class="user-type-box">
      <select name="userType">
        <option disabled selected>User Type</option>
        <option value="student">Student</option>
        <option value="faculty">Faculty</option>
        <option value="department head">Department Head</option>
        <option value="dean">Dean</option>
      </select>
    </div>
    <div class="user-box">
      <input type="text" name="ID" required="">
      <label>ID</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" required="">
      <label>Password</label>
    </div>
    <input type="submit" name="submit" value="Login" class="submitButton">
  </form>
</div>





</body>
</html> 