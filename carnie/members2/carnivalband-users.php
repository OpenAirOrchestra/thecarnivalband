<?php
// This is a hacked up version of the WordPress Users plugin hardwired to
// pull users from the carnival band members website.

/*
Plugin Name: WordPress Users
Plugin URI: http://kempwire.com/wordpress-users-plugin
Description: Display your WordPress users and user profiles.
Version: 1.1
Author: Jonathan Kemp
Author URI: http://kempwire.com/

Copyright 2009  Jonathan Kemp  (email : jonkemp@comcast.net)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
    
*/

function carnivalband_users() {  
		
	if(isset($_GET['uid']))
		display_user();	
	else
		display_user_list();

}

function display_user_list() {  
	// by default we show first page
	$pageNum = 1;

	// if $_GET['pg'] defined, use it as page number
	if(isset($_GET['pg']))
		{
	    	$pageNum = $_GET['pg'];
		}
	$usersPerPage = 15;
	
	// counting the offset
	$offset = ($pageNum - 1) * $usersPerPage;
	
	// Get the users from the database ordered by user nicename
	global $wpdb;
	// $query = "SELECT ID, user_nicename FROM aandrien_carnivalbandmembers.wp_users ORDER BY user_nicename LIMIT $offset, $usersPerPage";
	
	// Get the users from the database ordered by user nicename,
	// with capabilities not set to be role none.
	$query = "
	SELECT aandrien_carnivalbandmembers.wp_users.ID, aandrien_carnivalbandmembers.wp_users.user_nicename, 	
	       aandrien_carnivalbandmembers.wp_usermeta.meta_value
	FROM aandrien_carnivalbandmembers.wp_users 
		INNER JOIN aandrien_carnivalbandmembers.wp_usermeta
		ON (aandrien_carnivalbandmembers.wp_users.ID = aandrien_carnivalbandmembers.wp_usermeta.user_id)
	WHERE aandrien_carnivalbandmembers.wp_usermeta.meta_key = 'wp_capabilities' AND
     	      aandrien_carnivalbandmembers.wp_usermeta.meta_value NOT LIKE 'a:0:%'
	ORDER BY aandrien_carnivalbandmembers.wp_users.user_nicename
	LIMIT $offset, $usersPerPage";

	$author_ids = $wpdb->get_results($query);

    	$output = '';

	// Loop through each author
	foreach($author_ids as $author) {

		// Get user data
		$curauth = get_carnie_userdata($author->ID);

		$output .= get_user_listing($curauth);
	}
         
	echo $output;

	// how many rows we have in database
	$user_count = $wpdb->get_var("SELECT COUNT(ID) FROM aandrien_carnivalbandmembers.wp_users");

	// how many pages we have when using paging?
	$maxPage = ceil($user_count/$usersPerPage);
	
	$concat = wpu_concat_index();
	
	if(!isset($page))
		$page = 1;
		
	echo "<p>[ Page $pageNum of $maxPage ] ";
	
	if ($pageNum > 1)
	{
	   	$page  = $pageNum - 1;
	   	echo "&nbsp;[ <a href=\"", the_permalink(), $concat, "pg=$page\">&laquo; Prev</a> ]&nbsp;";
	}
	
	for($i = 1; $i <= $maxPage; $i++)
	{	
		if($i != $pageNum)
			echo "&nbsp;[ <a href=\"", the_permalink(), $concat, "pg=", $i, "\">$i</a> ]&nbsp;";
		else
			echo "&nbsp;[ ", $i, " ]&nbsp;";
	}
	
	if ($pageNum < $maxPage)
	{
   		$page = $pageNum + 1;
   		echo "&nbsp;[ <a href=\"", the_permalink(), $concat, "pg=$page\">Next &raquo;</a> ]&nbsp;";
	}
	
	echo "</p>\n";
}

function wpu_concat_index()
{
	$url = $_SERVER['REQUEST_URI'];
	$permalink = get_permalink(get_the_id());
	
	if(strpos($permalink, '?'))
		return '&';
	else
		return '?';
}

function wpu_concat_single()
{
	$url = $_SERVER['REQUEST_URI'];
	$permalink = get_permalink(get_the_id());
	
	if(strpos($permalink, '?'))
		return '&';
	else
		return '?';
}

function get_carnie_userdata($user_id) {
	global $wpdb;

	$user_id = absint($user_id);
	if ( $user_id <= 1 )
		return false;
	
	if ( !$user = $wpdb->get_row($wpdb->prepare("SELECT * FROM aandrien_carnivalbandmembers.wp_users WHERE ID = %d LIMIT 1", $user_id)) )
		return false;

	$metavalues = $wpdb->get_results($wpdb->prepare("SELECT meta_key, meta_value FROM aandrien_carnivalbandmembers.wp_usermeta WHERE user_id = %d", $user->ID));

	if ( $metavalues ) {
		foreach ( (array) $metavalues as $meta ) {
			$value = maybe_unserialize($meta->meta_value);
			$user->{$meta->meta_key} = $value;
		}
	}

	return $user;
}

function get_user_listing($curauth) {  
	$concat = wpu_concat_single();
	
	$html .= "<div class=\"wpu-user\">\n";

	 
	if($curauth->userphoto_thumb_file) 
	{
		$html .= "<div class=\"wpu-avatar\"><a href=\"" . get_permalink($post->ID) . $concat . "uid=$curauth->ID\" title=\"$curauth->display_name\">" .
			"<img src=\"http://members.thecarnivalband.com/wurst/wp-content/uploads/userphoto/" . $curauth->userphoto_thumb_file .  "\"/>" .
			"</a></div>\n";
	}

	$html .= "<div class=\"wpu-id\"><a href=\"" . get_permalink($post->ID) . $concat . "uid=$curauth->ID\" title=\"$curauth->display_name\">$curauth->display_name</a></div>\n";
	if ($curauth->description) {
		$html .=  "<div class=\"wpu-about\">" . $curauth->description . "</div>\n";
	}

	$html .= "</div>";
	return $html;
}

function display_user() {  
	if(isset($_GET['uid'])) {
		$uid = $_GET['uid'];
		$curauth = get_carnie_userdata($uid);
	}
	
	$html .= "<p><a href=" . get_permalink($post->ID) . ">&laquo; Back to " . get_the_title($post->ID) . " page</a></p>\n";
	
	$html .= "<h2>$curauth->display_name</h2>\n";
	
	if($curauth->userphoto_image_file) 
	{
		$html .= "<p>" . 
			"<img src=\"http://members.thecarnivalband.com/wurst/wp-content/uploads/userphoto/" . $curauth->userphoto_image_file .  "\"/>" .
			"</p>\n";
	}

	if ($curauth->user_url && $curauth->user_url != "http://") {
		$html .= "<p><strong>Website:</strong> <a href=\"$curauth->user_url\" rel=\"nofollow\">$curauth->user_url</a></p>\n";
	}
	
	if ($curauth->description) {
		$html .= "<p><strong>Profile:</strong></p>\n";
		$html .= "<p>$curauth->description</p>\n";
	}
	
	
	echo "<div id=\"wpu-profile\">
	";
	echo $html;
	echo "</div>
	";
}

?>