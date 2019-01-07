<?php

/**
 * Rquotes default layout file
 * This file includes quotation marks before and after quote
 * @package    Joomla.Rquotes
 * @subpackage Modules
 * @link www.mytidbits.us
 * @license		GNU/GPL-2
 */

 //no direct access
 defined('_JEXEC') or die('Restricted access');

$quotemarks= $params->get('quotemarks'); 
if($quotemarks)
{
 echo $rquote->quote ;
 
 }
else
{
?>" <?php
 echo $rquote->quote; 
 ?> " <?php
}
?>
<p align="right"><?php echo $rquote->author ?></p>
<br />


