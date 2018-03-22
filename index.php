<?php
/**
 * Plugin Name: Custom libraries
 * Plugin URI: http://www.igorkiselev.com/wp-plugin/libraries/
 * Description: Plugin for using different js and css libraries
 * Version: 1.0.1
 * Author: Igor Kiselev
 * Author URI: http://www.igorkiselev.com/
 * License: A "JustBeNice" license name e.g. GPL2.
 */

if( ! defined( 'ABSPATH' ) ) exit;

load_plugin_textdomain( 'libraries', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 

include( plugin_dir_path( __FILE__ ) . 'library.php');


add_action('admin_init', function () {
	
	global $library;
	
	foreach ($library as $key => $value){
		register_setting( 'libraries', 'libraries-'.$key );
	}
	
	register_setting( 'libraries', 'libraries-justbenice-editor' );
	
	register_setting( 'libraries', 'libraries-imagesloaded' );
	
	register_setting( 'libraries', 'libraries-google-map' );
	register_setting( 'libraries', 'libraries-google-map-key' );
	register_setting( 'libraries', 'libraries-google-map-limit' );
	
	register_setting( 'libraries', 'libraries-google-analytics' );
	register_setting( 'libraries', 'libraries-google-analytics-key' );
	
	register_setting( 'libraries', 'libraries-lazy-srcset');
	register_setting( 'libraries', 'libraries-lazy-brakepoints' );
	register_setting( 'libraries', 'libraries-lazy-brakepoints-sizes');
	
	register_setting( 'libraries', 'libraries-yandex-metrics' );
	register_setting( 'libraries', 'libraries-yandex-metrics-key' );
	
	register_setting( 'libraries', 'libraries-filenames' );
	register_setting( 'libraries', 'libraries-filenames-slug' );
	
	register_setting( 'libraries', 'libraries-owlcarousel-gallery' );
	
	function change_option($a,$b){
		
		$var = get_option($a);
		
		if ($var !== $b) {
			
			update_option($a,$b);
			
		}
	
	}
	
	change_option('image_default_link_type','none');
	
	change_option('image_default_size','full');
	
});


add_action('wp_enqueue_scripts', function () {
	
	global $library;
	
	wp_enqueue_script('jquery');
	
	foreach ($library as $key => $value){
		
		if(get_option( 'libraries-'.$key )){
			
			if(property_exists($value, 'type' ) && property_exists($value, 'src' ) && property_exists($value, 'name' ) && property_exists($value, 'depend' )){
				
				if($value->type == 'script'){
					
					$position = false;
					
					if (!empty($value->depend)) {
						$position = true;
					}
					
					//$version = $value->ver;
					
					$version = rand(0,5000);
					
					wp_enqueue_script($value->name, plugin_dir_url( __FILE__ ).$value->src, $value->depend, $version, $position);
					
				}elseif($value->type == 'style'){
					
					if(!wp_style_is( $value->name, $list = 'enqueued' )){
			
						wp_register_style($value->name, plugin_dir_url( __FILE__ ).$value->src, $value->depend, $value->ver);
						
						wp_enqueue_style($value->name);
						
					}
					
				}
				
			}
			
		}
		
	}

});

include( plugin_dir_path( __FILE__ ) . 'functions.php');







// Страница настроек плагина

add_action('admin_menu', function () {
	
	add_options_page( __("Custom libraries", "libraries"), __("Custom libraries", "libraries"), 'manage_options', 'libraries', function(){
		
		if (!current_user_can('manage_options')) {
			
			wp_die( __('You do not have sufficient permissions to access this page.', 'libraries') );
		
		}
		
		include( plugin_dir_path( __FILE__ ) . 'options.php');
	
	});

});	

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), function($links){
	
	return array_merge( $links, array('<a href="' . admin_url( 'options-general.php?page=libraries' ) . '">'.__('Settings', 'libraries').'</a>') );

});
?>