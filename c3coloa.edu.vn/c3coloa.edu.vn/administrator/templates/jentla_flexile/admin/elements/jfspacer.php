<?php
/**
* @Jentla Flexile is a fresh new template for the Joomla! Administrator Back-end.
* @copyright Copyright (C) 2010 ZacWare Pty Ltd. http://jentla.com. [^] All rights reserved.
* @license GNU/GPL, see license.txt
* Jentla Flexile is free software. you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version or open source software licenses.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*/
defined('JPATH_BASE') or die();
/**
 * @package     jentla_flexile
 * @subpackage  admin.elements
 */
class JElementJFSpacer extends JElement {
	

	function fetchElement($name, $value, &$node, $control_name)
	{
		global $flexile;
		
		$output = "";
		
		$presetSaver = $node->attributes('preset-saver');
		if (isset($presetSaver) && $presetSaver == "true") {
			$saver  = "<span class='preset-saver'>";
			$saver .= "		<a href='#' class='hasTip' title='".JText::_('PRESET_SAVER_DESC')."'>";
			$saver .= "			<span>".JText::_('PRESET_SAVER')."</span>";
			$saver .= "		</a>";
			$saver .= "</span>";
		}
		else $saver = '';
		
		$template	= "jentla_flexile";
		$flexile->templatePath = "administrator/templates/" . $template;
		$this->template = end(explode(DS, $flexile->templatePath));

		$opensTable = "<table class='paramlist admintable' width='100%' cellspacing='1'><tbody><tr><td>";
		$closeTable = "</td></tr></tbody></table>";
		$surroundOpens = "<div id='g-$name' class='g-surround'>";
		$surroundClose = "</div>";
		$title = "<h3 class='g-title' rel='$name'><span class='arrow'></span>".JText::_($node->attributes('glabel'))."</h3>";
		$shadow = "<div class='g-title-shadow' style='position:relative;'></div>";
		$innerOpens = "<div id='g-$name-inner' class='g-inner'>";
		$innerClose = "</div>";
				
		if (!defined("JFSPACER")) {
			$output = $closeTable . $surroundOpens . $title . $innerOpens . $opensTable;
			define("JFSPACER", 1);
		} else {
			$output = $closeTable . $innerClose . $surroundClose . $surroundOpens . $title . $innerOpens . $opensTable;
		}
		
		return $output;
		
	}
}
