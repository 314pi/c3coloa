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
$content = file_get_contents(JPATH_SITE.DS."administrator/templates".DS.'jentla_flexile'.DS.'params.ini');
$template_params = new JParameter($content);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<jdoc:include type="head" />
<style>
input:-webkit-autofill {
    background-color: #fff !important;
	background-image : none !important;
}
</style>

<link rel="stylesheet" href="templates/system/css/system.css" type="text/css" />
<link href="templates/<?php echo $this->template ?>/css/login.css" rel="stylesheet" type="text/css" />
<link href="templates/<?php echo $this->template ?>/css/general.css" rel="stylesheet" type="text/css" />
<link href="templates/<?php echo $this->template ?>/css/static.layout.css" rel="stylesheet" type="text/css" />
<link href="templates/<?php echo $this->template ?>/css/styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/jentla_flexile/js/curvy.corners.trunk.js"></script>
<script type="text/javascript" src="templates/jentla_flexile/js/scripts.js"></script>
<script type="text/javascript" src="templates/jentla_flexile/js/functions.js"></script>
<script type="text/javascript" src="templates/jentla_flexile/js/mce.js"></script>
<!--[if gte IE 7]>
<style>input{line-height:2;}</style>
<![endif]-->
<!--[if gte IE 7]>
<link href="templates/<?php echo  $this->template ?>/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if gte IE 8]>
<link href="templates/<?php echo  $this->template ?>/css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="templates/<?php echo  $this->template ?>/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script>
window.addEvent('domready', function() {
	document.getElementById('loginbody').style.backgroundImage = 'url("<?php echo JURI::base() . "templates/" . $this->template . "/index.php?background=gradient&fadefrom=".substr($template_params->get("loginpagefadefrom"),1,strlen($template_params->get("loginpagefadefrom")))."&fadeout=".substr($template_params->get("loginpagefadeto"),1,strlen($template_params->get("loginpagefadeto")))."&steps=100&width=1&height="?>'+(document.body.offsetHeight+250)+'")';
});
window.onresize = function(){
	document.getElementById('loginbody').style.backgroundImage = 'url("<?php echo JURI::base() . "templates/" . $this->template . "/index.php?background=gradient&fadefrom=".substr($template_params->get("loginpagefadefrom"),1,strlen($template_params->get("loginpagefadefrom")))."&fadeout=".substr($template_params->get("loginpagefadeto"),1,strlen($template_params->get("loginpagefadeto")))."&steps=100&width=1&height="?>'+(document.body.offsetHeight+250)+'")';
}

</script>
<?php  if($this->direction == 'rtl') : ?>
	<link href="templates/<?php echo $this->template ?>/css/login_rtl.css" rel="stylesheet" type="text/css" />
<?php  endif; ?>
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

<!--[if IE 7]>
<link href="templates/<?php echo  $this->template ?>/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="templates/<?php echo  $this->template ?>/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<?php  if($this->params->get('useRoundedCorners')) : ?>
	<link rel="stylesheet" type="text/css" href="templates/<?php echo $this->template ?>/css/rounded.css" />
<?php  else : ?>
	<link rel="stylesheet" type="text/css" href="templates/<?php echo $this->template ?>/css/norounded.css" />
<?php  endif; ?>

<script language="javascript" type="text/javascript">
	function setFocus() {
		document.login.username.select();
		document.login.username.focus();
	}
</script>
</head>
<body onload="javascript:setFocus()" id="loginbody" style='height:90%'>
	<div id="login-border-top" class="<?php echo $this->params->get('headerColor','green');?>">
		<div>
			<div>
				<span class="title"><?php //echo $this->params->get('showSiteName') ? $mainframe->getCfg( 'sitename' ) : JText::_('Administration'); ?></span>
			</div>
		</div>
	</div>
		<table class="logintab" border="0" cellspacing="0" cellpadding="0">
	<tr><td>
	<div id="content-box">
			<div class="padding">
			<div id="element-box" class="login">
						<div class="t">
					<div class="t">
						<div class="t"></div>
					</div>
				</div>
				<div class="m">
					<div id="joomla"><?php echo JText::_('Joomla! Administration Login') ?></div>
					<jdoc:include type="message" />
					<jdoc:include type="component" />
					
					<div id="lock"></div>
					<div class="des"><?php echo JText::_('DESCUSEVALIDLOGIN') ?><p></p><a href="<?php echo JURI::root(); ?>"><?php echo JText::_('Return to site Home Page') ?></a></div>
					
					<div class="clr"></div>
				</div>
				<div class="b">
					<div class="b">
						<div class="b"></div>
					</div>
				</div>
			</div>
			<noscript>
				<?php echo JText::_('WARNJAVASCRIPT') ?>
			</noscript>
			<div class="clr"></div>
		</div>
	</div>
	</td></tr>
	</table>

	<div id='selectBoxesList' style='width:0px;height:0px;'></div>
	<!--<div id="border-bottom"><div><div></div></div>-->
<!--</div>-->
<div id="footer">
	<p class="copyright">
		<a href="http://www.joomla.org" target="_blank">Joomla!</a>
		<?php echo JText::_('ISFREESOFTWARE') ?>
	</p>
</div>
<script language='javascript'>
window.addEvent('domready', function() {
	if($('openid-link')){
		$('openid-link').getNext().setStyle("float","left");
		$('openid-link').getNext().setStyle("margin-top","11px");
		$('openid-link').getNext().setStyle("margin-left","40px");
	}
	if (navigator.userAgent.toLowerCase().indexOf("chrome") < 0)return;
	var usr = $('form-login-password').clone();
	var pass = $('form-login-username').clone();
	$('form-login').removeChild($('form-login-password'));
	$('form-login').removeChild($('form-login-username'));
	usr.inject($("form-login"),"top");
	pass.inject($("form-login"),"top");
});
</script>
</body>
</html>
