<!-- https://www.tutorialspoint.com/php/php_mysql_login.htm -->
<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: login.php");
   }
?>