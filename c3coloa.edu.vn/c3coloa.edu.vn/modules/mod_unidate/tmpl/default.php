<?php 
/**
* @version		1.0 stable
* @copyright	Copyright (C) 2008 - 2009 style13. All rights reserved.
* @license		GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
 
echo '<div class="datemodule">';
echo '<'.$tag_for_title . $title.'</'.$tag_for_title.'>';
echo '<div>';
echo str_replace($search, $replace, $dateformat);
echo '</div>';
echo '</div>';

?>