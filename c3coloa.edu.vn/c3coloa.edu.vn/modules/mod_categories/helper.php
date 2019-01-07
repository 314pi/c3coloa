<?php
/** mod_categories.php 1.5.1
* @copyright Copyright (C) 2007-2008 Boris Komraz. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/


require_once('components'.DS.'com_content'.DS.'helpers'.DS.'query.php');

class modCategoriesHelper {   

	var $params = null;
	var $categories = null;
	var $section = null;

	
	function escape($txt) {
		echo $txt;
	}
	
	function mod_cat_orderby_sec( $orderby ) {
		switch ( $orderby ) {
		case 'alpha':
			$orderby = 'a.title';
			break;

		case 'ralpha':
			$orderby = 'a.title DESC';
			break;

		case 'order':
			$orderby = 'a.ordering';
			break;

		default:
			$orderby = 'a.ordering';
			break;
		}

		return $orderby;
	}


	function main(&$params)
	{
	
		global $mainframe;
		
		$this->params		=& $params;

		if ( JRequest::getString('option') != 'com_content' )
			return;
			
		$secid 	= intval( $this->params->get( 'id', "" ) );

		if ($secid == "") {
			$view = JRequest::getCmd('view');
			
			$id				= (int) JRequest::getString('id');
//			$temp			= explode(':', $id);
//	$id= $id[0];

			if ( !(strpos($view, "section") === false) ) {
				$secid = $id;
			} elseif ( !(strpos($view, "category") === false) ) {
				$categoryTable = & JTable::getInstance( 'category' );
				$categoryTable->load( $id );
				$secid = $categoryTable->section;  
			} elseif ($view == "article") {
				$contentTable = & JTable::getInstance( 'content' );
				$contentTable->load( $id );
				$secid = $contentTable->sectionid;
			} else {
			}
		}

		if ( $secid <> "" ) {
			$db	  =& JFactory::getDBO();
			$user =& JFactory::getUser();
			
			$access = !$mainframe->getCfg( 'shownoauth' );
			$date =& JFactory::getDate();
			$now = $date->toMySQL();
			$nullDate = $db->getNullDate();

			$this->section =& JTable::getInstance( 'section' );
			$this->section->load( $secid );

			
			// Check if section is published
			if(!$this->section->published) {
				echo JText::_('ALERTNOTAUTH');
				if ($user->get('id') < 1) {
					echo "<br />" . JText::_( 'You need to login.' );
				}
				return;
			}
			// check whether section access level allows access
			$my =& JFactory::getUser();

			$gid = $my->get('gid');
			if( $this->section->access > $gid ) {
				echo JText::_('ALERTNOTAUTH');
				if ($user->get('id') < 1) {
					echo "<br />" . JText::_( 'You need to login.' );
				}
				return;
			}

			$noauth 	= !$mainframe->getCfg( 'shownoauth' );

			$orderby = $this->params->get( 'orderby', '' );

			$this->params->set( 'type', 				'section' );

			// $this->params->def( 'show_page_title', 		$this->params->def('show_title') );
			$this->params->def( 'page_title', $this->section->title );
			$this->params->def( 'id', 		1 );
			$this->params->def( 'other_cat_section', 	1 );
			$this->params->def( 'show_empty_categories', 	0 );
			$this->params->def( 'show_description_image', 	0 );
			$this->params->def( 'show_description', 	    0 );
			$this->params->def( 'other_cat', 			1 );
			$this->params->def( 'show_empty_categories', 			0 );
			$this->params->def( 'show_cat_num_articles', 			1 );
			$this->params->def( 'show_category_description', 	1 );

			// Ordering control
			$orderby = modCategoriesHelper::mod_cat_orderby_sec( $orderby );
			// $orderby = ContentHelperQuery::orderbyPrimary($orderby);

			$canEdit	= ($user->authorize('com_content', 'edit', 'content', 'all') || $user->authorize('com_content', 'edit', 'content', 'own'));

			if ( $canEdit ) {
				$xwhere = '';
				$xwhere2 = "\n AND b.state >= 0";
			} else {
				$xwhere = "\n AND a.published = 1";
				$xwhere2 = "\n AND b.state = 1"
				. "\n AND ( b.publish_up = '$nullDate' OR b.publish_up <= '$now' )"
				. "\n AND ( b.publish_down = '$nullDate' OR b.publish_down >= '$now' )"
				;
			}

			$empty 		= '';
			$empty_sec 	= '';
			if ( $this->params->get( 'type' ) == 'category' ) {
				// show/hide empty categories
				if ( !$this->params->get( 'empty_cat' ) ) {
					$empty = "\n HAVING numitems > 0";
				}
			}
			if ( $this->params->get( 'type' ) == 'section' ) {
				// show/hide empty categories in section
				if ( !$this->params->get( 'empty_cat_section' ) ) {
					$empty_sec = "\n HAVING numitems > 0";
				}
			}

			$access_check = '';
			if ($noauth) {
				$access_check = "\n AND a.access <= $gid";
			}

			// Query of categories within section
			$query = "SELECT a.*, COUNT( b.id ) AS numitems"
			. "\n FROM #__categories AS a"
			. "\n LEFT JOIN #__content AS b ON b.catid = a.id"
			. $xwhere2
			. "\n WHERE a.section = '".$this->section->id."'"
			. $xwhere
			. $access_check
			. "\n GROUP BY a.id"
			. $empty
			. $empty_sec
			. "\n ORDER BY $orderby"
			;
			$db->setQuery( $query );
			$this->categories = $db->loadObjectList();

			foreach ($this->categories as $key => $category) {
				$category->catslug = strlen( $category->alias ) ?  $category->id . ":" . $category->alias : $category->id;
				$category->link = JRoute::_(ContentHelperRoute::getCategoryRoute($category->catslug, $this->section->id));
				$this->categories[$key] = $category;
			}
			
			// Dynamic Page Title
			//	$mainframe->SetPageTitle( $menu->name );


			// components\com_content\views\section\tmpl\default.php
			require (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'views'.DS.'section'.DS.'tmpl'.DS.'default.php');  
		}

	}	

}
?>
