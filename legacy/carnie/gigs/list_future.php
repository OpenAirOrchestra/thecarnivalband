<?php

include "config.php";
include "opendb.php";

$query = 'SELECT * FROM `wp_gig_table` WHERE `date` >= DATE(DATE_SUB(NOW(), INTERVAL 7 HOUR)) AND `advertise` = \'1\' ORDER BY `date`';

// execute query
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 
// see if any rows were returned
if (mysql_num_rows($result) > 0)
{
        while ($gig = mysql_fetch_assoc($result))
        {
		include 'gig.php';
	}
}

include 'closedb.php';

?>
