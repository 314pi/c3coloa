<?php
/**
 * Plugin Helper File
 *
 * @package			Advanced Module Manager
 * @version			2.2.7
 *
 * @author			Peter van Westen <peter@nonumber.nl>
 * @link			http://www.nonumber.nl
 * @copyright		Copyright © 2011 NoNumber! All Rights Reserved
 * @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die();

/**
 * Plugin that gives advanced features for modules
 */
class plgSystemAdvancedModulesHelper
{
	/*
	 * Replace links to com_modules with com_advancedmodules
	 */
	function onAfterRender()
	{
		JResponse::setBody( preg_replace( '#(option=com_)(modules[^a-z-_])#', '\1advanced\2', JResponse::getBody() ) );
	}

	function xupdateParams( $id, $params )
	{
		$db =& JFactory::getDBO();

		$assignto_menuitems = 1;
		$selection = array();

		if ( $params ) {
			if ( strpos( $params, 'assignto_' ) === false ) {
				$params = str_replace( 'limit_', 'assignto_', $params ); // fix old param names

				$query = 'UPDATE #__advancedmodules'
					.' SET params = '.$db->quote( $params )
					.' WHERE moduleid = '.(int) $id;
				$db->setQuery( $query );
				$db->query();
			}

			$db->setQuery( 'show tables like '.$db->quote( $db->getPrefix().'advancedmodules_menu' ) );
			$exists = $db->loadResult();
			if ( $exists ) {
				$assignto_menuitems = 2;
				$query = 'SELECT menuid AS value'
					.' FROM #__advancedmodules_menu'
					.' WHERE moduleid = '.(int) $id;
				$db->setQuery( $query );
				$selection = $db->loadResultArray();
			}
		}

		if ( empty( $selection ) ) {
			$assignto_menuitems = 1;
			$query = 'SELECT menuid AS value'
				.' FROM #__modules_menu'
				.' WHERE moduleid = '.(int) $id;
			$db->setQuery( $query );
			$selection = $db->loadResultArray();
			if ( !empty( $selection ) == 1 && $selection['0'] == 0 ) {
				$assignto_menuitems = 0;
			}
		}

		$params .= "\nassignto_menuitems=".$assignto_menuitems."\nassignto_menuitems_selection=".implode( '|', $selection );
		$query = 'REPLACE INTO #__advancedmodules'
			.' ( `moduleid`, `params` ) VALUES'
			.' ( '.(int ) $id.', '.$db->quote( trim( $params ) ).' )';
		$db->setQuery( $query );
		$db->query();

		return trim( $params );
	}
}