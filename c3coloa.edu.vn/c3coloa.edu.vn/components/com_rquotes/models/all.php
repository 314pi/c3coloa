<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class ModelRquotesAll extends JModel

{

	var $_rquotes = null;
		
	function getList()
	{
	 
	
		if(!$this->_rquotes)
		
		{
		
		
		$params =& JComponentHelper::getParams('com_rquotes');
		$category= $params->get('category');
		$limit= $params->get('limit');
		$order= $params->get('order');
		$order_collumn= $params->get('order_collumn');
		$db =& JFactory::getDBO(); 
	
		if(!$category)
	{
	
	
	$query = "SELECT * FROM #__rquotes WHERE published = '1'  ORDER BY $order_collumn $order LIMIT $limit " ; 
			$this->_rquotes = $this->_getList($query, 0, 0);
			
			return $this->_rquotes;
	}
	
			
	$sql = "SELECT  name  FROM  #__rquotes_categories WHERE AND published = '1' id='$category'";
	$db->setQuery($sql); 
	$results=$db->loadResult() ;
	

//$query = "SELECT * FROM #__rquotes WHERE published = '1' AND category='$results[1]' ORDER BY $order_collumn $order LIMIT $limit " ; 
		//	$this->_rquotes = $this->_getList($query, 0, 0);
				
		
		$query = "SELECT * FROM #__rquotes WHERE published = '1' AND catid='$category' ORDER BY $order_collumn $order LIMIT $limit " ; 
			$this->_rquotes = $this->_getList($query, 0, 0);
			
		}
		
		return $this->_rquotes;
	}
}

?>