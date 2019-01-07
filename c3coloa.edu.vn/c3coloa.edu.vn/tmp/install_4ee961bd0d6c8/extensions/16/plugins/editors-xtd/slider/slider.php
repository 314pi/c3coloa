<?php
/**
 * Main Plugin File
 * Does all the magic!
 *
 * @package     Slider editor button
 * @version     1.7.1
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright © 2011 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die();

// Import library dependencies
jimport( 'joomla.plugin.plugin' );

/**
** Plugin that places the button
*/
class plgButtonSlider extends JPlugin
{
	/**
	* Display the button
	*
	* @return array A two element array of ( imageName, textToInsert )
	*/
	function onDisplay( $name )
	{
		jimport( 'joomla.filesystem.file' );

		// return if system plugin is not installed
		if ( !JFile::exists( JPATH_PLUGINS.'/system/'.$this->_name.'/'.$this->_name.'.php' ) ) {
			return;
		}

		// return if NoNumber! Framework plugin is not installed
		if ( !JFile::exists( JPATH_PLUGINS.'/system/nnframework/nnframework.php' ) ) {
			return;
		}

		// load the admin language file
		$lang =& JFactory::getLanguage();
		if ( $lang->getTag() != 'en-GB' ) {
			// Loads English language file as fallback (for undefined stuff in other language file)
			$lang->load( 'plg_'.$this->_type.'_'.$this->_name, JPATH_ADMINISTRATOR, 'en-GB' );
		}
		$lang->load( 'plg_'.$this->_type.'_'.$this->_name, JPATH_ADMINISTRATOR, null, 1 );

		// Load system plugin parameters
		require_once JPATH_PLUGINS.'/system/nnframework/helpers/parameters.php';
		$parameters =& NNParameters::getParameters();
		$system_params = JPluginHelper::getPlugin( 'system', $this->_name );
		$params = $parameters->getParams( $system_params->params, JPATH_PLUGINS.'/system/'.$this->_name.'/'.$this->_name.'.xml' );

		// Include the Helper
		require_once JPATH_PLUGINS.'/'.$this->_type.'/'.$this->_name.'/helper.php';
		$class = get_class( $this ).'Helper';
		$this->helper = new $class( $params );

		return $this->helper->render( $name );
	}
}