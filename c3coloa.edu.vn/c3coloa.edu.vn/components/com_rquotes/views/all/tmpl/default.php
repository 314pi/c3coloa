<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?> 
<table> 
<?php foreach($this->list as $l): ?> 
<tr><td>

<?php
$params =& JComponentHelper::getParams('com_rquotes');
		$show_quote= $params->get('show_quote');
		$show_author= $params->get('show_author');
		$show_notes= $params->get('show_notes');


if($show_quote == 'yes' )
 {echo $l->quote;}
    ?>
    
 </a> <p>
 
 <?php
if($show_author == 'yes' )
 echo $l->author; 
 ?>
 
 <p></a>
 
<?php
if($show_notes == 'yes' )
 echo $l->notes;
  ?>
  </a></td></tr> 
<?php endforeach; ?><p> 

</table>