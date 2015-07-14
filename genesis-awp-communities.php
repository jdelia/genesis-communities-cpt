<?php
/**
 * Genesis AWP Communities Plugin
 *
 * This plugin is based on the Community Custom Post Type found in the Winning Agent Pro theme by Carrie Dils.
 * Now you can add this custom post to any Genesis child theme including the AgentPress Pro by StudioPress.  
 * Read more about why we created this plugin at http://savvyjackiedesigns.com/genesis-awp-communities-plugin/
 *
 * @package           Genesis_AWP_Communities
 * @author            Jackie D'Elia
 * @license           GPL-2.0+
 * @link              http://www.savvyjackiedesigns.com
 * @copyright         2015 Jackie D'Elia
 *
 * Plugin Name:       Genesis AWP Communities
 * Plugin URI:        https://github.com/savvyjackie/genesis-communities-cpt
 * Description:       Adds a custom post type for Communities to any Genesis Child Theme. Includes Featured Communities Widget, Custom Archive Page and ability to edit the Custom Post Type name and slug url.
 * Version:           0.5.1
 * Author:            Jackie D'Elia
 * Author URI:        http://www.savvyjackiedesigns.com
 * Text Domain:       genesis-awp-community
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       genesis-awp-communities
 * Domain Path:       /languages/
 * Function prefix:   genawpcomm_
 * GitHub Plugin URI: https://github.com/savvyjackie/genesis-communities-cpt
 * GitHub Branch:     master
 */

