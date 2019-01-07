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
// no direct access
if(isset($_GET["background"]) && $_GET["background"]=='bgimage'){
	require("bgimage.php");
	exit;
}else if(isset($_GET["background"]) && $_GET["background"]=='gradient'){
	require("gradient.php");
	exit;
}
defined( '_JEXEC' ) or die( 'Restricted access' );
$db = JFactory::getDBO();
$user		=& JFactory::getUser();
$css='div.corner{
	-moz-border-radius-topleft:20px; -moz-border-radius-topright:20px;-moz-border-radius-bottomleft:20px;-moz-border-radius-bottomright:20px;
	-webkit-border-radius-topleft:20px;-webkit-border-radius-topright:20px;-webkit-border-radius-bottomright:20px;-webkit-border-radius-bottomleft:20px;
	border-radius:12px;border:1px solid #D6D6D6;
	background-color:#D6D6D6;margin:2px;height:18px;padding:2px 0 0 10px;
	font-size:12px;width:180px;	
}';
$document =& JFactory::getDocument();
$document->addStyleDeclaration( $css );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo  $this->language; ?>" lang="<?php echo  $this->language; ?>" dir="<?php echo  $this->direction; ?>" id="minwidth" >
<head>
<jdoc:include type="head" /> 
<div id="ajaxLoadBack" style="position:absolute;z-index:99999;width:100%;height:100%;background:#CCC;opacity:0.3;filter: alpha(opacity=0.3); ">&nbsp;</div>
<div id="ajaxLoadPrepare" style="position:fixed;z-index:99999;top:300px;text-align:center;width:100%;"><img src="templates/<?php echo  $this->template ?>/images/ajax-loader.gif" border="0"></div>
<script type="text/javascript">
var in1 = 0;
    function showLoading(){
		 var fx = new Fx.Styles('ajaxLoadPrepare', { duration: 1000 });
		 fx.addEvent('onComplete',function () { $('ajaxLoadPrepare').setStyle('display', 'block'); });
		 fx.start.delay(10, fx, { 'opacity' : 1 });
		$('ajaxLoadPrepare').style.filter="alpha(opacity=1)";
    }
    function HideLoading(){
		try{
			 var fx = new Fx.Styles('ajaxLoadPrepare', { duration: 1000 });
			 fx.addEvent('onComplete',function () { $('ajaxLoadPrepare').setStyle('display', 'none'); });
			 fx.start.delay(1000, fx, { 'opacity' : 0 });
			if(window.innerHeight){ 
				$('ajaxLoadBack').style.width = window.innerWidth + "px";
				$('ajaxLoadBack').style.height = window.innerHeight + "px";
			}else{
				$('ajaxLoadBack').style.width = document.body.clientWidth + "px";
				$('ajaxLoadBack').style.height = document.body.clientHeight + "px";
			}
			 var fx = new Fx.Styles('ajaxLoadBack', { duration: 1000 });
			 fx.addEvent('onComplete',function () { $('ajaxLoadBack').setStyle('display', 'none'); });
			 fx.start.delay(1000, fx, { 'opacity' : 0 });
		}catch(e){
			$('ajaxLoadBack').style.filter=$('ajaxLoadPrepare').style.filter="alpha(opacity=0)";
			$('ajaxLoadBack').style.display=$('ajaxLoadPrepare').style.display="none";
			$('ajaxLoadBack').style.visibility=$('ajaxLoadPrepare').style.visibility="hidden";
		}
		if($('toolbar-save') && $('divtoolbar')){
			$('divtoolbar').addEvent('mouseover',function(){$('toolbar-save').parentNode.style.visibility="visible";});
			$('divtoolbar').addEvent('mouseleave',function(){$('toolbar-save').parentNode.style.visibility="hidden";});
		}
		if(in1>0)clearInterval ( in1 );
    }
	
    </script>
	<style>div#content-content form table.adminlist td a img{visibility:hidden;}</style>
