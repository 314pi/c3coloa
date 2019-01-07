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

require_once( JApplicationHelper::getPath( 'toolbar_html' ) );

switch($task)
{
	case 'edit':
	case 'add':
		TOOLBAR_rquotes::_NEW();
		break;
		
		case 'categories': 
	case 'saveCategory': 
	case 'removeCategory': 
		TOOLBAR_rquotes_categories::_DEFAULT(); 
		break; 

	case 'editCategory': 
		TOOLBAR_rquotes_categories::_EDIT(); 
		break;	
	
	default:
		TOOLBAR_rquotes::_DEFAULT();
		break;
}

?>