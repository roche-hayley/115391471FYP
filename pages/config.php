<!-- https://www.tutorialspoint.com/php/php_mysql_login.htm -->
<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'albertroad');
   define('DB_DATABASE', 'fypdatabase');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>