<link rel="stylesheet" href="templates/system/css/system.css" type="text/css" />
<link href="templates/<?php echo  $this->template ?>/css/template.css" rel="stylesheet" type="text/css" />
<link href="templates/<?php echo  $this->template ?>/css/styles.css" rel="stylesheet" type="text/css" />
<link href="templates/<?php echo  $this->template ?>/css/static.layout.css" rel="stylesheet" type="text/css" />
<?php if($this->direction == 'rtl') : ?>
	<link href="templates/<?php echo  $this->template ?>/css/template_rtl.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<?php
$content = file_get_contents(JPATH_SITE.DS.'administrator/templates'.DS.'jentla_flexile'.DS.'params.ini');
$template_params = new JParameter($content);
$restore=$template_params->get("restore");
if($restore==1) {
	$restore_content = file_get_contents(JPATH_SITE.DS.'administrator/templates'.DS.'jentla_flexile'.DS.'restore.ini');
	$template_params = new JParameter($restore_content);
}
?>

<script language='javascript' type='text/javascript'>
var row0hovercolor="<?php echo $template_params->get("articlerow0hover"); ?>";
var row1hovercolor="<?php echo $template_params->get("articlerow1hover"); ?>";
</script>
<?php require("css_styles.php"); ?>
<?php if($this->params->get('useRoundedCorners')) : ?>
	<link rel="stylesheet" type="text/css" href="templates/<?php echo  $this->template ?>/css/rounded.css" />
<?php else : ?>
	<link rel="stylesheet" type="text/css" href="templates/<?php echo  $this->template ?>/css/norounded.css" />
<?php endif; ?>
<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/menu.js"></script>
<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/index.js"></script>
<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/functions.js"></script>
<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/scripts.js"></script>
<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/curvy.corners.trunk.js"></script>
<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/mce.js"></script>

<!--[if gte IE 7]>
<link href="templates/<?php echo  $this->template ?>/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if gte IE 8]>
<link href="templates/<?php echo  $this->template ?>/css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="templates/<?php echo  $this->template ?>/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body id="minwidth-body">
	<div id='minwidth-container'>
	<div id="border-top" class="<?php echo $this->params->get('headerColor','green');?>">
			<span class="title"><img src='templates/<?php echo  $this->template ?>/images/mini_icon.png' align='absmiddle'>&nbsp;<?php echo $this->params->get('showSiteName') ? $mainframe->getCfg( 'sitename' ) : JText::_('Administration'); ?></span>
			<span class="preview"><a href="<?php echo JURI::root();?>" target="_blank"><?php echo JText::_('Preview');?></a></span>
			<span id="module-status" class="version">
			<?php 
				$query = 'SELECT COUNT(*)'
				. ' FROM #__messages'
				. ' WHERE state = 0'
				. ' AND user_id_to = '.(int) $user->get('id');
				$db->setQuery( $query );
				$unread = $db->loadResult();
				$inboxLink = '<a href="index.php?option=com_messages">';
				if ($unread)echo  $inboxLink.'<span class="unread-messages"><span class="no-of-msgs">'.$unread.'</span><img src="templates/jentla_flexile/images/menu/mailbox.png" /></span></a>';
				else echo  $inboxLink.'<span class="no-unread-messages"><span class="no-of-msgs">'.$unread.'</span><img src="templates/jentla_flexile/images/menu/mailbox.png" /></span></a>';
			?>
