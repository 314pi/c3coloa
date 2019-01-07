<?php

 /**
 * Rquotes main file
 * 
 * @package    Joomla.Rquotes
 * @subpackage Modules
 * @link www.mytidbits.us
 * @license		GNU/GPL-2
 */
 
 //no direct access
defined('_JEXEC') or die('Restricted access'); 

// Create functions if neeeded. 
	if(!defined('RQUOTES_LOADED'))
{
	define(@RQUOTES_LOADED, 1);
	//include helper file	
	require(dirname(__FILE__).DS.'helper.php'); 
	error_reporting(0);
}
$source=$params->get('source');
//text file params
$filename=$params->get('filename','rquotes.txt');
$randomtext=$params->get('randomtext');
//database params
$style = $params->get('style', 'default'); 
$category=$params->get('category','');
$rotate = $params->get('rotate');
$num_of_random= $params->get('num_of_random');


switch ($source) 
{
case 'db':
if($rotate=='single_random')
{

 $list = modRquotesHelper::getRandomRquote($category,$num_of_random);

}


elseif($rotate=='multiple_random')
{

 $list = modRquotesHelper::getMultyRandomRquote($category,$num_of_random);

}
elseif($rotate=='sequential') 

{

	$list = modRquotesHelper::getSequentialRquote($category);

}
elseif($rotate=='daily')
{
	$x='j';
	$list= getDailyRquote($category,$x);
	
}

elseif($rotate=='weekly')
{
	$x='W';
	$list= getDailyRquote($category,$x);
	
}
elseif($rotate=='monthly')
{
	$x='n';
	$list= getDailyRquote($category,$x);
	
}
elseif($rotate=='yearly')
{
	$x='y';
	$list= getDailyRquote($category,$x);
	
}
//start

//end
require(JModuleHelper::getLayoutPath('mod_rquotes', $style,'default'));
break;

case 'text':
if (!$randomtext)
{
$list=getTextFile($params,$filename);
}
else
{
$list=getTextFile2($params,$filename);
}
break;
default:
echo('Please choose a text file and Daily or Every page load and save it to display information.');


}
?> 
