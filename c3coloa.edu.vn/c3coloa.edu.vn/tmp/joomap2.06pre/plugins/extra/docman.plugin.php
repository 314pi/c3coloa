<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); ?>
<?php
/* @version $Id: docman.plugin.php 2006/03/18 15:10:10 mic Exp $
 * @package joomap
 */

$tmp = new Joomap_docman;
JoomapPlugins::addPlugin( $tmp );

class Joomap_docman {

    function isOfType( &$joomap, &$parent ) {
        if( !isset( $row )){
            return false;
        }
        if( strpos($row['link'], 'task=cat_view') ) {
            return true;
        }
        return false;
    }

    function &getTree( &$joomap, &$parent) {
        global $database, $mosConfig_absolute_path;

        //DOCMan core interaction API
        include_once( $mosConfig_absolute_path."/administrator/components/com_docman/docman.class.php");
        global $_DOCMAN;
        if(!is_object($_DOCMAN)) {
            $_DOCMAN = new dmMainFrame();
        }

        $_DOCMAN->setType(_DM_TYPE_MODULE);
        $_DOCMAN->loadLanguage('modules');

        require_once($_DOCMAN->getPath('classes', 'utils'));
        require_once($_DOCMAN->getPath('classes', 'file'));
        require_once($_DOCMAN->getPath('classes', 'model'));

        // get the parameters
        $link_query = parse_url( $parent->link );
        parse_str( html_entity_decode($link_query['query']), $link_vars);

        $catid          = $link_vars['gid'];
        $limits         = 25;
        $show_icon      = 0;
        $show_category  = 0;

        $menuid = $_DOCMAN->getMenuId();

        $content = "";
        $enum    = 0;

        $rows = DOCMAN_Docs::getDocsByUserAccess($catid, '', '', $limits);
        $list = array();
        foreach ($rows as $row) {
            $doc = new DOCMAN_Document($row->id);

            $node = new stdclass;
            $node->link = sefRelToAbs("index.php?option=com_docman&amp;task=doc_download&amp;Itemid=$menuid&amp;gid=".$row->id);
            $node->name = $doc->getData('dmname');
            $node->type = 'separator';

            $list[] = $node;
        }

        return $list;
    }
}
?>
