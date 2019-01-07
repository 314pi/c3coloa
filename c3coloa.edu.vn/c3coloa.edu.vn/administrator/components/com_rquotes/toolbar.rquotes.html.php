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

class TOOLBAR_rquotes {
	function _NEW() {
		JToolBarHelper::save();
		JToolBarHelper::apply();
		JToolBarHelper::cancel();
	}

	function _DEFAULT() {
		JToolBarHelper::title( JText::_( ' Rquotes' ), 'generic.png' );
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::editList();
		JToolBarHelper::deleteList();
		JToolBarHelper::addNew();
		JToolBarHelper::preferences('com_rquotes','500','500');
		JToolBarHelper::help('help','true');
	}
}

class TOOLBAR_rquotes_categories
{
	function _EDIT()
	{
		JToolBarHelper::save('saveCategory');
		JToolBarHelper::cancel('categories');
	}	
	function _DEFAULT()
	{
		JToolBarHelper::title( JText::_('Categories'), 'generic.png');
		JToolBarHelper::addNew('editCategory');
		JToolBarHelper::editList('editCategory');
		JToolBarHelper::deletelist ('are you shore?', 'removeCategory');
		}
}		
?>
