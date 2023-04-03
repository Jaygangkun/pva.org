<?php
/**
 * This serves as the main function file for the theme. Functionality should be broken out into reasonable chunks and included here.
 * Note: No code should be added directly to this file!
 */

require_once __DIR__ . '/theme-extensions/bladerunner/bladerunner.php';
require_once __DIR__ . '/theme-extensions/wp-h5bp-htaccess/wp-h5bp-htaccess.php';

/* TODO:: Get this package installed through autoloading */
require_once __DIR__ . '/functions/class-wp-bootstrap-navwalker.php';

//require_once __DIR__ . '/functions/acfHooks.php';
require_once __DIR__ . '/functions/wordpressFunctions.php';
require_once __DIR__ . '/functions/UIHelperFunctions.php';
require_once __DIR__ . '/functions/searchFunctions.php';
require_once __DIR__ . '/functions/SimpleLoggerHooks.php';
require_once __DIR__ . '/functions/customPostTypes.php';
require_once __DIR__ . '/functions/breadcrumbFunction.php';
require_once __DIR__ . '/functions/performanceOptimizations.php';
require_once __DIR__ . '/functions/bladerunnerDirectives.php';
/** require_once __DIR__ . '/functions/wp-pagebuilderFunctions.php'; */


function prefix_add_block_callback( $blocks ){
        $blocks[] = array(
                'name' => 'PVA Standard Hero', // Name of the Block
                'file' => plugin_dir_path( __FILE__ ).'pagebuilder/addons/pva-hero.json', // JSON export file directory path
                'banner' => 'https://prnt.sc/1r4jjd2', // Banner Image URL
                'section' => 'PVA Standard Hero', // Section Name
                'liveurl' => 'https://prnt.sc/1r4jjd2' //
        );
        return $blocks;
}
add_filter('wppb_add_block', 'prefix_add_block_callback');

add_filter( 'wppb_available_addons', 'prefix_custom_addon_include' );
if ( ! function_exists('prefix_custom_addon_include')){
    function prefix_custom_addon_include($addons){
        $addons[] = 'PVA_Button';
	$addons[] = 'PVA_Heading';
	$addons[] = 'PVA_Text';
	$addons[] = 'PVA_Text_Image';
	$addons[] = 'PVA_Tile_Card';
	$addons[] = 'PVA_News_List';

        // Add Other Custom Addon class name in here, at a time.
        return $addons;
    }
}

