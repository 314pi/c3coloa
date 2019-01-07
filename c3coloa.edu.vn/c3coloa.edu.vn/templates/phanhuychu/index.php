<?php
/**
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

defined('_JEXEC') or die('Restricted access');

$url = clone(JURI::getInstance());
$trangchu = $this->countModules('tinanh or nhom1_trai or nhom1_phai or phai1');
$showRightColumn = $this->countModules('phai1 or phai or giua');
?>
<?php echo '<?xml version="1.0" encoding="utf-8"?'.'>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
	<jdoc:include type="head" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/template.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/position.css" type="text/css" media="screen,projection" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/layout.css" type="text/css" media="screen,projection" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/print.css" type="text/css" media="Print" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/general.css" type="text/css" />
	<?php if($this->direction == 'rtl') : ?>
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/template_rtl.css" type="text/css" />
	<?php endif; ?>
	<!--[if lte IE 6]>
		<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/ieonly.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<!--[if IE 7]>
		<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/ie7only.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/javascript/md_stylechanger.js"></script>
</head>
<body>
	<div id="all">
		<div id="logo">
			<jdoc:include type="modules" name="logo" />
		
		</div> <!--logo -->

		<div id="menungang">
			<jdoc:include type="modules" name="menungang" />
		
		</div> <!--menungang -->

		<div id="duongdan">
		
		
			<jdoc:include type="modules" name="duongdan" />
		</div> <!--duong dan -->
		
		<div id="thoigian">
		
		
			<jdoc:include type="modules" name="thoigian" />
		</div> <!--thoi gian -->
		<div id="trinhbay">
		<?php 

		if($trangchu) {
//			echo $trangchu;
		 ?>
	<!-- Trang chu		-->
			<div id="trai1">
				<div id="tinanh">
					<jdoc:include type="modules" name="tinanh" />
				</div> <!--tinanh -->
				<div id="anhgioithieu">
					<jdoc:include type="modules" name="anhgioithieu" />
				</div> <!--anhgioithieu -->
			</div> <!--trai1 -->
			
			<div id="nhom1">
				<div id="nhom1_trai">
					<jdoc:include type="modules" name="nhom1_trai" style="phanhuychu" headerLevel="3"/>
				</div> <!--nhom1_trai -->
				<div id="nhom1_giua">
					<jdoc:include type="modules" name="nhom1_giua" style="phanhuychu" headerLevel="3"/>
				</div> <!--nhom1_giua -->
				<div id="nhom1_phai">
					<jdoc:include type="modules" name="nhom1_phai" style="phanhuychu" headerLevel="3" />
				</div> <!--nhom1_phai -->
			</div> <!--nhom1 -->
			

			<div id="phai1">	
				<div id="phai1_1">
					<jdoc:include type="modules" name="phai1_1" style="phanhuychu" headerLevel="3"/>
				</div> <!--phai1_1-->
				<div id="phai1_a">
					<jdoc:include type="modules" name="phai1_a" style="phanhuychu" headerLevel="3"/>
				</div> <!--phai1_a-->
				<div id="phai1_b">
					<jdoc:include type="modules" name="phai1_b" style="phanhuychu" headerLevel="3"/>
				</div> <!--phai1_b-->
				<div id="phai1_c">
					<jdoc:include type="modules" name="phai1_c" style="phanhuychu" headerLevel="3"/>
				</div> <!--phai1c-->
				<div id="phai1_d">
					<jdoc:include type="modules" name="phai1_d" style="phanhuychu" headerLevel="3"/>
				</div> <!--phai1_d-->
			</div> <!--phai1 -->

	<!-- Ket thuc trang chu -->
	<?php } ?>
	<!-- Trang con	 -->
		<div id="<?php echo $showRightColumn ? 'noidung' : 'noidung2'; ?>">
		
			<jdoc:include type="component" />
		</div> <!--noidung -->
		<div id="nhom2">
			<div id="giua">
			
			
			
				<jdoc:include type="modules" name="giua" style="phanhuychu" headerLevel="3" />
			</div> <!--giua -->
			
			<div id="phai2">
			
			
			
			
				<jdoc:include type="modules" name="phai2" style="phanhuychu" headerLevel="3" />
			</div> <!--phai2 -->
		</div>
	<!-- Ket thuc trang con -->
		</div>
		<div id="lienket">
			<div id="lienket_tructuyen">
			
			
				<jdoc:include type="modules" name="lienkettructuyen" style="phanhuychu" headerLevel="3" />
			</div>
			
			<div id="lienketA123">
			
			
			
				<jdoc:include type="modules" name="lienketA123" style="phanhuychu" headerLevel="3"  />
			</div>
		
			
		</div> <!--lienket -->
		
		<div id="chantrang">
		
			<jdoc:include type="modules" name="chantrang" />
		</div> <!--chantrang -->
	</div>

</body>
</html>
