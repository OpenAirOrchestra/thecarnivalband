<?php

include "config.php";
include "opendb.php";

$query = 'SELECT * FROM `wp_gig_table` ORDER BY `date` DESC';

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
