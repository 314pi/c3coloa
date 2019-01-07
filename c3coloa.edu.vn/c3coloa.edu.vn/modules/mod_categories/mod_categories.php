<?php
/** mod_categories.php 1.5.1
* @copyright Copyright (C) 2007-2008 Boris Komraz. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

/// no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

require_once (dirname(__FILE__).DS.'helper.php');

$categories = new modCategoriesHelper();
$categories->main($params);

?>