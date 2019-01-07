<?php

$tmp = new Joomap_gallery2;
JoomapPlugins::addPlugin( $tmp );

class Joomap_gallery2 {
	
	function isOfType( &$joomap, &$parent ) {
		if( strpos( $parent->link, 'g2_view=core.ShowItem') ) {
			return true;
		}
		return false;
	}
	
	function &getTree( &$joomap, &$parent ) {
		global $database;
		
		//Determine Itemid and URL
		$query = "SELECT id"
		 . "\n FROM #__menu"
		 . "\n WHERE link = 'index.php?option=com_gallery2'"
		 . "\n AND published = '1'"
		 . "\n ORDER BY `access`, `parent`, `ordering` ASC LIMIT 1";
		 
		$database->setQuery( $query );
		$pageId = $database->loadResult();		
		$url = 'index.php?option=com_gallery2&Itemid=' . $pageId . '&g2_view=core.ShowItem&g2_itemId=';
		
		//Initialize Gallery2 Component.
		require_once($GLOBALS['mosConfig_absolute_path'] . "/components/com_gallery2/init.inc" );
	
		//Determine the parent id.
		$ret = core::initiatedG2();
		$link_query = parse_url($parent->link);
		parse_str (html_entity_decode($link_query['query']), $link_vars);
		return $this->getchildrenitems($link_vars['g2_itemId'], 0, $url);
	}
	
	function &getchildrenitems($g2_itemId, $depth, $url) {
		if ($depth > 10) {
			return;
		}
		$list = array();
		list ($ret, $tree) = GalleryCoreApi::fetchAlbumTree($g2_itemId, 1);
		list ($ret, $items) = GalleryCoreApi::loadEntitiesById(GalleryUtilities::arrayKeysRecursive($tree));
		if (!empty($items)) {
			foreach ($items as $item) {
				list ($ret, $count) = GalleryCoreApi::fetchChildCounts(array($item->getId()));
				if (empty($count)) {
					$showcount = '';
				} else {
					reset($count);
					$showcount = ' <span class="small">(' . current($count) . ' photos)</span>';
				}
				
				$node = new stdclass;
				$node->link = sefRelToAbs($url . $item->getId());
				$node->name = ($item->getTitle() ? $item->getTitle() : $item->getPathComponent()) . $showcount;
				$node->type = 'separator';
				$node->tree = $this->getchildrenitems( $item->getId(), $depth + 1, $url );
				
				$list[] = $node;
			}
		}
		return $list;
	}
};
?>