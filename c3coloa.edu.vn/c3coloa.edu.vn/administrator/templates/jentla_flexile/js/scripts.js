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


/*var Globals={initialize:function(){Custom.init();Convert.init();Fade.initialize();Nav.initialize();}}
window.onload=Globals.initialize;var checkboxHeight="25";var radioHeight="25";var selectWidth="190";document.write('<style type="text/css">input.styled { display: none; } select.styled { position: relative; width: '+selectWidth+'px; opacity: 0; filter: alpha(opacity=0); z-index: 5; }</style>');var Custom={init:function(){var inputs=document.getElementsByTagName("input"),span=Array(),textnode,option,active;for(a=0;a<inputs.length;a++){if((inputs[a].type=="checkbox"||inputs[a].type=="radio")&&inputs[a].className=="styled"){span[a]=document.createElement("span");span[a].className=inputs[a].type;if(inputs[a].checked==true){if(inputs[a].type=="checkbox"){position="0 -"+(checkboxHeight*2)+"px";span[a].style.backgroundPosition=position;}else{position="0 -"+(radioHeight*2)+"px";span[a].style.backgroundPosition=position;}}
inputs[a].parentNode.insertBefore(span[a],inputs[a]);inputs[a].onchange=Custom.clear;span[a].onmousedown=Custom.pushed;span[a].onmouseup=Custom.check;document.onmouseup=Custom.clear;}}
inputs=document.getElementsByTagName("select");for(a=0;a<inputs.length;a++){if(inputs[a].className=="styled"){option=inputs[a].getElementsByTagName("option");active=option[0].childNodes[0].nodeValue;textnode=document.createTextNode(active);for(b=0;b<option.length;b++){if(option[b].selected==true){textnode=document.createTextNode(option[b].childNodes[0].nodeValue);}}
span[a]=document.createElement("span");span[a].className="select";span[a].id="select"+inputs[a].name;span[a].appendChild(textnode);inputs[a].parentNode.insertBefore(span[a],inputs[a]);inputs[a].onchange=Custom.choose;}}},pushed:function(){element=this.nextSibling;if(element.checked==true&&element.type=="checkbox"){this.style.backgroundPosition="0 -"+checkboxHeight*3+"px";}else if(element.checked==true&&element.type=="radio"){this.style.backgroundPosition="0 -"+radioHeight*3+"px";}else if(element.checked!=true&&element.type=="checkbox"){this.style.backgroundPosition="0 -"+checkboxHeight+"px";}else{this.style.backgroundPosition="0 -"+radioHeight+"px";}},check:function(){element=this.nextSibling;if(element.checked==true&&element.type=="checkbox"){this.style.backgroundPosition="0 0";element.checked=false;}else{if(element.type=="checkbox"){this.style.backgroundPosition="0 -"+checkboxHeight*2+"px";}else{this.style.backgroundPosition="0 -"+radioHeight*2+"px";group=this.nextSibling.name;inputs=document.getElementsByTagName("input");for(a=0;a<inputs.length;a++){if(inputs[a].name==group&&inputs[a]!=this.nextSibling){inputs[a].previousSibling.style.backgroundPosition="0 0";}}}
element.checked=true;}},clear:function(){inputs=document.getElementsByTagName("input");for(var b=0;b<inputs.length;b++){if(inputs[b].type=="checkbox"&&inputs[b].checked==true&&inputs[b].className=="styled"){inputs[b].previousSibling.style.backgroundPosition="0 -"+checkboxHeight*2+"px";}else if(inputs[b].type=="checkbox"&&inputs[b].className=="styled"){inputs[b].previousSibling.style.backgroundPosition="0 0";}else if(inputs[b].type=="radio"&&inputs[b].checked==true&&inputs[b].className=="styled"){inputs[b].previousSibling.style.backgroundPosition="0 -"+radioHeight*2+"px";}else if(inputs[b].type=="radio"&&inputs[b].className=="styled"){inputs[b].previousSibling.style.backgroundPosition="0 0";}}},choose:function(){option=this.getElementsByTagName("option");for(d=0;d<option.length;d++){if(option[d].selected==true){document.getElementById("select"+this.name).childNodes[0].nodeValue=option[d].childNodes[0].nodeValue;}}}}
var Convert={init:function(){var spans=document.getElementsByTagName("span");for(var i=0;i<spans.length;i++){if(spans[i].className=="address"){string=spans[i].childNodes[0].nodeValue;email=string.split("_")[0]+"@"+string.split("_")[2];spans[i].innerHTML='<a href="mailto:'+email+'">'+email+'</a>';}}}}
var stage=new Array(),img,rotate=0,opac=100,int;var Fade={initialize:function(){if(document.getElementById("stage")){img=document.getElementById("stage");stage[0]=new Image();stage[0].src="/workspace/images/stage-one.png";stage[1]=new Image();stage[1].src="/workspace/images/stage-two.png";stage[2]=new Image();stage[2].src="/workspace/images/stage-three.png";setTimeout("Fade.fadeOut()",3000);}},fadeOut:function(){opac=(opac-10);img.style.opacity=(opac/100);img.style.filter="alpha(opacity="+opac+")";if(opac==90){int=setInterval("Fade.fadeOut()",50);}else if(opac==0){clearInterval(int);Fade.switchImage(img);}},fadeIn:function(){opac=(opac+20);img.style.opacity=(opac/100);img.style.filter="alpha(opacity="+opac+")";if(opac==20){int=setInterval("Fade.fadeIn()",50);}else if(opac==100){clearInterval(int);setTimeout("Fade.fadeOut()",5000);}},switchImage:function(){rotate++;if(rotate==stage.length){rotate=0;}
img.src=stage[rotate].src;Fade.fadeIn();}}
var Nav={initialize:function(){var nav=document.getElementById("nav").getElementsByTagName("li");for(var i=0;i<nav.length;i++){nav[i].onmouseover=Nav.swapin;nav[i].onmouseout=Nav.swapout;}},swapin:function(){if(this.id=="home"){document.getElementById("nav").style.backgroundPosition="100% -190px";}
if(this.id=="services"||this.id=="services active"){document.getElementById("nav").style.backgroundPosition="100% -380px";}
if(this.id=="portfolio"||this.id=="portfolio active"){document.getElementById("nav").style.backgroundPosition="100% -570px";}
if(this.id=="resources"||this.id=="resources active"){document.getElementById("nav").style.backgroundPosition="100% -760px";}
if(this.id=="contact"||this.id=="contact active"){document.getElementById("nav").style.backgroundPosition="100% -950px";}},swapout:function(){document.getElementById("nav").style.backgroundPosition="100% 0";}}*/

