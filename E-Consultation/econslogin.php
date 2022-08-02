<?php

@include 'comfig.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $email =  $_POST['email'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
   $count=mysqli_num_rows($result);
   $row=msqli_fetch_assoc($result);

   $result = mysqli_query($con, $select);

   if($count> 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:landingpage.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }
};
   if(isset($_POST['register'])){

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $district = mysqli_real_escape_string($con, $_POST['district']);
    $department = mysqli_real_escape_string($con, $_POST['department']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];
 
    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
 
    $result = mysqli_query($con, $select);
    $count=mysqli_num_rows($result);

    if($count> 0){
 
       $error[] = 'user already exist!';
 
    }else{
 
       if($pass != $cpass){
          $error[] = 'password not matched!';
       }else{
          $insert = "INSERT INTO user_form(name, email,date,gender,district,department, password, user_type) VALUES('$name','$email','$date','$gender','$district','$department',$pass','$user_type')";
          mysqli_query($con, $insert);
          header('location:loginn.php');
       }
    }
 
 };


?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <title>login </title>
    <link rel="stylesheet" href="loginn.css">
 </head>
 <body>
 <div class="form-container">
    <div class="overlay">

    </div>
    
  
    <div class="login">
        <div class="back">
            <a href="..index.css"><input type="submit"name="submit" class="send-btn"value="back" required></a>
        </div>
    
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn"onclick="login()">Login In</button>
                <button type="button" class="toggle-btn"onclick="register()">Registration</button>
            </div>
        <form  id="login" action="" class="form">
        <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
            <input type="text" name="name" class="input-field"placeholder=" name" required>
            <input type="text" name="email" class="input-field"placeholder=" email" required>
            <input type="password" name="password" class="input-field"placeholder="Enter password" required>
            <input type="checkbox" name="cpassword" class="check-box"><span>Remember Password</span>
            <select name="user_type" name="user_type" class="input-field" placeholder="field" id="" > User type
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
            <button type="submit" name="login"class="submit-btn"onclick="showalert()">Login</button>
        </form>    

        <form id="register" action="" class="form">
        <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
            <input type="text" name="name" class="input-field"placeholder="user name" required >
            <input type="text" name="email" class="input-field"placeholder="email" required>
            <input type="date" name="date" class="input-field"placeholder="DD/MM/YY" required>
            <select name="" id=""class="input-field" placeholder="Gender">Gender
                <option value="">Gender</option>
                <option value="">male</option>
                <option value="">female</option>
                <option value="">others</option>
            </select>
            <select name="district" id=""class="input-field" placeholder="District">district
                <option value="">Gasabo</option>
                <option value="">Kicukiro</option>
                <option value="">Nyarugenge</option>
                <option value="">others</option>
            </select>
            <select name="department" id=""class="input-field" placeholder="field">field
                <option value="">mental health disorder</option>
            </select>
            <select name="user_type" class="input-field" placeholder="field"id="" >User type
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
            <input type="pasword" class="input-field"placeholder="Enter password" required>
            <input type="pasword" class="input-field"placeholder="Enter password" required>  
            <input type="checkbox" class="check-box"><span>I accept to th terms and condition</span>
            <button type="register"class="submit-btn"name="register">REGISTER</button>
        </form>
        </div>
    </div>
 </div>
    <script>
        var x=document.getElementById("login");
        var y=document.getElementById("register");
        var z=document.getElementById("btn");
        function register(){
            x.style.left="-40rem";
            y.style.left="5rem";
            z.style.left="7rem"
        }
        function login(){
            x.style.left="5rem";
            y.style.left="40rem";
            z.style.left="0"
        }
    </script>
 </body>
 </html>