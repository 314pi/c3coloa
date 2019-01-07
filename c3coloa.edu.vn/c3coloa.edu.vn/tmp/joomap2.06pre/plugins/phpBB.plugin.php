<?php

/**
 * Integrates phpBB forum structure into Joomap tree
 * @author Daniel Grothe
 * @version 1.01
 */

// Register with the Plugin Manager
$tmp = new Joomap_phpBB;
JoomapPlugins::addPlugin( $tmp );

/** Handles phpBB forum structure */
class Joomap_phpBB {

	/** Check if we are responsible for this kind of content */
	function isOfType( &$joomla, &$parent ) {
		if( $parent->type == 'components'
		 && $parent->component == 'phpBB' ) {
			return true;
		}
		return false;
	}

	/** Return category/forum tree */
	function &getTree( &$joomap, &$parent ) {
		global $database;

		$list = array();
		
		$query = "SELECT cat_id, cat_title FROM phpbb_categories ORDER BY cat_order";
		$database->setQuery($query);
		$cats = $database->loadObjectList();									// get list of categories
		
		foreach($cats as $cat) {
			$node = new stdclass;
			$node->id   = $parent->id;
		    $node->name = $cat->cat_title;
			$node->browserNav = $parent->browserNav;
			$node->link = $parent->link.'&amp;c='.$cat->cat_id;
			$node->tree = array();
			
			$list[$cat->cat_id] = $node;
	    }
		
		$query =
		  "SELECT f.forum_id, f.cat_id, f.forum_name, p.post_time as modified"
		. "\n FROM (phpbb_forums f"
		. "\n LEFT JOIN phpbb_posts p ON p.post_id = f.forum_last_post_id)"
		. "\n ORDER BY forum_order";
		$database->setQuery($query);
		$forums = $database->loadObjectList();									// get list of forums
		
		foreach($forums as $forum) {											// sort forums into categories
			if( !isset($list[$forum->cat_id]) )
				continue;

			$node = new stdclass;
			$node->id = $parent->id;
			$node->name = $forum->forum_name;
			$node->modified = intval($forum->modified);
			$node->browserNav = $parent->browserNav;
			$node->link = $parent->link.'&amp;page=viewforum&amp;f='.$forum->forum_id;
			
			$list[$forum->cat_id]->tree[] = $node;
		}

		//DEBUG: echo '<pre>'.print_r( $list, true).'</pre>';
		
		return $list;
	}
}

