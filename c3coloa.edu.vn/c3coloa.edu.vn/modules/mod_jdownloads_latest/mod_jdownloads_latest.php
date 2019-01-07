<?php
/**
* @version $Id: mod_jdownloads_latest.php v1.5
* @package mod_jdownloads_latest
* @copyright (C) 2009 Arno Betz
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author Arno Betz http://www.jDownloads.com
*/

/** This Modul shows the newest added downloads from the component jDownloads. 
*   It is only for jDownloads 1.5 and later (Support: www.jDownloads.com)
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
Error_Reporting(E_ERROR);

$database = &JFactory::getDBO(); 
$user = &JFactory::getUser(); 
$Itemid = JRequest::getVar("itemId");
$config=&JFactory::getConfig();
$sef=$config->getValue("sef");

JHTML::_('behavior.tooltip');

$text_before     = trim($params->get( 'text_before' ) );
$text_after      = trim($params->get( 'text_after' ) );
$cat_id          = trim($params->get( 'cat_id' ) );
$sum_view        = intval(($params->get( 'sum_view' ) ));
$sum_char        = intval(($params->get( 'sum_char' ) ));
$short_char      = ($params->get( 'short_char' ) ); 
$short_version   = ($params->get( 'short_version' ) );
$detail_view     = ($params->get( 'detail_view' ) ); 
$view_date       = ($params->get( 'view_date' ) );
$view_date_same_line = ($params->get( 'view_date_same_line' ) ); 
$date_format     = ($params->get( 'date_format' ) );
$view_pics       = ($params->get( 'view_pics' ) );
$view_pics_size  = ($params->get( 'view_pics_size' ) );
$view_numerical_list   = ($params->get( 'view_numerical_list' ) );
$date_alignment        = ($params->get( 'date_alignment' ) ); 
$cat_show              = ($params->get( 'cat_show' ) );
$cat_show_type         = ($params->get( 'cat_show_type' ) );
$cat_show_text         = ($params->get( 'cat_show_text' ) );
$cat_show_text_color   = ($params->get( 'cat_show_text_color' ) );
$cat_show_text_size    = ($params->get( 'cat_show_text_size' ) );
$cat_show_as_link      = ($params->get( 'cat_show_as_link' ) ); 
$view_tooltip          = ($params->get( 'view_tooltip' ) ); 
$view_tooltip_length   = intval(($params->get( 'view_tooltip_length' ) )); 
$alignment             = ($params->get( 'alignment' ) ); 
$moduleclass_sfx       = ($params->get( 'moduleclass_sfx' ) );

    $cat_show_text = trim($cat_show_text);
    if ($cat_show_text) $cat_show_text = ' '.$cat_show_text.' ';

    if ($sum_view == 0) $sum_view = 5;
    $option = 'com_jdownloads';
    
    // get published root menu link
    $database->setQuery("SELECT id from #__menu WHERE link = 'index.php?option=com_jdownloads&view=viewcategories' and published = 1");
    $root_itemid = $database->loadResult();
    
    $access = '';
    if ($user->aid == 0) $access = '01';
    if ($user->aid == 1) $access = '11';
    if ($user->aid == 2) $access = '22';
    // admins has access to all categories
    if ($user->usertype == 'Super Administrator' || $user->usertype == 'Administrator'){
        $access = '99';
    }
    
    $groups_exists = false;
    $prefix = $database->_table_prefix;
    $tables = array( $prefix.'jdownloads_cats' );
    $result = $database->getTableFields( $tables );
    if ($result[$prefix.'jdownloads_cats']['cat_group_access']) $groups_exists = true;    
    
    // get cat access groups
    if ($user->id){
        $database->setQuery("SELECT id FROM #__jdownloads_groups WHERE FIND_IN_SET($user->id, groups_members)");
        $in_groups = implode(',', $database->loadResultArray());           
    } 
    if (!$in_groups) $in_groups = 9999999;
        
    // only given cat id's
    $catids = array(); 
    if ($cat_id != 0) {
        if ($groups_exists){
            $database->setQuery("SELECT cat_id FROM #__jdownloads_cats WHERE published = 1 AND cat_id IN ($cat_id)  OR parent_id IN ($cat_id) AND (cat_access <= '$access' OR cat_group_access IN ($in_groups))");
        } else {
            $database->setQuery("SELECT cat_id FROM #__jdownloads_cats WHERE published = 1 AND cat_id IN ($cat_id) OR parent_id IN ($cat_id) AND cat_access <= '$access'");
        }    
        $catids = $database->loadResultArray(0);
        if ($catids){
            $catid = implode(',', $catids);
            $database->setQuery('SELECT * FROM #__jdownloads_files WHERE published = 1 AND cat_id IN ('.$catid.') ORDER BY date_added DESC limit '.$sum_view);
        }
    } else {
        // all categories
        if ($groups_exists){
            $database->setQuery("SELECT cat_id FROM #__jdownloads_cats WHERE published = 1 AND (cat_access <= '$access' OR cat_group_access IN ($in_groups))");
        } else {
           $database->setQuery("SELECT cat_id FROM #__jdownloads_cats WHERE published = 1 AND cat_access <= '$access'");
        }    
        $catids = $database->loadResultArray(0);
        if ($catids){
            $catid = implode(',', $catids);
            $database->setQuery('SELECT * FROM #__jdownloads_files WHERE published = 1 AND cat_id IN ('.$catid.') ORDER BY date_added DESC limit '.$sum_view);
        }    
    }
    $files = $database->loadObjectList();
    
    $html = '';
    $html = '<table width="100%" class="moduletable'.$moduleclass_sfx.'">';
    
    if ($files) {
        if ($text_before <> ''){
            $html .= '<tr><td>'.$text_before.'</td></tr>';   
        }
        for ($i=0; $i<count($files); $i++) {
            $version = $short_version; 
            if ($sum_char > 0){
                $gesamt = strlen($files[$i]->file_title) + strlen($files[$i]->release) + strlen($short_version) +1;
                if ($gesamt > $sum_char){
                   $files[$i]->file_title = JString::substr($files[$i]->file_title, 0, $sum_char).$short_char;
                   $files[$i]->release = '';
                }    
            } 
            
            $database->setQuery("SELECT id from #__menu WHERE link = 'index.php?option=com_jdownloads&view=viewcategory&catid=".$files[$i]->cat_id."' and published = 1");
            $Itemid = $database->loadResult();
            if (!$Itemid){
                $Itemid = $root_itemid;
            }  

            if ($cat_show) {
                if ($cat_show_type == 'containing') {
                    $database->setQuery('SELECT cat_title FROM #__jdownloads_cats WHERE cat_id = '.$files[$i]->cat_id);
                    $cattitle = $database->loadResult();
                    $cat_show_text2 = $cat_show_text.$cattitle;
                } else {
                    $database->setQuery('SELECT cat_dir FROM #__jdownloads_cats WHERE cat_id = '.$files[$i]->cat_id);
                    $catdir = $database->loadResult();
                    $cat_show_text2 = $cat_show_text.$catdir;
                }
            } else {
                $cat_show_text2 = '';
            }    
                           
            if ($detail_view == '1'){
                $link = 'index.php?option='.$option.'&amp;Itemid='.$Itemid.'&amp;view=viewdownload&catid='.$files[$i]->cat_id.'&cid='.$files[$i]->file_id;
            } else {    
                $link = 'index.php?option='.$option.'&amp;Itemid='.$Itemid.'&amp;view=viewcategory&catid='.$files[$i]->cat_id;
            }    
            if ($sef==1){
                $link = JRoute::_($link);
            }
            if (!$files[$i]->release) $version = '';
            
            $size = 0;
            $files_pic = '';
            $number = '';
            if ($view_pics){
                $size = (int)$view_pics_size;
                $files_pic = '<img src="'.JURI::base().'images/jdownloads/fileimages/'.$files[$i]->file_pic.'" align="top" width="'.$size.'" height="'.$size.'" border="0" alt="" /> '; 
            }
            if ($view_numerical_list){
                $num = $i+1;
                $number = "$num. ";
            }    
            if ($view_tooltip){
                $link_text = '<a href="'.$link.'">'.JHTML::tooltip(strip_tags(substr($files[$i]->description,0,$view_tooltip_length)).$short_char,JText::_('DESCRIPTION_TITLE'),$files[$i]->file_title.' '.$version.$files[$i]->release,$files[$i]->file_title.' '.$version.$files[$i]->release).'</a>';                
            } else {    
                $link_text = '<a href="'.$link.'">'.$files[$i]->file_title.' '.$version.$files[$i]->release.'</a>';
            }    
            $html .= '<tr valign="top"><td align="'.$alignment.'">'.$number.$files_pic.$link_text.'</td>';
            
            if ($view_date) {
                if ($files[$i]->date_added){
                    if ($view_date_same_line){
                        $html .= '<td align="'.$date_alignment.'">'.substr(JHTML::date($files[$i]->date_added, $date_format),0,10).'</td>'; 
                    } else {
                        $html .= '<tr valign="top"><td align="'.$date_alignment.'">'.substr(JHTML::date($files[$i]->date_added, $date_format),0,10).'</td>';
                    }
                }    
            } 
            $html .= '</tr>';
            
            if ($cat_show_text2) {
                if ($cat_show_as_link){
                    $html .= '<tr valign="top"><td align="'.$alignment.'" style="font-size:'.$cat_show_text_size.'; color:'.$cat_show_text_color.';"><a href="index.php?option='.$option.'&amp;Itemid='.$Itemid.'&amp;view=viewcategory&catid='.$files[$i]->cat_id.'">'.$cat_show_text2.'</a></td></tr>';
                } else {    
                    $html .= '<tr valign="top"><td align="'.$alignment.'" style="font-size:'.$cat_show_text_size.'; color:'.$cat_show_text_color.';">'.$cat_show_text2.'</td></tr>';
                }
            }    
        }
        if ($text_after <> ''){
            $html .= '<tr><td>'.$text_after.'</td></tr>';
        }
    }
    
    echo $html.'</table>'; 
?>