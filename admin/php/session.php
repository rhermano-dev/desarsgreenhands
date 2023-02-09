<?php
   include('/home/desarsgr/public_html/admin/php/config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select * from db_users where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
  
   $login_id = $row['id'];
   $login_name = $row['firstname']." ". $row['lastname'];
   $login_email = $row['email'];
   
   if(!isset($_SESSION['login_user'])){
      header("location: https://admin.desarsgreenhands.com/login.php");
      die();
   }
?>