<?php
/*------------------------------------------------------------------------
 # Vt NewsTicker  - Version 1.0 - YouTech Club
 # ------------------------------------------------------------------------
 # Copyright (C) 2009-2010 YouTech Club. All Rights Reserved.
 # @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 # Author: Ytcvn.Com
 # Websites: http://www.ytcvn.com
 -------------------------------------------------------------------------*/

class JElementVThemes extends JElement {
  var   $_name = 'Vthemes';
  function fetchElement($name, $value, &$node, $control_name){
  		$document = &JFactory::getDocument();
  		$selected =  $this->_parent->get('selectradio');
  		if(!$selected){
  			$selected = 0;
  		}
  		$db = &JFactory::getDBO();
  		$radiolist   = "<div style='height:160px;width:100%;overflow:hidden;'>";
  		/*SHOW SECTIONS*/
  		$radiolist  .= "<div id='sections'>";
  		$query = "SELECT title,id FROM `#__sections` WHERE `published`='1'";
  		$db->setQuery($query);
  		$sections = $db->loadObjectList();
  		
  		foreach ($sections as $s){
		$sec[]			= JHTML::_('select.option', $s->id, $s->title);//select.option tao ra 1 mang doi tuong
		}
		
		$lists['sections']	= JHTML::_('select.genericlist', $sec,$control_name."[sections][]", 'class="inputbox" size="12"  style="width:100%"  multiple="multiple"', 'value', 'text',$this->_parent->get('sections'));
  		$radiolist .= $lists['sections'];
  		$radiolist .= "</div>" ;
  		/*SHOW SECTIONS*/
  		
  		/*SHOW CATEGORYS*/
  		$radiolist  .= "<div id='categories'>";
  		$query = "SELECT c.title, c.id, s.title as section_title FROM `#__categories` c INNER JOIN `#__sections` s ON s.id = c.section WHERE c.published='1'";
  		$db->setQuery($query);
  		$categories = $db->loadObjectList();
  		
  		foreach ($categories as $c){
		$cats[]			= JHTML::_('select.option', $c->id, $c->section_title . ' -> ' . $c->title);//select.option tao ra 1 mang doi tuong
		}
		
		$lists['categories']	= JHTML::_('select.genericlist', $cats,$control_name."[categories][]", 'class="inputbox" size="12"  style="width:100%"  multiple="multiple"', 'value', 'text',$this->_parent->get('categories'));
  		$radiolist .= $lists['categories'];
  		$radiolist .= "</div>" ;
  		/*SHOW CATEGORYS*/
  		$radiolist .= "</div>" ;
  		JHTML::script('jquery-1.3.2.min.js','modules/mod_vt_newsticker/assets/');
  		$document->addScriptDeclaration('
						jQuery.noConflict();
						jQuery(document).ready(function(){
							var selected = '.$selected.'
							if(selected==0){
								jQuery("div#sections").show();
								jQuery("div#categories").hide();
  							}else{
  							    jQuery("div#sections").hide();
							    jQuery("div#categories").show();
  							}
						jQuery("#paramsselectradio0").click(function(){
							jQuery("div#sections").show();
							jQuery("div#categories").hide();
						});
						jQuery("#paramsselectradio1").click(function(){
							jQuery("div#sections").hide();
							jQuery("div#categories").show();
						});
					});
  		');

    return  $radiolist;

  }
}
?>
		

				