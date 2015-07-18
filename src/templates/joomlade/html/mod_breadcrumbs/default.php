<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$x = '<i class="fa fa-home pr-10"></i>';
?>

<ol class="breadcrumb">
	<?php

	// Get rid of duplicated entries on trail including home page when using multilanguage
	for ($i = 0; $i < $count; $i++)
	{
		if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link == $list[$i - 1]->link)
		{
			unset($list[$i]);
		}
	}

	// Find last and penultimate items in breadcrumbs list
	end($list);
	$last_item_key = key($list);
	prev($list);
	$penult_item_key = key($list);

	// Make a link if not the last item in the breadcrumbs
	$show_last = $params->get('showLast', 1);

	// Generate the trail
	foreach ($list as $key => $item) :
	if ($key != $last_item_key)
	{
		// Render all but last item - along with separator
		echo '<li>';
		if (!empty($item->link))
		{
			if($item->name == "Home")
			{
				echo '<i class="fa fa-home pr-10"></i>';
			}
			echo '<a href="' . $item->link . '">' . $item->name . '</a>';
		}
		else
		{
			if($item->name == "Home")
			{
				echo '<i class="fa fa-home pr-10"></i>';
			}
			echo '<span>' . $item->name . '</span>';
		}


		echo '</li>';
	}
	elseif ($show_last)
	{
		// Render last item if reqd.
		echo '<li class="active">';
		echo '<span>' . $item->name . '</span>';
		echo '</li>';
	}
	endforeach; ?>
</ol>
