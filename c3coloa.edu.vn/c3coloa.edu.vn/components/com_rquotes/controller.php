<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 

jimport( 'joomla.application.component.controller' ); 

class RquoteController extends JController 
{
	function display() 
	{ 
		$document =& JFactory::getDocument(); 
		$viewName = JRequest::getVar('view', 'all'); 
		$viewType = $document->getType(); 
		$view = &$this->getView($viewName, $viewType, 'View'); 
		$model =& $this->getModel( $viewName, 'ModelRquotes' ); 

		if (!JError::isError( $model )) { 
			$view->setModel( $model, true ); 
		}

		$view->setLayout('default'); 
		$view->display(); 
	}


} 

?>