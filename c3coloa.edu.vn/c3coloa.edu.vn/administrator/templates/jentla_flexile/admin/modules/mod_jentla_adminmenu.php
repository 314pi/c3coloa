<?php
/**
* @Jentla Flexile is a fresh new template for the Joomla! Administrator Back-end.
* @copyright Copyright (C) 2010 ZacWare Pty Ltd. http://jentla.com. [^] All rights reserved.
* @license GNU/GPL, see license.txt
* Jentla Flexile is free software. you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version or open source software licenses.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*/
// Check to ensure this file is included in Joomla!

defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.base.tree');


class JAdminCSSLeftMenu extends JTree
{
	/**
	 * CSS string to add to document head
	 * @var string
	 */
	var $_css = null;
    	var $i=0;
	var $sel=array();
	var $childrens=array();
	var $l=0;
	var $flag=true;
	var $j=1;
    var $id='';
	//var $s = "currentMenu";
	function __construct()
	{
		$this->_root = new JLeftMenuNode('ROOT');
		$this->_current = & $this->_root;
	}

	function addSeparator()
	{
		$this->addChild(new JLeftMenuNode(null, null, 'separator', false));
	}

	function renderMenu($id = 'menu', $class = '')
	{
		global $mainframe;
		
        echo "<dl class='accordion'>";
		$depth = 1;
		$s=0;
		if(!empty($id)) {
			$id='id="'.$id.'"';
		}

		if(!empty($class)) {
			$class='class="'.$class.'"';
		}
		

		/*
		 * Recurse through children if they exist
		 */
		while ($this->_current->hasChildren())
		{
			//echo "<ul ".$id." ".$class.">\n";
			foreach ($this->_current->getChildren() as $child)
			{
				if($this->flag){
					$this->sel[0]=$s;
					$s++;	
				}
				$this->_current = & $child;
				$this->renderLevel($depth++,1);
			}
			//echo "</ul>\n";
		}

		if ($this->_css) {
			// Add style to document head
			$doc = & JFactory::getDocument();
			$doc->addStyleDeclaration($this->_css);
		}
        echo "</dl>";
	}

	function renderLevel($depth,$i=1)
	{
        
		/*
		 * Build the CSS class suffix
		 */
                
       global $mainframe;
		$class = '';
		if ($this->_current->hasChildren()) {
			$class = ' class="node"';
		}

		if($this->_current->class == 'separator') {
			$class = ' class="separator"';
		}

		if($this->_current->class == 'disabled') {
			$class = ' class="disabled"';
		}
		
		$link="index.php?".$_SERVER['QUERY_STRING'];
		
		/*
		 * Print the item
		 */
		
		$class = " class='accordion_toggler_$i'";
		$content_class = " class='accordion_content_$i'";
		$content_content_class = " class='accordion_content_accordion_content_$i'";
		
//	currentMenu
		/*
		 * Print a link if it exists
		 */
	
		if ($this->_current->link != null) {
			$link=urldecode($link);
			if($i>1 && str_replace("&amp;","&",$link)==str_replace("&amp;","&",$this->_current->link)) {//$this->_current->hasChildren()<=0 && 
				$this->flag=false;
			}
			if($this->_current->hasChildren()){
				echo "<dt".$class."><a class=\"".$this->getIconClass($this->_current->class)."\" href=\"".$this->_current->link."\">".$this->_current->title."</a>";
			}else{
				if($this->flag==false && $i==3 && $this->l==0){
					$mainframe->setUserState("idsub",$this->j);
					$mainframe->setUserState("id",0);
					$this->l = 1;
				}else if($this->flag==false && $i==2 && $this->l==0){
					$mainframe->setUserState("id",$this->j);
					$mainframe->setUserState("idsub",0);
					$this->l = 1;
				}
					echo "<dd id='leftmenu_".$this->j++."' ".$content_content_class." style='height:0;'>";
				if($this->_current->params!=null){ 					
					?>
					<a class="<?php echo $this->getIconClass($this->_current->class); ?>" href="<?php echo $this->_current->link;?>" onclick="set3rdlevel(this,'<?php //echo $this->j;//echo $this->_current->title;?>');<?php echo $this->_current->params; ?>"><?php echo $this->_current->title; ?></a>				
					<?php
				}else{
					?>
					<a class="<?php echo $this->getIconClass($this->_current->class); ?>" onclick='set3rdlevel(this,"");' href="<?php echo $this->_current->link;?>"><?php echo $this->_current->title; ?></a>				
					<?php
				}
				echo "</dd>";
			}
		} elseif ($this->_current->title != null) {
			if($this->_current->hasChildren()){
				echo "<dt".$class."><a class=\"".$this->getIconClass($this->_current->class)."\">".$this->_current->title."</a>\n";
			}else{
				echo "<dd id='leftmenu_".$this->j++."' ".$content_content_class." style='height:0;'>";
				echo "<a class=\"".$this->getIconClass($this->_current->class)."\">".$this->_current->title."</a>\n</dd>";
			}
		} else {
			return;
		}
	

		/*
		 * Recurse through children if they exist
		 */
		while ($this->_current->hasChildren()){
			if ($this->_current->class) {
				echo "<dd id='leftmenu_".$this->j++."' " . $content_class . " style='height:0;'><dl>";
			} else {
				echo "<dd id='leftmenu_".$this->j++."' " . $content_class . " style='height:0;'><dl>\n'";
			}$i++;
			foreach ($this->_current->getChildren() as $child){
				$i1 = $i-1;
				$this->_current = & $child;
				if($this->flag && count($this->_current->getChildren())>0){
					if(isset($this->sel[$i1]))$this->sel[$i1]+=1;else $this->sel[$i1]=0;
				}
				if($this->flag){
					if(isset($this->menuChilds[$i1]))$this->menuChilds[$i1]+=1;else $this->menuChilds[$i1]=0;
				}
				if(isset($this->totalMenuChilds[$i1]))$this->totalMenuChilds[$i1]+=1;else $this->totalMenuChilds[$i1]=0;
				$this->childrens[$i1][$this->totalMenuChilds[$i1]] = array($this->_current->title,count($this->_current->getChildren()));
				$this->renderLevel($depth++,$i);
			}
			echo "</dl></dd>\n";
		}
		echo "</dt>\n";  
	}
	


