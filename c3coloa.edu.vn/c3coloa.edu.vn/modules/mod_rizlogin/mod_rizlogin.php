<?php/*** Module RizVN Login* @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.* @license		GNU/GPL, see LICENSE.php* Joomla! is free software. This version may have been modified pursuant* to the GNU General Public License, and as distributed it includes or* is derivative of works licensed under the GNU General Public License or* other free or open source software licenses.* See COPYRIGHT.php for copyright notices and details.*/// no direct accessdefined('_JEXEC') or die('Restricted access');
JHTML::_( 'behavior.mootools' );
$document = &JFactory::getDocument();
$document->addScript(JURI::base().'modules/mod_rizlogin/js/jquery.min.js');
$document->addScript(JURI::base().'modules/mod_rizlogin/js/jquery-ui.min.js');
$document->addScript(JURI::base().'modules/mod_rizlogin/js/side-bar.js');
$document->addStyleSheet(JURI::base().'modules/mod_rizlogin/css/style.css');
// Include the syndicate functions only oncerequire_once (dirname(__FILE__).DS.'helper.php');$params->def('greeting', 1);$type 	= modRizLoginHelper::getType();$return	= modRizLoginHelper::getReturnURL($params, $type);$user =& JFactory::getUser();require(JModuleHelper::getLayoutPath('mod_rizlogin'));