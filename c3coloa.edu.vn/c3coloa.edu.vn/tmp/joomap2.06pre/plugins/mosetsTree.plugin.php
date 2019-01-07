<?php

/**
* Mosets Tree Plug-in by Sam Lewis - Moxie Media, LLC -> GoMoxieMedia.com
* Version 1.0
*/

// Register with the Plugin Manager
$tmp = new Joomap_mosetsTree;
JoomapPlugins::addPlugin( $tmp );

/** Handles Mosets Tree component */
class Joomap_mosetsTree {

	function isOfType( &$joomla, &$parent ) {
		if( strpos($parent->link, 'option=com_mtree') ) {
			return true;
		}
		return false;
	}


	function &getTree( &$joomap, &$parent ) {

		global $database, $mosConfig_absolute_path;


		//Determine Itemid and URL
		$query = "SELECT id"
		 . "\n FROM #__menu"
		 . "\n WHERE link = 'index.php?option=com_mtree'"
		 . "\n AND published = '1'"
		 . "\n ORDER BY `access`, `parent`, `ordering` ASC LIMIT 1";
		$database->setQuery( $query );
		$pageId = $database->loadResult();		

		/* Returns URLs of all Categories in mosTree */

		$query = "SELECT cat_name, cat_id, cat_created, cat_parent FROM #__mt_cats WHERE cat_published='1' AND cat_approved='1' AND cat_name != 'ROOT' ORDER BY cat_id";

		$database->setQuery($query);
		$rows = $database->loadObjectList();

		$list = array();		
		foreach($rows as $row) {
			if( $row->cat_created == "0000-00-00 00:00:00" ) {
				$row->cat_created = date('Y-m-d'). " 12:00:00";
			}
			if( $row->cat_parent == 0 ) {
				$row->cat_parent = '';
			}
			$node = new stdclass;
		    $node->name = $row->cat_name;
			$node->link = 'index.php?option=com_mtree&amp;task=listcats&amp;cat_id='.$row->cat_id;
			$node->id = $pageId;

			//$node->browserNav = $parent->browserNav;
			$node->modified = $this->_toTimestamp($row->cat_created);
			$node->pid = $row->cat_parent;												// parent id
			
		    $list[$row->cat_id] = $node;
	    }

		/* Returns URLs of all listings in mosTree */
		$query = "SELECT a.link_name, a.link_id, a.link_created, a.link_modified, b.cat_id \n FROM #__mt_links AS a, #__mt_cl as b \n WHERE a.link_id = b.link_id AND ( link_published='1' AND link_approved='1' )";

		$database->setQuery($query);

		$rows = $database->loadObjectList();

		foreach($rows as $row) {
			if( $row->link_modified == "0000-00-00 00:00:00" ) {
				$row->link_modified = $row->link_created;
			}
			if( $row->cat_id == 0 ) {
				$row->cat_id = '';
			}
			$node = new stdclass;
		    $node->name = $row->link_name;
			$node->link = 'index.php?option=com_mtree&amp;task=viewlink&amp;link_id='.$row->link_id;
			$node->id = $pageId;
			//$node->browserNav = $parent->browserNav;
			$node->modified = $this->_toTimestamp($row->link_modified);
			$node->pid = $row->cat_id;												// parent id
			
		    $list['link'.$row->link_id] = $node;
	    }
	    
		foreach( $list as $id => $cat ) {										// move children into their parent nodes
			if( $cat->pid > '-1'  && isset($list[$cat->pid]) ) {
				$list[ $cat->pid ]->tree[] = &$list[$id];
			}
		}
		foreach( $list as $id => $cat ) {										// remove children from top tree
			if( $cat->pid > '-1' ) {
				unset( $list[$id] );
			}
		}
		return $list;

	}
	/** Translate Joomla datestring to timestamp */
	function _toTimestamp( &$date ) {
		if ( $date && ereg( "([0-9]{4})-([0-9]{2})-([0-9]{2})[ ]([0-9]{2}):([0-9]{2}):([0-9]{2})", $date, $regs ) )
			return mktime( $regs[4], $regs[5], $regs[6], $regs[2], $regs[3], $regs[1] );
		return NULL;
	}
}