	/**
	 * Method to get the CSS class name for an icon identifier or create one if
	 * a custom image path is passed as the identifier
	 *
	 * @access	public
	 * @param	string	$identifier	Icon identification string
	 * @return	string	CSS class name
	 * @since	1.5
	 */
	function getIconClass($identifier)
	{
		global $mainframe;

		static $classes;

		// Initialize the known classes array if it does not exist
		if (!is_array($classes)) {
			$classes = array();
		}

		/*
		 * If we don't already know about the class... build it and mark it
		 * known so we don't have to build it again
		 */
		if (!isset($classes[$identifier])) {
			if (substr($identifier, 0, 6) == 'class:') {
				// We were passed a class name
				$class = substr($identifier, 6);
				$classes[$identifier] = "icon-16-$class";
			} else {
				// We were passed an image path... is it a themeoffice one?
				if (substr($identifier, 0, 15) == 'js/ThemeOffice/') {
					// Strip the filename without extension and use that for the classname
					$class = preg_replace('#\.[^.]*$#', '', basename($identifier));
					$classes[$identifier] = "icon-16-$class";
				} else {
					if ($identifier == null) {
						return null;
					}
					// Build the CSS class for the icon
					$class = preg_replace('#\.[^.]*$#', '', basename($identifier));
					$class = preg_replace( '#\.\.[^A-Za-z0-9\.\_\- ]#', '', $class);

					$this->_css  .= "\n.icon-16-$class {\n" .
							"\tbackground: url($identifier) no-repeat;\n" .
							"}\n";

					$classes[$identifier] = "icon-16-$class";
				}
			}
		}
		return $classes[$identifier];
	}
}
class JLeftMenuNode extends JNode
{
	/**
	 * Node Title
	 */
	var $title = null;

	/**
	 * Node Id
	 */
	var $id = null;


	/**
	 * Node Link
	 */
	var $link = null;

	/**
	 * CSS Class for node
	 */
	var $class = null;

	/**
	 * Active Node?
	 */
	var $active = false;
	var $params = null;


	function __construct($title, $link = null, $class = null, $active = false,$params='')
	{
		$this->title	= $title;
		$this->link		= JFilterOutput::ampReplace($link);
		$this->class	= $class;
		$this->active	= $active;
		$this->id		= str_replace(" ","-",$title);
		$this->params   = $params;

	}
}

// no direct access

