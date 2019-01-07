<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<marquee onmouseover="this.stop();" onmouseout="this.start();" scrollAmount=<?php echo trim( $params->get( 'amount' ) ); ?> scrollDelay=<?php  echo trim( $params->get( 'delay' ) ); ?> direction="left">
<?php foreach ($list as $item) :  ?>
		<a href="<?php echo $item->link; ?>" class="latestnews<?php echo $params->get('moduleclass_sfx'); ?>">
		 <?php echo "+ <b>$item->text</b></a> &nbsp;&nbsp;"?>
<?php endforeach; ?>
</marquee>
