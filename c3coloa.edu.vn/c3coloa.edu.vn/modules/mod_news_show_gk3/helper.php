<?php

/**
* Gavick News Show GK3 - helper class
* @package Joomla!
* @Copyright (C) 2008 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 3.0 $
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

class GK3NewsShowHelper
{
	
	var $module_unique_id,
	$width,
	$section,
	$category,
	$sections,
	$categoriess,
	$news_amount,
	$news_sort_value,
	$news_sort_order,
	$news_column,
	$news_rows,
	$show_list,
	$list_style,
	$news_content_header_pos,
	$news_content_image_pos,
	$news_content_text_pos,
	$news_content_readmore_pos,
	$news_readmore_text,
	$news_header_link,
	$news_image_link,
	$news_text_link,
	$news_header_order,
	$news_image_order,
	$news_text_order,
	$news_limit_type,
	$news_limit,
	$clean_xhtml,
	$img_height,
	$img_width,
	$panel,
	$panel_font,
	$panel_amount,
	$useMoo,
	$useScript,
	$news_datee,
	$news_content_info_pos,
	$news_cats,
	$news_authorr,
	$news_info_order,
	$news_more_in,
	$more_in_text,
	$timezone,
	$news_frontpage, 
	$date_format, 
	$username, 
	$startposition, 
	$force_itemid, 
	$IDs,
	$plugin_support,
	$images_tab,
	$only_plugin,
	$compress_js,
	$rounded;
	// --- OTHER
	var $style;
	var $access;
	var $content_id = array();
	var $content_iid = array();
	var $content_cid = array();
	var $content_title = array();
	var $content_text = array();
	var $content_date = array();
	var $content_images = array();
	var $content_author = array();
	var	$content_catname = array();
	var $content_sid = array();
	var $na = 0;
	
	/**
		VARIABLES VALIDATION
	**/
	
	function validateVariables(&$params)
	{
		$this->module_unique_id = $params->get('module_unique_id','gk_news_show-1'); // unique ID
		$this->width = $params->get('width', 0); // module width

		$this->section = $params->get('section', ''); // ID of section from list
		$this->category = $params->get('category', ''); // ID of category from list	
		$this->sections = $params->get('sections', ''); // String contained IDs of sections separated by comma
		$this->categoriess = $params->get('categories', ''); // String contained IDs of scategories separated by comma
		$this->news_amount = $params->get('news_amount', 15); // News amount to load 
		$this->news_sort_value = $params->get('news_sort_value','created'); // Parameter for SQL Query - value of sort	
		$this->news_sort_order = $params->get('news_sort_order','DESC'); // Parameter for SQL Query - sort direct
		$this->news_column = $params->get('news_column', 4); // amount of news columns
		$this->news_rows = $params->get('news_rows', 3); // amount of news rows
		$this->show_list = $params->get('show_list', 1); // boolean value - show list or not
		$this->rounded = $params->get('rounded', 1); // boolena value - support for rounded corners
		$this->list_style = $params->get('list_style',1); // style of list with rest of news
		$this->news_content_header_pos = $params->get('news_content_header_pos', 1); // text-align for news header
		$this->news_content_image_pos = $params->get('news_content_image_pos', 1); // text-align for news image
		$this->news_content_text_pos = $params->get('news_content_text_pos', 1); // text-align for news text
		$this->news_content_readmore_pos = $params->get('news_content_readmore_pos', 2); // text-align for news readmore button
		$this->news_content_info_pos = $params->get('news_content_info_pos', 1); // text-align for news info
		$this->news_readmore_text = $params->get('news_readmore_text', 'Readmore'); // text for news readmore button
		$this->news_header_link = $params->get('news_header_link', 1); // add link to header ? (boolean)
		$this->news_image_link = $params->get('news_image_link', 1); // add link to image ? (boolean)
		$this->news_text_link = $params->get('news_text_link', 0); // add link to text ? (boolean)
		$this->news_header_order = $params->get('news_header_order', 1); // order of news header
		$this->news_image_order = $params->get('news_image_order', 2); // order of news image
		$this->news_text_order = $params->get('news_text_order', 3); // order of news text
		$this->news_limit_type = $params->get('news_limit_type', 0); // type of limit fo news text
		$this->news_limit = $params->get('news_limit', 30); // amout of limit "units"
		$this->clean_xhtml = $params->get('clean_xhtml', 1); // cleaning XHTML in news
		$this->plugin_support = $params->get('plugin_support', 0); // plugin support
		$this->only_plugin = $params->get('only_plugin', 0); // use only plugin images
		$this->img_height = $params->get('img_height', 0); // image height
		$this->img_width = $params->get('img_width', 0); // image width
		$this->date_format = $params->get('date_format', 'D, d M Y'); // date format
		$this->panel = $params->get('panel', 1); // use panel with additional options
		$this->panel_font = $params->get('panel_font', 1); // show in panel slider of font-size (50-150%)
		$this->panel_amount = $params->get('panel_amount', 1); // show in panel slider of news amount
		$this->useMoo = $params->get('useMoo', 2); // add mootools script to page (if you use more than one module per page then disable it / or if you have mootools included)
		$this->useScript = $params->get('useScript', 2); // add script for this module to page (if you use more than one module per page then disable it)
		//
		($this->width == 0) ? $this->mstyle = '' : $this->mstyle = ' style="width: '.$this->width.'px;"';
		//
		$this->news_datee = $params->get('news_date', 1);
		$this->news_cats = $params->get('news_cats', 1);
		$this->news_authorr = $params->get('news_author', 1);
		$this->news_info_order = $params->get('news_info_order', 4);
		$this->news_more_in = $params->get('news_more_in', 1);
		//
		$this->timezone = $params->get('news_content_timezone','0');
		$this->username = $params->get('username', 0);
		//
		$this->startposition = $params->get('startposition', 0);
		$this->news_frontpage = $params->get('news_frontpage',1);
		$this->IDs = $params->get('ids',''); 
		//
		$this->compress_js = $params->get('compress_js', 1);
		//
		if(strpos($this->img_height,'px') === false && strpos($this->img_height,'%') === false) $this->img_height = 0;# Height image
		if(strpos($this->img_width,'px') === false && strpos($this->img_width,'%') === false) $this->img_width = 0;# Width image
	}
	
	/**
		Generating SQL Query
	**/
		
	function getDatas()
	{
		global $mainframe;
		//
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$aid = $user->get('aid', 0);
		$contentConfig = &JComponentHelper::getParams( 'com_content' );
		$noauth	= !$contentConfig->get('shownoauth');
		$now = date('Y-m-d H:i:s', time() + $mainframe->getCfg('offset') * 60 * 60);
		$nullDate = $db->getNullDate();
		// if source type is section / sections
		$source = false;
		$where1 = '';
		$where2 = '';
		//
		if($this->section != 0 
			&& $this->category == 0 
			&& $this->sections == '' 
			&& $this->categoriess == ''
			&& $this->IDs == ''
			)
		{
			$source = $this->section;
			$where1 = ' c.section = ';
			$where2 = ' OR c.section = ';
		}
		elseif($this->category != 0
			&& $this->sections == '' 
			&& $this->categoriess == ''
			&& $this->IDs == ''
			)
		{
			$source = $this->category;
			$where1 = ' c.id = ';
			$where2 = ' OR c.id = ';
		}
		elseif($this->sections != ''
			&& $this->categoriess == ''
			&& $this->IDs == ''
			)
		{
			$source = $this->sections;
			$where1 = ' c.section = ';
			$where2 = ' OR c.section = ';
		}
		elseif($this->categoriess != ''
			&& $this->IDs == ''
			)
		{
			$source = $this->categoriess;
			$where1 = ' c.id = ';
			$where2 = ' OR c.id = ';		
		}
		else
		{
			$source = $this->IDs;
			$where1 = ' content.id = ';
			$where2 = ' OR content.id = ';		
		}
		//	
		$content_tab = explode(',', $source);
		$where = ''; // initialize WHERE condition
		// generating WHERE condition
		for($i = 0;$i < count($content_tab);$i++)
		{
			//
			if($i == 0)
			{
				$where .= $where1.$content_tab[$i];
			}
			else //
			{
				$where .= $where2.$content_tab[$i];
			}			
		}
		//
		$query_name = '
			SELECT DISTINCT 
				c.id AS ID, 
				c.section AS SID, 
				c.title AS name, 
				m.id AS MID 
			FROM 
				#__categories AS c
			LEFT JOIN 
				#__menu AS m 
				ON 
				c.id = m.componentid 
			LEFT JOIN 
				#__content AS content 
				ON 
				c.id = content.catid 	
			WHERE 
				( '.$where.' ) 
				AND 
				c.published = 1'.($noauth ? ' 
				AND 
				c.access <= ' .(int) $aid : '').';
		';	
		// Executing SQL Query
		$db->setQuery($query_name);
		//
		$this->more_in_text = ''; //
		$sql_where = ''; // initialize sql condition
		// if in database exist some needs datas
		if($categories = $db->loadObjectList())
		{
			//
			$j = 0;
			// getting categories ItemIDs
			foreach ($categories as $item) 
			{
				$this->more_in_text .= '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($item->ID,$item->SID)).'">'. $item->name .'</a>, ';
				//
				if($j != 0)
				{
					$sql_where .= ' OR content.catid = '.$item->ID;
				}
				else
				{
					$sql_where .= ' content.catid = '.$item->ID;
				}
				//
				$j++;
			}	
			//
			$this->more_in_text = JText::_('MORE_IN').": ".substr($this->more_in_text, 0, strlen($this->more_in_text)-2);
		}
		//
		if($this->IDs != '')
		{
			$sql_where = '';
			$idss = explode(',',$this->IDs);
			for($z = 0; $z < count($idss); $z++ )
			{	
				if($z != 0)
				{
					$sql_where .= ' OR content.id = '.$idss[$z];
				}
				else
				{
					$sql_where .= ' content.id = '.$idss[$z];
				}
			}
		}
		// if some datas are avalabile
		if(count($categories) > 0){
			// setting time variable as now
			if($this->timezone == '0')
			{ 
				$now = date('Y-m-d H:i:s',time());
			}
			else
			{
				$time = time() + ((int) $this->timezone * 3600);
				$now = date('Y-m-d H:i:s', $time);
			}
			//
			$frontpage_con = ($this->news_frontpage == 0) ? ' AND frontpage.content_id IS NULL ' : '';
			//
			$order_options = '';
			//
			if($this->news_sort_value == 'random')
			{
				$order_options = ' RAND() '; 
			}
			else //
			{
				$order_options = ' content.'.$this->news_sort_value.' '.$this->news_sort_order.' ';
			}
			//
			$query_news = '
			SELECT DISTINCT
				cats.title AS cat, 
				'.(($this->username != 2) ? 'users.'.(($this->username == 1) ? 'username':'name') : 'content.created_by_alias').' AS author, 
				cats.section AS SID, 
				content.title AS title, 
				content.introtext AS text, 
				content.created AS date, 
				content.images AS images, 
				content.id as IID,
				CASE WHEN CHAR_LENGTH(content.alias) 
					THEN CONCAT_WS(":", content.id, content.alias) 
						ELSE content.id END as ID, 
				CASE WHEN CHAR_LENGTH(cats.alias) 
					THEN CONCAT_WS(":", cats.id, cats.alias) 
						ELSE cats.id END as CID 			
			FROM 
				#__content AS content 
				LEFT JOIN 
					#__categories AS categories 
					ON categories.id = content.catid 
				LEFT JOIN 
					#__sections AS sections 
					ON sections.id = content.sectionid 
				LEFT JOIN 
					#__menu AS menu 
					ON menu.componentid = content.id 
				LEFT JOIN 
					#__users AS users 
					ON users.id = content.created_by 
				LEFT JOIN 
					#__categories AS cats 
					ON content.catid = cats.id 
				LEFT JOIN 
					#__content_frontpage AS frontpage 
					ON content.id = frontpage.content_id 
			WHERE 
				content.state = 1'.($noauth ? ' 
					AND categories.access <= ' .(int) $aid . ' 
					AND content.access <= '.(int) $aid : '').' 
				AND categories.published = 1  
				AND ( content.publish_up = '.$db->Quote($nullDate).' 
					OR content.publish_up <= '.$db->Quote($now).' ) 
					AND ( content.publish_down = '.$db->Quote($nullDate).' 
					OR content.publish_down >= '.$db->Quote($now).' ) 
				AND ( '.$sql_where.' ) '.$frontpage_con.' 
			ORDER BY 
				'.$order_options.'
			LIMIT
				'.$this->startposition.','.($this->news_amount+$this->startposition).';
			';
			//
			$db->setQuery($query_news);
			//
			if($news = $db->loadObjectList())
			{
				// generating tables of news data
				foreach($news as $item)
				{
					$this->content_id[] = $item->ID; // news IDs
					$this->content_iid[] = $item->IID; // news IDs
					$this->content_cid[] = $item->CID; // news CIDs
					$this->content_title[] = $item->title; // news titles
					$this->content_text[] = $item->text; // news text
					$this->content_images[] = $item->images; // news images	
					$this->content_date[] = $item->date; // news dates
					$this->content_author[] = $item->author; // news author
					$this->content_catname[] = $item->cat; // news category name
					$this->content_sid[] = $item->SID; // news category section ID
					$this->na++;	
				}
			}
			// 
			if($this->plugin_support == 1)
			{
				$WHERE = '';
				//
				for($i = 0;$i < count($this->content_iid);$i++)
				{
					//
					if($i == 0)
					{
						$WHERE .= ' s.article = '.$this->content_iid[$i];
					}
					else //
					{
						$WHERE .= ' OR s.article = '.$this->content_iid[$i];
					}			
				}
				//
				$query_image = '
				SELECT 
					s.`file` AS filename,
					s.`article` AS artID		
				FROM 
					#__gk2_photoslide_slides AS s
				LEFT JOIN
					#__gk2_photoslide_groups AS g
					ON
					s.group_id = g.id
				WHERE 
				 	s.access <= '.(int) $aid.' 
					AND 
					s.published = 1  
					AND
					g.plugin = "News Show GK3"
					AND
					( '.$WHERE.' ) 
				;';
				//
				$db->setQuery($query_image);
				//
				if($images = $db->loadObjectList())
				{
					foreach($images as $image)
					{
						$this->images_tab[$image->artID] = $image->filename;	
					}	
				}
			}
		}
	}
	
	/**
	
	**/
	
	function renderLayout()
	{	
		unset($news_id, $news_cid, $news_title, $news_text, $news_date, $news_images, $news_author, $news_catname, $news_sid);	
		// selecting correctly part of datas
		for($x = 0;$x < count($this->content_id);$x++)
		{
			$news_id[] = $this->content_id[$x];
			$news_iid[] = $this->content_iid[$x];
			$news_cid[] = $this->content_cid[$x];
			$news_title[] = $this->content_title[$x];
			$news_text[] = $this->content_text[$x];
			$news_date[] = $this->content_date[$x];
			$news_images[] = $this->content_images[$x];
			$news_author[] = $this->content_author[$x];
			$news_catname[] = $this->content_catname[$x];
			$news_sid[] = $this->content_sid[$x];
		}
		// tables which will be used in generated content
		$news_rest_news_list_tab = '';
		$news_code_html_tab = array();
		// Generating content
		if(isset($_COOKIE['gk_news_show_amount'.$this->module_unique_id]) && $this->panel == 1 && $this->panel_amount == 1)
		{
			$news_rows2 = $_COOKIE['gk_news_show_amount'.$this->module_unique_id];
		}
		else
		{
			$news_rows2 = $this->news_rows;
		} 
		//
		$uri =& JURI::getInstance();
		//
		for($y = 0;$y < count($news_id);$y++)
		{
			/*
				GENERATING NEWS CONTENT
			*/
		
			// GENERATING HEADER
			if($this->news_content_header_pos != 0)
			{
				$news_header = ($this->news_header_link == 1) ? '<h4 class="gk_news_show_news_header"><a href="'.JRoute::_(ContentHelperRoute::getArticleRoute($news_id[$y], $news_cid[$y], $news_sid[$y])).'">'.$news_title[$y].'</a></h4>' : '<h4 class="gk_news_show_news_header">'.$news_title[$y].'</h4>';
			}
			else
			{
				$news_header = '';
			}
			// GENERATING IMAGE
			$news_image = '';
			$IMG_SOURCE = '';
			$IMG_LINK = JRoute::_(ContentHelperRoute::getArticleRoute($news_id[$y], $news_cid[$y], $news_sid[$y]));
			
			if($this->only_plugin == 0 && !isset($this->images_tab[$news_iid[$y]]))
			{
				//	
				$imgSPos = strpos($news_text[$y],'src="');
				//
				if($imgSPos)
				{
					$imgEPos = strpos($news_text[$y],'"',$imgSPos+5);
				} 
				//	
				if($imgSPos > 0) 
				{
					$IMG_SOURCE = substr($news_text[$y], ($imgSPos+5), ($imgEPos-($imgSPos+5)));
				}
				//
			}
			else
			{
				if($this->plugin_support == 1 && isset($this->images_tab[$news_iid[$y]]))
				{
					$IMG_SOURCE = $uri->root().'components/com_gk2_photoslide/images/thumbs/'.$this->images_tab[$news_iid[$y]];
				}	
			}	
			
			if($IMG_SOURCE != '' && $this->news_content_image_pos != 0)
			{
				//
				if($this->news_image_link == 1){
					$news_image = ($this->news_content_image_pos == 3) ? '<div><a href="'.$IMG_LINK.'"><img class="gk_news_show_news_image'.((isset($this->images_tab[$news_iid[$y]])) ? '' : '_static').'" src="'.$IMG_SOURCE.'" alt="News image" /></a></div>' : '<a href="'.$IMG_LINK.'"><img class="gk_news_show_news_image'.((isset($this->images_tab[$news_iid[$y]])) ? '' : '_static').'" src="'.$IMG_SOURCE.'" alt="News image" /></a>';
				}
				else
				{
					$news_image = ($this->news_content_image_pos == 3) ? '<div><img class="gk_news_show_news_image'.((isset($this->images_tab[$news_iid[$y]])) ? '' : '_static').'" src="'.$IMG_SOURCE.'" alt="News image" /></div>' : $news_image = '<img class="gk_news_show_news_image'.((isset($this->images_tab[$news_iid[$y]])) ? '' : '_static').'" src="'.$IMG_SOURCE.'" alt="News image" />';
				}
			} 
		// GENERATING READMORE
		$news_readmore = '';
		//
		if($this->news_content_readmore_pos != 0)
		{
			//
			if($this->news_content_readmore_pos != 4)
			{
				$news_readmore = '<a class="readon readon_class" href="'.JRoute::_(ContentHelperRoute::getArticleRoute($news_id[$y], $news_cid[$y], $news_sid[$y])).'">'.$this->news_readmore_text.'</a>';
			}
			else
			{
				$news_readmore = '<a class="gk_news_show_news_readmore_inline" href="'.JRoute::_(ContentHelperRoute::getArticleRoute($news_id[$y], $news_cid[$y], $news_sid[$y])).'">'.$this->news_readmore_text.'</a>';
			}
		}
		// GENERATING TEXT
		$news_textt = '';
		//
		if($this->news_content_text_pos != 0)
		{
			//
			$news_textt = str_replace('{mosimage}', '', $news_text[$y]);
			//
			if($this->clean_xhtml == 1) $news_textt = strip_tags($news_textt);
			//
			if($this->news_limit_type == 0)
			{
				$str = $news_textt;
				//
				if(strlen($str) > $this->news_limit)
				{
					$words=explode(' ',preg_replace("/\s+/",' ',preg_replace("/(\r\n|\r|\n)/"," ",$str)));
					//
					if(count($words)>=$this->news_limit)
					{
						$str = '';
						//
						for ($i=0;$i<$this->news_limit;$i++)
						{
							$str.=$words[$i].' ';
						}
						//
						$news_textt = trim($str);
						$news_textt .= "...";
					}
				}
			}
			else
			{
				$str = $news_textt;
				//
				if(strlen($str) > $this->news_limit)
				{
					$str = preg_replace("/\s+/", ' ', preg_replace("/(\r\n|\r|\n)/", " ", $str));
					//	
					if(strlen($str) >= $this->news_limit)
					{						
						$news_textt = substr($str, 0, $this->news_limit);
						$news_textt .= "...";
					}
				}
			}
			//	
			$news_textt = ($this->news_text_link == 1) ? '<a href="'.JRoute::_(ContentHelperRoute::getArticleRoute($news_id[$y], $news_cid[$y], $news_sid[$y])).'">'.$news_textt.'</a>' : $news_textt; 
			//
			$news_textt = ($this->news_content_readmore_pos == 4) ? '<p class="gk_news_show_news_text">'.$news_textt.' '.$news_readmore.'</p>' : $news_textt = '<p class="gk_news_show_news_text">'.$news_textt.'</p>';
		}
			// GENERATE NEWS INFO
			$news_infoo = '';
			//
			if($this->news_content_info_pos != 0)
			{
				if($this->news_datee == 1 || $this->news_cats == 1 || $this->news_authorr == 1)
				{
					//
					$news_infoo .= '<p class="gk_news_show_news_info">';
					//
					if($this->news_cats == 1)
					{
						$news_infoo .= '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($news_cid[$y],$news_sid[$y])).'">'.$news_catname[$y].'</a>';
					}
					//
					if($this->news_authorr == 1)
					{
						if($this->news_cats == 1)
						{
							$news_infoo .= ' | ';
						}
						//
						$news_infoo .= $news_author[$y];
					}			
					//
					if($this->news_datee == 1)
					{
						if($this->news_cats == 1 || $this->news_authorr == 1)
						{
							$news_infoo .= ' | ';
						}
						//
						$GKD = new GK3NewsShowDateClass();
						$GKD->init();
						//
						$news_infoo .= $GKD->news_date($news_date[$y], $this->date_format); 
					}
					//
					$news_infoo .= '</p>';
				}	
			}			
			// GENERATE CONTENT FOR TAB
			$news_generated_content = ''; // initialize variable
			//
			for($i = 1;$i < 5;$i++)
			{
				if($this->news_header_order == $i) $news_generated_content .= $news_header;
				if($this->news_image_order == $i) $news_generated_content .= $news_image;
				if($this->news_text_order == $i) $news_generated_content .= $news_textt;
				if($this->news_info_order == $i) $news_generated_content .= $news_infoo;
			}			
			//
			if($this->news_content_readmore_pos != 4) 
			{
				$news_generated_content .= $news_readmore;
			}
			//	
			if($this->show_list == 1)
			{
				// if news on list must be visible
				$li_visible = (($y+1) > $news_rows2 * $this->news_column) ? 'block' : 'none';
				// creating rest news list
				$news_rest_news_list_tab .= '<li class="'.$li_visible.'"><a href="'.JRoute::_(ContentHelperRoute::getArticleRoute($news_id[$y], $news_cid[$y], $news_sid[$y])).'">'.$news_title[$y].'</a></li>';
			}
			// creating table with news content
			$news_code_html_tab[$y] = $news_generated_content;	
		}	
		/**
			GENERATING FINAL XHTML CODE START
		**/

		// create instances of basic Joomla! classes
		$document =& JFactory::getDocument();
		$uri =& JURI::getInstance();
		// add stylesheets to document header
		$document->addStyleSheet( $uri->root().'modules/mod_news_show_gk3/style/style.php?modid='.$this->module_unique_id.'&amp;news_content_header_pos='.$this->news_content_header_pos.'&amp;news_content_image_pos='.$this->news_content_image_pos.'&amp;img_height='.$this->img_height.'&amp;img_width='.$this->img_width.'&amp;news_content_info_pos='.$this->news_content_info_pos.'&amp;news_content_readmore_pos='.$this->news_content_readmore_pos.'&amp;news_content_text_pos='.$this->news_content_text_pos, 'text/css' );
		// init $headData variable
		$headData = false;
		// add scripts with automatic mode to document header
		if($this->useMoo == 2)
		{
			// getting module head section datas
			unset($headData);
			$headData = $document->getHeadData();
			// generate keys of script section
			$headData_keys = array_keys($headData["scripts"]);
			// set variable for false
			$mootools_founded = false;
			// searching phrase mootools in scripts paths
			for($i = 0;$i < count($headData_keys); $i++)
			{
				if(preg_match('/mootools/i', $headData_keys[$i]))
				{
					// if founded set variable to true and break loop
					$mootools_founded = true;
					break;
				}
			}
			// if mootools file doesn't exists in document head section
			if(!$mootools_founded)
			{
				// add new script tag connected with mootools from module
				$headData["scripts"][$uri->root().'modules/mod_news_show_gk3/scripts/mootools.js'] = "text/javascript";
				// if added mootools from module then this operation have sense
				$document->setHeadData($headData);
			}
		}
		
		if($this->useScript == 2)
		{
			// getting module head section datas
			unset($headData);
			$headData = $document->getHeadData();
			// generate keys of script section
			$headData_keys = array_keys($headData["scripts"]);
			// set variable for false
			$engine_founded = false;
			// searching phrase mootools in scripts paths
			if(array_search($uri->root().'modules/mod_news_show_gk3/scripts/engine'.(($this->compress_js == 1) ? '_compressed' : '').'.js', $headData_keys) > 0)
			{
				// if founded set variable to true
				$engine_founded = true;
			}
			// if mootools file doesn't exists in document head section
			if(!$engine_founded)
			{
				// add new script tag connected with mootools from module
				$headData["scripts"][$uri->root().'modules/mod_news_show_gk3/scripts/engine'.(($this->compress_js == 1) ? '_compressed' : '').'.js'] = "text/javascript";
				// if added mootools from module then this operation have sense
				$document->setHeadData($headData);
			}
		}
		//
		$news_amount_to_show = $news_rows2 * $this->news_column;
		$column_width = floor(100 / $this->news_column) . "%";
		$panel_content = '';
		//
		require(JModuleHelper::getLayoutPath('mod_news_show_gk3', 'view.default'));
		//
		if($this->useScript != 2 || $this->useMoo != 2)
		{
			require(JModuleHelper::getLayoutPath('mod_news_show_gk3', 'view.script_style'));
		}
	}
}

?>