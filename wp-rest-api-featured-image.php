<?php
/*
Plugin Name: WP Rest Api Featured Image
Plugin URI: https://github.com/rveitch/wp-rest-api-featured-image
Description: Adds featured image url to wp rest api
Author: Ryan Veitch
Version: 1.0
Author URI: https://ryanveitch.blog/
*/

add_action('rest_api_init', 'register_rest_images' );

function register_rest_images(){
    register_rest_field( array('post'),
        'featured_image_url',
        array(
            'get_callback'    => 'get_rest_featured_image',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

function get_rest_featured_image( $object, $field_name, $request ) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
        return $img[0];
    }
    return false;
}
