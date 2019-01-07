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
defined('_JEXEC') or die('Restricted access');

class TableRquote extends JTable
{
	var $id = null;
	var $daily_number = null;
	var $quote = null;
	var $author = null;
	var $catid = null;
	var $notes = null;
	var $published = null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__rquotes', 'id', $db );
	}
}

?>