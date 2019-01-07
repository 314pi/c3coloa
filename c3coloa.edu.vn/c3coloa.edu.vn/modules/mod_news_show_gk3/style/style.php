<?php

/**
* Gavick News Show GK3 - dynamic CSS file
* @package Joomla!
* @Copyright (C) 2008 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 3.0 $
**/

// access restriction for this file haven't any sense

/*
	This file generate CSS file for specified in $_GET variables module
*/
	
// set document type as text/javascript	
header("Content-Type: text/css");

switch($_GET['news_content_header_pos'])
{
	case 0: $news_header_style = '';break; 
	case 1: $news_header_style = 'text-align: left;';break; 
	case 2: $news_header_style = 'text-align: right;';break; 
	case 3: $news_header_style = 'text-align: center;';break; 
}

$news_image_style = '';

switch($_GET['news_content_image_pos']){
	case 0: $news_image_style .= '';break; 
	case 1: $news_image_style .= 'display: block;float: left;';break; 
	case 2: $news_image_style .= 'display: block;float: right;';break; 
	case 3: $news_image_style .= 'display: block;margin: 0 auto;';break; 
}

$news_image_style_static = $news_image_style;

if($_GET['img_height'] != 0) 
{
	$news_image_style_static .= 'height: '.$_GET['img_height'].';';
}

if($_GET['img_width'] != 0) 
{
	$news_image_style_static .= 'width: '.$_GET['img_width'].';';
}

if($_GET['news_content_info_pos'] == 1)
{
	$pos = 'left';
}
elseif($_GET['news_content_info_pos'] == 2)
{
	$pos = 'right';
}
else
{
	$pos = 'center';
}

switch($_GET['news_content_readmore_pos'])
{
	case 0: $news_readmore_style = '';break; 
	case 1: $news_readmore_style = 'float: left;';break; 
	case 2: $news_readmore_style = 'float: right;';break; 
	case 4: $news_readmore_style = '';break; 
}

switch($_GET['news_content_text_pos'])
{
	case 0: $news_text_style = '';break; 
	case 1: $news_text_style = 'text-align: left;';break; 
	case 2: $news_text_style = 'text-align: right;';break; 
	case 3: $news_text_style = 'text-align: center;';break; 
	case 4: $news_text_style = 'text-align: justify;';break; 
}

?>

<?php echo '#'.$_GET['modid']; ?> a.readon_class{
	<?php echo $news_readmore_style; ?>
}

<?php echo '#'.$_GET['modid']; ?> h4.gk_news_show_news_header {
	margin: 0 0 8px;
	padding:0;
	<?php echo $news_header_style; ?>
}

<?php echo '#'.$_GET['modid']; ?> img.gk_news_show_news_image {
	<?php echo $news_image_style; ?>
}

<?php echo '#'.$_GET['modid']; ?> img.gk_news_show_news_image_static {
	<?php echo $news_image_style_static; ?>
}

<?php echo '#'.$_GET['modid']; ?> a.gk_news_show_news_readmore {
}

<?php echo '#'.$_GET['modid']; ?> a.gk_news_show_news_readmore_inline {
	margin-left: 10px;
}

<?php echo '#'.$_GET['modid']; ?> p.gk_news_show_news_text {
	margin-top: 0px;
	<?php echo $news_text_style; ?>
}

<?php echo '#'.$_GET['modid']; ?> p.gk_news_show_news_info{
	text-align: <?php echo $pos; ?>
}

<?php echo '#'.$_GET['modid']; ?> table.gk_news_show_table {
}

<?php echo '#'.$_GET['modid']; ?> td.gk_news_show_tablerow_top {
}

<?php echo '#'.$_GET['modid']; ?> div.gk_news_show_panel {
	display: none;
	padding: 6px 0 0 0;
}

<?php echo '#'.$_GET['modid']; ?> div.gk_news_show_panel_font {
	float: left;
	width: 100px;
	padding: 0;
}

<?php echo '#'.$_GET['modid']; ?> div.gk_news_show_panel_font_path {
	width: 100px;
	height: 6px;
	padding: 0;
	border: 1px solid #EEE;
}

<?php echo '#'.$_GET['modid']; ?> div.gk_news_show_panel_font_knob {
	width: 5px;
	height: 6px;
	padding: 0;
	cursor: pointer;
	font-size: 1px;
	background: #CCC;
}

<?php echo '#'.$_GET['modid']; ?> span.gk_news_show_panel_font_value {
	display:block;
	float:left;
}

<?php echo '#'.$_GET['modid']; ?> div.gk_news_show_panel_amount {
	float: right;
	width: 50px;
	padding: 0;
}

<?php echo '#'.$_GET['modid']; ?> div.gk_news_show_panel_amount_plus,
<?php echo '#'.$_GET['modid']; ?> div.gk_news_show_panel_amount_minus {
	width: 12px;
	height: 12px;
	float:left;
	line-height: 12px;
	padding: 0;
	text-align: center;
	cursor: pointer;
	margin-right: 3px;
	border: 1px solid #EEE;
}

<?php echo '#'.$_GET['modid']; ?> span.gk_news_show_panel_amount_value {
	display: block;
	float:left;
	font-size: 10px;
	margin-left: 4px;
}

<?php echo '#'.$_GET['modid']; ?> div.gk_news_show_panel_tools,
<?php echo '#'.$_GET['modid']; ?> div.gk_news_show_panel_tools_hidden {
	cursor: pointer;
	padding: 0;
	float:right;
	font-size: 10px;
	
}

<?php echo '#'.$_GET['modid']; ?> td.gk_news_show_panel-border {
       border-top: 1px dotted #ccc;
}

<?php echo '#'.$_GET['modid']; ?> tr.gk_news_show_tablerow {
}

<?php echo '#'.$_GET['modid']; ?> td.gk_news_show_left {
}

<?php echo '#'.$_GET['modid']; ?> td.gk_news_show_center {
}

<?php echo '#'.$_GET['modid']; ?> td.gk_news_show_right {
}

<?php echo '#'.$_GET['modid']; ?> td.gk_news_show_tablerow_bottom  ul.gk_news_show_list_floated {
}

<?php echo '#'.$_GET['modid']; ?> ul.gk_news_show_list {
}

<?php echo '#'.$_GET['modid']; ?> tr.gk_news_show_tablerow{
}

<?php echo '#'.$_GET['modid']; ?> tr.gk_news_show_tablerow_invisible{
	display: none;
}

<?php echo '#'.$_GET['modid']; ?> li.block{
	display: block;
}

<?php echo '#'.$_GET['modid']; ?> li.none{
	display: none;
}