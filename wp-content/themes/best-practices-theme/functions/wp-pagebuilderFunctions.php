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
/*
add_filter( 'wppb_available_addons', 'prefix_custom_addon_include' );
if ( ! function_exists('prefix_custom_addon_include')){
    function prefix_custom_addon_include($addons){
        $addons[] = 'PVA_Button';
        // Add Other Custom Addon class name in here, at a time.
        return $addons;
    }
}
*/
