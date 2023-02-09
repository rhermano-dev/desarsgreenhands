<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: https://admin.desarsgreenhands.com/login.php");
   }
?>
