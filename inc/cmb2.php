<?php
add_filter( 'cmb2_meta_boxes', 'cmb2_ad_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_ad_metaboxes( array $meta_boxes ) {
    $prefix = '';

    /**
	 * Metabox Page
	 */
	$meta_boxes['about_page_metabox'] = array(
		'id'           => 'bg_page_metabox',
		'title'        => __( 'Additional Detail Page', 'wpzaro' ),
		'object_types' => array( 'page', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'fields'       => array(
			array(
				'name' => __( 'Background', 'wpzaro' ),
				'desc' => __( '', 'wpzaro' ),
				'id'   => $prefix . 'bgimage',
				'type' => 'file',
                'query_args' => array(
                    'type' => array(
                        'image/gif',
                        'image/jpeg',
                        'image/png',
                    ),
                ),
			),		
        )
    );

    /**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb2_metabox_form` helper function. See wiki for more info.
	 */
	$meta_boxes['options_page'] = array(
		'id'      => 'wpzaro_options_page',
		'title'   => __( 'WPzaro Theme Options', 'cmb2' ),
		'show_on' => array( 'options-page' => array( $prefix . 'wpzaro_theme_options', ), ),
		'fields'  => array(			
			array(
				'name' => __( 'Logo', 'wpzaro' ),
				'desc' => __( '', 'wpzaro' ),
				'id'   => $prefix . '_theme_logo',
				'type' => 'file',
                'options' => array(
                    'url' => false, // Hide the text input for the url
                ),
                'query_args' => array(
                    'type' => array(
                        'image/gif',
                        'image/jpeg',
                        'image/png',
                    ),
                ),
			),			
			array(
				'name' => __( 'Default Featured Image', 'wpzaro' ),
				'desc' => __( '', 'wpzaro' ),
				'id'   => $prefix . '_theme_default_thumb',
				'type' => 'file',
                'options' => array(
                    'url' => false, // Hide the text input for the url
                ),
                'query_args' => array(
                    'type' => array(
                        'image/gif',
                        'image/jpeg',
                        'image/png',
                    ),
                ),
			),
		)
	);
    
	return $meta_boxes;

}