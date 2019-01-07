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
// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

//Register the session storage class with the loader
JLoader::register('JButton', JPATH_BASE.DS.'libraries'.DS.'joomla'.DS.'html'.DS.'toolbar'.DS.'button.php');

/**
 * ToolBar handler
 *
 * @author 		Louis Landry <louis.landry@joomla.org>
 * @package 	Joomla.Framework
 * @subpackage	HTML
 * @since		1.5
 */
class JToolBars extends JObject
{
	/**
	 * Toolbar name
	 *
	 * @access	private
	 * @var		string
	 */
	var $_name = array ();

	/**
	 * Toolbar array
	 *
	 * @access	private
	 * @var		array
	 */
	var $_bar = array ();

	/**
	 * Loaded buttons
	 *
	 * @access	private
	 * @var		array
	 */
	var $_buttons = array ();

	/**
	 * Directories, where button types can be stored
	 *
	 * @access	private
	 * @var		array
	 */
	var $_buttonPath = array ();

	/**
	 * Constructor
	 *
	 * @access protected
	 * @param string The toolbar name
	 * @var string The type of setup file
	 */
	function __construct($name = 'toolbar')
	{
		$this->_name = $name;

		// Set base path to find buttons
		$this->_buttonPath[] = JPATH_BASE.DS.'libraries'.DS.'joomla'.DS.'html'.DS.'toolbar'.DS.'button';

	}

	/**
	 * Returns a reference to a global JToolBar object, only creating it if it
	 * doesn't already exist.
	 *
	 * This method must be invoked as:
	 * 		<pre>  $toolbar = & JToolBar::getInstance( $name );</pre>
	 *
	 * @access	public
	 * @param	string		$name  The name of the toolbar.
	 * @return	JToolBar	The JToolBar object.
	 */
	function & getInstance($name = 'toolbar')
	{
		static $instances;

		if (!isset ($instances)) {
			$instances = array ();
		}

		if (empty ($instances[$name])) {
			$instances[$name] = new JToolBars($name);
		}

		return $instances[$name];
	}

	/**
	 * Set a value
	 *
	 * @access	public
	 * @param	string	The name of the param
	 * @param	string	The value of the parameter
	 * @return	string	The set value
	 */
	function appendButton()
	{
		// Push button onto the end of the toolbar array
		$btn = func_get_args();
		array_push($this->_bar, $btn);
		return true;
	}

	/**
	 * Get a value
	 *
	 * @access	public
	 * @param	string	The name of the param
	 * @param	mixed	The default value if not found
	 * @return	string
	 */
	function prependButton()
	{
		// Insert button into the front of the toolbar array
		$btn = func_get_args();
		array_unshift($this->_bar, $btn);
		return true;
	}

	/**
	 * Render
	 *
	 * @access	public
	 * @param	string	The name of the control, or the default text area if a setup file is not found
	 * @return	string	HTML
	 */
	/*function render()
	{
		$html = array ();

		// Start toolbar div
		$html[] = '<div class="toolbar" id="'.$this->_name.'">';
		$html[] = '<table class="toolbar"><tr>';
		//$html[] = '<ul id="toolbar">';

		// Render each button in the toolbar
		foreach ($this->_bar as $button) {
			//print_r(strip_tags($this->renderButton($button),"<a><span>"));echo "<br>";
			$html[] = $this->renderButton($button);
			//$html[] = str_replace(array("<td ","</td>"),array("<li ","</li>"),$this->renderButton($button));
		}

		// End toolbar div
		$html[] = '</tr></table>';
		//$html[] = '</ul>';
		$html[] = '</div>';

		return implode("\n", $html);
	}*/

