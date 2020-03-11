<?php
/**
 * Plugin Name: My First Plugin
 * Description: My First Plugin for WP Gravity Forms Task
 * Author: Tatsiana Zubel
 */


function my_custom_styles() {
    wp_deregister_style( 'gforms_formsmain_css' );
    wp_register_style( 'style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_style( 'style' );
    }
    add_action( 'wp_enqueue_scripts', 'my_custom_styles' );


function set_post_content( $entry, $form ) {
    global $user_ID;
    $printing_field;
    $numeric = 1;
    foreach ($form['fields'] as $field) {
        $printing_field .= $field['label']. ' ';
        $printing_field .= rgar( $entry, $numeric). ' ';
        $numeric++;
    }
    $my_post = array(
        'post_title'    => date('Y-m-d'). ' '. rgar( $entry, '4' ),
        'post_content' => $printing_field,
        'post_status'   => 'publish',
        'post_date' => date('Y-m-d H:i:s'),
        'post_author'   => $user_id,
        'post_type' => 'post',
        'post_category' => array(0)
        );
wp_insert_post( $my_post );
}
add_action( 'gform_after_submission', 'set_post_content', 10, 2 );
 
    