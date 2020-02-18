
<h3> 
<?php

if ($gig['cancelled'])
{
	echo "Cancelled: ";
	echo date('l, d M Y', strtotime($gig['date']));
	echo ": ";

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
	?>
	</h3>
<?php
}
else
{
	if ($gig['tentative'])
	{
		echo "Tentative: ";
	}
	echo date('l, d M Y', strtotime($gig['date']));
	echo ": ";

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
	?>
	</h3>

	<?php
	if (strlen($gig['location']) > 0)
	{
	?>
		<p class="location">
			<?php echo stripslashes($gig['location']); ?>
		</p>
	<?php
	}
	?>

	<?php
	if (strlen($gig['description']) > 0)
	{
	?>
		<p class="description">
			<?php echo stripslashes($gig['description']); ?>
		</p>
	<?php
	}
	?>
		<p class="times">
	<?php 
		if (strlen($gig['eventstart']) > 0)
		{
			echo "Event start: ";
			echo date('g:ia', strtotime($gig['eventstart']));
			echo ". ";
		}
		if (strlen($gig['performancestart']) > 0)
		{
			echo "Performance start: ";
			echo date('g:ia', strtotime($gig['performancestart']));
			echo ". ";
		}
	?>
		</p>

<?php
}
?>

