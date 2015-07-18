<?php
/**
 * This file contains the Community class.
 */

/**
 * This class handles the creation of the "Community" post type,
 * and creates a UI to display the Community-specific data on
 * the admin screens.
 */
class AWP_Communities {
    
    var $settings_page  = 'awp-settings';
    
    var $settings_field = 'awp_community_options';
    
    var $options;
    
    /**
     * Construct Method.
     */
    function __construct() {
        
        $this->options = get_option( 'plugin_awp_community_settings' );
        
        add_action( 'admin_init', array(&$this,
            'register_settings'
        ) );
        add_action( 'admin_init', array(&$this,
            'update_options'
        ) );
        add_action( 'admin_menu', array(&$this,
            'settings_init'
        ) , 15 );
    }
    
    function register_settings() {
        
               
        register_setting( 'awp_community_options', 'plugin_awp_community_settings', array(
            $this,
            'awp_sanitize_data'
        ) );


    }
    
    function awp_sanitize_data( $input ) {
       
             
        if( !isset( $input['stylesheet_load'] ) || $input['stylesheet_load'] != '1' ) {
            $input['stylesheet_load'] = 0;
        } 
        else {
            $input['stylesheet_load'] = 1;
        }
        // check to make sure the fields are not empty - if they are - fill with defaults
        if ( empty( $input['singular_name'] )) $input['singular_name'] = 'Community';
        
        if ( empty( $input['plural_name'] )) $input['plural_name'] = 'Communities';
        
        if ( empty( $input['slug'] )) $input['slug'] = 'communities';

        if ( empty( $input['num_posts'] ) || !is_numeric($input['num_posts']) ) $input['num_posts'] = '8';

        //if ( $input['order_by'] =='rand')  $input['num_posts'] = '999';

        // sanitize the fields 
        $input['singular_name'] = wp_strip_all_tags( $input['singular_name'] );
               
        $input['plural_name'] = wp_strip_all_tags( $input['plural_name'] );

        $input['slug'] = sanitize_title( $input['slug'] );

        return $input;
    }
    
    function update_options() {
        // if no options found - initialize them
      

        $new_options = array(
            'stylesheet_load' => 0,
            'singular_name' => 'Community',
            'plural_name' => 'Communities',
            'slug' => 'communities',
            'order_by' => 'title',
            'sort_order' => 'ASC',
        );


 
        if( empty( $this->options['stylesheet_load'] ) && empty( $this->options['slug'] ) && empty( $this->options['singular_name'] ) && empty( $this->options['plural_name'] ) 
            && empty( $this->options['order_by'] ) && empty( $this->options['sort_order'] ) ) {
                  
            update_option( 'plugin_awp_community_settings', $new_options );
        }
    }
    
    /**
     * Adds settings page under Community post type in admin menu
     */
    function settings_init() {
        add_submenu_page( 'edit.php?post_type=awp-community', __( 'Settings', 'genesis-communities-cpt' ), __( 'Settings', 'genesis-communities-cpt' ), 'manage_options', $this->settings_page, array(&$this,
            'settings_page'
        ) );
    }
    
    /**
     * Creates display of settings page along with form fields
     */
    function settings_page() {
        include( dirname( __FILE__ ) . '/views/awp-settings.php' );
    }
}
?>
