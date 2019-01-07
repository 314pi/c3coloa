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
defined( '_JEXEC' ) or die( 'Restricted access' );
$db = JFactory::getDBO();
$user		=& JFactory::getUser();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo  $this->language; ?>" lang="<?php echo  $this->language; ?>" dir="<?php echo  $this->direction; ?>" id="minwidth" >
<head>
<jdoc:include type="head" />
<?php
$content = file_get_contents(JPATH_SITE.DS.'administrator/templates'.DS.'jentla_flexile'.DS.'params.ini');
$template_params = new JParameter($content);
$restore=$template_params->get("restore");

if($restore==1) {
	$restore_content = file_get_contents(JPATH_SITE.DS.'administrator/templates'.DS.'jentla_flexile'.DS.'restore.ini');
	$template_params = new JParameter($restore_content);
}
?>
<?php require("css_styles.php"); ?>
<link rel="stylesheet" href="templates/system/css/system.css" type="text/css" />
<link href="templates/<?php echo  $this->template ?>/css/template.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/functions.js"></script>
<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/scripts.js"></script>
<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/curvy.corners.trunk.js"></script>
<link href="templates/<?php echo  $this->template ?>/css/styles.css" rel="stylesheet" type="text/css" />
<?php if($this->direction == 'rtl') : ?>
	<link href="templates/<?php echo  $this->template ?>/css/template_rtl.css" rel="stylesheet" type="text/css" />
<?php endif; ?>

<!--[if gte IE 7]>
<link href="templates/<?php echo  $this->template ?>/css/ie7.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/curvy.corners.trunk.js"></script>
<![endif]-->

<!--[if lte IE 6]>
<link href="templates/<?php echo  $this->template ?>/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<?php if($this->params->get('useRoundedCorners')) : ?>
	<link rel="stylesheet" type="text/css" href="templates/<?php echo  $this->template ?>/css/rounded.css" />
<?php else : ?>
	<link rel="stylesheet" type="text/css" href="templates/<?php echo  $this->template ?>/css/norounded.css" />
<?php endif; ?>

<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/menu.js"></script>
<script type="text/javascript" src="templates/<?php echo  $this->template ?>/js/index.js"></script>

</head>
<body id="minwidth-body" class='cpanelbody'>

		<div id="border-top" class="<?php echo $this->params->get('headerColor','green');?>">
		<div>
			<div>
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
					if ($unread)echo  $inboxLink.'<span class="unread-messages"><img src="templates/jentla_flexile/images/menu/mailbox.png" /><span class="no-of-msgs">'.$unread.'</span></span></a>';
					else echo  $inboxLink.'<span class="no-unread-messages"><img src="templates/jentla_flexile/images/menu/mailbox.png" /><span class="no-of-msgs">'.$unread.'</span></span></a>';
				?>
				<!--<jdoc:include type="modules" name="status"  />-->
<!--				<span class="help_img"><a href="index.php?option=com_admin&task=help"><img src='templates/jentla_flexile/images/menu/help.png' /></a></span> -->
				<span class="logout"><a href="index.php?option=com_login&amp;task=logout"><?php echo JText::_('Logout');?></a></span>
			</span>
			</div>
		</div>
	</div>
	<div id="content-box" style='height:100%;'>
		<div class="border" style='height:100%;'>
			<div class="padding" style='height:100%;'>
				<div id="element-box" style='height:100%;'>
					<!--<div class="t">
						<div class="t">
							<div class="t"></div>
						</div>
					</div>-->
				<div class="m" style='height:100%;'>
				<!--<table id='contentTable' width="100%" height='100%' border="0" cellspacing="0" cellpadding="0" style='border-top:3px solid #1A77BA;'> 	
				<tr><td class="lfm">-->
						<div style='float:left;'>
						<div style='float:left;' id='content-left'>
						<?php 
//							<jdoc:include type="modules" name="left" />
								require("templates/" . $this->template . "/admin/modules/mod_jentla_adminmenu.php");
								$db = JFactory::getDBO();
								$query = 'SELECT COUNT( session_id ) FROM #__session  WHERE username!="" and client_id = 0';
								$db->setQuery($query);
								$online_f_num = intval( $db->loadResult() );
								$query = 'SELECT COUNT( session_id ) FROM #__session  WHERE username!="" and client_id = 1';
								$db->setQuery($query);
								$online_b_num = intval( $db->loadResult() );
						?>
						<div class="clr"></div>
						<div class='fe'><div class="corner"><?php echo "Logged in users"; ?>
						<div><?php  echo $online_f_num; ?></div></div>
						</div>
						<div class="clr"></div>
						<div class='be'><div class="corner"><?php echo "Logged in admin users"; ?>	
							<div><?php echo $online_b_num; ?></div></div>
						</div>
						</div>
						<!--</td>
						
						<td class="lfm1">-->
						<div style='margin-left:182px;position:relative;'>
						<jdoc:include type="message" />
						<table class="adminform" style='margin-top:0px;'>
						<tr>
							<td width="55%" valign="top">
								<jdoc:include type="modules" name="icon" />
							</td>
							<td width="45%" valign="top">
								<jdoc:include type="component" />
							</td>
						</tr>
						</table>
						</div>
						<!--</td></tr></table>-->
						<div class="clr"></div>
					</div>
					<div class="b">
						<div class="b">
							<div class="b"></div>
						</div>
					</div>
				</div>
				<noscript>
					<?php echo  JText::_('WARNJAVASCRIPT') ?>
				</noscript>
				<div class="clr"></div>
			</div>
		</div>
	</div>
<script language='javascript'>
window.addEvent('domready', function() {
	if($('content-left').offsetHeight<=window.innerHeight){
		$('content-left').style.height = (window.innerHeight - 30) + "px";
	}
});
</script>
</body>
</html>
