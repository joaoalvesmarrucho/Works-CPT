<?php
/*
Plugin Name: Works
Plugin URI:  https://greentiger.internetbravo.net/plugins/ctp
Version:     1.0
Author:      Joao Alves Marrucho
Author URI:  https://greentiger.internetbravo.net
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl.html
Text Domain: works
*/
function ctg_cpt_init() {
      register_post_type( 'Works',
        array(
          'labels' => array(
            'name' => __( 'Works' ),
            'singular_name' => __( 'Work' )
          ),
          'menu_position' => ('10'),
     'public' => true,
     'description' => ('Work'),
     'has_archive' => true,
     'taxonomies' => array('category'),
     'menu_icon' => 'dashicons-format-image',
     'supports' => array( 'title', 'editor', 'thumbnail')
        )
      );
    }
add_action( 'init', 'ctg_cpt_init' );

function ctg_rewrite_flush() {
    ctg_cpt_init();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ctg_rewrite_flush' );

add_filter( 'pre_get_posts', 'be_archive_query' );

function be_archive_query( $query ) {
	if( $query->is_main_query() && $query->is_post_type_archive('works') ) {
		$query->set( 'posts_per_page', -1 );
	}
}

function works_install()
{
    ctg_cpt_init();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'works_install' );
function works_deactivation()
{
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'works_deactivation' );

?>
