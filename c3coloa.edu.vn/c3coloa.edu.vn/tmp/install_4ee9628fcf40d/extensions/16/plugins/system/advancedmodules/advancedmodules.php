<?php
/**
 * Main Plugin File
 * Does all the magic!
 *
 * @package			Advanced Module Manager
 * @version			2.2.7
 *
 * @author			Peter van Westen <peter@nonumber.nl>
 * @link			http://www.nonumber.nl
 * @copyright		Copyright © 2011 NoNumber! All Rights Reserved
 * @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die();

// Import library dependencies
jimport( 'joomla.plugin.plugin' );

// Include the moduleHelper
jimport( 'joomla.filesystem.file' );
if ( JFile::exists( JPATH_PLUGINS.'/system/nnframework/nnframework.php' ) ) {
	$classes = get_declared_classes();
	if ( !in_array( 'JModuleHelper', $classes ) && !in_array( 'jmodulehelper', $classes ) ) {
		require_once JPATH_PLUGINS.'/system/advancedmodules/modulehelper.php';
	}
	$mainframe =& JFactory::getApplication();
	$mainframe->registerEvent( 'onRenderModule', 'plgSystemAdvancedModulesRenderModule' );
	$mainframe->registerEvent( 'onCreateModuleQuery', 'plgSystemAdvancedModulesCreateModuleQuery' );
	$mainframe->registerEvent( 'onPrepareModuleList', 'plgSystemAdvancedModulesPrepareModuleList' );
}

/**
 * Plugin that shows active modules in menu item edit view
 */
class plgSystemAdvancedModules extends JPlugin
{
	function __construct( &$subject, $config )
	{
		$this->_pass = 0;
		parent::__construct( $subject, $config );
	}

	function onAfterRoute()
	{
		$this->_pass = 0;
		$mainframe =& JFactory::getApplication();

		if ( $mainframe->isSite() ) {
			return;
		}

		$document =& JFactory::getDocument();
		$docType = $document->getType();

		// only in html
		if ( $docType != 'html' ) {
			return;
		}

		// load the admin language file
		$lang =& JFactory::getLanguage();
		if ( $lang->getTag() != 'en-GB' ) {
			// Loads English language file as fallback (for undefined stuff in other language file)
			$lang->load( 'com_advancedmodules', JPATH_ADMINISTRATOR, 'en-GB' );
		}
		$lang->load( 'com_advancedmodules', JPATH_ADMINISTRATOR, null, 1 );

		// return if NoNumber! Framework plugin is not installed
		jimport( 'joomla.filesystem.file' );
		if ( !JFile::exists( JPATH_PLUGINS.'/system/nnframework/nnframework.php' ) ) {
			if ( $mainframe->isAdmin() && JRequest::getCmd( 'option' ) !== 'com_login' ) {
				$msg = JText::_( 'AMM_NONUMBER_FRAMEWORK_PLUGIN_NOT_INSTALLED' );
				$mq = $mainframe->getMessageQueue();
				foreach ( $mq as $m ) {
					if ( $m['message'] == $msg ) {
						$msg = '';
						break;
					}
				}
				if ( $msg ) {
					$mainframe->enqueueMessage( $msg, 'error' );
				}
			}
			return;
		}

		if ( JRequest::getCmd( 'option' ) == 'com_modules' ) {
			return;
		}

		if ( !JFile::exists( JPATH_ADMINISTRATOR.'/components/com_advancedmodules/advancedmodules.php' ) ) {
			return;
		}

		$this->_pass = 1;

		// Include the Helper
		require_once JPATH_PLUGINS.'/'.$this->_type.'/'.$this->_name.'/helper.php';
		$class = get_class( $this ).'Helper';
		$this->helper = new $class();

		// Load component config
		$this->helper->config = plgSystemAdvancedModulesConfig();
	}

	/*
	 * Replace links to com_modules with com_advancedmodules
	 */
	function onAfterRender()
	{
		if ( $this->_pass ) {
			$this->helper->onAfterRender();
		}
	}
}

