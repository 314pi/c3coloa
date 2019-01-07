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
$doc =& JFactory::getDocument();
$site = JFactory::getApplication();
$template = $site->getTemplate();
$user		=& JFactory::getUser();
//template background-image: url(http://192.168.2.123/jentla/manager/administrator/templates/jentla_flexile/index.php?background=bgimage);
$style = "body,#minwidth-body{background:url(" . JURI::base() . "templates/" . $this->template . "/index.php?background=bgimage&img=bodybackgroundimg) repeat-y ".$template_params->get("headerfadefrom")."}"."\n";
$style .= "#loginbody{background:".$template_params->get("headerfadefrom")."}"."\n";
$style .= "#border-top{background-image:url(".JURI::base()."templates/".$this->template."/index.php?background=gradient&fadefrom=".substr($template_params->get("headerfadefrom"),1,strlen($template_params->get("headerfadefrom"))).  "&fadeout=".substr($template_params->get("headerfadeto"),1,strlen($template_params->get("headerfadeto")))."&steps=100&width=1&height=36);height:31px;padding-top:5px;padding-left:10px;}"."\n";
/*//toolbar 
$style.="div#toolbar-box div.m{background:".$template_params->get("toolbarbg")."}"."\n";
$style.="div.m div.header{color:".$template_params->get("toolbartitle")."}"."\n";
$style.="div.m div.header{font-size:".$template_params->get("toolbartext")."px}"."\n";*/
//legend
$style.="fieldset legend{color:".$template_params->get("legend")."}"."\n";
$style.="fieldset legend{font-size:".$template_params->get("legendtext")."px}"."\n";
$style.="div.m fieldset{border:1px solid ".$template_params->get("bordercolor")."}"."\n";
//article
$style.="table.adminlist thead tr th{background:".$template_params->get("articleheaderbg")."}"."\n";
$style.="div.m .adminlist th a,div.m .adminlist th{color:".$template_params->get("articletitle")."}"."\n";
$style.="table.adminlist a:link,table.adminlist a:visited{color:".$template_params->get("linkcolor")."}"."\n";
$style.="table.adminlist th{font-size:".$template_params->get("articletext")."px}"."\n";
$style.="table.adminlist tbody tr.row0 td{background-color:".$template_params->get("articlerow0")."}"."\n";
$style.="div.m table.adminlist tbody tr.row1 td{background-color:".$template_params->get("articlerow1")."}"."\n";
$style.="div.m table.adminlist tbody tr.row0:hover td{background-color:".$template_params->get("articlerow0hover")."}"."\n";
$style.="div.m table.adminlist tbody tr.row1:hover td{background-color:".$template_params->get("articlerow1hover")."}"."\n";
//header
$style.="div.m ul li.node{background:".$template_params->get("headerbg")."}"."\n";
$style.="div.m #menu a{font-size:".$template_params->get("headertext")."px}"."\n";
$style.="div.m #menu a{color:".$template_params->get("headertitle")."}"."\n";
//input box
$style.=".inputbox[type=checkbox]{background-color:transparent}"."\n";
$style.=".inputbox[type=checkbox]{border:none}"."\n";
//this is not valid for ie checkbox
//$style.=".inputbox{background-color:".$template_params->get("inputboxbg")."}"."\n";
$style.=".inputbox,select{color:".$template_params->get("inputbox")."}"."\n";
$style.="div.m input{border:1px solid ".$template_params->get("inputboxborder")."}"."\n";
//$style.="div.m input:focus,div.m select:focus,div.m textarea:focus{background-color:".$template_params->get("inputboxfocus")."}"."\n";
//note
$style.="div.m span.note{background-color:".$template_params->get("notebg")."}"."\n";
$style.="div.m span.note{color:".$template_params->get("notetitle")."}"."\n";
//label box
$style.="div.m .admintable td.key,div.m .admintable td.paramlist_key{background-color:".$template_params->get("labelboxbg")."}"."\n";
$style.="div.m .admintable td.key,div.m .admintable td.paramlist_key span.editlinktip label{color:".$template_params->get("labelboxtitle")."}"."\n";
$style.="div.m .admintable td.key,div.m .admintable td.paramlist_key{font-size:".$template_params->get("labelboxtext")."px}"."\n";
//button
$style.="div.m td button{background-color:".$template_params->get("buttonbg")."}"."\n";
$style.="div.m td button{color:".$template_params->get("buttontitle")."}"."\n";
//menu level1
$style.="#content-left dl.accordion dt.accordion_toggler_1 a{color:".$template_params->get("leftMenuLinkColor1")."}"."\n";
$style.="#content-left dl.accordion dt.accordion_toggler_1{background:".$template_params->get("leftMenuLinkBackColor1")."}"."\n";
$style.=".admintable .pane-sliders .panel h3,.adminform .pane-sliders .panel h3,form .pane-sliders .panel h3,.g-title{background:".$template_params->get("leftMenuLinkBackColor2")."}"."\n";
$style.="#content-left dl.accordion dt.accordion_toggler_1.open a{color:".$template_params->get("leftMenuOpenLinkColor1")."}"."\n";
$style.="#content-left dl.accordion dt.accordion_toggler_1.open{background:".$template_params->get("leftMenuOpenBGColor1")."}"."\n";
$style.="form .pane-sliders .panel h3.jpane-toggler-down,.admintable .pane-sliders .panel h3.jpane-toggler-down,.adminform .pane-sliders .panel h3.jpane-toggler-down,.g-title_open{color:#fff;background:".$template_params->get("leftMenuOpenColor")."}"."\n";
$style.="form .pane-sliders .panel h3.jpane-toggler span,.admintable .pane-sliders .panel h3.jpane-toggler span,.adminform .pane-sliders .panel h3.jpane-toggler span,.g-title{color:#666;}"."\n";
//$style.="#content-left dl.accordion dt.accordion_toggler_1 open{background:".$template_params->get("leftMenuLinkBackColor1")."}"."\n";
//menu level2
$style.="#content-left dl.accordion dd.accordion_content_1 dl dt.accordion_toggler_2 a,#content-left dl.accordion dd.accordion_content_1 dl dd.accordion_content_accordion_content_2 a{color:".$template_params->get("leftMenuLinkColor2")."}"."\n";
$style.="#content-left dl.accordion dd.accordion_content_1 dl dt.accordion_toggler_2,#content-left dl.accordion dd.accordion_content_1 dl dd.accordion_content_accordion_content_2{background:".$template_params->get("leftMenuLinkBackColor2")."}"."\n";
$style.="#content-left dl.accordion dd.accordion_content_1 dl dt.accordion_toggler_2.open{background:".$template_params->get("leftMenuLinkOpenBackColor2")."}"."\n";
//menu level3
$style.="#content-left dl.accordion dd dl dl dd.accordion_content_accordion_content_3 a{color:".$template_params->get("leftMenuLinkColor3")."}"."\n";
$style.="#content-left dl.accordion dd dl dl dd.accordion_content_accordion_content_3{background:".$template_params->get("leftMenuLinkBackColor3")."}"."\n";
//Open menu
$style.="#content-left dl.accordion dd dl dl dd.bg.accordion_content_accordion_content_3 a,#content-left dl.accordion dd dl dd.bgc.accordion_content_accordion_content_2 a{color:".$template_params->get("leftMenuLinkOpenColor")."}"."\n";
$style.="#content-left dl.accordion dd dl dl dd.bg.accordion_content_accordion_content_3,#content-left dl.accordion dd dl dd.bgc.accordion_content_accordion_content_2{background:".$template_params->get("leftMenuOpenColor")."}"."\n";

