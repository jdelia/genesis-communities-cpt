<?php
/**
 * This file adds the custom community post type archive template the plugin uses.
 *
 * @author Jackie D'Elia
 */

// Force full width content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove the breadcrumb navigation
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// add the div and class for the custom post type archive
add_action('genesis_before_loop', 'awp_open_div');
function awp_open_div() { echo '<div class="featured-community awp-community">'; }

// close the div and class for the custom post type archive
add_action('genesis_after_loop', 'awp_close_div');
function awp_close_div() { echo '</div> <!-- close featured community div -->' ; }

// Remove the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

// Remove the post content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

// Remove the post title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Remove the post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

// Add community body class to the head
add_filter( 'body_class', 'awp_add_community_body_class' );
function awp_add_community_body_class( $classes ) {
   $classes[] = 'awp-community-archive';
   return $classes;
}

// Add the featured image and post title
add_action( 'genesis_entry_header', 'genawpcomm_awp_community_grid' );
function genawpcomm_awp_community_grid() {

    if ( $image = genesis_get_image( 'format=url&size=awp-feature-community' ) ) {
        printf( '<div class="awp-community-image"><div class="community-featured-image"><a href="%s" rel="bookmark"><img src="%s" alt="%s" /></a></div>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );
    }

	echo '<header class="entry-header">';
		printf( '<h2 class="entry-title"><a href="%s" title="%s">%s</a></h2>', get_permalink(), the_title_attribute( 'echo=0' ), get_the_title() );
	echo '</header>';
}

// Remove the post meta function
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

genesis();