// ModuleHelper methods
function plgSystemAdvancedModulesRenderModule( &$module )
{
	$mainframe =& JFactory::getApplication();
	$client = $mainframe->getClientId();

	if ( $client == 0 ) {
		$config = plgSystemAdvancedModulesConfig();
		if ( $config->show_hideempty ) {
			if ( isset( $module->adv_params ) && isset( $module->adv_params->hideempty ) && $module->adv_params->hideempty ) {
				$trimmed_content = trim( $module->content );
				if ( $trimmed_content != '' ) {
					// remove html and hidden whitespace
					$trimmed_content = str_replace( chr( 194 ).chr( 160 ), ' ', $trimmed_content );
					$trimmed_content = str_replace( array( '&nbsp;', '&#160;' ), ' ', $trimmed_content );
					// remove comment tags
					$trimmed_content = preg_replace( '#<\!--.*?-->#si', '', $trimmed_content );
					// remove all closing tags
					$trimmed_content = preg_replace( '#</[^>]+>#si', '', $trimmed_content );
					// remove tags to be ignored
					$tags = '|p|div|span|strong|b|em|i|ul|font|br|h[0-9]|fieldset|label|ul|ol|li|table|thead|tbody|tfoot|tr|th|td|form';
					$s = '#<('.$tags.')([^a-z0-9>][^>]*)?>#si';
					if ( @preg_match( $s.'u', $trimmed_content ) ) {
						$s .= 'u';
					}
					if ( preg_match( $s, $trimmed_content ) ) {
						$trimmed_content = preg_replace( $s, '', $trimmed_content );
					}
				}
				if ( trim( $trimmed_content ) == '' ) {
					// return true will prevent the module from outputting html
					return true;
				}
			}
		}
	}
}

function &plgSystemAdvancedModulesConfig()
{
	static $instance;
	if ( !is_object( $instance ) ) {
		require_once JPATH_PLUGINS.'/system/nnframework/helpers/parameters.php';
		$parameters =& NNParameters::getParameters();
		$config = JComponentHelper::getParams( 'com_advancedmodules' );
		$instance = $parameters->getParams( $config->toObject(), JPATH_ADMINISTRATOR.'/components/com_advancedmodules/config.xml' );
	}
	return $instance;
}

function plgSystemAdvancedModulesCreateModuleQuery( &$query )
{
	$mainframe =& JFactory::getApplication();
	$client = $mainframe->getClientId();

	if ( $client == 0 ) {
		foreach ( $query as $type => $strings ) {
			foreach ( $strings as $i => $string ) {
				if ( $type == 'select' ) {
					$query->{$type}[$i] = str_replace( ', mm.menuid', '', $string );
				} else if ( !( strpos( $string, 'mm.' ) === false ) || !( strpos( $string, 'm.publish_' ) === false ) ) {
					unset( $query->{$type}[$i] );
				}
			}
		}
		$query->select[] = 'am.params as adv_params, 0 as menuid, m.publish_up, m.publish_down';
		$query->join[] = '#__advancedmodules as am ON am.moduleid = m.id';
		$query->order = array( 'm.ordering, m.id' );
	}
}

