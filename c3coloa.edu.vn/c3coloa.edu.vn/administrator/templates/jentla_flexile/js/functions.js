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


var GlobalFunctions={ind:function(){Random.textbox();Random.dropdown();Random.attrInit();}};

var Random={
	dropdown:function(){
	
		// Dropdown
		span = spanhidden = Array();
		inputs=document.getElementsByTagName("select"); 
		for(a=0,cnt = inputs.length;a<cnt;a++){ 
			inputs[a].className = "inputbox";
			if(inputs[a].size>1){
				inputs[a].style.opacity = 1;
				inputs[a].style.filter = null;
				continue;
			}
			if(inputs[a].className=="inputbox"){
				option=inputs[a].getElementsByTagName("option");
				if(option.length<=0)continue;
				if(option[0].childNodes.length>0){
					active=option[0].childNodes[0].nodeValue;
				}
				textnode=document.createTextNode(active);
				textnode=active;
				for(b=0;b<option.length;b++){
					if(option[b].selected==true){
						if(option[b].childNodes.length<=0)continue;
						textnode=document.createTextNode(option[b].childNodes[0].nodeValue);
						textnode=option[b].childNodes[0].nodeValue;
					}
				}
				var myFirstElement  = new Element('select', {id: 'myselectbox'});
				myFirstElement.innerHTML = inputs[a].innerHTML;
				//myFirstElement.inject($('selectBoxesList'),'top');
				if($(inputs[a].id)==null)inputs[a].id = "inputbox_"+a;
				var clone = $(inputs[a].id).clone().inject($('selectBoxesList'),'top');
				var elementOffset = clone.offsetWidth;
				spanhidden[a]=document.createElement("span");
				spanhidden[a].className="select"; 
				spanhidden[a].id="select"+clone.id; 
				//spanhidden[a].appendChild(textnode);
				spanhidden[a].innerHTML = textnode;
				clone.parentNode.insertBefore(spanhidden[a],clone);
				var elehidden = new Element('span', {id: spanhidden[a].id+'right'});
				elehidden.className=spanhidden[a].className+'right';
				elehidden.style.paddingRight = (elementOffset+2)+"px";
				spanhidden[a].parentNode.insertBefore(elehidden,spanhidden[a]);
				var spanOffset = spanhidden[a].offsetWidth;
				$('selectBoxesList').innerHTML = "";

				span[a]=document.createElement("span");
				span[a].className="select";
				span[a].id="select"+inputs[a].name;
				if(parseInt(elementOffset-26)>0)span[a].style.width = (elementOffset-26)+"px";
				//alert(textnode.data);
				span[a].innerHTML = textnode;
				//span[a].appendChild(textnode);
				span[a].style.paddingRight = "0px";
				inputs[a].parentNode.insertBefore(span[a],inputs[a]);
				var ele = new Element('span', {id: span[a].id+'right'});
				ele.className=span[a].className+'right';
				ele.style.paddingRight = (elementOffset+5)+"px";
				span[a].parentNode.insertBefore(ele,span[a]);
				var width = (elementOffset-spanOffset-24); 
				if(width<0)width = 0;
				width = width+"px";
				$(span[a].id+'right').adopt($(span[a].id));
				inputs[a].alt = inputs[a].getAttribute("onchange");
				if(inputs[a].alt==null || inputs[a].alt=='null')inputs[a].alt = inputs[a].onchange;
				inputs[a].onchange = function(){
					var je=location.href;
					var jentlasite=/getJentlaSite/;
					if(je.match(jentlasite)){
						if(this.value!=""){		
							$('jentla_site').getPrevious().style.visibility="hidden";
							$('jentla_site').parentNode.style.visibility="hidden";
						}else if(this.value==""){
							$('jentla_site').getPrevious().style.visibility="visible";		
							$('jentla_site').parentNode.style.visibility="visible";
						}
					}	
					var changeVar = this.alt;
					option=this.getElementsByTagName("option"); 
					for(d=0;d<option.length;d++){
						if(option[d].selected==true){
							if(document.getElementById("select"+this.name).childNodes.length<=0)continue;
							document.getElementById("select"+this.name).childNodes[0].nodeValue=option[d].childNodes[0].nodeValue;
							$("select"+this.name).style.width = (this.offsetWidth-26)+"px";
							$("select"+this.name).style.paddingRight = "0px";
						}
					}
					if($('search'))if($('search').value=='Search ' || $('search').value=='search')$('search').value = "";
					if($('filter_search'))if($('filter_search').value=='Search ' || $('filter_search').value=='search')$('filter_search').value = "";
					if(changeVar!=null){
						changeVar = changeVar.toString().replace("function () {","").replace(new RegExp("\n}" + '$'), '');
						changeVar = changeVar.toString().replace("function (){","").replace(new RegExp(" }" + '$'), '');
						changeVar = changeVar.toString().replace("function(){","").replace(new RegExp(" }" + '$'), '');
						changeVar = changeVar.toString().replace("function ()\n{","").replace(new RegExp("\n}" + '$'), '');
						changeVar = changeVar.toString().replace("function onchange()\n{","").replace(new RegExp("\n}" + '$'), '');
						changeVar = changeVar.toString().replace("function anonymous()\n{","").replace(new RegExp("\n}" + '$'), '');
						eval(changeVar);
					}
					if($('storage_type')){
						setTimeout(function cck(){
							if($$('div#select_dd_options div label')){
								$$('div#select_dd_options div label').setStyle('vertical-align','middle');
							}						
						GlobalFunctions.ind();
						Globals.initialize();
						},2000);
					}	
				}
			}
		}
	},
	
	
	// TEXTBOX Tags
	textbox:function(){
		input=document.getElementsByTagName("input");
		for(var k=0;k<input.length;k++){//alert(input.length);
			if(input[k].id!="search" && input[k].id!="filter_search" && input[k].type=="text" || input[k].type=="password"){
				if(input[k].parentNode.className!="textbox"){ 
					//if(input[k].getProperty('style')!=null){input[k].setStyle('margin','0px 0px 0px 0px');}
					var div=new Element('div',{'class':'textbox'});
					var spanleft=new Element('span',{'class':'textboxleft',styles:{'background-color':'#fff'}});
					spanleft.innerHTML="&nbsp;";
					if(input[k].id=="" || input[k].id==null || input[k].id=="null")input[k].id = "input_"+k;
					if(input[k].className==''){input[k].className="text_area";}
					var clone = $(input[k].id).clone().inject($('selectBoxesList'),'top');
					var elementOffset = clone.offsetWidth;
					div.inject(input[k],'before');
					spanleft.injectInside(div);
					input[k].injectInside(div);
					$('selectBoxesList').innerHTML = "";
				}
				if(input[k].className=="moor-BrighInput"){
					var div=new Element('div',{'class':'textbox'});
					var spanleft=new Element('span',{'class':'textboxleft',styles:{'background-color':'#fff'}});
					spanleft.innerHTML="&nbsp;";
					if(input[k+1].id=="" || input[k+1].id==null || input[k+1].id=="null")input[k+1].id = "input_"+k+1;
					if(input[k+1].className==''){input[k+1].className="text_area";}
					var clone = $(input[k+1].id).clone().inject($('selectBoxesList'),'top');
					var elementOffset = clone.offsetWidth;
					div.inject(input[k+1],'before');
					spanleft.injectInside(div);
					input[k+1].injectInside(div);
					$('selectBoxesList').innerHTML = ""; 
				}
			}

			if($(input[k]).getProperty('disabled')){
				if($(input[k]).getStyle('background')!=""){
					$(input[k]).removeProperty('style');
				}
			}
		}

		var is = {chrome: Boolean(window.chrome)};
		var table=$$('table.adminlist');
		if(table[0] && table[0].className=="adminlist"){
			var ta=$$('div[class^=textbox]');
			for(var i=0;i<ta.length;i++){
				if($('adminlist')){
				}else{
					//ta[i].style.width="25%";
				}
			}
		}
		window.addEvent('domready', function(){
			Random.checkIEVersion();
		});
		
		
	
	},
	checkIEVersion:function(){
			var msg = "You're not using Windows Internet Explorer.";
			var ver = Random.getInternetExplorerVersion(); 
			if ( ver> -1 ){
				if ( ver!= 7.0 ){
					if($('modlgn_username')){
						ver=8;
					}
				}else if ( ver == 7.0 ){
					if($('modlgn_username')){
						$('modlgn_username').parentNode.style.paddingTop="0px";
						$('modlgn_passwd').parentNode.style.paddingTop="0px";
						ver=7;
					}
				}
			}
			return ver;
	},
	getInternetExplorerVersion:function(){
			var rv = -1;
			if (navigator.appName == 'Microsoft Internet Explorer'){
				var ua = navigator.userAgent;
				var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
				if (re.exec(ua) != null)rv = parseFloat( RegExp.$1 );
			}
			return rv;
	},

// TEXTBOX Tags
	attrInit:function(){
		if($("btnProcess")){	
			var elemToCheck =$("btnProcess");
			if (elemToCheck.addEventListener) { // Firefox, Opera, Google Chrome and Safari
				elemToCheck.addEventListener ('DOMAttrModified', OnAttrModified, false);    // Firefox, Opera
			} else if (elemToCheck.attachEvent) {   // Internet Explorer
				elemToCheck.attachEvent ('onpropertychange', OnAttrModified);
			}
		}	
    }
}