<!--			<span class="help_img"><a href="index.php?option=com_admin&task=help"><img src='templates/jentla_flexile/images/menu/help.png' /></a></span> -->
			<span class="logout"><a href="index.php?option=com_login&amp;task=logout"><?php echo JText::_('Logout');?></a></span>
			</span>
	</div>
	<div id="content-box" style='height:100%;'>
		<div class="border" style='height:100%;'>
			<div class="padding">
				<div id="toolbar-box">
			<div class="m">
				<div class="clr"></div>
			</div>
			</div>
  		</div>
   		<div class="clr"></div>
		<div id='toolbar-strip' style='width:100%;white-space:nowrap;height:30px;border-top:3px solid #1A77BA;'></div>
		<div id="element-box" style='height:100%;'>
			<div class="clr"></div>
			<div class="m" style='height:100%;'>
				<div id='content-left'>
				<?php require("templates/" . $this->template . "/admin/modules/mod_jentla_toolbar.php");?>
				<?php 
						require("templates/" . $this->template . "/admin/modules/mod_jentla_adminmenu.php");
						$query = 'SELECT COUNT( session_id ) FROM #__session  WHERE username!="" and client_id = 0';
						$db->setQuery($query);
						$online_f_num = intval( $db->loadResult() );
						$query = 'SELECT COUNT( session_id ) FROM #__session  WHERE username!="" and client_id = 1';
						$db->setQuery($query);
						$online_b_num = intval( $db->loadResult() );
				?>
				<div class="clr"></div>
				<div class='fe'>
					<div class='corner'>
						<?php echo "Logged in users"; ?>
						<div><?php  echo $online_f_num; ?></div>
					</div>
				</div>
				<div class="clr"></div>
				<div class='be'>
					<div class='corner'>
						<?php echo "Logged in admin users"; ?>	
						<div><?php echo $online_b_num; ?></div>
					</div>
				</div>
				</div>
				<div id='content-content'>
				<jdoc:include type="message" />
				<?php if (!JRequest::getInt('hidemainmenu')): ?>
				<jdoc:include type="modules" name="submenu" style="rounded" id="submenu-box" />
				<?php endif; ?>
				<div id='searchHider'  style='position:absolute;top:0px;width:100%;height:65px;z-index:9999;background:#fff;'>&nbsp;</div>
				<jdoc:include type="component" />
				</div>
				<div class="clr"></div>
				<div class="clear:both"></div>
			</div>
   		</div>
		<noscript>
			<?php echo  JText::_('WARNJAVASCRIPT') ?>
		</noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
	<div id='adminListFunctions' style='position:absolute;display:none;width:190px;'>
		<div id='editicondiv' style='float:left;cursor:pointer;'><img src='templates/jentla_flexile/icons/edit_black.gif'/><a id='editicon'>Edit</a></div><div id='deleteicondiv' style='float:left;'><img src='templates/jentla_flexile/icons/delete_black.gif'/><a id='deleteicon'>Delete</a></div>
	</div>
	<div id='selectBoxesList' style='width:0px;height:0px;'></div>	
	<?php
	$content = file_get_contents(JPATH_SITE.DS.'administrator/templates'.DS.'jentla_flexile'.DS.'params.ini');
$template_params = new JParameter($content);
$value=$template_params->get("showicons",0);
echo '<script language="javascript">';
echo 'var showicons= '.$value.';';
echo "var FlexileSlideList = Array();";
echo '</script>';
?>
</div>
<script language='javascript'>
window.onbeforeunload=function(e){
	if($$('#toolbar li ul').getStyle("visibility")=='visible'){
		$('ajaxLoadPrepare').style.top = "120px";
		$('ajaxLoadPrepare').style.right = "90px";
		$$('#toolbar li ul').setStyle("visibility","visible");
		$('ajaxLoadPrepare').style.textAlign = "right";
		$('ajaxLoadPrepare').style.display = "";
		$('ajaxLoadPrepare').style.visibility = "visible";
		$('ajaxLoadPrepare').style.opacity = "1";
		$('ajaxLoadPrepare').style.filter="alpha(opacity=1)";
	}
	in1=setInterval("HideLoading()",500);
}
window.addEvent("load",function(){
	if(window.innerHeight){
		if($('content-left').offsetHeight<=window.innerHeight){
			$('content-left').style.height = (window.innerHeight - 69) + "px";
		}
	}else{
		if($('content-left').offsetHeight<=document.body.clientHeight){
			$('content-left').style.height = (document.body.clientHeight - 69) + "px";
		}
	}
	$('searchHider').parentNode.removeChild($('searchHider'));
	HideLoading();
	if(typeof(editorIconsHide)=='function'){
		editorIconsHide();
	}
});
if (navigator.userAgent.toLowerCase().indexOf("chrome") >= 0) {
    $(window).load(function(){
        $('input:-webkit-autofill').each(function(){
            var text = $(this).val();
            var name = $(this).attr('name');
            $(this).after(this.outerHTML).remove();
            $('input[name=' + name + ']').val(text);
        });
    });
}
</script>
</body>
</html>