function plgSystemAdvancedModulesPrepareModuleList( &$modules )
{
	$mainframe =& JFactory::getApplication();
	$client = $mainframe->getClientId();

	if ( $client == 0 ) {
		$db =& JFactory::getDBO();

		jimport( 'joomla.filesystem.file' );

		require_once JPATH_PLUGINS.'/system/nnframework/helpers/parameters.php';
		$parameters =& NNParameters::getParameters();

		require_once JPATH_PLUGINS.'/system/nnframework/helpers/assignments.php';
		$assignments = new NNFrameworkAssignmentsHelper;

		$xmlfile_assignments = JPATH_ADMINISTRATOR.'/components/com_advancedmodules/assignments.xml';

		$config = plgSystemAdvancedModulesConfig();

		// set params for all loaded modules first
		// and make it an associated array (array id = module id)
		$new_modules = array();
		require_once JPATH_ADMINISTRATOR.'/components/com_advancedmodules/models/module.php';
		$model = new AdvancedModulesModelModule;
		foreach ( $modules as $id => $module ) {
			if ( !isset( $module->adv_params ) ) {
				$module->adv_params = '';
			}
			$registry = new JRegistry;
			if ( strpos( $module->adv_params, '"assignto_menuitems"' ) === false ) {
				$module->adv_params = $model->initAssignments( $module->id, $module, $module->adv_params );
				$registry->loadArray( $module->adv_params );
			} else {
				$registry->loadString( $module->adv_params );
			}
			$module->adv_params = $registry->toObject();
			$module->adv_params = $parameters->getParams( $module->adv_params, $xmlfile_assignments );
			$new_modules[$module->id] = $module;
		}
		$modules = $new_modules;
		unset( $new_modules );

		foreach ( $modules as $id => $module ) {
			if ( $module->adv_params === 0 ) {
				continue;
			}

			$extraparams = array();
			for ( $i = 1; $i <= 5; $i++ ) {
				$var = 'extra'.$i;
				$extraparams[$var] = ( isset( $module->adv_params->$var ) ? $module->adv_params->$var : '' );
			}
			if ( !empty( $extraparams ) ) {
				$registry = new JRegistry;
				$registry->loadString( $module->params );
				$module->params = $registry->toArray();
				$module->params = array_merge( $module->params, $extraparams );
				$registry = new JRegistry;
				$registry->loadArray( $module->params );
				$module->params = $registry->toString();
			}
			$module->reverse = 0;

			if ( !isset( $module->published ) ) {
				$module->published = 0;
			}
			// Check if module should mirror another modules assignment settings
			if ( $module->published && $config->show_mirror_module ) {
				$count = 0;
				while ( $count++ < 10
					&& isset( $module->adv_params->mirror_module )
					&& $module->adv_params->mirror_module
					&& isset( $module->adv_params->mirror_moduleid )
					&& $module->adv_params->mirror_moduleid
				) {
					$mirror_moduleid = $module->adv_params->mirror_moduleid;
					$module->reverse = ( $module->adv_params->mirror_module == 2 );
					if ( $mirror_moduleid ) {
						if ( $mirror_moduleid == $id ) {
							$empty = new stdClass();
							$module->adv_params = $parameters->getParams( $empty, $xmlfile_assignments );
						} else {
							if ( isset( $modules[$mirror_moduleid] ) ) {
								$module->adv_params = $modules[$mirror_moduleid]->adv_params;
							} else {
								$query = 'SELECT params'
									.' FROM #__advancedmodules'
									.' WHERE moduleid = '.(int) $mirror_moduleid
									.' LIMIT 1';
								$db->setQuery( $query );
								$registry = new JRegistry;
								$registry->loadString( $db->loadResult() );
								$module->adv_params = $parameters->getParams( $registry->toObject(), $xmlfile_assignments );
							}
						}
					}
				}
			}

			if ( $module->published ) {
				$params = array();
				if ( $module->adv_params->assignto_menuitems ) {
					$params['MenuItem'] = new stdClass();
					$params['MenuItem']->assignment = $module->adv_params->assignto_menuitems;
					$params['MenuItem']->selection = $module->adv_params->assignto_menuitems_selection;
					$params['MenuItem']->params = new stdClass();
					$params['MenuItem']->params->inc_children = $module->adv_params->assignto_menuitems_inc_children;
					$params['MenuItem']->params->inc_noItemid = $module->adv_params->assignto_menuitems_inc_noitemid;
				}
				if ( $config->show_assignto_homepage && $module->adv_params->assignto_homepage ) {
					$params['HomePage'] = new stdClass();
					$params['HomePage']->assignment = $module->adv_params->assignto_homepage;
				}
				if ( $config->show_assignto_content ) {
					if ( $module->adv_params->assignto_cats ) {
						$params['Cats'] = new stdClass();
						$params['Cats']->assignment = $module->adv_params->assignto_cats;
						$params['Cats']->selection = $module->adv_params->assignto_cats_selection;
						$params['Cats']->params = new stdClass();
						$incs = $assignments->makeArray( $module->adv_params->assignto_cats_inc );
						$params['Cats']->params->inc_categories = in_array( 'inc_cats', $incs );
						$params['Cats']->params->inc_articles = in_array( 'inc_arts', $incs );
						$params['Cats']->params->inc_others = in_array( 'inc_others', $incs );
						$params['Cats']->params->inc_children = $module->adv_params->assignto_cats_inc_children;
					}
					if ( $module->adv_params->assignto_articles ) {
						$params['Articles'] = new stdClass();
						$params['Articles']->assignment = $module->adv_params->assignto_articles;
						$params['Articles']->selection = $module->adv_params->assignto_articles_selection;
						$params['Articles']->params = new stdClass();
						$params['Articles']->params->keywords = $module->adv_params->assignto_articles_keywords;
					}
				}
				/*
				if ( $config->show_assignto_fc && JFile::exists( JPATH_ADMINISTRATOR.'/components/com_flexicontent/admin.flexicontent.php' ) ) {
					if ( $module->adv_params->assignto_fccats ) {
						$params['Categories_FC'] = new stdClass();
						$params['Categories_FC']->assignment = $module->adv_params->assignto_fccats;
						$params['Categories_FC']->selection = $module->adv_params->assignto_fccats_selection;
						$params['Categories_FC']->params = new stdClass();
						$params['Categories_FC']->params->inc_children = $module->adv_params->assignto_fccats_inc_children;
						$incs = $assignments->makeArray( $module->adv_params->assignto_fccats_inc );
						$params['Categories_FC']->params->inc_categories = in_array( 'inc_cats', $incs );
						$params['Categories_FC']->params->inc_items = in_array( 'inc_items', $incs );
					}
					if ( $module->adv_params->assignto_fctags ) {
						$params['Tags_FC'] = new stdClass();
						$params['Tags_FC']->assignment = $module->adv_params->assignto_fctags;
						$params['Tags_FC']->selection = $module->adv_params->assignto_fctags_selection;
						$params['Tags_FC']->params = new stdClass();
						$incs = $assignments->makeArray( $module->adv_params->assignto_fctags_inc );
						$params['Tags_FC']->params->inc_tags = in_array( 'inc_tags', $incs );
						$params['Tags_FC']->params->inc_items = in_array( 'inc_items', $incs );
					}
					if ( $module->adv_params->assignto_fctypes ) {
						$params['Types_FC'] = new stdClass();
						$params['Types_FC']->assignment = $module->adv_params->assignto_fctypes;
						$params['Types_FC']->selection = $module->adv_params->assignto_fctypes_selection;
						$params['Types_FC']->params = new stdClass();
					}
					if ( $module->adv_params->assignto_fcitems ) {
						$params['Items_FC'] = new stdClass();
						$params['Items_FC']->assignment = $module->adv_params->assignto_fcitems;
						$params['Items_FC']->selection = $module->adv_params->assignto_fcitems_selection;
					}
				}*/
				if ( $config->show_assignto_k2 && JFile::exists( JPATH_ADMINISTRATOR.'/components/com_k2/admin.k2.php' ) ) {
					if ( $module->adv_params->assignto_k2cats ) {
						$params['Categories_K2'] = new stdClass();
						$params['Categories_K2']->assignment = $module->adv_params->assignto_k2cats;
						$params['Categories_K2']->selection = $module->adv_params->assignto_k2cats_selection;
						$params['Categories_K2']->params = new stdClass();
						$params['Categories_K2']->params->inc_children = $module->adv_params->assignto_k2cats_inc_children;
						$incs = $assignments->makeArray( $module->adv_params->assignto_k2cats_inc );
						$params['Categories_K2']->params->inc_categories = in_array( 'inc_cats', $incs );
						$params['Categories_K2']->params->inc_items = in_array( 'inc_items', $incs );
					}
					if ( $module->adv_params->assignto_k2tags ) {
						$params['Tags_K2'] = new stdClass();
						$params['Tags_K2']->assignment = $module->adv_params->assignto_k2tags;
						$params['Tags_K2']->selection = $module->adv_params->assignto_k2tags_selection;
						$params['Tags_K2']->params = new stdClass();
						$incs = $assignments->makeArray( $module->adv_params->assignto_k2tags_inc );
						$params['Tags_K2']->params->inc_tags = in_array( 'inc_tags', $incs );
						$params['Tags_K2']->params->inc_items = in_array( 'inc_items', $incs );
					}
					if ( $module->adv_params->assignto_k2items ) {
						$params['Items_K2'] = new stdClass();
						$params['Items_K2']->assignment = $module->adv_params->assignto_k2items;
						$params['Items_K2']->selection = $module->adv_params->assignto_k2items_selection;
					}
				}
				/*if ( $config->show_assignto_mr && $module->adv_params->assignto_mrcats && JFile::exists( JPATH_ADMINISTRATOR.'/components/com_resource/resource.php' ) ) {
					$params['Categories_MR'] = new stdClass();
					$params['Categories_MR']->assignment = $module->adv_params->assignto_mrcats;
					$params['Categories_MR']->selection = $module->adv_params->assignto_mrcats_selection;
					$params['Categories_MR']->params = new stdClass();
					$params['Categories_MR']->params->inc_children = $module->adv_params->assignto_mrcats_inc_children;
					$incs = $assignments->makeArray( $module->adv_params->assignto_mrcats_inc );
					$params['Categories_MR']->params->inc_categories = in_array( 'inc_cats', $incs );
					$params['Categories_MR']->params->inc_items = in_array( 'inc_items', $incs );
				}
				*/
				if ( $config->show_assignto_zoo && $module->adv_params->assignto_zoocats && JFile::exists( JPATH_ADMINISTRATOR.'/components/com_zoo/zoo.php' ) ) {
					$params['Categories_ZOO'] = new stdClass();
					$params['Categories_ZOO']->assignment = $module->adv_params->assignto_zoocats;
					$params['Categories_ZOO']->selection = $module->adv_params->assignto_zoocats_selection;
					$params['Categories_ZOO']->params = new stdClass();
					$params['Categories_ZOO']->params->inc_children = $module->adv_params->assignto_zoocats_inc_children;
					$incs = $assignments->makeArray( $module->adv_params->assignto_zoocats_inc );
					$params['Categories_ZOO']->params->inc_apps = in_array( 'inc_apps', $incs );
					$params['Categories_ZOO']->params->inc_categories = in_array( 'inc_cats', $incs );
					$params['Categories_ZOO']->params->inc_items = in_array( 'inc_items', $incs );
				}
				if ( $config->show_assignto_components && $module->adv_params->assignto_components ) {
					$params['Components'] = new stdClass();
					$params['Components']->assignment = $module->adv_params->assignto_components;
					$params['Components']->selection = $module->adv_params->assignto_components_selection;
				}
				if ( $config->show_assignto_urls && $module->adv_params->assignto_urls ) {
					$params['URL'] = new stdClass();
					$params['URL']->assignment = $module->adv_params->assignto_urls;

					$configuration =& JFactory::getConfig();
					if ( $config->use_sef == 1 || ( $config->use_sef == 2 && $configuration->getValue( 'config.sef' ) == 1 ) ) {
						$params['URL']->selection = $module->adv_params->assignto_urls_selection_sef;
					} else {
						$params['URL']->selection = $module->adv_params->assignto_urls_selection;
					}
					$params['URL']->selection = explode( "\n", $params['URL']->selection );
				}
				if ( $config->show_assignto_browsers && $module->adv_params->assignto_browsers ) {
					$params['Browsers'] = new stdClass();
					$params['Browsers']->assignment = $module->adv_params->assignto_browsers;
					$params['Browsers']->selection = $module->adv_params->assignto_browsers_selection;
				}
				if ( $config->show_assignto_date ) {
					if ( $module->adv_params->assignto_date ) {
						$params['Date'] = new stdClass();
						$params['Date']->assignment = $module->adv_params->assignto_date;
						$params['Date']->params = new stdClass();
						$params['Date']->params->publish_up = $module->adv_params->assignto_date_publish_up;
						$params['Date']->params->publish_down = $module->adv_params->assignto_date_publish_down;
					}
					if ( $module->adv_params->assignto_seasons ) {
						$params['Seasons'] = new stdClass();
						$params['Seasons']->assignment = $module->adv_params->assignto_seasons;
						$params['Seasons']->selection = $module->adv_params->assignto_seasons_selection;
						$params['Seasons']->params = new stdClass();
						$params['Seasons']->params->hemisphere = $module->adv_params->assignto_seasons_hemisphere;
					}
					if ( $module->adv_params->assignto_months ) {
						$params['Months'] = new stdClass();
						$params['Months']->assignment = $module->adv_params->assignto_months;
						$params['Months']->selection = $module->adv_params->assignto_months_selection;
					}
					if ( $module->adv_params->assignto_days ) {
						$params['Days'] = new stdClass();
						$params['Days']->assignment = $module->adv_params->assignto_days;
						$params['Days']->selection = $module->adv_params->assignto_days_selection;
					}
					if ( $module->adv_params->assignto_time ) {
						$params['Time'] = new stdClass();
						$params['Time']->assignment = $module->adv_params->assignto_time;
						$params['Time']->params = new stdClass();
						$params['Time']->params->publish_up = $module->adv_params->assignto_time_publish_up;
						$params['Time']->params->publish_down = $module->adv_params->assignto_time_publish_down;
					}
				}
				if ( $config->show_assignto_usergrouplevels && $module->adv_params->assignto_usergrouplevels ) {
					$params['UserGroupLevels'] = new stdClass();
					$params['UserGroupLevels']->assignment = $module->adv_params->assignto_usergrouplevels;
					$params['UserGroupLevels']->selection = $module->adv_params->assignto_usergrouplevels_selection;
				}
				if ( $config->show_assignto_users && $module->adv_params->assignto_users ) {
					$params['Users'] = new stdClass();
					$params['Users']->assignment = $module->adv_params->assignto_users;
					$params['Users']->selection = $module->adv_params->assignto_users_selection;
				}
				if ( $config->show_assignto_languages && $module->adv_params->assignto_languages ) {
					$params['Languages'] = new stdClass();
					$params['Languages']->assignment = $module->adv_params->assignto_languages;
					$params['Languages']->selection = $module->adv_params->assignto_languages_selection;
				}
				if ( $config->show_assignto_templates && $module->adv_params->assignto_templates ) {
					$params['Templates'] = new stdClass();
					$params['Templates']->assignment = $module->adv_params->assignto_templates;
					$params['Templates']->selection = $module->adv_params->assignto_templates_selection;
				}
				if ( $config->show_assignto_php && $module->adv_params->assignto_php ) {
					$params['PHP'] = new stdClass();
					$params['PHP']->assignment = $module->adv_params->assignto_php;
					$params['PHP']->selection = $module->adv_params->assignto_php_selection;
				}

				$pass = $assignments->passAll( $params, $module->adv_params->match_method );

				if ( !$pass ) {
					$module->published = 0;
				}

				if ( $module->reverse ) {
					$module->published = $module->published ? 0 : 1;
				}
			}

			$modules[$id] = $module;
		}
	}
}