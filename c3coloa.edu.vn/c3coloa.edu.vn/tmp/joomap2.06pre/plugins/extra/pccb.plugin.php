<?php

$tmp = new Joomap_pccb;
JoomapPlugins::addPlugin( $tmp );

class Joomap_pccb {
	function isOfType( &$joomla, &$parent ) {
		if( strpos($parent->link, 'option=com_pccookbook') ) {
			return true;
		}
		return false;
	}
	function &getTree( &$joomla, &$parent ) {
		global $database, $mosConfig_absolute_path;
		
		//Determine Itemid and URL
		$query = "SELECT id"
		 . "\n FROM #__menu"
		 . "\n WHERE link = 'index.php?option=com_pccookbook'"
		 . "\n AND published = '1'"
		 . "\n ORDER BY `access`, `parent`, `ordering` ASC LIMIT 1";
		$database->setQuery( $query );
		$pageId = $database->loadResult();		
		$url = $GLOBALS['mosConfig_live_site'] . '/index.php?option=com_pccookbook&Itemid=' . $pageId;
		
		$list = array();
		require_once($mosConfig_absolute_path . '/components/com_pccookbook/include.pccookbook.php');
		$link_query = parse_url($parent->link);
		parse_str (html_entity_decode($link_query['query']), $link_vars);
	
		// Produce the list
		if ((!array_key_exists('page',$link_vars)) && array_key_exists('sitemap',$link_vars)) {
		
			//Get the groups/categories
			$browselist = pccb_GetBrowseList();		
			$lastgroup = "";
			$group_index = -1;
			foreach ($browselist as $row) {
				if ($lastgroup != $row->grouptitle) { // Add Group heading and start sublist.
					$group_index++;
					
					$node = new stdclass;
					$node->link = sefRelToAbs("index.php?option=com_pccookbook&Itemid=" . $pageId . 
											  "&page=viewgroup&catgroup_id=" . $row->catgroup_id);
					$node->name = $row->grouptitle;
					$node->type = 'separator';
					
					$list[] = $node;

					$lastgroup = $row->grouptitle;
				}
				if (!($row->numrecipes == "0")) {
					$node = new stdclass;
					$node->link = sefRelToAbs("index.php?option=com_pccookbook&Itemid=" . $pageId . 
											  "&page=viewcategory&cat_id=" . $row->cat_id);
					$node->name = $row->cattitle . " <span class=\"small\">(" . $row->numrecipes . 
								  " recipe" . ($row->numrecipes != 1 ? "s" : "") . ")</span>";
					$node->type = 'separator';
					
					$list[$group_index] = $node;
				}
			}
		}
		return $list;	
	}
};
?>