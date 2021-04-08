<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["admin"]);
   unset($_SESSION["user_id"]);
   unset($_SESSION["password"]);   
   echo 'You have cleaned session';
   header('Refresh: 1; URL = login.php');
?>
