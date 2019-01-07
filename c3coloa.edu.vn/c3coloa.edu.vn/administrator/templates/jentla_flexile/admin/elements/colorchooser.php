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

defined('JPATH_BASE') or die();
/**
 * @package     jentla_flexile
 * @subpackage  admin.elements
 */
class JElementColorChooser extends JElement {
	

	function fetchElement($name, $value, &$node, $control_name)
	{
		//global $stylesList;
        /**
         * @global Flexile $flexile
         */
		global $flexile,$mainframe;
		$output = '';
		$template	= "jentla_flexile";
		$flexile->templatePath = "administrator/templates/" . $template;

		$flexile->flexileUrl = "administrator/templates/" . $template;
		$flexile->platform->jslib = "mootools";
		$flexile->platform->jslib_version = "1.1";
		$this->template = end(explode(DS, $flexile->templatePath));
		
		//$styles = '../templates/'.$this->template.'/styles.php';
		//if (file_exists($styles)) include_once($styles);
		//else return "No styles file found";

        if (!defined('FLEXILE_CSS')) {
			JHTML::stylesheet( 'jentla_flexile.css', $flexile->flexileUrl.'/admin/widgets/');
			//flexile_addStyle($flexile->flexileUrl.'/admin/widgets/flexile.css');
			define('FLEXILE_CSS', 1);
		}
		
		$document =& JFactory::getDocument();
		if (!defined('FLEXILE_MOORAINBOW')) {
			JHTML::script( 'jentla_flexile.js', $flexile->flexileUrl.'/admin/widgets/');
			JHTML::stylesheet( 'mooRainbow.css', $flexile->flexileUrl.'/admin/widgets/colorchooser/css/');
			JHTML::script( 'mooRainbow.js', $flexile->flexileUrl.'/admin/widgets/colorchooser/js/');
			//$document->addScript($flexile->flexileUrl.'/admin/widgets/colorchooser/js/mooRainbow.js');
			//flexile_addStyle($flexile->flexileUrl.'/admin/widgets/colorchooser/css/mooRainbow.css');
			//flexile_addScript($flexile->flexileUrl.'/admin/widgets/colorchooser/js/mooRainbow.js');
			
			//$scriptconfig  = $this->populateStyles($stylesList);
			//$scriptconfig = $this->rainbowInit();
			
			//$document->addScriptDeclaration($scriptconfig);
			//flexile_addInlineScript($scriptconfig);
			
			define('FLEXILE_MOORAINBOW',1);
		}
	
		$scriptconfig = $this->newRainbow($name);
		$document->addScriptDeclaration($scriptconfig);
		//flexile_addInlineScript($scriptconfig);
		
		$output .= "<style>span.textboxleft{display:none;}</style><div style='z-index:0;display:inline;overflow:hidden;zoom:1;'><input class=\"inputbox\" id=\"".$control_name.$name."\" name=\"".$control_name."[".$name."]\" type=\"text\" size=\"7\" maxlength=\"11\" value=\"".$value."\" style=\"float:left;\"/></div>";
		$output .= "<div class='wrapper'>";		
$output .= "<div class=\"picker\" id=\"myRainbow_".$name."_input\"><div class=\"overlay".(($value == 'transparent') ? ' overlay-transparent' : '')."\"><img src=\"".JURI::base()."templates/jentla_flexile/admin/widgets/colorchooser/images/rainbow_sel_new.png\" width=0 height=0 id=\"coloricon\">\n";
		$output .= "</div>";
		//$output = false;
		
		return $output;
	}
	
	function newRainbow($name)
	{
        global $flexile;

        $name2 = str_replace("-", "_", $name);

		$mt = ($flexile->platform->jslib == 'mootools' && $flexile->platform->jslib_version == '1.1');
		$dollar = $mt ? "$" : "document.id";
		$getValue = $mt ? "getValue()" : "get('value')";

		return "
		var r_".$name2.";

		window.addEvent('domready', function() {
			var input = ".$dollar."('params".$name."');
try{
			r_".$name2." = new MooRainbow('myRainbow_".$name."_input', {
				id: 'myRainbow_".$name."',
				startColor: $('params".$name."').".$getValue.".hexToRgb(true) || [255, 255, 255],
				imgPath: '../".$flexile->flexileUrl."/admin/widgets/colorchooser/images/',
				onChange: function(color) {
					input.value = color.hex;
				}
			});
}catch(e){
return;
}
			
			r_".$name2.".okButton.setStyle('outline', 'none');
			".$dollar."('myRainbow_".$name."_input').addEvent('click', function() {
				(function() {r_".$name2.".okButton.focus()}).delay(10);
			});
			input.addEvent('keyup', function(e) {
				if (e) e = new Event(e);
				if ((this.value.length == 4 || this.value.length == 7) && this.value[0] == '#') {
					var rgb = new Color(this.value);
					var hex = this.value;
					var hsb = rgb.rgbToHsb();
					var color = {
						'hex': hex,
						'rgb': rgb,
						'hsb': hsb
					}
					r_".$name2.".fireEvent('onChange', color);
					r_".$name2.".manualSet(color.rgb);
				};
			}).addEvent('set', function(value) {
				this.value = value;
				this.fireEvent('keyup');
			});
		});\n";
	}	
}
?>
