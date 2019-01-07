<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 

jimport('joomla.application.component.view'); 

class ViewAll extends JView
{

	function display($tpl = null)
	{
	
		global $option;

		$params =& JComponentHelper::getParams('com_rquotes');
		$title= $params->get('title');
		$show_title= $params->get('show_title');
		$description=$params->get('description');
		$show_description=$params->get('show_description');
		
		?>
		 <div class="componentheading">
		  <?php
		  if ($show_title == 'yes') 
		  echo $title;
		   ?>
		   </div>
		   <div class="componentheading"> 
		   <?php
		   if ($show_description == 'yes')
		    echo $description; ?></div>
<?php
		
		
	
		$model =& $this->getModel();
		$list = $model->getList();

		for($i = 0; $i < count($list); $i++) 
		{ 
			$row =& $list[$i]; 
			
		}

		$this->assignRef('list', $list); 
		parent::display($tpl);	
	}

} 

?>