var Globals={initialize:function(){Custom.init();Custom.button();Convert.init();Fade.initialize();}};//Nav.initialize();
//window.onload=Globals.initialize;

var checkboxHeight="25";var radioHeight="25";var selectWidth="190";
document.write('<style type="text/css">input.styled { display: none; } select.inputbox { margin:5px 5px 0 0;position: relative;  opacity: 0; filter: alpha(opacity=0); z-index: 5; } </style>');//width: '+selectWidth+'px;
var Custom={
	init:function(){
		var inputs=document.getElementsByTagName("input"),span=Array(),spanhidden=Array(),textnode,option,active;
		for(a=0;a<inputs.length;a++){
			if(inputs[a].type=="button"){
				inputs[a].className="inputbox";
				inputs[a].style.position="relative";
			}
			if(inputs[a].type=="checkbox" || inputs[a].type=="radio"){
				if(inputs[a].className!="random"){
					inputs[a].className="random";
					span[a]=document.createElement("span");
					span[a].className=inputs[a].type;
					 span[a].id = inputs[a].type;
					span[a].innerHTML = "&nbsp;";
					if(inputs[a].checked==true){
						if(inputs[a].type=="checkbox"){
							position="0 -"+(checkboxHeight*2)+"px";
							span[a].style.backgroundPosition=position;
						}else{
							position="0 -"+(radioHeight*2)+"px";
							span[a].style.backgroundPosition=position;
						}
					}
					inputs[a].style.visibility = "hidden";
					if(inputs[a].type=="radio"){
							if(inputs[a].id == inputs[a].getParent().getProperty('for'))
							{
								var label = inputs[a].getParent();
								var newele = new Element('span',{id:inputs[a].id + "_label"});
								newele.inject(label,'before');
								inputs[a].inject(newele);

							}
					}
					inputs[a].parentNode.insertBefore(span[a],inputs[a]);
					inputs[a].onchange=Custom.clear;

					//label
					if(inputs[a].type=="radio") {
						$$('label[for='+inputs[a].id+ ']').addEvent('click', function(){
							this.removeProperty('for');
							});
						}

					span[a].onmousedown=Custom.pushed;
					span[a].onmouseup=Custom.check;
					document.onmouseup=Custom.clear;

					if(!inputs[a].getAttribute("disabled")) {
						span[a].onmousedown = Custom.pushed;
						span[a].onmouseup = Custom.check;
					} else {
						span[a].className = span[a].className += " disabled";
					}
				}
			}
		}

		//$(label_parent_id).innerHTML = data;


		//CHECKBOX Tags
		//if($('toggle'))
		if(document.adminForm && document.adminForm.toggle){
			th=document.getElementsByTagName("th");
			for(m=0,ct=th.length;m<ct;m++){
				spn=th[m].getElementsByTagName("span");
				for(n=0,ct1=spn.length;n<ct1;n++){
					if(spn[n].className=="checkbox") {spn[n].setAttribute("id","toggle");}
				}
			}
			document.getElementById('toggle').onclick = function(){
				if(document.adminForm.toggle.checked){
					td=document.getElementsByTagName("td");
					for(m=0,ct=td.length;m<ct;m++){
					inp=td[m].getElementsByTagName("input");
						for(k=0,tot=inp.length;k<tot;k++){
							if(inp[k].className=="random" && inp[k].type=="checkbox") {inp[k].checked=true;}
						}
						spn=td[m].getElementsByTagName("span");
						for(n=0,ct1=spn.length;n<ct1;n++){
							if(spn[n].className=="checkbox") {spn[n].style.backgroundPosition="0 -50px";document.adminForm.boxchecked.value=$$('form[name="adminForm"] input[type="checkbox"]').length-1;}
						}
					}
				}else{
					td=document.getElementsByTagName("td");
					for(m=0,ct=td.length;m<ct;m++){
					inp=td[m].getElementsByTagName("input");
						for(k=0,tot=inp.length;k<tot;k++){
							if(inp[k].className=="random" && inp[k].type=="checkbox") {inp[k].checked=false;}
						}
						spn=td[m].getElementsByTagName("span");
						for(n=0,ct1=spn.length;n<ct1;n++){
							if(spn[n].className=="checkbox") {spn[n].style.backgroundPosition="0 0px";document.adminForm.boxchecked.value=0;}
						}

					}
				}
			}
		}
		//CHECKBOX Tags
	},
    button:function(){
        var inputs=document.getElementsByTagName("input");
		for(a=0;a<inputs.length;a++){
			if((inputs[a].type=="button" || inputs[a].type=="submit") && (inputs[a].parentNode.className!="randomright")){//alert("in");
                if(inputs[a].value!="Login"){inputs[a].className = "random";}
				if(inputs[a].id==''){inputs[a].id = "input_"+a;}
				var ele = new Element('span', {id: inputs[a].id+"_right"});
				ele.className = inputs[a].className+'right';
				inputs[a].parentNode.insertBefore(ele,inputs[a]);
				//ele.inject(inputs[a].parentNode,"before");
				//$(inputs[a].attachEvent ('onpropertychange', function(){alert("fdsa");});
				$(inputs[a].id+"_right").adopt($(inputs[a]));
                if($('select_dd_options')){
		inputs[a].onclick = function(){
		if(this.value=="Remove"){
			this.parentNode.parentNode.remove();
		}
		setTimeout(function cck(){
			$$('div#select_dd_options div label').setStyle('vertical-align','middle');
			GlobalFunctions.ind();
			Globals.initialize();
		},2000);
                }
                }
			}
		}

	if($('search') || $('filter_search')){
		inpus=document.getElementsByTagName("select");
		for(a=0,cnt = inpus.length;a<cnt;a++){
			inpus[a].onchange = function(){
				if($('search'))if($('search').value=='Search ' || $('search').value=='search')$('search').value = "";
				if($('filter_search'))if($('filter_search').value=='Search ' || $('filter_search').value=='search')$('filter_search').value = "";
				document.adminForm.submit();
			}
		}
	}
		//  BUTTON Tags
		buttons=document.getElementsByTagName("button");
		for(b=0;b<buttons.length;b++){
			if(buttons[b].className!="buttonbox"){
				buttons[b].className = "buttonbox"+((buttons[b].className!='')?" "+buttons[b].className:"");
				if(buttons[b].id=='')buttons[b].id = "button_"+b;
				if(buttons[b].className == "buttonbox btn"){buttons[b].className="buttonbox";}
				if(buttons[b].className=="buttonbox"){
					if(buttons[b].getAttribute("onclick")!=null){
						var str = (buttons[b].getAttribute("onclick")).toString();
						str = str.replace(/ /g,"");
						str = str.replace(/\n/g,"");
						if(buttons[b].getAttribute("onclick").toString().replace("( )","()")=='this.form.submit();' || str=='functionanonymous(){this.form.submit();}'){
							buttons[b].onclick = function(){
								if($('search').value=='Search ' || $('search').value=='search')$('search').value = "";
								if($('filter_search').value=='Search ' || $('filter_search').value=='search')$('filter_search').value = "";
								this.form.submit();
							}
						}
					}
					var ele = new Element('div', {id: buttons[b].id+"_right"});
					ele.className = buttons[b].className+'right';
					buttons[b].parentNode.insertBefore(ele,buttons[b]);
					$(buttons[b].id+"_right").adopt($(buttons[b].id));
				}
			}
		}
		//  BUTTON Tags
    },
	choose:function(){
		option=this.getElementsByTagName("option");
		for(d=0;d<option.length;d++){
			if(option[d].selected==true && typeof(document.getElementById("select"+this.name).childNodes[0])!='undefined'){
				document.getElementById("select"+this.name).childNodes[0].nodeValue=option[d].childNodes[0].nodeValue;
				$id="select"+this.name;
				$("select"+this.name).style.width = (this.offsetWidth-26)+"px";
				$("select"+this.name).style.paddingRight = "0px";
			}
		}
	},
	pushed:function(){
		element=this.nextSibling;//if(this.getNext().checked){var ra=this.getNext().getAttribute("onclick");alert(ra.toString());}
		if(element.checked==true&&element.type=="checkbox"){
			this.style.backgroundPosition="0 -"+checkboxHeight*3+"px";
		}else if(element.checked==true&&element.type=="radio"){
			this.style.backgroundPosition="0 -"+radioHeight*3+"px";
		}else if(element.checked!=true&&element.type=="checkbox"){
			this.style.backgroundPosition="0 -"+checkboxHeight+"px";
		}else{
			this.style.backgroundPosition="0 -"+radioHeight+"px";
		}
	},
	check:function(){
		//return;
		element=this.nextSibling;
		if(element.checked==true && element.type=="checkbox"){
			this.style.backgroundPosition="0 0";
			if (navigator.appName != 'Microsoft Internet Explorer' && $('checkbox')) {
                if ($('checkbox').parentNode.tagName != "LABEL") {
                    element.checked = false;
                }
            }
            else {
                element.checked = false;
            }
			//edited
			var changeVar = element.getAttribute("onclick");
			if(changeVar!=null){
			changeVar = changeVar.toString().replace('this.', 'element.');
			changeVar = changeVar.toString().replace("function onmouseup()\n{","").replace(new RegExp("\n}" + '$'), '');
			changeVar = changeVar.toString().replace("function anonymous()\n{","").replace(new RegExp("\n}" + '$'), '');
			changeVar = changeVar.toString().replace("function onclick()\n{","").replace(new RegExp("\n}" + '$'), '');
			eval(changeVar);
			}
			//edited

		}else{
			if(element.type=="checkbox"){
				this.style.backgroundPosition="0 -"+checkboxHeight*2+"px";
			}else{
				this.style.backgroundPosition="0 -"+radioHeight*2+"px";
				group=this.nextSibling.name;
				inputs=document.getElementsByTagName("input");
				for(a=0;a<inputs.length;a++){
					if(inputs[a].name==group&&inputs[a]!=this.nextSibling){
						inputs[a].previousSibling.style.backgroundPosition="0 0";
					}
				}
			}

			if (navigator.appName != 'Microsoft Internet Explorer' && $('checkbox')) {
                if ($('checkbox').parentNode.tagName != "LABEL") {
                    element.checked = true;
                }
            }
            else {
                element.checked = true;
            }

			//edited
			var changeVar = element.getAttribute("onclick");
			if(changeVar!=null){
			changeVar = changeVar.toString().replace('this.', 'element.');
			changeVar = changeVar.toString().replace("function onmouseup()\n{","").replace(new RegExp("\n}" + '$'), '');
			changeVar = changeVar.toString().replace("function anonymous()\n{","").replace(new RegExp("\n}" + '$'), '');
			changeVar = changeVar.toString().replace("function onclick()\n{","").replace(new RegExp("\n}" + '$'), '');
			eval(changeVar);
			}
			//edited
		}
	},
	clear:function(){
		//return;
		inputs=document.getElementsByTagName("input");
		for(var b=0;b<inputs.length;b++){
			if(inputs[b].type=="checkbox"&&inputs[b].checked==true&&inputs[b].className=="random"){
				inputs[b].previousSibling.style.backgroundPosition="0 -"+checkboxHeight*2+"px";
			}else if(inputs[b].type=="checkbox"&&inputs[b].className=="random"){
				inputs[b].previousSibling.style.backgroundPosition="0 0";
			}/*else if(inputs[b].type=="radio"&&inputs[b].checked==true&&inputs[b].className=="inputbox"){
				inputs[b].previousSibling.style.backgroundPosition="0 -"+radioHeight*2+"px;";
			}else if(inputs[b].type=="radio"&&inputs[b].className=="inputbox"){
				inputs[b].previousSibling.style.backgroundPosition="0 0";
			} */
		}
	}
};
var Convert={
	init:function(){
		var spans=document.getElementsByTagName("span");
		for(var i=0;i<spans.length;i++){
			if(spans[i].className=="address"){
				string=spans[i].childNodes[0].nodeValue;
				email=string.split("_")[0]+"@"+string.split("_")[2];
				spans[i].innerHTML='<a href="mailto:'+email+'">'+email+'</a>';
			}
		}
	}
};
var stage=new Array(),img,rotate=0,opac=100,int;
var Fade={
	initialize:function(){
		if(document.getElementById("stage")){
			img=document.getElementById("stage");
			stage[0]=new Image();
			stage[0].src="/workspace/images/stage-one.png";
			stage[1]=new Image();
			stage[1].src="/workspace/images/stage-two.png";
			stage[2]=new Image();
			stage[2].src="/workspace/images/stage-three.png";
			setTimeout("Fade.fadeOut()",3000);
		}
	},
	fadeOut:function(){
		opac=(opac-10);
		img.style.opacity=(opac/100);
		img.style.filter="alpha(opacity="+opac+")";
		if(opac==90){
			int=setInterval("Fade.fadeOut()",50);
		}else if(opac==0){
			clearInterval(int);
			Fade.switchImage(img);
		}
	},
	fadeIn:function(){
		opac=(opac+20);
		img.style.opacity=(opac/100);
		img.style.filter="alpha(opacity="+opac+")";
		if(opac==20){
			int=setInterval("Fade.fadeIn()",50);
		}else if(opac==100){
			clearInterval(int);
			setTimeout("Fade.fadeOut()",5000);
		}
	},
	switchImage:function(){
		rotate++;
		if(rotate==stage.length){
			rotate=0;
		}
		img.src=stage[rotate].src;Fade.fadeIn();
	}
};
var Nav={
	initialize:function(){
		var nav=document.getElementById("nav").getElementsByTagName("li");
		for(var i=0;i<nav.length;i++){
			nav[i].onmouseover=Nav.swapin;nav[i].onmouseout=Nav.swapout;
		}
	},
	swapin:function(){
		if(this.id=="home"){
			document.getElementById("nav").style.backgroundPosition="100% -190px";
		}
		if(this.id=="services"||this.id=="services active"){
			document.getElementById("nav").style.backgroundPosition="100% -380px";
		}
		if(this.id=="portfolio"||this.id=="portfolio active"){
			document.getElementById("nav").style.backgroundPosition="100% -570px";
		}
		if(this.id=="resources"||this.id=="resources active"){
			document.getElementById("nav").style.backgroundPosition="100% -760px";
		}
		if(this.id=="contact"||this.id=="contact active"){
			document.getElementById("nav").style.backgroundPosition="100% -950px";
		}
	},
	swapout:function(){
		document.getElementById("nav").style.backgroundPosition="100% 0";
	}
};

//window.onload = Custom.init;
