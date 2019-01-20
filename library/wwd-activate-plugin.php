<?php

function wwd_plugin_activate() {
  
    if ( !is_admin() ) {
        return;
    }

    //  need to build logic to push into existing options
    
    $default = array(
        'custom_carousel' => true,
        'custom_posts' => array(
            array(
                'name' => 'layout',
                'label' => 'Layout',
                'plural' => 'Layouts'
            ),
            array(
                'name' => 'apartment',
                'label' => 'Apartment',
                'plural' => 'Apartments'
            )
        )
    );
    update_option('wwd_plugin', $default);
    
    flush_rewrite_rules();
}

function wwd_plugin_deactivate() {
  
    // if ( !is_admin() || !get_option( 'wwd_plugin' ) ) {
    //     return;
    // }

    // delete_option('wwd_plugin');

    // flush_rewrite_rules();
}
