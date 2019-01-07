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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//Import the JToolBar library
jimport('joomla.html.toolbar');
require("templates/" . $this->template . "/html/toolbar.php");
// Get the JComponent instance of JToolBar
$bar = & JToolBar::getInstance('toolbar');
// Render the toolbar
//echo $bar->render('toolbar');
$bars = & JToolBars::getInstance('toolbar');
//JToolBars = JToolBar;
$bars->_bar = $bar->_bar;
$bars->name = "";
if(isset($bar->name))$bars->name = $bar->name;
$bars->_buttons = $bar->_buttons;
$bars->_buttonPath = $bar->_buttonPath;
echo $bars->render('toolbar');
?>
<script language='javascript' type='text/javascript'>
window.addEvent('load', function(){
	element = $('toolbar');
	if(element && !element.hasClass('disabled')) {
		var menu = new JMenu(element);
		document.menu = menu;
	}
});
</script>