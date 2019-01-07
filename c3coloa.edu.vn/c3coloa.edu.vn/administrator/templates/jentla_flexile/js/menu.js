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
var JMenu = new Class({
	initialize: function(el)
	{	
		var elements = $ES('li', el);
		var nested = null
		var flag=0;
		var root=elements[0];
		root.addEvent('mouseover', function(){ this.addClass('open'); });
		root.addEvent('mouseout', function(){ this.removeClass('open'); });
		
		/*root.addEvent('click', function(){ this.addClass('open');flag=0; });

		$('minwidth-body').addEvent('click', function(){
			if(flag==1){
				if(root.className=="toolbarHeading open"){
		            		root.removeClass('open');
		        	}else{
		            		flag=0;
		        	}
		    	}else{
				flag=1;
			}
		});*/

		 for (var i=1; i<elements.length; i++)
		{
			var element = elements[i];
			element.addEvent('mouseover', function(){this.addClass('hover'); });
			element.addEvent('mouseout', function(){ this.removeClass('hover'); });

			//find nested UL
			nested = $E('ul', element);
			if(!nested) {
				continue;
			}

			//declare width
			var offsetWidth  = 0;

			//find longest child
			for (k=0; k < nested.childNodes.length; k++) {
				var node  = nested.childNodes[k]
				if (node.nodeName == "LI")
					offsetWidth = (offsetWidth >= node.offsetWidth) ? offsetWidth :  node.offsetWidth;
			}
				//match longest child
			for (l=0; l < nested.childNodes.length; l++) {
				var node = nested.childNodes[l]
				if (node.nodeName == "LI") {
					$(node).setStyle('width', offsetWidth+'px');
				}
			}

			$(nested).setStyle('width', offsetWidth+'px');
		}
	}
	
});

function sbmenu(param){
	page=null;
	element = $('config-document');
	elements = element.getElements('div[id^=page-]');
	
		for (i=0; i < elements.length; i++) {
			hide(elements[i]);
		}
	
	element1 = element.getElements('div[id^=page-'+param+']');
	show(element1);
}
function hide(element){

element.setStyle('display', 'none');
}
function show(element){

element.setStyle('display', 'block');
}
function set3rdlevel(element,title){	
	var l=$(document.body).getElements('dd[id^=leftmenu_]').getProperty('id');
	var sel=$(document.body).getElements('dd[id^=leftmenu_]').getProperty('class');
	for(i=0;i<sel.length;i++){
		if(sel[i].search(/ bg/)>=0){
			$(l[i]).removeClass('bg');
		}else if(sel[i].search(/ bgc bg/)>=0){
			$(l[i]).removeClass('bgc bg');
		}
	}
	element.parentNode.className=element.parentNode.className+" bg";
}