	function render()
	{
		$html = array ();

		// Start toolbar div
		$style = "";
		if(count($this->_bar)<=0)$style='visibility:hidden;';
		$html[] = '<div class="toolbar" style="display:none;' . $style . '">';
		$html[] = '<ul  id="'.$this->_name.'">';
		$html[] = '<li class="toolbarHeading">';
		$html[] = '<img src="'.JURI::base().'templates/jentla_flexile/images/toolbar/spanner_sel_new.png" width="0" height="0"/>';
		$html[] = '<img src="'.JURI::base().'templates/jentla_flexile/admin/widgets/colorchooser/images/rainbow_sel_new.png" width="0" height="0"/>';
		$html[] = '<ul>';
		
		// Render each button in the toolbar
		$i =0;
		$this->_bar = array_reverse($this->_bar);
		reset($this->_bar);
		while (list(,$button)=each($this->_bar)) {
			/*if($i==0){
				$html[] = '<ul  id="'.$this->_name.'">';
				$html[] = str_replace(array("<td ","</td>","<a ","</a>"),array("<li ","",'<a style="line-height:2.5;"','<img src="templates/jentla_flexile/images/toolbar/dd-arrow.png" width="32px" height="30px" style="position:absolute;right:0;" /></a>'),$this->renderButton($button));
				//$html[] = '<li><a style="line-height:2.5;">OPTIONS</a><img src="templates/jentla_flexile/images/toolbar/dd-arrow.png" width="32px" height="30px" style="float:right;" />';
				
			}else{
				if($i==1)*/
				//$html[] = '<ul>';
				//echo $this->renderButton($button);
				$html[] = str_replace(array("<td ","</td>"),array("<li ","</li>"),$this->renderButton($button));
			//}
			$i++;
		}

		// End toolbar div
		$html[] = '</ul></li></ul>';
		$html[] = '</div>';

		return implode("\n", $html);
	}
	/**
	 * Render a parameter type
	 *
	 * @param	object	A param tag node
	 * @param	string	The control name
	 * @return	array	Any array of the label, the form element and the tooltip
	 */
	function renderButton( &$node )
	{
		// Get the button type
		$type = $node[0];

		$button = & $this->loadButtonType($type);

		/**
		 * Error Occurred
		 */
		if ($button === false) {
			return JText::_('Button not defined for type').' = '.$type;
		}
		return $button->render($node);
	}

	/**
	 * Loads a button type
	 *
	 * @access	public
	 * @param	string	buttonType
	 * @return	object
	 * @since	1.5
	 */
	function & loadButtonType($type, $new = false)
	{
		$false = false;

		$signature = md5($type);
		if (isset ($this->_buttons[$signature]) && $new === false) {
			return $this->_buttons[$signature];
		}

		if (!class_exists('JButton'))
		{
			JError::raiseWarning( 'SOME_ERROR_CODE', 'Could not load button base class.' );
			return $false;
		}

		$buttonClass = 'JButton'.$type;
		if (!class_exists($buttonClass))
		{
			if (isset ($this->_buttonPath)) {
				$dirs = $this->_buttonPath;
			} else {
				$dirs = array ();
			}

			$file = JFilterInput::clean(str_replace('_', DS, strtolower($type)).'.php', 'path');

			jimport('joomla.filesystem.path');
			if ($buttonFile = JPath::find($dirs, $file)) {
				include_once $buttonFile;
			} else {
				JError::raiseWarning('SOME_ERROR_CODE', "Could not load module $buttonClass ($buttonFile).");
				return $false;
			}
		}

		if (!class_exists($buttonClass))
		{
			//return	JError::raiseError( 'SOME_ERROR_CODE', "Module file $buttonFile does not contain class $buttonClass." );
			return $false;
		}
		$this->_buttons[$signature] = new $buttonClass($this);

		return $this->_buttons[$signature];
	}

	/**
	 * Add a directory where JToolBar should search for button types
	 *
	 * You may either pass a string or an array of directories.
	 *
	 * {@link JParameter} will be searching for an element type in the same order you
	 * added them. If the parameter type cannot be found in the custom folders,
	 * it will look in JParameter/types.
	 *
	 * @access	public
	 * @param	string|array	directory or directories to search.
	 * @since	1.5
	 */
	function addButtonPath($path)
	{
		if (is_array($path)) {
			$this->_buttonPath = array_merge($this->_buttonPath, $path);
		} else {
			array_push($this->_buttonPath, $path);
		}
	}
}
