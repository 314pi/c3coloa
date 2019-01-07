<?php
/**
 * @version		1.5.1
 * @package		Joomla
 * @subpackage	Rquotes
 * @copyright	Copyright (C) 2005 - 2009 Open Source Matters. All rights reserved.
 * @license		GPLv2.0, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

function com_uninstall()
{
	?>
	<div class="header">The component is now removed from your system. The DB table rquotes has been backed up to bac_rquotes. Please remove or rename this table manually .This is to allow for upgrades.To completely remove the software from your system, be sure to also uninstall the modules.
	We're sorry to see you go! 
	</div>
	<p>
	
	</p>
	<?php
}

?>