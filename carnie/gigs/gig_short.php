<a href='javascript:;' class='expand_button' onclick='toggle_parent_collapsed(event);'>&nbsp;&nbsp;&nbsp;&nbsp;</a> <span class="date"> <?php
	echo date('j M Y', strtotime($gig['date']));
	echo ": ";
?> </span> <span class="gig_title"> <?php
	if ((strncasecmp($gig['url'], 'http://', 7) == 0) ||
	    (strncasecmp($gig['url'], 'https://', 8) == 0))
	{
	    echo "<a href=\"{$gig['url']}\">";
	}
	else if (strlen($gig['url']) > 0)
	{
		echo "<a href=\"http://{$gig['url']}\">";
	}
	echo stripslashes($gig['title']);
	if (strlen($gig['url']) > 0)
	{
		echo "</a>";
	}
?> </span> <div class="details">
	<?php
	if (strlen($gig['location']) > 0)
	{
	?> <p class="location"> <?php echo stripslashes($gig['location']); ?> </p> <?php
	}
	if (strlen($gig['description']) > 0)
	{
	?> <p class="description"> <?php echo stripslashes($gig['description']); ?> </p> <?php
	}
	?></div>
