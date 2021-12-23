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
	 * Metabox Page for background page
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
    
	return $meta_boxes;

}