<?php

/**
* Gavick News Show GK3 - default template
* @package Joomla!
* @Copyright (C) 2008 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 3.0 $
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

if($this->na < $this->news_amount) $this->news_amount = $this->na;

?>

<table <?php echo $this->mstyle; ?> class="gk_news_show_table" id="<?php echo $this->module_unique_id; ?>" cellpadding="0" cellspacing="0" >
<?php for($b=0;(($this->news_amount-($b*$this->news_column))>0);$b++) : ?>
	
	<?php if($b < $news_rows2): ?> 
		<tr valign="top" class="gk_news_show_tablerow">
	<?php else: ?>
		<tr valign="top" class="gk_news_show_tablerow_invisible">
	<?php endif; ?>
	
	<?php for($c=0;$c<$this->news_column;$c++) : ?>
		<?php
			if($this->news_column == 1)
			{
				$tablecell_class = 'gk_news_show_center';
			}
			elseif($this->news_column == 2)
			{
				$tablecell_class = ($c == 0) ? 'gk_news_show_left' : 'gk_news_show_right';
			}
			else
			{
				if($c == 0)
				{
					$tablecell_class = 'gk_news_show_left';
				}
				else
				{
					if($c == ($this->news_column - 1) )
					{
						$tablecell_class = 'gk_news_show_right';
					}
					else
					{
						$tablecell_class = 'gk_news_show_center';
					}
				}
			}
		?>
			
		<?php if((($b*$this->news_column)+$c) >= count($news_code_html_tab)) : ?>
			<td style="width: <?php echo $column_width; ?>;" class="<?php echo $tablecell_class; ?>"></td>
		<?php else : ?>
			<td style="width: <?php echo $column_width; ?>;" class="<?php echo $tablecell_class; ?>">
				<?php if($this->rounded):?>
				<div class="gk_round">
  					<div>
    					<div>
			      			<div class="clearfix">
			    <?php endif; ?> 			
								<?php if(isset($news_code_html_tab[(($b*$this->news_column)+$c)]))echo $news_code_html_tab[(($b*$this->news_column)+$c)];?>
				<?php if($this->rounded):?>				
     	 					</div>
    					</div>
  					</div>
				</div>
				<?php endif; ?> 
			</td>		
		<?php endif; ?>
	<?php endfor; ?>
		</tr>
<?php endfor; ?>

<?php if($this->show_list == 1) : ?>
	<tr class="gk_news_show_tablerow">
		<td colspan="<?php echo $this->news_column; ?>" class="gk_news_show_tablerow_bottom gk_news_show_tablerow">
			<?php if($this->news_more_in == 1) echo '<p>'.$this->more_in_text.'</p>'; ?> 
			<ul class="<?php echo ($this->list_style == 0) ? 'gk_news_show_list_floated' : 'gk_news_show_list' ?>"><?php echo $news_rest_news_list_tab; ?></ul>
		</td>
	</tr>
<?php endif; ?>
	
<?php if($this->panel == 1) : ?>
	<tr class="gk_news_show_tablerow_top gk_news_show_tablerow"><td class="gk_news_show_panel-border" colspan="<?php echo $this->news_column; ?>"><div class="gk_news_show_panel">
	<?php if($this->panel_font == 1) : ?> 
		<div class="gk_news_show_panel_font"><div class="gk_news_show_panel_font_path"><div class="gk_news_show_panel_font_knob"></div></div><span class="gk_news_show_panel_font_value">100%</span></div> 
	<?php endif; ?>
		
	<?php if($this->panel_amount == 1) : ?>
		<div class="gk_news_show_panel_amount"><div class="gk_news_show_panel_amount_minus">-</div><div class="gk_news_show_panel_amount_plus">+</div><span class="gk_news_show_panel_amount_value"><?php echo $news_amount_to_show; ?></span></div>
		</div><div class="gk_news_show_panel_tools gk_news_show_panel_tools_hidden" title="<?php echo JText::_('HIDEOPTIONS'); ?>"><?php echo JText::_('SHOWOPTIONS'); ?></div></td></tr>
	<?php endif; ?>
<?php endif; ?>

</table>