/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// If this file is called directly, abort.
if( !defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Defining Genesis Community constants
 *
 * @since 0.2.0
 */

if( !defined( 'GENAWPCOMM_VERSION' ) )define( 'GENAWPCOMM_VERSION', '0.5.0' );
if( !defined( 'GENAWPCOMM_BASE_FILE' ) )define( 'GENAWPCOMM_BASE_FILE', __FILE__ );
if( !defined( 'GENAWPCOMM_BASE_DIR' ) )define( 'GENAWPCOMM_BASE_DIR', dirname( GENAWPCOMM_BASE_FILE ) );
if( !defined( 'GENAWPCOMM_PLUGIN_URL' ) )define( 'GENAWPCOMM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
if( !defined( 'GENAWPCOMM_PLUGIN_PATH' ) )define( 'GENAWPCOMM_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'GENAWPCOMM_SETTINGS_FIELD', 'genawpcomm-settings' );

/**
 * The text domain for the plugin
 *
 * @since 0.2.0
 */
define( 'GENAWPCOMM_DOMAIN', 'genesis-awp-communities' );

/**
 * Load the text domain for translation of the plugin
 *
 * @since 0.2.0
 */


load_plugin_textdomain( 'genesis-awp-communities', false, 'genesis-communities-cpt/languages/' );

register_activation_hook( __FILE__, 'genawpcomm_activation_check' );

/**
 * Checks for activated Genesis Framework and its minimum version before allowing plugin to activate
 *
 * @author Nathan Rice, Remkus de Vries, Rian Rietveld, adjusted Jackie D'Elia for this plugin
 * @uses genawpcomm_activation_check()
 * @since 0.2.0
 */
function genawpcomm_activation_check() {
    
    // Find Genesis Theme Data
    $theme                   = wp_get_theme( 'genesis' );
    
    // Get the version
    $version                 = $theme->get( 'Version' );
   
    // Set what we consider the minimum Genesis version
    $minimum_genesis_version = '2.1.2';
    
    // Restrict activation to only when the Genesis Framework is activated
    if( basename( get_template_directory() ) != 'genesis' ) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        
        // Deactivate ourself
        wp_die( sprintf( __( 'Whoa.. this plugin requires that you have installed the %1$sGenesis Framework version %2$s%3$s or greater.', GENAWPCOMM_DOMAIN ), '<a href="http://savvyjackiedesigns.com/go/genesis-framework-theme">', '</a>', $minimum_genesis_version ) );
    }
    
    // Set a minimum version of the Genesis Framework to be activated on
    if( version_compare( $version, $minimum_genesis_version, '<' ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        
        // Deactivate ourself
        wp_die( sprintf( __( 'Oops.. you need to update to the latest version of the %1$sGenesis Framework version %2$s%3$s or greater to install this plugin.', GENAWPCOMM_DOMAIN ), '<a href="http://savvyjackiedesigns.com/go/genesis-framework-theme">', '</a>', $minimum_genesis_version ) );
    }
}
register_deactivation_hook( __FILE__, 'genawpcomm_myplugin_deactivate' );

function genawpcomm_myplugin_deactivate() {
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'genawpcomm_myplugin_flush_rewrites' );
function genawpcomm_myplugin_flush_rewrites() {
    
    // call your CPT registration function here (it should also be hooked into 'init')
    
    genawpcomm_create_custom_post_type();
    flush_rewrite_rules();
}

add_action( 'init', 'genawpcomm_create_custom_post_type' );

/**
 * Creates our "Community" post type and image sizes
 */
function genawpcomm_create_custom_post_type() {
    
    $options = get_option( 'plugin_awp_community_settings' );
    
    if( !isset( $options['stylesheet_load'] ) ) {
        
        $options['stylesheet_load']         = 0;
    }
    
    if( !isset( $options['slug'] ) ) {
        
        $options['slug']         = 'communities';
    }

    if( !isset( $options['singular_name'] ) ) {
        
        $options['singular_name']         = 'Community';
    }

    if( !isset( $options['plural_name'] ) ) {
        
        $options['plural_name']         = 'Communities';
    }

    
    $args    = apply_filters( 'awp_community_post_type_args', array(
        'labels' => array(
        'name'               => $options['plural_name'],
        'singular_name'      => $options['singular_name'],
        'menu_name'          => $options['plural_name'] ,
        'name_admin_bar'     => $options['singular_name'],
        'add_new'            => __( 'Add New', 'genesis-awp-communities' ),
        'add_new_item'       => __( 'Add New ', 'genesis-awp-communities' ) . $options['singular_name'],
        'new_item'           => __( 'New ', 'genesis-awp-communities' ) . $options['singular_name'],
        'edit_item'          => __( 'Edit ', 'genesis-awp-communities' ) . $options['singular_name'],
        'view_item'          => __( 'View ', 'genesis-awp-communities' ) . $options['singular_name'],
        'all_items'          => __( 'All ', 'genesis-awp-communities' ) . $options['plural_name'],
        'search_items'       => __( 'Search ', 'genesis-awp-communities' ) . $options['plural_name'],
        'parent_item_colon'  => __( 'Parent ', 'genesis-awp-communities' ) . $options['plural_name'] . ':',
        'not_found'          => __( 'No ', 'genesis-awp-communities' ) .  $options['plural_name'] . __( ' found.', 'genesis-awp-communities' ),
        'not_found_in_trash' => __( 'No ', 'genesis-awp-communities' ) .  $options['plural_name'] . __( ' found in Trash.', 'genesis-awp-communities' ),
        ) ,
        'has_archive' => true,
        'hierarchical' => true,
        'menu_icon' => 'dashicons-admin-home',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'menu_position' => 25,
        'publicly_queryable' => true,
       // 'taxonomies' => array('features'),  // reserved for future release
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'comments',
            'thumbnail',
            'page-attributes',
            'genesis-seo',
            'genesis-layouts',
            'genesis-simple-sidebars',
            'genesis-cpt-archives-settings'
        ) ,
        'rewrite' => array('slug' => $options['slug'], 'with_front' => false
        ) ,
    ) );
    
    register_post_type( 'awp-community', $args );
    
    // Add custom image sizes if they don't exist
    if( !has_image_size( 'awp-feature-community' ) ) {
        add_image_size( 'awp-feature-community', 440, 300, true );
    }
    if( !has_image_size( 'awp-feature-small' ) ) {
        add_image_size( 'awp-feature-small', 340, 140, true );
    }
    if( !has_image_size( 'awp-feature-wide' ) ) {
        add_image_size( 'awp-feature-wide', 740, 285, true );
    }
    
    // Show the custom sizes when choosing image size in media
    add_filter( 'image_size_names_choose', 'genawpcomm_my_custom_sizes' );
    function genawpcomm_my_custom_sizes( $sizes ) {
        return array_merge( $sizes, array(
            'awp-feature-community'              => __( 'awp-feature-community' ),
            'awp-feature-small'              => __( 'awp-feature-small' ),
            'awp-feature-wide'              => __( 'awp-feature-wide' )
        ) );
    }
    
   
}
/* load the plugin stylesheet if not deregistered in settings
 * use a lower priority number to load earlier, so users can override styles in their stylesheet
*/
add_action( 'wp_enqueue_scripts', 'genawpcomm_enqueue_main_stylesheet', 5 );
function genawpcomm_enqueue_main_stylesheet() {
  $options = get_option( 'plugin_awp_community_settings' );
    
    if( $options['stylesheet_load'] == 0 ) {
        
        $awp_css_path = GENAWPCOMM_PLUGIN_URL . 'css/awp-communities.css';
        if( file_exists( GENAWPCOMM_BASE_DIR . '/css/awp-communities.css' ) ) {

            wp_enqueue_style( 'awp-community-style', $awp_css_path, false, '1.0.0' );
        }
    }
}

add_action( 'widgets_init', 'genawpcomm_register_widget' );

/**
 * Register Widget
 * @return type
 */
function genawpcomm_register_widget() {
    
    register_widget( 'AWP_Featured_Communities' );
}
require_once( dirname( __FILE__ ) . '/includes/functions.php' );
require_once( dirname( __FILE__ ) . '/widgets/featured-awp-communities-widget.php' );
require_once( dirname( __FILE__ ) . '/admin/class-awp-communities.php' );

/** Instantiate */
$_awp_community = new AWP_Communities;

?>
