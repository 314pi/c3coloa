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


//bold
//italic
//strikethrough
//justifyleft
//justifycenter
//justifyright
//bullist
//numlist
//outdent
//indent
//undo
//redo
//removeformat
//cleanup
//sub
//sup
//charmap
//formatSelect

function editorIconsHide(){
var flag=0;
textarea=document.getElementsByTagName("textarea");
	for(var i=0;i<textarea.length;i++){
		if(textarea[i].className=="mce_editable"){
			flag=1;
		}
	}

if(flag==1){
	if($('editor-xtd-buttons')){ 
		var editor=tinyMCE.settings.editor_selector;
		textarea=document.getElementsByTagName("textarea");
		for(var i=0;i<textarea.length;i++){
			if(textarea[i].className.match(editor)){
			    var button=textarea[i].id;
			}
		}
		var button=button+"_";
		/*if(!$(button+'bold')){
			var button="mce_editor_0_";
		}*/
		var dropdown=new Array("select_text","Select","select");
		var separator=new Array("mceSeparatorLine","mceSeparator");
		var tableselect=new Array("select","select_text");
		if (document.getElementsByClassName == undefined) {
			document.getElementsByClassName = function(className)
			{
			    var hasClassName = new RegExp("(?:^|\\s)" + className + "(?:$|\\s)");
			    var allElements = document.getElementsByTagName("*");
			    var results = [];
			    var element;
				for (var i = 0; (element = allElements[i]) != null; i++) {
					var elementClass = element.className;
					if (elementClass && elementClass.indexOf(className) != -1 && hasClassName.test(elementClass))
					results.push(element);
				}
				return results;
			}
		}
		var iconids=new Array("underline","justifyfull","link","unlink","anchor","image","code","search","replace","insertdate","inserttime","emotions","media","ltr","rtl","insertlayer","moveforward","movebackward","absolute","forecolor","hr","visualaid","advhr","table","row_props","cell_props","row_before","row_after","delete_row","col_before","col_after","delete_col","split_cells","merge_cells","fullscreen","styleprops","help","newdocument","pasteword","pastetext","backcolor_action","cut","copy","paste_action","preview","delete_table","table_props","print","nonbreaking","visualchars","cite","abbr","acronym","del","ins","attribs","imgmanager","advlink","spellchecker_action","advcode","readmore","pagebreak","backcolor_open","styleselect_open","paste_open","spellchecker_open","fontselect_open","fontsizeselect_open");
		for(var i=0;i<iconids.length;i++){
			if($(button+iconids[i])){
			    document.getElementById(button+iconids[i]).style.display="none";
			}
		}
		for(var i=0;i<separator.length;i++){
			var a=document.getElementsByClassName(separator[i]);
			for(i=0;i<a.length;i++){
				a[i].style.display="none";
			}
		}
		for(var i=0,j=0;i<=dropdown.length,j<tableselect.length;i++,j++){
				if($(button+'font'+dropdown[i])){
					if(button+'style'+dropdown[i])document.getElementById(button+'style'+dropdown[i]).style.display="none";
					if(button+'font'+dropdown[i])document.getElementById(button+'font'+dropdown[i]).style.display="none";
                    if(button+'fontsize'+dropdown[i])document.getElementById(button+'fontsize'+dropdown[i]).style.display="none";
				}else if($(button+'fontName'+dropdown[i])){
					if(button+'style'+dropdown[i])document.getElementById(button+'style'+dropdown[i]).style.display="none";
					if(button+'font'+dropdown[i])document.getElementById(button+'fontName'+dropdown[i]).style.display="none";
                    if(button+'fontsize'+dropdown[i])document.getElementById(button+'fontsize'+dropdown[i]).style.display="none";
				}
				var seperatorline1=new Element('span',{'class':'mceSeparator'});
				var seperatorline2=new Element('span',{'class':'mceSeparator'});
				var seperatorline3=new Element('span',{'class':'mceSeparator'});
				var seperatorline4=new Element('span',{'class':'mceSeparator'});
				var seperatorline5=new Element('span',{'class':'mceSeparator'});
				var seperatorline6=new Element('span',{'class':'mceSeparator'});
				if($(button+'toolbar1')){
					var span = new Element('div', {'class': 'spanbutton','id': 'spanbutton'});
					span.inject($(button+'toolbar1'),'before');
					var spantd=new Element('td',{'id':'spantd',styles:{border:'none'}});
					spantd.injectInside($('spanbutton'));
					if($(button+'format'+tableselect[i])){
						if(tableselect[i]=="select_text"){
						}else{
							$(button+'format'+tableselect[i]).inject($('spanbutton'),'before');
						}
					}else{
                        if($(button+'format'+dropdown[i])){
                            $(button+'format'+dropdown[i]).inject($('spanbutton'),'before');
                            $(button+'formatselect_open').style.display="block";
                            $(button+'format'+dropdown[i]).inject($('spanbutton'),'before');
                        }
                    }
					for(var j=1;j<=4;j++){
						if($(button+'toolbar'+[j])){
							$(button+'toolbar'+[j]).style.display="none";
						}
					}
				}else if(button+'toolbar'){
					var span = new Element('div', {'class': 'spanbutton','id': 'spanbutton'});
					span.inject($(button+'toolbar'),'before');
					var spantd=new Element('td',{'id':'spantd',styles:{border:'none'}});
					spantd.injectInside($('spanbutton'));
					if($(button+'format'+tableselect[i])){
						$(button+'format'+tableselect[i]).inject($('spanbutton'),'before');
					}else{
						$(button+'format'+dropdown[i]).inject($('spanbutton'),'before');
					}
				}
            if($(button+'bold'))$(button+'bold').injectInside($('spantd'));
			if($(button+'italic'))$(button+'italic').injectInside($('spantd'));
            if($(button+'strikethrough'))$(button+'strikethrough').injectInside($('spantd'));
			seperatorline1.injectInside($('spantd'));
            if($(button+'justifyleft'))$(button+'justifyleft').injectInside($('spantd'));
			if($(button+'justifycenter'))$(button+'justifycenter').injectInside($('spantd'));
			if($(button+'justifyright'))$(button+'justifyright').injectInside($('spantd'));
			seperatorline2.injectInside($('spantd'));
			if($(button+'bullist'))$(button+'bullist').injectInside($('spantd'));
			if($(button+'numlist'))$(button+'numlist').injectInside($('spantd'));
			seperatorline3.injectInside($('spantd'));
			if($(button+'outdent'))$(button+'outdent').injectInside($('spantd'));
			if($(button+'indent'))$(button+'indent').injectInside($('spantd'));
			seperatorline4.injectInside($('spantd'));
			if($(button+'undo'))$(button+'undo').injectInside($('spantd'));
			if($(button+'redo'))$(button+'redo').injectInside($('spantd'));
			if($(button+'cleanup'))$(button+'cleanup').injectInside($('spantd'));
			if($(button+'removeformat'))$(button+'removeformat').injectInside($('spantd'));
			seperatorline5.injectInside($('spantd'));
			if($(button+'sub'))$(button+'sub').injectInside($('spantd'));
			if($(button+'sup'))$(button+'sup').injectInside($('spantd'));
			if($(button+'charmap')){
                seperatorline6.injectInside($('spantd'));
                $(button+'charmap').injectInside($('spantd'));
            }
			if($('editor-xtd-buttons')) $('editor-xtd-buttons').inject($(button+'parent'),'before');
		}
	}	
	if(typeof(dropdown)!='undefined')
	for(var i=0,j=0;i<=dropdown.length,j<tableselect.length;i++,j++){
            if($(button+'format'+dropdown[i])){
                $(button+'format'+dropdown[i]).style.styleFloat="left";
            }
        }
	if($(button+"toolbar"))$(button+"toolbar").style.display="none";
}
	if($('editor-xtd-buttons')){
			$('editor-xtd-buttons').inject($(button.replace("_","")),'before');
			if(typeof(document.getElementById('text_tbl'))!='undefined' && $('text_tbl')!=null){
				$('editor-xtd-buttons').getNext().style.width="98%";
				$('text_tbl').style.width = "98%";
			}
	}
}
