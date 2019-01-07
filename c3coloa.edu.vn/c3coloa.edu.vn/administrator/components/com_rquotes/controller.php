<?php
/**
 * @version		1.5.4
 * @package		Joomla
 * @subpackage	Rquotes
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
 * @license		GPLv2.0, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );

class RquoteController extends JController 

{ 
 
	function __construct( $default = array() )
	{ 
		parent::__construct( $default ); 
		$this->registerTask( 'add' , 'edit' ); 
		$this->registerTask( 'apply', 'save' );
		$this->registerTask( 'unpublish', 'publish' );
		
}
//-------------------------------------------------------------------------------------------
function edit() 
	{ 
		global $option,$mainframe;
			
		$row =& JTable::getInstance('rquote', 'Table'); 
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' ); 
		$id = $cid[0]; 
		$row->load($id); 
		 $lists=array();
		 
//default published 	
	$isNew		= ($row->id < 1);
	if ($isNew)
	{$row->published=1;}


	$filter_catid = $mainframe->getUserStateFromRequest($option.'filter_catid','filter_catid');
	
	$lists['catid'] = JHTML::_('list.category',  'filter_catid', $option, intval( $row->catid ) );
		
	$lists['published'] = JHTML::_('select.booleanlist','published' ,'class="inputbox"', $row->published); 


	HTML_rquotes::editRquote($row, $lists, $option); 
		
	}	
 //-----------------------------------------------------------------------------------------
function save() 
	{ 
		global $option; 

		$row =& JTable::getInstance('rquote', 'Table');
	
		if (!$row->bind(JRequest::get('post'))) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		}

		$row->catid = JRequest::getVar('filter_catid');
		$row->quote = JRequest::getVar( 'quote', '', 'post', 'string', JREQUEST_ALLOWRAW );
		$row->author = JRequest::getVar( 'author', '', 'post', 'string', JREQUEST_ALLOWRAW );
		
		if (!$row->store()) { 
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
			exit(); 
		}
		
		switch ($this->_task)        
		{
			case 'apply': 
				$msg = JText::_('Changes to Rquote saved'); 
				$link = 'index.php?option=' . $option . '&task=edit&cid[]='. $row->id; 
				break;
			
			case 'save': 
			default: 
				$msg = JText::_('Rquote Saved'); 
				$link = 'index.php?option=' . $option; 
				break; 
		}
		 
		$this->setRedirect($link, $msg); 
	} 
//---------------------------------------------------------------------------------------
/**
* List the records
*/
function showRquotes(  )
{
	global $mainframe, $option;

	$db	=& JFactory::getDBO();

	$filter_order		= $mainframe->getUserStateFromRequest( "$option.filter_order",		'filter_order',		'a.ordering',	'cmd' );
	$filter_order_Dir	= $mainframe->getUserStateFromRequest( "$option.filter_order_Dir",	'filter_order_Dir',	'',				'word' );
$filter_state		= $mainframe->getUserStateFromRequest( "$option.filter_state",		'filter_state',		'',				'word' );
	$filter_catid		= $mainframe->getUserStateFromRequest( "$option.filter_catid",'filter_catid',		0,				'int' );
	


	$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
	$limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );

	$where = array();
	if ( $filter_catid ) {
		$where[] = 'a.catid = '.(int) $filter_catid;
	}

	if ( $filter_state ) {
		if ( $filter_state == 'P' ) {
			$where[] = 'a.published = 1';
		} else if ($filter_state == 'U' ) {
			$where[] = 'a.published = 0';
		}
	}



	$where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
	if ($filter_order == 'a.ordering'){
		$orderby 	= ' ORDER BY catname, a.ordering';
	} else
 {
		$orderby 	= ' ORDER BY '. $filter_order .' '. $filter_order_Dir .', catname, a.ordering';
	}

	// get the total number of records
	$query = 'SELECT COUNT(*) '
	. ' FROM #__rquotes AS a'
	. $where
	;
	$db->setQuery( $query );
	$total = $db->loadResult();

	jimport('joomla.html.pagination');
	$pageNav = new JPagination( $total, $limitstart, $limit );

	// get the subset (based on limits) of required records
	$query = 'SELECT a.*, c.title AS catname'
	. ' FROM #__rquotes AS a'
	. ' LEFT JOIN #__categories AS c ON c.id = a.catid'
	. $where
	. $orderby
	;
	$db->setQuery( $query, $pageNav->limitstart, $pageNav->limit );

	$rows = $db->loadObjectList();
	if ($db->getErrorNum()) {
		echo $db->stderr();
		return false;
	}

	// build list of categories
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['catid'] = JHTML::_('list.category',  'filter_catid', 'com_rquotes', $filter_catid, $javascript );

	// state filter
	$lists['state']	= JHTML::_('grid.state',  $filter_state );

	// table ordering
	$lists['order_Dir']	= $filter_order_Dir;
	$lists['order']		= $filter_order;

	  HTML_rquotes::showRquotes( $option, $rows, $pageNav ,$lists);
}
//-----------------------------------------------------------------------------------------	
function remove() 
	{ 
		global $option; 
		$cid = JRequest::getVar( 'cid', array(), '', 'array' ); 
		$db =& JFactory::getDBO();
		 
		if(count($cid)) 
		{ 
			$cids=implode(',',$cid);$cids = implode( ',', $cid ); 
			$query = "DELETE FROM #__rquotes WHERE id IN ( $cids )"; 
			$db->setQuery( $query );
			if (!$db->query()) { 
				echo "<script> alert('".$db->getErrorMsg()."'); window. history.go(-1); </script>\n"; 
			} 
		}
		
		$this->setRedirect( 'index.php?option=' . $option ); 
	}
//--------------------------------------------------------------------------------	
function publish() 
	{ 
		global $option;

		$cid = JRequest::getVar( 'cid', array(), '', 'array' ); 
		
		if( $this->_task == 'publish') 
		{ 
			$publish = 1; 
		} 
		else 
		{ 
			$publish = 0; 
		}
		
		$rquoteTable =& JTable::getInstance('rquote', 'Table'); 
		$rquoteTable->publish($cid, $publish); 
		$this->setRedirect( 'index.php?option=' . $option ); 
	}
}
?>