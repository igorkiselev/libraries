<?php
/**
 * Plugin Name: Libraries
 * Plugin URI: http://www.igorkiselev.com/wp-plugin/libraries/
 * Description: Plugin for using different js and css libraries
 * Version: 1.0.2
 * Author: Igor Kiselev
 * Author URI: http://www.igorkiselev.com/
 * License: A "JustBeNice" license name e.g. GPL2.
 */

if (! defined('ABSPATH')) {
    exit;
}

load_plugin_textdomain('libraries', false, dirname(plugin_basename(__FILE__)) . '/languages/');

include(plugin_dir_path(__FILE__) . 'library.php');


add_action('admin_init', function () {
    global $lib;
    
    register_setting('libraries', 'additional_libraries');
    
    
    function change_option($a, $b)
    {
        $var = get_option($a);
        
        if ($var !== $b) {
            update_option($a, $b);
        }
    }
    
    change_option('image_default_link_type', 'none');
    
    change_option('image_default_size', 'full');
});


add_action('wp_enqueue_scripts', function () {
    global $lib;
    
    wp_enqueue_script('jquery');
    
    $settings = get_option('additional_libraries');
    
    foreach ($lib as $key => $value) {
        if (!empty($settings[$key])) {
            if (!empty($value['type'])) {
                if ($value['type'] == 'script') {
                    $position = false;
            
                    if (!empty($value['depend'])) {
                        $position = true;
                    }
                    
                    $version = rand(0, 5000);
                    
                    if (!empty($value['src'])) {
                        wp_enqueue_script($key, plugin_dir_url(__FILE__).$value['src'], $value['depend'], $value['ver'], $position);
                    } else {
                        wp_enqueue_script($key);
                    }
                } elseif ($value['type'] == 'style') {
                    if (!wp_style_is($key, $list = 'enqueued')) {
                        wp_register_style($key, plugin_dir_url(__FILE__).$value['src'], $value['depend'], $value['ver']);
                        
                        wp_enqueue_style($key);
                    }
                }
            }
        }
    }
});

include(plugin_dir_path(__FILE__) . 'functions.php');

// Страница настроек плагина

add_action('admin_menu', function () {
    add_options_page(__("Custom libraries", "libraries"), __("Custom libraries", "libraries"), 'manage_options', 'libraries', function () {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'libraries'));
        }
        
        include(plugin_dir_path(__FILE__) . 'options.php');
    });
});

add_filter('plugin_action_links_' . plugin_basename(__FILE__), function ($links) {
    return array_merge($links, array('<a href="' . admin_url('options-general.php?page=libraries') . '">'.__('Settings', 'libraries').'</a>'));
});
