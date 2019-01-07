<?php 
defined('_JEXEC') or die('Restricted access'); 

require_once( JPATH_COMPONENT.DS.'controller.php' );

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS. 'com_rquotes'.DS.'tables'); 
		

$controller = new RquoteController(); 
$controller->execute( JRequest::getVar( 'task' ) ); 
$controller->redirect(); 

?> 
