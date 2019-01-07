<?php 
/**
 * @version		1.5.4
 * @package		Joomla
 * @subpackage	Rquotes
 * @copyright	Copyright (C) 2008 - 2010 Open Source Matters. All rights reserved.
 * @license		GPLv2.0, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */
defined( '_JEXEC' ) or die( 'Restricted access' ); 
class HTML_rquotes 
{ 
	function editRquote( $row, $lists, $option ) 
	
	{ 
	
		$editor =& JFactory::getEditor(); 
?>
 
<form action="index.php" method="post" 
				 name="adminForm" id="adminForm"> 
		<fieldset class="adminform"> 
		<legend><?php echo JText::_('Details');?></legend> 
		<table class="admintable">
	<tr>
		
  <td width="100" align="right" class="key"><?php echo JText::_('Daily Order # (Optional-for daily display)');	?>  : </td>
			
			<td>
			<input class ="text_area" type="int" name="daily_number"
			id="daily_number" size="20" maxlength="10"
			value="<?php echo $row->daily_number;?>" />
			</td>
		
		</tr>
		<tr> 
      <td width="50" align="right" class="key"><?php echo JText::_('Published');?> : </td>
      <td> 
        <?php 
			echo $lists['published']; 
			?>
      </td>
    </tr>
    <tr> 
      <td width="100" align="right" class="key"><?php echo JText::_('Category');?>  : </td>
      <td> 
        <?php 
		
		echo $lists['catid'];
		
			?>
      </td>
    </tr>
    <tr> 
      <td width="100" align="right" class="key"><?php echo JText::_('Quote,Riddle,etc');?> : </td>
      <td> 
        <?php 
			echo $editor->display( 'quote',	 $row->quote , 
									  '100%', '150', '40', '5' ) ; 
			?>
      </td>
    </tr>
    <tr> 
      <td width="100" align="right" class="key"><?php echo JText::_('Author,Answer,etc');?>: </td>
      <td> 
        <?php 
			echo $editor->display( 'author',  $row->author , 
									 '100%', '150', '40', '5' ) ; 
			?>
      </td>
    </tr>
    <tr> 
      <td width="100" align="right" class="key"><?php echo JText::_('Notes');?> : </td>
      <td> <textarea class="text_area" cols="20" rows="4" 
			   name="notes" id="notes" style="width:500px"><?php echo 
			   $row->notes; ?></textarea> </td>
    </tr>
    
  </table> 
		</fieldset>
	
	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option;?>" /> 
	<input type="hidden" name="task" value="" /> 

	</form> 
		<?php 
	}
	
	function showRquotes( $option, &$rows, &$pageNav,&$lists ) 
	{ 
	
	 ?> 
	  
	 
	 <table>
		<tr>
			<td align="right" width="100%">
				
	  <form action="index.php" method="post" name="adminForm"> 
	
			</td>
			<td nowrap="nowrap">
				<?php
				
				echo $lists['catid'];
				echo $lists['state'];
			
				
				?>
			</td>
		</tr>
		</table>
		
  <table width="594" class="adminlist">
 
<thead>
     
     
    
    <tr> 
	<th width="5"><?php echo JText::_('#') ;?></th>
        <th width="5"> <input type="checkbox" name="toggle" 
	               value="" onClick="checkAll(<?php echo 
	               count( $rows ); ?>);" /> </th>
				   
				   
			   
		
<th width="5">	<?php echo JHTML::_('grid.sort','Daily#','daily_number',$lists['order_Dir'],$lists['order']);?></th>			   
				   
    
		 <th width="250">	<?php echo JHTML::_('grid.sort','Quote,Riddle,etc','quote',$lists['order_Dir'],$lists['order']);?></th>
     
			<th width="50">	<?php echo JHTML::_('grid.sort','Author,Answer,etc','author',$lists['order_Dir'],$lists['order']);?></th>
		        <th width="30">	<?php echo JHTML::_('grid.sort','Category','catid',$lists['order_Dir'],$lists['order']);?></th>
    <th width="86">	<?php echo JHTML::_('grid.sort','Notes','notes',$lists['order_Dir'],$lists['order']);?></th>
         <th width="30">	<?php echo JHTML::_('grid.sort','Published','published',$lists['order_Dir'],$lists['order']);?></th>	
    </tr>
</thead>
	
    <?php
		jimport('joomla.filter.output');
	    $k = 0;
	    for ($i=0, $n=count( $rows ); $i < $n; $i++) 
	    {
			$row = &$rows[$i]; 
			$checked = JHTML::_('grid.id', $i, $row->id );
			$published = JHTML::_('grid.published', $row, $i );
			$link = JFilterOutput::ampReplace( 'index.php?option=' . $option . '&task=edit&cid[]='. $row->id );
	      ?>
    <tr class="<?php echo "row$k"; ?>">
<td align="center"><a href="<?php echo $link; ?>"><?php echo $row->id; ?> </td>	
		<td align="center"> <?php echo $checked; ?> </td>
		
		
		<td align="center"> <?php echo $row->daily_number; ?> </td> 
		
		
		<td> <a href="<?php echo $link; ?>"> <?php echo $row->quote; ?></a> </td>
		<td> <a href="<?php echo $link; ?>"> <?php echo $row->author; ?> </a></td>
		<td> <a href="<?php echo $link; ?>"><?php echo $row->catname; ?></td>
		
		<td> <?php echo $row->notes; ?></td>
		<td align="center"> <?php echo $published;?> </td>
    </tr>
    <?php 
	      $k = 1 - $k; 
	    } 
	    ?>
    <tfoot>
    <tr> 
      <td colspan="7"><?php echo $pageNav->getListFooter(); ?></td>
  </table> 
	  <input type="hidden" name="option" value="<?php echo $option;?>" /> 
	  <input type="hidden" name="task" value="" /> 
	  <input type="hidden" name="boxchecked" value="0" /> 
	  <input type="hidden" name="filter_order" value="<?php echo $lists['order'];?>" />
	  <input type="hidden" name="filter_order_Dir" value=" " />	  
</form> 
	  
<?php 
}
}
?>
