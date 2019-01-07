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
	
	$link=(isset($_GET['img'])?$_GET['img']:'');
	switch ($link){
		case 'bodybackgroundimg':
			image();
			break;
		default:
			break;
	}
	
	function image(){
		$bgimg = imagecreate( 4500, 1 );
		$bg = ImageColorAllocate($bgimg,255,255,255);
		$pane1 = imagecolorallocate( $bgimg, 234, 234, 234 );
		$line = imagecolorallocate( $bgimg, 181, 181, 181 );
		$pane2 = imagecolorallocate( $bgimg, 255, 255, 255 );
		ImageRectangle($bgimg,0,86,1000,1,$bg);
		ImageFilledRectangle($bgimg,0,86,180,0,$pane1);
		imagesetthickness ( $bgimg, 1 );
		imageline( $bgimg, 181, 86, 181, 0, $line );
		ImageFilledRectangle($bgimg,182,86,1500,0,$pane2);
		header( "Content-type: image/png" );
		imagepng( $bgimg );
	}
?>