class modLeftMenuHelper
{
	/**
	 * Show the menu
	 * @param string The current user type
	 */
	function buildMenu()
	{
		global $mainframe;

		$lang		= & JFactory::getLanguage();
		$user		= & JFactory::getUser();
		$db			= & JFactory::getDBO();
		$usertype	= $user->get('usertype');
		
		
		// cache some acl checks
		$canCheckin			= $user->authorize('com_checkin', 'manage');
		$canConfig			= $user->authorize('com_config', 'manage');
		$manageTemplates	= $user->authorize('com_templates', 'manage');
		$manageTrash		= $user->authorize('com_trash', 'manage');
		$manageMenuMan		= $user->authorize('com_menus', 'manage');
		$manageLanguages	= $user->authorize('com_languages', 'manage');
		$installModules		= $user->authorize('com_installer', 'module');
		$editAllModules		= $user->authorize('com_modules', 'manage');
		$installPlugins		= $user->authorize('com_installer', 'plugin');
		$editAllPlugins		= $user->authorize('com_plugins', 'manage');
		$installComponents	= $user->authorize('com_installer', 'component');
		$editAllComponents	= $user->authorize('com_components', 'manage');
		$canMassMail		= $user->authorize('com_massmail', 'manage');
		$canManageUsers		= $user->authorize('com_users', 'manage');		

		// Menu Types
		require_once( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_menus'.DS.'helpers'.DS.'helper.php' );
		$menuTypes 	= MenusHelper::getMenuTypelist();

		/*
		 * Get the menu object
		 */
		$menu = new JAdminCSSLeftMenu();

		/*
		 * Site SubMenu
		 */
		
		$menu->addChild(new JLeftMenuNode(JText::_('Site'),'','class:site'), true);
		$menu->addChild(new JLeftMenuNode(JText::_('Control Panel'), 'index.php', 'class:cpanel'));
		$menu->addSeparator();
		if ($canManageUsers) {
			$menu->addChild(new JLeftMenuNode(JText::_('User Manager'), 'index.php?option=com_users&task=view', 'class:user'));
		}
		$menu->addChild(new JLeftMenuNode(JText::_('Media Manager'), 'index.php?option=com_media', 'class:media'),true);
		$menu->addSeparator();
		$lk1="index.php?".$_SERVER['QUERY_STRING'];
		if($lk1=='index.php?option=com_media')
		{
		$menu->addChild(new JLeftMenuNode(JText::_('Thumbnail View'), 'javascript:void(0)','class:thumb','false','javascript:MediaManager.setViewType(\'thumbs\')'));
		$menu->addChild(new JLeftMenuNode(JText::_('Detail View'), 'javascript:void(0)','class:detail','false','javascript:MediaManager.setViewType(\'details\')'));
		$menu->getParent();
		}else{
		$menu->addChild(new JLeftMenuNode(JText::_('Thumbnail View'), 'index.php?option=com_media','class:thumb'));
		$menu->addChild(new JLeftMenuNode(JText::_('Detail View'), 'index.php?option=com_media','class:detail'));
		$menu->getParent();
		}
		if ($canConfig) {
			$menu->addChild(new JLeftMenuNode(JText::_('Configuration'), 'index.php?option=com_config', 'class:config'),true);
			$menu->addSeparator();
			$lnk="index.php?".$_SERVER['QUERY_STRING'];
			if($lnk=='index.php?option=com_config')
			{
			$menu->addChild(new JLeftMenuNode(JText::_('Site'),'javascript:void(0)','class:site1','false','javascript:sbmenu(\'site\')'));
			$menu->addChild(new JLeftMenuNode(JText::_('System'),'javascript:void(0)','class:system','false','javascript:sbmenu(\'system\')'));
			$menu->addChild(new JLeftMenuNode(JText::_('Server'),'javascript:void(0)','class:server','false','javascript:sbmenu(\'server\')'));
			$menu->getParent();
			}else{
			$menu->addChild(new JLeftMenuNode(JText::_('Site'), 'index.php?option=com_config','class:site1'));
			$menu->addChild(new JLeftMenuNode(JText::_('System'), 'index.php?option=com_config','class:system'));
			$menu->addChild(new JLeftMenuNode(JText::_('Server'), 'index.php?option=com_config','class:server'));
			$menu->getParent();
			}
		}
		$menu->addChild(new JLeftMenuNode(JText::_('Logout'), 'index.php?option=com_login&task=logout', 'class:logout'));

		$menu->getParent();

		/*
		 * Menus SubMenu
		 */
		$menu->addChild(new JLeftMenuNode(JText::_('Menus'),'','class:Menu'), true);
		if ($manageMenuMan) {
			$menu->addChild(new JLeftMenuNode(JText::_('Menu Manager'), 'index.php?option=com_menus', 'class:menu'));
		}
		if ($manageTrash) {
			$menu->addChild(new JLeftMenuNode(JText::_('Menu Trash'), 'index.php?option=com_trash&task=viewMenu', 'class:trash'));
		}

		if($manageTrash || $manageMenuMan) {
			$menu->addSeparator();
		}
		/*
		 * SPLIT HR
		 */
		if (count($menuTypes)) {
			foreach ($menuTypes as $menuType) {
					if($menuType->menutype=="left menu"){
						$menu->addChild(new JLeftMenuNode(JText::_('Left Menu'), 'index.php?option=com_menus&task=view&menutype=left menu', 'class:leftmenu'));
					}else if($menuType->menutype=="usermenu"){
						$menu->addChild(new JLeftMenuNode(JText::_('User Menu'), 'index.php?option=com_menus&task=view&menutype=usermenu', 'class:usermenu'));
					}else if($menuType->menutype=="ExamplePages"){
						$menu->addChild(new JLeftMenuNode(JText::_('Example Pages'), 'index.php?option=com_menus&task=view&menutype=ExamplePages', 'class:expgs'));
					}else if($menuType->menutype=="topmenu"){
						$menu->addChild(new JLeftMenuNode(JText::_('Top Menu'), 'index.php?option=com_menus&task=view&menutype=topmenu', 'class:topmenu'));
					}else if($menuType->menutype=="mainmenu"){
						$menu->addChild(new JLeftMenuNode(JText::_('Main Menu'), 'index.php?option=com_menus&task=view&menutype=mainmenu', 'class:mainmenu'));
					}else if($menuType->menutype=="othermenu"){
						$menu->addChild(new JLeftMenuNode(JText::_('Resources'), 'index.php?option=com_menus&task=view&menutype=othermenu', 'class:resources'));
					}else if($menuType->menutype=="keyconcepts"){
						$menu->addChild(new JLeftMenuNode(JText::_('Key Concepts'), 'index.php?option=com_menus&task=view&menutype=keyconcepts', 'class:key'));
					}else{					
				$menu->addChild(new JLeftMenuNode($menuType->title.($menuType->home ? ' *' : ''), 'index.php?option=com_menus&task=view&menutype='.$menuType->menutype, 'class:menu'));
				}
			}
		}

		$menu->getParent();				
			
		/*
		 * Content SubMenu
		 */
		$menu->addChild(new JLeftMenuNode(JText::_('Content'),'','class:content'), true);
		$menu->addChild(new JLeftMenuNode(JText::_('Article Manager'), 'index.php?option=com_content', 'class:article'));
		if ($manageTrash) {
			$menu->addChild(new JLeftMenuNode(JText::_('Article Trash'), 'index.php?option=com_trash&task=viewContent', 'class:trash'));
		}
		$menu->addSeparator();
		$menu->addChild(new JLeftMenuNode(JText::_('Section Manager'), 'index.php?option=com_sections&scope=content', 'class:section'));
		$menu->addChild(new JLeftMenuNode(JText::_('Category Manager'), 'index.php?option=com_categories&section=com_content', 'class:category'));
		$menu->addSeparator();
		$menu->addChild(new JLeftMenuNode(JText::_('Frontpage Manager'), 'index.php?option=com_frontpage', 'class:frontpage'));

		$menu->getParent();

		/*
		 * Components SubMenu
		 */
		$jentla_present = false; 
		if ($editAllComponents)
		{
			$menu->addChild(new JLeftMenuNode(JText::_('Components'),'','class:components'), true);

			$query = 'SELECT *' .
				' FROM #__components' .
				' WHERE '.$db->NameQuote( 'option' ).' <> "com_frontpage"' .
				' AND '.$db->NameQuote( 'option' ).' <> "com_media"' .
				' AND enabled = 1' .
				' ORDER BY ordering, name';
			$db->setQuery($query);
			$comps = $db->loadObjectList(); // component list
			$subs = array(); // sub menus
			$langs = array(); // additional language files to load

			// first pass to collect sub-menu items
			foreach ($comps as $row)
			{
				if(strtolower($row->option)=='com_jentla' && $row->enabled==1)$jentla_present = true;
				if ($row->parent)
				{
					if (!array_key_exists($row->parent, $subs)) {
						$subs[$row->parent] = array ();
					}
					$subs[$row->parent][] = $row;
					$langs[$row->option.'.menu'] = true;
				} elseif (trim($row->admin_menu_link)) {
					$langs[$row->option.'.menu'] = true;
				}
			}

			// Load additional language files
			if (array_key_exists('.menu', $langs)) {
				unset($langs['.menu']);
			}
			foreach ($langs as $lang_name => $nothing) {
				$lang->load($lang_name);
			}

			foreach ($comps as $row)
			{
				if(strtolower($row->option)=='com_jentla' && $row->enabled==1)continue;
				if ($editAllComponents | $user->authorize('administration', 'edit', 'components', $row->option))
				{						
					if ($row->parent == 0 && $row->name!='Jentla' && (trim($row->admin_menu_link) || array_key_exists($row->id, $subs)))
					{//echo $row->name."<br>";						
						$text = $lang->hasKey($row->option) ? JText::_($row->option) : $row->name;												
						$link = $row->admin_menu_link ? "index.php?$row->admin_menu_link" : "index.php?option=$row->option";
						if (array_key_exists($row->id, $subs)) {
								if($link=='index.php?option=com_banners'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:banners'),true);
								}else if($link=='index.php?option=com_contact'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:contact'),true);	
								}else if($link=='index.php?option=com_weblinks'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:weblinks'),true);	
								}else if($link=='index.php?option=com_qcontacts'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:qcontacts'),true);	
								}else if($link=='index.php?option=com_phocagallery'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:phoca'),true);	
								}else if($link=='index.php?option=com_newsfeeds'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:newsfeed'),true);	
								}
								else{
									$menu->addChild(new JLeftMenuNode($text, $link,'class:components'), true);
								}
							foreach ($subs[$row->id] as $sub) {
								$key  = $row->option.'.'.$sub->name;
								$text = $lang->hasKey($key) ? JText::_($key) : $sub->name;
								$link = $sub->admin_menu_link ? "index.php?$sub->admin_menu_link" : null;
								$class='class:'.strtolower($sub->name);
								if($link=='index.php?option=com_jce'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:content'));
								}else if($link=='index.php?option=com_jce&type=config'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:content'));
								}else if($link=='index.php?option=com_jce&type=group'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:content'));
								}else if($link=='index.php?option=com_jce&type=plugin'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:content'));
								}else if($link=='index.php?option=com_jce&type=install'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:content'));
								}else if($link=='index.php?option=com_phocagallery'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:cpanel'));
								}
								else{
								$menu->addChild(new JLeftMenuNode($text, $link, $class));
								}
							}
							$menu->getParent();							
						} else if($link=='index.php?option=com_jentlamedia'){
								$menu->addChild(new JLeftMenuNode($text, $link, 'class:jentlamedia'),true);
								$l="index.php?".$_SERVER['QUERY_STRING'];
									if($l=='index.php?option=com_jentlamedia')
									{
										$menu->addChild(new JLeftMenuNode(JText::_('Thumbnail View'), 'javascript:void(0)','class:thumb','false','javascript:MediaManager.setViewType(\'thumbs\')'));
										$menu->addChild(new JLeftMenuNode(JText::_('Detail View'), 'javascript:void(0)','class:detail','false','javascript:MediaManager.setViewType(\'details\')'));
										$menu->getParent();
									}else{
										$menu->addChild(new JLeftMenuNode(JText::_('Thumbnail View'),$link,'class:thumb'));
										$menu->addChild(new JLeftMenuNode(JText::_('Detail View'),$link,'class:detail'));
										$menu->getParent();
									}
							}	else if($link=='index.php?option=com_manager'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:manager'));	
								}	else if($link=='index.php?option=com_poll'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:polls'));	
								}else if($link=='index.php?option=com_search'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:search'));	
								}else if($link=='index.php?option=com_yos_media'){
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:yos'));	
								}else{
									$menu->addChild(new JLeftMenuNode($text, $link, 'class:components'));
								}
					}
				}
			}
			$menu->getParent();
		}

		/*
		 * Extensions SubMenu
		 */
		if ($installModules)
		{
			$menu->addChild(new JLeftMenuNode(JText::_('Extensions'),'','class:extension'), true);

			$menu->addChild(new JLeftMenuNode(JText::_('Install/Uninstall'), 'index.php?option=com_installer', 'class:install'),true);
			$menu->addSeparator();
			$link1="index.php?".$_SERVER['QUERY_STRING'];
				$menu->addChild(new JLeftMenuNode(JText::_('Install'), 'index.php?option=com_installer&task=installer','class:install1'));
				$menu->addChild(new JLeftMenuNode(JText::_('Components'), 'index.php?option=com_installer&type=components&task=manage','class:components'));
				$menu->addChild(new JLeftMenuNode(JText::_('Modules'), 'index.php?option=com_installer&type=modules&task=manage','class:module'));
				$menu->addChild(new JLeftMenuNode(JText::_('Plugins'), 'index.php?option=com_installer&type=plugins&task=manage','class:plugin'));
				$menu->addChild(new JLeftMenuNode(JText::_('Languages'), 'index.php?option=com_installer&type=languages&task=manage','class:language'));
				$menu->addChild(new JLeftMenuNode(JText::_('Templates'), 'index.php?option=com_installer&type=templates&task=manage','class:template'));
				$menu->getParent();
			if ($editAllModules) {
				$menu->addChild(new JLeftMenuNode(JText::_('Module Manager'), 'index.php?option=com_modules', 'class:module'),true);
				$menu->addChild(new JLeftMenuNode(JText::_('Site'), 'index.php?option=com_modules','class:sites'));
				$menu->addChild(new JLeftMenuNode(JText::_('Administrator'),'index.php?option=com_modules&client=1','class:admin'));
				$menu->getParent();
			}
			if ($editAllPlugins) {
				$menu->addChild(new JLeftMenuNode(JText::_('Plugin Manager'), 'index.php?option=com_plugins', 'class:plugin'));
			}
			if ($manageTemplates) {
				$menu->addChild(new JLeftMenuNode(JText::_('Template Manager'), 'index.php?option=com_templates', 'class:template'),true);
				$menu->addChild(new JLeftMenuNode(JText::_('Site'), 'index.php?option=com_templates','class:sites'));
				$menu->addChild(new JLeftMenuNode(JText::_('Administrator'), 'index.php?option=com_templates&client=1','class:admin'));
				$menu->getParent();
			}
			if ($manageLanguages) {
				$menu->addChild(new JLeftMenuNode(JText::_('Language Manager'), 'index.php?option=com_languages', 'class:language'),true);
				if($link1=='index.php?option=com_languages')
				{
				$menu->addChild(new JLeftMenuNode(JText::_('Site'), 'javascript:void(0)','class:sites','false','javascript:document.adminForm.client.value=\'0\';submitbutton(\'\');'));
				$menu->addChild(new JLeftMenuNode(JText::_('Administrator'), 'javascript:void(0)','class:admin','false','javascript:document.adminForm.client.value=\'1\';submitbutton(\'\');'));
				$menu->getParent();
				}else{
				$menu->addChild(new JLeftMenuNode(JText::_('Site'), 'index.php?option=com_languages&client=0','class:sites'));
				$menu->addChild(new JLeftMenuNode(JText::_('Administrator'), 'index.php?option=com_languages&client=1','class:admin'));
				$menu->getParent();
				}
			}
			$menu->getParent();
		}

		/*
		 * System SubMenu
		 */
		if ($canConfig || $canCheckin)
		{
			$menu->addChild(new JLeftMenuNode(JText::_('Tools'),'','class:tools'), true);

			if ($canConfig) {
				$menu->addChild(new JLeftMenuNode(JText::_('Read Messages'), 'index.php?option=com_messages', 'class:messages'));
				$menu->addChild(new JLeftMenuNode(JText::_('Write Message'), 'index.php?option=com_messages&task=add', 'class:messages'));
				$menu->addSeparator();
			}
			if ($canMassMail) {
				$menu->addChild(new JLeftMenuNode(JText::_('Mass Mail'), 'index.php?option=com_massmail', 'class:massmail'));
				$menu->addSeparator();
			}
			if ($canCheckin) {
				$menu->addChild(new JLeftMenuNode(JText::_('Global Checkin'), 'index.php?option=com_checkin', 'class:global_checkin'));
				$menu->addSeparator();
			}
			$menu->addChild(new JLeftMenuNode(JText::_('Clean Cache'), 'index.php?option=com_cache', 'class:config'),true);
			$menu->addChild(new JLeftMenuNode(JText::_('Site'), 'index.php?option=com_cache','class:sites'));
			$menu->addChild(new JLeftMenuNode(JText::_('Administrator'), 'index.php?option=com_cache&client=1','class:admin'));
			$menu->getParent();
			$menu->getParent();
		}

		/*
		 * Help SubMenu
		 */
		$menu->addChild(new JLeftMenuNode(JText::_('Help'),'','class:help1'), true);
//		$menu->addChild(new JLeftMenuNode(JText::_('Joomla! Help'), 'index.php?option=com_admin&task=help', 'class:help'));
		$menu->addChild(new JLeftMenuNode(JText::_('System Info'), 'index.php?option=com_admin&task=sysinfo', 'class:system_info'),true);
			$link2="index.php?".$_SERVER['QUERY_STRING'];
			if($link2=='index.php?option=com_admin&task=sysinfo'){
			$menu->addChild(new JLeftMenuNode(JText::_('System Info'),'javascript:void(0)','class:system_info1','false','javascript:sbmenu(\'site\')'));
			$menu->addChild(new JLeftMenuNode(JText::_('PHP Settings'),'javascript:void(0)','class:settings','false','javascript:sbmenu(\'phpsettings\')'));
			$menu->addChild(new JLeftMenuNode(JText::_('Configuration File'),'javascript:void(0)','class:general','false','javascript:sbmenu(\'config\')'));
			$menu->addChild(new JLeftMenuNode(JText::_('Directory Permissions'),'javascript:void(0)','class:general','false','javascript:sbmenu(\'directory\')'));
			$menu->addChild(new JLeftMenuNode(JText::_('PHP Information'),'javascript:void(0)','class:system_info1','false','javascript:sbmenu(\'phpinfo\')'));
			$menu->getParent();
			}else{
			$menu->addChild(new JLeftMenuNode(JText::_('System Info'), 'index.php?option=com_admin&task=sysinfo','class:system_info1'));
			$menu->addChild(new JLeftMenuNode(JText::_('PHP Settings'), 'index.php?option=com_admin&task=sysinfo','class:settings'));
			$menu->addChild(new JLeftMenuNode(JText::_('Configuration File'), 'index.php?option=com_admin&task=sysinfo','class:content'));
			$menu->addChild(new JLeftMenuNode(JText::_('Directory Permissions'), 'index.php?option=com_admin&task=sysinfo','class:content'));
			$menu->addChild(new JLeftMenuNode(JText::_('PHP Information'), 'index.php?option=com_admin&task=sysinfo','class:system_info1'));
			$menu->getParent();
			}
		$menu->getParent();

		if($jentla_present){
		/*
		 *Jentla SubMenu
		*/
		$menu->addChild(new JLeftMenuNode(JText::_('Jentla'),'index.php?option=com_jentla','class:general'),true);
		
		$subtabs=array(array('name'=>'Sites','link'=>'index.php?option=com_jentla&view=sites&menutab=I','class'=>'sites'),
									array('name'=>'SiteAdmin','link'=>'index.php?option=com_jentla&view=sitemodules&menutab=M','class'=>'admin'),
									array('name'=>'Users','link'=>'index.php?option=com_jentla&view=jentlausers&menutab=U','class'=>'users'),
									array('name'=>'Sections','link'=>'index.php?option=com_jentla&view=sections&menutab=S','class'=>'sections'),
									array('name'=>'Categories','link'=>'index.php?option=com_jentla&view=categories&menutab=C','class'=>'categories'),
									array('name'=>'Content','link'=>'index.php?option=com_jentla&view=mergetags&menutab=T'),
									array('name'=>'System','link'=>'index.php?option=com_jentla&view=jentlaconfig&menutab=Y','class'=>'system'));
		
		$subs['Sites']=array(array('name'=>'Sites','link'=>'index.php?option=com_jentla&view=sites&menutab=I','class'=>'site1'),
//array('name'=>'Site Admin','link'=>'index.php?option=com_jentla&view=sitemanagement&menutab=I','class'=>'admin'),
array('name'=>'Site Groups','link'=>'index.php?option=com_jentla&view=region&menutab=I'));

		$subs['SiteAdmin']=array(array('name'=> 'Modules','link'=>'index.php?option=com_jentla&view=sitemodules&menutype=M','class'=>'class:module'),
													array('name'=> 'Components','link'=>'index.php?option=com_jentla&view=sitemodules&element_type=component&menutab=M','class'=>'class:components'),
													array('name'=> 'Templates','link'=>'index.php?option=com_jentla&view=sitemodules&element_type=template&menutab=M','class'=>'class:template'),
													array('name'=> 'Languages','link'=>'index.php?option=com_jentla&view=sitemodules&element_type=language&menutab=M','class'=>'class:language'),
													array('name'=> 'Plugins','link'=>'index.php?option=com_jentla&view=sitemodules&element_type=plugin&menutab=M','class'=>'class:plugin'));
		
		$subs['Users']=array(
                            array('name'=> 'Common Users','link'=>'index.php?option=com_jentla&view=jentlausers&menutab=U','class'=>'user'),
                            array('name'=>'User Groups','link'=>'index.php?option=com_jentla&view=usergroup&menutab=U','class'=>'clients'));
		
		$subs['Sections']=array();
		$subs['Categories']=array();
		
		$subs['Content']=array(
                           array('name'=>'Merge','link'=>'index.php?option=com_jentla&view=mergetags&menutab=T','class'=>'jentla-merge'),
                           array('name'=>'Global Replace','link'=>'index.php?option=com_jentla&view=globalreplace&menutab=T','class'=>'jentla-global'),
                           array('name'=>'Global Find','link'=>'index.php?option=com_jentla&view=globalfind&menutab=T','class'=>'jentla-find'),
                           array('name'=>'Keyword List','link'=>'index.php?option=com_jentla&view=keyword&menutab=T','class'=>'jentla-keyword'),
                           array('name'=>'Comments Tag','link'=>'index.php?option=com_jentla&view=commentstag&menutab=T','class'=>'jentla-comments'),
                           array('name'=>'CCK Fields Group','link'=>'index.php?option=com_jentla&view=cckfieldsgroup&menutab=T','class'=>'jentla-cckgroup'),
                           array('name'=>'CCK Fields','link'=>	'index.php?option=com_jentla&view=cckfields&menutab=T','class'=>'jentla-cckfields'),
                           array('name'=>'CCK Forms','link'=>	'index.php?option=com_jentla&view=cckfieldsform&menutab=T','class'=>'jentla-cckforms'),
                           array('name'=>'CCK Export CSV','link'=>'index.php?option=com_jentla&view=cckfields&layout=cckexport&menutab=T','class'=>'jentla-cckexport'),
                           array('name'=>'Import Articles','link'=>	'index.php?option=com_jentla&view=importarticles&menutab=T','class'=>'jentla-import'));
		
		$subs['System']=array(
                            array('name'=>'Configuration','link'=>'index.php?option=com_jentla&view=jentlaconfig&menutab=Y','class'=>'settings'),
                            array('name'=>'Compatibility','link'=>'index.php?option=com_jentla&view=compatibility&menutab=Y'),
                            array('name'=>'Log Details','link'=>'index.php?option=com_jentla&view=logdetails&menutab=Y'),
                            array('name'=>'Dashboard','link'=>'index.php?option=com_jentla&view=dashboardlist&menutab=Y'));
		
		$subtabs=(object)$subtabs;
		$subs['Sites']=(object)$subs['Sites'];
		$subs['SiteAdmin'] = (object)$subs['SiteAdmin'];
		$subs['Users']=(object)$subs['Users'];
		$subs['Sections']=(object)$subs['Sections'];
		$subs['Categories']=(object)$subs['Categories'];
		$subs['Content']=(object)$subs['Content'];
		$subs['System']=(object)$subs['System'];
		
		reset($subtabs);
		while (list($key, $row) = each($subtabs)) {
			$menu->addChild(new JLeftMenuNode($row['name'], $row['link'],(isset($row['class']))?$row['class']:'class:content'),true);
			reset($subs[$row['name']]);
			while (list($skey, $child) = each($subs[$row['name']])) {
				$menu->addChild(new JLeftMenuNode($child['name'], $child['link'],(isset($child['class']))?$child['class']:'class:content'));
			}
			$menu->getParent();
		}
		
		$menu->getParent();
		}

		$menu->renderMenu('menu', '');
		//print_r($menu->sel);
		return $menu;
	}

	/**
	 * Show an disbaled version of the menu, used in edit pages
	 *
	 * @param string The current user type
	 */
	function buildDisabledMenu()
	{
		$lang	 =& JFactory::getLanguage();
		$user	 =& JFactory::getUser();
		$usertype = $user->get('usertype');

		$canConfig			= $user->authorize('com_config', 'manage');
		$installModules		= $user->authorize('com_installer', 'module');
		$editAllModules		= $user->authorize('com_modules', 'manage');
		$installPlugins		= $user->authorize('com_installer', 'plugin');
		$editAllPlugins		= $user->authorize('com_plugins', 'manage');
		$installComponents	= $user->authorize('com_installer', 'component');
		$editAllComponents	= $user->authorize('com_components', 'manage');
		$canMassMail			= $user->authorize('com_massmail', 'manage');
		$canManageUsers		= $user->authorize('com_users', 'manage');

		$text = JText::_('Menu inactive for this Page', true);

		// Get the menu object
		$menu = new JAdminCSSLeftMenu();

		// Site SubMenu
		$menu->addChild(new JLeftMenuNode(JText::_('Site'), null, 'disabled'));

		// Menus SubMenu
		$menu->addChild(new JLeftMenuNode(JText::_('Menus'), null, 'disabled'));

		// Content SubMenu
		$menu->addChild(new JLeftMenuNode(JText::_('Content'), null, 'disabled'));

		// Components SubMenu
		if ($installComponents) {
			$menu->addChild(new JLeftMenuNode(JText::_('Components'), null, 'disabled'));
		}

		// Extensions SubMenu
		if ($installModules) {
			$menu->addChild(new JLeftMenuNode(JText::_('Extensions'), null, 'disabled'));
		}

		// System SubMenu
		if ($canConfig) {
			$menu->addChild(new JLeftMenuNode(JText::_('Tools'),  null, 'disabled'));
		}

		// Help SubMenu
		$menu->addChild(new JLeftMenuNode(JText::_('Help'),  null, 'disabled'));

		$menu->renderMenu('menu', 'disabled');
	}
}
$selectedLeftmenu=modLeftMenuHelper::buildMenu();
$selectedmenu = $selectedLeftmenu->sel;
if($_SERVER['QUERY_STRING']=='' && count($_POST)<=0){
	$selectedLeftmenu->flag = false;
	$selectedmenu = array(0);
}
//print_r($selectedmenu);echo "<br><br>";
for($i=0;$i<count($selectedmenu);$i++)if(isset($selectedLeftmenu->childrens[$i]) && $selectedLeftmenu->childrens[$i][$selectedLeftmenu->menuChilds[$i]][1]<=0)$selectedmenu[$i] = -1;
//print_r($selectedmenu);
//print_r($selectedLeftmenu->menuChilds);
//print_r($selectedLeftmenu->childrens);
if($selectedLeftmenu->flag)$selectedmenu = $mainframe->getUserState("flag");
else $mainframe->setUserState("flag",$selectedmenu);
//$selectedmenu = @array_filter($selectedmenu);
if($_SERVER['QUERY_STRING']=='' && count($_POST)<=0){
	$selectedLeftmenu->flag = false;
	$selectedmenu = array(0);
}
//print_r($selectedmenu);
$selected = $mainframe->getUserState("id");
$selectedsub=$mainframe->getUserState("idsub");
//echo $selected . ":" . $selectedsub;
if($_SERVER['QUERY_STRING']=='option=com_jentla')$selectedmenu[0] = 7;
?>
<script language="javascript" text="text/javascript">
<?php echo "var selectedMenu=new Array('" . @implode("','",$selectedmenu) . "');";?>
    <?php if($_SERVER['QUERY_STRING']=='' && count($_POST)<=0){ ?>
    document.getElementById('<?php echo "leftmenu_2"; ?>').className+=' bgc';
    <?php }else{if($selected!=null){ ?>
    document.getElementById('<?php echo "leftmenu_".$selected; ?>').className+=' bgc';
    <?php }if($selectedsub!=null){ ?>
    document.getElementById('<?php echo "leftmenu_".$selectedsub; ?>').className+=' bg';
    <?php }} ?>
</script>