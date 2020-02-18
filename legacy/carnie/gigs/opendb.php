<?php
$conn = mysql_connect($database_host, $database_user, $database_password) or die                      
	('Error connecting to mysql');
mysql_select_db($database_name);
?>
