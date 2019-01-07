<?php
/**
 * @version		1.5.4
 * @package		Joomla
 * @subpackage	Rquotes
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
 * @license		GPLv2.0, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

function com_install()
{
	?>
	<div class="header">Congratulations, Your RQUOTES 1.5.4 Component has been installed </div>
	
<p> New to this version:</p>
<p> 1)defaults to published when adding a new item'</p>
<p> 2) Uses the built in Category table with all its benefits.</p>
<p> 3) You will need to create new categories and edit all your items into the 
  new categories.</p>
<p> To get started, navigate to Components, Rquotes, and click on "Manage Categories","New" 
  and enter a name and optional description. Save it and go to "List Quotes","New' 
  and enter your information. All fields are optional. Also, be sure to install 
  the latest version of mod_rquotes ( 1.5.4 available at http://www.mytidbits.us) 
  to promote your Random, Quotes,Riddles,etc throughout your website! </p>
	<?php
}

?>