$style.="table.adminlist tfoot td{background-image:url(".JURI::base()."templates/".$this->template."/index.php?background=gradient&fadefrom=".substr($template_params->get("footerfadefrom"),1,strlen($template_params->get("footerfadefrom"))).  "&fadeout=".substr($template_params->get("footerfadeto"),1,strlen($template_params->get("footerfadeto")))."&steps=100&width=1&height=60);border:1px solid #999999}";
$style.="ul#toolbar,div#content-strip,div#toolbar-strip,#toolbar_filter{background-image:url(".JURI::base()."templates/".$this->template."/index.php?background=gradient&fadefrom=".substr($template_params->get("toolbarfadefrom"),1,strlen($template_params->get("toolbarfadefrom"))).  "&fadeout=".substr($template_params->get("toolbarfadeto"),1,strlen($template_params->get("toolbarfadeto")))."&steps=100&width=1&height=32);border-left:none}";
//login page
//$style.="body#loginbody{background-image:url(".JURI::base() ."templates/".$this->template."/index.php?background=gradient&fadefrom=".substr($template_params->get("loginpagefadefrom"),1,strlen($template_params->get("loginpagefadefrom"))). "&fadeout=".substr($template_params->get("loginpagefadeto"),1,strlen($template_params->get("loginpagefadeto")))."&steps=100&width=1&height=window.innerHeight);}";
$doc->addStyleDeclaration( $style );
?>