window.addEvent('domready', function() {
	GlobalFunctions.ind();
	
	if(($$('table.adminlist'))!=''){
		var list=$$('table.adminlist');
		list[0].cellSpacing=0;
	}
	
	if (navigator.appName != 'Microsoft Internet Explorer' && $('combobox-position-select')) {
		 $('combobox-position-select').getNext().style.display="none";
    }
	else if (navigator.appName == 'Microsoft Internet Explorer' && $('combobox-position-select')) {
		$('combobox-position-select').getNext().style.display="none";
		$('combobox-position-select').getNext().getNext().style.display="none";
	}
	
	if($$('input.moor-inputbox')){
		$$('input.moor-inputbox').set({"class":"inputbox","size":"7"}); 
	}	
	
	$$('li.toolbarHeading ul').setProperty('id','actiontxt');
	
	var sps = document.getElementsByTagName("select");
	for (var m=0,n=sps.length;m<n;m++) {
		if(sps[m].id=='group_id' && sps[m].parentNode.tagName=='FIELDSET'){
			sps[m].parentNode.setStyle("width","83%");
		}
	}
	
	$$('div .button2-left').getParent().setStyle("margin-top","10px");
	
	// Published Eye Image 
	var j,n,arr1,s;
	var cells = document.getElementsByTagName("a");
	for (var i=0,j=cells.length;i<j;i++) {
		s=cells[i].innerHTML; 
		arr1=s.substring(0,s.indexOf('<'));
		if(arr1=='Published'){
			//cells[i].setStyle("text-align","center");
			cells[i].innerHTML=s.replace(arr1,"<img src='templates/jentla_flexile/icons/published.jpg'>");
		}
		if(s=='Published'){
			//cells[i].style.textAlign="center";
			cells[i].innerHTML="<img src='templates/jentla_flexile/icons/published.jpg'>";
		}
	}
	
	var deflt = document.getElementsByTagName("th");
	for (var m=0,n=deflt.length;m<n;m++) {
		var result=deflt[m].innerHTML.toString().trim();
		if(result=='Default'){
			deflt[m].style.textAlign = "center";
			deflt[m].innerHTML="<img src='templates/jentla_flexile/icons/default.jpg'>";
		}
	}

	// Anpassung IE6
	if(window.ie6) var heightValue='100%';
	else var heightValue='';
	
	// Selektoren der Container für Schalter und Inhalt
	var togglerName='dt.accordion_toggler_';
	var contentName='dd.accordion_content_';

	
	// Selektoren setzen
	var counter=1;	
	var toggler=$$(togglerName+counter);
	var content=$$(contentName+counter);
	if(typeof(selectedMenu)!='undefined' && selectedMenu=='')selectedMenu[0] = 0;
	$$('dl.accordion dd').setStyle("height","auto");
	while(toggler.length>0){	
		// Accordion anwenden	
		myAccordion = new Accordion(toggler, content, {
			opacity: false,
			display: selectedMenu[counter-1],
			duration:800,
			/*alwaysHide: true,*/
			onComplete: function() { 
				var element=$(this.elements[this.previous]);
				if(element && element.offsetHeight>0)
					element.setStyle('height', heightValue);
			},
			onActive: function(toggler, content) {
				
				if(($$('dl.accordion dt'))!=''){
		 			$$('dl.accordion dt').getNext().setStyle("border-bottom","none");
				}
				toggler.addClass('open');
				for(i=0;i<$$('dl.accordion dt.accordion_toggler_1').length;i++)
				if(($$('dl.accordion dt.accordion_toggler_1')[i].className)=='accordion_toggler_1 open'){
		 			$$('dl.accordion dt.accordion_toggler_1')[i].getNext().setStyle("border-bottom","2px solid #000000");
				}
			},
			onBackground: function(toggler, content) {
				toggler.removeClass('open');
				for(i=0;i<$$('dl.accordion dt.accordion_toggler_1').length;i++)
				if(($$('dl.accordion dt.accordion_toggler_1')[i].className)=='accordion_toggler_1'){
		 			$$('dl.accordion dt.accordion_toggler_1')[i].getNext().setStyle("border-bottom","none");
				}
			}	
		});
		// Selektoren für nächstes Level setzen
		counter++;
		toggler=$$(togglerName+counter);
		content=$$(contentName+counter);
	}
	window.rowelement = null;
	//  ACTION  PERFORMS ON FORM
	var tr=$$('tr');
	for(i=0,j=0;i<tr.length;i++,j++){
		if(tr[i].className=="row0" || tr[i].className=="row1"){
			if(i%2==0)tr[i].className="row1";
			else if(i%2==1)tr[i].className="row0";
		}
	}
	for(i=0;i<document.getElementsByName("cid[]").length;i++){
		document.getElementsByName("cid[]")[i].parentNode.parentNode.alias = i;
		if($('adminListFunctions'))document.getElementsByName("cid[]")[i].parentNode.parentNode.onmousemove = document.getElementsByName("cid[]")[i].parentNode.parentNode.onmouseover = function(e){
			if(!$(document.getElementsByName("cid[]")[this.alias].id))return;
			window.rowelement = this;
			var size = $(document.getElementsByName("cid[]")[this.alias].id).getPosition();
			document.getElementById('adminListFunctions').style.left = size.x+200+"px";
			document.getElementById('adminListFunctions').style.top = size.y-4+"px";
			document.getElementById('adminListFunctions').style.display = "";
			//alert(this.alias);
			document.getElementById('deleteicon').alias = document.getElementById('editicon').alias = this.alias;
			if(!$('toolbar-edit')) $('editicondiv').setStyle("display","none");  
			//if(!$('toolbar-delete') && !$('toolbar-trash')) $('deleteicondiv').setStyle("display","none"); 			
			document.getElementById('editicon').onclick = function(){	//alert("i");			
				if($('toolbar-edit')){		//alert("i");			
					eval("document.getElementsByName('cid[]')[this.alias].checked = true;isChecked(true);");
					var kal = $('toolbar-edit').getElementsByTagName("a")[0].getAttribute("onclick");
					kal = kal.toString().replace("function onclick()\n{","").replace(new RegExp("\n}" + '$'), '');
					kal = kal.toString().replace("function anonymous()\n{","").replace(new RegExp("\n}" + '$'), '');
					eval(kal);
				}
				//eval($('toolbar-edit').getElementsByTagName("a")[0].getAttribute("onclick"));
				//document.getElementsByName('cid[]')[this.alias].checked = true;isChecked(true);hideMainMenu(); submitbutton('edit');
			}
			document.getElementById('deleteicon').onclick = function(){
				eval("document.getElementsByName('cid[]')[this.alias].checked = true;isChecked(true);");
				if($('toolbar-delete')){
					var kal = $('toolbar-delete').getElementsByTagName("a")[0].getAttribute("onclick");
				}else if($('toolbar-trash')){
					var kal = $('toolbar-trash').getElementsByTagName("a")[0].getAttribute("onclick");
				}else if($('toolbar-Are you sure you want to delete the selected User Group(s)?')){
					var kal = $('toolbar-Are you sure you want to delete the selected User Group(s)?').getElementsByTagName("a")[0].getAttribute("onclick");
				}
				else{
					kal = "";
				}
				kal = kal.toString().replace("function onclick()\n{","").replace(new RegExp("\n}" + '$'), '');
				kal = kal.toString().replace("function anonymous()\n{","").replace(new RegExp("\n}" + '$'), '');
				eval(kal);				
				//if(document.getElementById('toolbar-delete'))
				//else if(document.getElementById('toolbar-delete'))document.getElementById('deleteicon').setAttribute("onclick","javascript:document.getElementsByName('cid[]')[this.alias].checked = true;isChecked(true);submitbutton('trash');");
			}
		}
	}
	if(document.getElementsByName("cid[]")[0] && $('adminListFunctions'))document.getElementsByName("cid[]")[0].parentNode.parentNode.parentNode.parentNode.onmouseout = function(e){
		document.getElementById('adminListFunctions').style.display = "none";
	}


	
	//  ACTION  PERFORMS ON FORM
	
	var toolbar_height = "0px";
	if($('toolbar'))toolbar_height = $('toolbar').offsetHeight + "px";
	else toolbar_height = $$('.toolbar').getStyle("height");
	//   SEARCH BOX
	if($('search') && $('search').type=='text'){
		$('search').getParent().childNodes[0].data = "";
		$('search').getParent().style.visibility = "hidden";
		if($('search').getPrevious("label"))$('search').getPrevious().innerHTML = "";
		if(!$('search_box')){
			$('search').parentNode.style.padding = "0px";
			var ele = new Element('div', {id: 'search_box'});
			ele.inject($('search').parentNode,"top");
			$('search_box').adopt($('search'));
		}
		if((!$('submenu-box') || $('submenu-box').getStyle("display")=="none") && $('search').parentNode.parentNode.parentNode.parentNode.parentNode.tagName=='TABLE'){
			$('search').parentNode.parentNode.parentNode.parentNode.parentNode.id="toolbar_filter";
			$('search').parentNode.parentNode.parentNode.parentNode.parentNode.style.background = "none";
			$('search').parentNode.parentNode.parentNode.parentNode.parentNode.style.position = "absolute";
			$('search').parentNode.parentNode.parentNode.parentNode.parentNode.style.visibility = "hidden";
			//$('search').parentNode.parentNode.parentNode.parentNode.parentNode.style.borderBottom = "1px solid #999999";
			//$('search').parentNode.parentNode.parentNode.parentNode.parentNode.style.height = parseInt(toolbar_height)+1+"px";
		}else if((!$('submenu-box') || $('submenu-box').getStyle("display")=="none") && $('search').parentNode.parentNode.parentNode.parentNode.tagName=='FIELDSET'){
			$('search').parentNode.parentNode.parentNode.parentNode.id="toolbar_filter";
			//$('search').parentNode.parentNode.parentNode.parentNode.style.borderBottom = "1px solid #999999";
			//$('search').parentNode.parentNode.parentNode.parentNode.style.borderTop = "0px solid #999999";
			//$('search').parentNode.parentNode.parentNode.parentNode.style.height = parseInt(toolbar_height)+"px";
		}
		$('search').form.onsubmit = function(){
			if($('search').value=='Search ' || $('search').value=='search')$('search').value = "";
		};
		document.adminForm.onsubmit = function(){
			if($('search').value=='Search ' || $('search').value=='search')$('search').value = "";			
		}
		//alert($('filter_type').getAttribute("onchange"));
		//$('filter_type').onchange += "if($('search').value=='Search ' || $('search').value=='search')$('search').value = '';";
	}
	$$('div#submenu-box div.m div.submenu-box').setStyle("borderBottom","1px solid "+$$('.lfm').getStyle('border-right-color'));
	//   SEARCH BOX
	if($('content-strip')){
		if($('submenu-box') && ($$('div#subs div#submenu-box div.mm') && $$('div#subs div#submenu-box div.mm')=='') && $('search')){
			$('content-strip').style.position = "absolute";
		}else if($$('div#submenu-box div.m') && $$('div#submenu-box div.m')!=''){
			$('content-strip').style.position = "absolute";
		}else if((!$('submenu-box') || $('submenu-box').getStyle("display")=="none") && $('search') && $('search').parentNode.parentNode.parentNode.parentNode.parentNode.tagName=='TABLE'){
			$('content-strip').style.position = "absolute";
		}else if((!$('submenu-box') || $('submenu-box').getStyle("display")=="none") && $('search') && $('search').parentNode.parentNode.parentNode.parentNode.tagName=='FIELDSET'){
			$('content-strip').style.position = "absolute";
		}
		//$('content-strip').style.height = toolbar_height-2;
		if(!$('toolbar_filter')){
			$('content-strip').style.position="relative";
		}else{
			$('content-strip').style.display = "none";
		}
	}
	if($('adminListFunctions')){
		$('adminListFunctions').onmouseover = function(){
			document.getElementById('adminListFunctions').style.display = "";
			var tds = $(window.rowelement).getElements("td");
			if(window.rowelement.className=="row0"){
				//for(i=0;i<tds.length;i++)$(tds[i]).setStyle("background",row0hovercolor);
				tds.setStyle("background",row0hovercolor);
			}else if(window.rowelement.className=="row1"){
				//for(i=0;i<tds.length;i++)$(tds[i]).setStyle("background",row1hovercolor);
				tds.setStyle("background",row1hovercolor);
			}
		}
		$('adminListFunctions').onmouseout = function(){
			var tds = $(window.rowelement).getElements("td");		
			tds.removeProperty('style');
			tds.setProperty('style',null);
			document.getElementById('adminListFunctions').style.display = "none";
		}		
		
		var li=$$('ul#actiontxt li a span');
		for(var m=0;m<li.length;m++){
			var s=li[m].title;
			if(s=="Trash" || s=="Uninstall"){
				$('deleteicon').innerHTML=s;
			}
			if((s=="Trash" || s=="Uninstall" || s=="Delete") && (li[m].parentNode.className=='modal')){
				$('deleteicon').style.color="#000000";
				$('deleteicon').setProperty("rel",li[m].parentNode.rel);
				$('deleteicon').setProperty("href",li[m].parentNode.href);
				$('deleteicon').addEvent('click', function(e) {
					new Event(e).stop();
					SqueezeBox.fromElement($('deleteicon'));
				});
			}	
			if(s=="Edit" && li[m].parentNode.className=='modal'){	
				$('editicon').style.color="#000000";				
				$('editicon').setProperty("rel",li[m].parentNode.rel);
				$('editicon').setProperty("href",li[m].parentNode.href);
				$('editicon').addEvent('click', function(e) {
					new Event(e).stop();
					SqueezeBox.fromElement($('editicon'));
				});
			}
		}
	}	
				
	
	// Image Replacements
	//img = "";
	var search_array = new Array("/images/publish_g.png","/images/tick.png","/images/disabled.png","/images/uparrow.png","/images/downarrow.png","/images/sort_asc.png","/images/sort_desc.png","/images/filesave.png","/images/publish_x.png","/images/publish_r.png");
	var replace_array = new Array("/templates/jentla_flexile/icons/publish_g1.png","/templates/jentla_flexile/icons/publish_g1.png","/templates/jentla_flexile/icons/disabled.png","/templates/jentla_flexile/icons/uparrow.png","/templates/jentla_flexile/icons/downarrow.png","/templates/jentla_flexile/icons/sort_asc.png","/templates/jentla_flexile/icons/sort_desc.png","/templates/jentla_flexile/icons/filesave.png","/templates/jentla_flexile/icons/dot_col_black.png","/templates/jentla_flexile/icons/dot_col_black.png");

	var unwanted_image="/images/publish_x.png";var unwanted_image1="/images/publish_r.png";
	for(i=0;i<document.images.length;i++){
		for(j=0;j<search_array.length;j++){
			s=document.images[i].src;
			if(typeof(showicons)!='undefined' && showicons == 0){
				if(s.match(unwanted_image)||s.match(unwanted_image1)){
					//document.images[i].parentNode.removeChild(document.images[i]);
					//continue;
				}
			}
			document.images[i].src = document.images[i].src.replace(search_array[j],replace_array[j]);
		}
	}
	$$('div#content-content form table.adminlist td a img').setStyle("visibility","visible");
	// Image Replacements
	
	if($('search') && $('search_box')){
		var div=new Element('div',{id:'toolbar_form'});
		if($('content-content'))
		div.style.width = ($('content-content').offsetWidth+180)+"px";
		div.inject($('toolbar_filter'),'before');
	}
	if($('search') && $('search').parentNode.parentNode.tagName=='TD'){
		var mydiv = new Element('div', {id: 'mydiv1'});
		mydiv.inject($("toolbar_form"),"top");
		if($('search').parentNode.parentNode.getNext()==null || $('search').parentNode.parentNode.getNext().getNext()==null){
			var ele = $('search').parentNode.parentNode.getNext();
			if(ele){
				mydiv.innerHTML = ele.innerHTML;
				ele.innerHTML = "";
			}
		}else{
			var ele = new Array();
			var j=2;
			for(var i=0;i<j;i++){
				if(i==0)
					ele[i] = $('search').parentNode.parentNode.getNext();
				if(i==1)
					ele[i] = $('search').parentNode.parentNode.getNext().getNext();
				if(ele[i]){
					mydiv.innerHTML += ele[i].innerHTML;
					ele[i].innerHTML = "";
				}
			}
		}
		
		var mydiv = new Element('div', {id: 'mydiv2'});
		mydiv.inject($("toolbar_form"),"bottom");
		ele = $('search').parentNode.parentNode;
		mydiv.innerHTML = ele.innerHTML;
		if(($('search').value).trim()==""){
			if($('search').className.indexOf(" ")<0)
				$('search').className += " searchInputBox";
		}
		ele.innerHTML = "";
	}
	if($('search') &&  $('search_box')) {
		$('search').onfocus = function(){
			if($('search').className.indexOf(" ")<0){
				$('search').className += " Emptysearch";
			}else $('search').className = ($('search').className).toString().replace(" searchInputBox"," Emptysearch");
		}
		$('search').onblur = function(){
			if(($('search').value).trim()=='')$('search').className = ($('search').className).toString().replace(" Emptysearch"," searchInputBox");
		}
	}
	if($('toolbar-strip') && $('menu-item')){
		if($('menu-item').parentNode.parentNode.parentNode.parentNode.parentNode.tagName=='TABLE'){
			var div=new Element('div',{id:'toolbar_form'});
			div.inject($('menu-item').parentNode.parentNode.parentNode.parentNode.parentNode,'before');	
		}
	}	
	if(!$('filter_search') && $('toolbar')){
		var mydiv = new Element('div', {id: 'toolbarDiv'});
		if($('search'))mydiv.inject($("toolbar_form"),"top");
		else mydiv.inject($("toolbar-strip"),"top");
		$$('div.toolbar').setProperty("id","divtoolbar");
		$('divtoolbar').inject(mydiv,"bottom");
		$('divtoolbar').setStyle("display","");
		$$('ul#toolbar li').setStyle("white-space","normal");
		//$('divtoolbar').style.width="200px";
	}
	if($('toolbar_form')){
		var div=new Element('div',{id:'toolbar_container'});
		div.inject($('toolbar_form'),"before");
		$('toolbar_form').inject(div);
		/*var url=location.href;
		var patt1=/sitemodules/;
		if(url.match(patt1)){
			var tab=new Element('table',{'id':'tdwidth'});
			tab.inject($('sbox-window'),"after");
			var tr=new Element('tr');
			tr.injectInside(tab);
			var td=new Element('td');
			td.injectInside(tr);
			$('toolbar_form').clone().injectInside(td);
		}*/		
	}	
	Globals.initialize();
	//usermanager
	/*if($('content-content')){
		var body_width;
		body_width=$('content-left').offsetWidth+$('content-content').offsetWidth;
		var url=location.href;
		var patt1=/com_users/;
		if(url.match(patt1)){
			$('minwidth-body').setStyle('width',(body_width+188));
		}
	}*/
	//Colorchooser Button
	var l = $$('div.buttondiv span.inputboxright div input');

	for(var g=0;g<l.length;g++){
		l[g].parentNode.setAttribute("class","close1");
	}
	var m = $$('div.buttondiv span.inputboxright div');
	for(var i=0;i<m.length;i++){
		m[i].parentNode.setAttribute("class","closeright");
		m[i].parentNode.setAttribute("id","closeright");
	}
			
//Colorchooser inputbox
	var u = $$('label.moor-hexLabel div.textbox input');
	u.setStyle("position","relative");
	var span=$$('span[class^=arrow]');
	for(var m=0;m<span.length;m++){
		if(span[m].className=="arrow active"){
			span[m].parentNode.className="g-title_open";
		}
	}
	var div=$$('div[class^=g-surround]');
	for(var m=0;m<div.length;m++){
		div[m].getFirst().addEvent('click',function(event){
			if(this.className=="g-title_open"){
				this.className="g-title";
			}else
				this.className="g-title_open";
		});
	}
	$$('li[class^=toolbarHeading]').setStyle('width','30px');
	//if($('id_name'))$('id_name').setProperty("background-image",null,null);	
	
	var find=$('jxformReplacefind_img-lbl');
	if(find){
		find.parentNode.parentNode.style.width="0px";
		find.parentNode.parentNode.setAttribute('class','xyz');
	}
	var replac=$('jxformReplacereplace_img-lbl');
	if(replac){
		replac.parentNode.parentNode.style.width="0px";
		replac.parentNode.parentNode.setAttribute('class','xyz');
	}
	/*if($('Global Replace')&&$$('td.paramlist_value')){
		if($$(input.random)){
			var ch=$$('span.checkbox').getNext();
			for(var i=0;i<ch.length;i++){
				if(ch[i].type=="checkbox"){
					ch[i].setStyle('position','static');
				}
			}
		}
		$$('span.checkbox').setStyle('position','static');	
		if($$('td')){
			var td=$$('td');
			for(var i=0;i<td.length;i++){
				if(td[i].getFirst()){	
					if(td[i].getFirst().type=="span"){
						td[i].getFirst().setStyle('position','static');	
						

					}	
				}
			}
			$$('td.paramlist_value').setStyle('position','static');
		}
	}*/
	if($('select_dd_options')){
		var lab=$('select_dd_options').getChildren().getChildren();
		for(var i=0;i<lab.length;i++){
			//alert(lab[i].tagName);
		}
	}
	var fi=$('jxformfind_imagefind_img');
	if(fi){
		fi.parentNode.parentNode.parentNode.parentNode.style.width="200px";
	}
	if($('paramsshow_noauth-lbl')){
		$('paramsshow_noauth-lbl').parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.setStyle("height","100%");
	}
	if($('input_2_right')){
	//  $('input_2_right').getNext().setStyle('float','none');
	}
	var ieversion=Random.checkIEVersion();	
		if(ieversion==7){
			if($('editor_params')){
				$('editor_params').parentNode.parentNode.style.width="60%";
			}	
			if($('article-edit')){
				$('article-edit').getNext().getFirst().getFirst().style.width="95%";
			}
			if($('jxform_menu-lbl')){
				$('jxform_menu-lbl').parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.width="90%";
			}
	}	
	/*if($('editor-xtd-buttons')){
		$('editor-xtd-buttons').getPrevious().style.width="640px";
	}*/
	if($('editor-xtd-buttons')){
			$('editor-xtd-buttons').getPrevious().style.width="550px";
	}
    if($('paramseditor_width-lbl')){
	    $('content-content').getNext().style.clear="none";
    }
	if($('jxform_title-lbl')){
		//$('jxform_title-lbl').parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.style.width="1020px";
	}
	if($('jxform_menu-lbl')){
		//$('jxform_menu-lbl').parentNode.parentNode.parentNode.parentNode.parentNode.style.width="800px";
	}
	//ToolBox setParent Tag width.				
	if($$('#toolbar_form').toString()!="") {	
		var parent_width = 0;
		var space = 40;
		var children = $('toolbar_form').getChildren();	 
		for(i=0;i<$('toolbar_form').getChildren().length;i++) {
			parent_width += children[i].offsetWidth;			
		}
		if (navigator.appName != 'Microsoft Internet Explorer'){parent_width +=space;}
		else{parent_width +=150;}
		
		$('toolbar_form').setStyle('width',parent_width);
		function changewidth(){
		if($('search') || $('filter_search')){
			var twidth=$('toolbar_form').style.width;				
			if(navigator.appName != 'Microsoft Internet Explorer'){wwidth=window.innerWidth;}
			else{wwidth=document.body.clientWidth;}
			if(parseInt(wwidth)<parseInt(twidth)){
				$('minwidth-body').setStyle('width',twidth); 
            }	//$minwidth-body('print').getStyle('display','block');
		}
		}			
		window.addEvent('resize', changewidth);
		changewidth();
		/*var url=location.href;
		var patt1=/sitemodules&menutype=M/;
		if(url.match(patt1)){			
			$('tdwidth').setStyle('width',parent_width+300);
			$('tdwidth').setStyle('visibility','hidden');
		}*/
		/*
		var parent_width = 0;
			for(i=0; i < children.length; i++){ 
				sub_child = $(children[i].id).getChildren()
				for(j=0; j < sub_child.length; j++)
				{  alert($(sub_child[j]).offsetWidth);
				   parent_width += $(sub_child[j]).offsetWidth;
				}
			}	
		$('toolbar_form').setStyle('width',parent_width);
		*/
	}
	 
	
	/*if($$('.form-validate fieldset div')){
		t = $$('.form-validate').getFirst().getNext();
		t.setStyle('width','690px');
	}*/
	
	$$('#globalfind-form').getFirst().getNext().removeProperty('style');
	
	/*
	get_t_width = $$('#toolbar-strip');	
	set_t_width = $$('div#extra');
	set_t_width[0].setStyle('width',get_t_width[0].offsetWidth); */
	
	/*if($('btnProcess')){alert($('btnProcess').getStyle('display').toString());
		if($('btnProcess').getStyle('display')!="inline"){
			$('btnProcess').parentNode.setStyle("display","none");
		}
	}*/
	var anchor=$$('a');
	for(i=0;i<anchor.length;i++){
		if(anchor[i].className=="modal-button"){
			anchor[i].href=anchor[i].href+"&end=admin";
		}
		
	}
	if($('selectrelationright')){
		$('selectrelationright').setStyle('padding-right','160px');
	}
	var is = {chrome: Boolean(window.chrome)}
	if(is.chrome){
		$$('label[for=site_section_categories]').setStyle('line-height','2');
		$$('label[for=ad_advanced]').setStyle('line-height','2');
		$$('label[for=mergetags]').setStyle('line-height','2');
		$$('label[for=params]').setStyle('line-height','2');
	}
	$$("div.overlay").addEvent('click',function(){
		var spanri=$$("span.randomright");
		for(var i=0;i<spanri.length;i++){
			if(spanri[i].parentNode.className=="textbox"){
				spanri[i].parentNode.setStyle("background","none");
			}
		}	
	});
	if($('btnProcess')){	
		$('btnProcess').addEvent('click',function(){
			$('btnProcess_right').setStyle('visibility','visible');
			var butval=$('btnProcess').value;
			if($('btnProcess').value=="Continue"){
				$('btnBack_right').setStyle('visibility','visible');
				$('btnClose_right').setStyle('visibility','visible');
			}
			if($('btnProcess').value=="Stop"){
				$('btnBack_right').setStyle('visibility','hidden');
				$('btnClose_right').setStyle('visibility','hidden');
			}
		});
	}
});
function OnAttrModified(event) { 
	if (event === undefined) {  // Internet Explorer
		event = window.event;
	}
	switch (event.attrChange) {
		case MutationEvent.MODIFICATION://alert("fdasf");
			$('btnBack_right').setStyle('visibility','visible');
			$('btnClose_right').setStyle('visibility','visible');
			$('btnProcess_right').setStyle('visibility','hidden');
			break;
	};
}
