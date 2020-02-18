<?php

include "config.php";
include "opendb.php";

$query = 'SELECT * FROM `wp_gig_table` WHERE `date` < DATE(DATE_SUB(NOW(), INTERVAL 7 HOUR)) AND `advertise` = \'1\' ORDER BY `date` DESC';

// execute query
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 
// see if any rows were returned
if (mysql_num_rows($result) > 0)
{
	$year = "";
	$first = 1;

        while ($gig = mysql_fetch_assoc($result))
        {
		if (date('Y', strtotime($gig['date'])) != $year)
		{
			if ($first)
			{
				echo "\n<div class='year'>\n";
			}
			else
			{
				echo "</div>\n";
				echo "\n<div class='year collapsed'>\n";
			}
			
			$year = date('Y', strtotime($gig['date']));
			echo "<a href='javascript:;' class='expand_button' onclick='toggle_parent_collapsed(event);'>&nbsp;&nbsp;&nbsp;&nbsp;</a> <span class='year'>$year</span><br/>";
		}
		if ((! $gig['cancelled']) && (! $gig['tentative']))
		{
			echo "<div class='gig collapsed'>\n";
			include 'gig_short.php';
			echo "\n</div>\n";
		}
		$first = 0;
	}
	echo "</div>\n";
}

include 'closedb.php';

?>
