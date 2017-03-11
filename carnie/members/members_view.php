<?php

include "config.php";
include "opendb.php";

$diplayAttributes = array ( "givenname", "instrument", "bio", "website" );

// Load the attribute table into memory so that we can
// quickly get the tablename of an attribute.
$query = 'SELECT id, tablename FROM `phplist_user_attribute`';

// execute query 
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 
$attributes[0] = "zero";

// see if any rows were returned 
if (mysql_num_rows($result) > 0) 
{ 
	while ($row = mysql_fetch_assoc($result))
	{
		$attributes[$row['id']] = $row['tablename'];
	}
}

// List users into array, sort by givenname, then display.
$users = array();

// List users in the carnival band mailing list.
// Note: carnival band mailing list is listid 3.
$query = 'SELECT userid FROM `phplist_listuser` WHERE listid = 3';

$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 
if (mysql_num_rows($result) > 0) 
{ 
	while ($row = mysql_fetch_assoc($result))
	{
		$userAttributes = array();
		$userAttributes['userid'] = $row['userid'];

		$attributequery  = "SELECT attributeid, value FROM phplist_user_user_attribute WHERE userid = {$row['userid']}";

		$attributeresult = mysql_query($attributequery);
    		while($attributerow = mysql_fetch_assoc($attributeresult))
    		{
			$userAttributes[$attributes[$attributerow['attributeid']]] = $attributerow['value'];
		}

		$givenname = trim(strtoupper($userAttributes['givenname']));

		if ($givenname[0] == '&')
		{
			$pos = strpos($givenname, ';');
			if ($pos !== false)
			{
				$givenname = substr($givenname, $pos + 1);
			}
		}


		if (strlen($givenname))
		{
			$index = $givenname . '_' . $userAttributes['lastname'];
			$users[ $index ] = $userAttributes;
		}
	}

	ksort($users);

	foreach ($users as $givenname => $userAttributes) 
	{
		echo "<p>\n";

		foreach ($diplayAttributes as $item)
                {
			$value = $userAttributes[$item];
			if (strlen($value) > 0)
                        {
				if (($item != 'instrument') &&
				    ($item != 'givenname'))
				{
					echo "<br/>";
				}
				if ($item == 'website')
				{
					if (substr($value,0,4) != "http")
					{                                     
						$value = "http://" . $value;
					}
					echo "<a href=\"";
					echo $value;
					echo "\">";
					echo $value;
					echo "</a> ";
				}
				else if ($item == 'instrument')
				{
					echo ": <span class=\"";
					echo $item;
					echo "\">";
					echo $value;
					echo "</span> ";
				}
				else
				{
					echo " <span class=\"";
					echo $item;
					echo "\">";
					echo $value;
					echo "</span>";
				}

                        }
                }
		echo "</p>\n";
	}

}

include 'closedb.php';

?>
