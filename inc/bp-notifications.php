<?php
/**
 * @param array $component_names
 *
 * @return array
 * Add a custom component for notification.
 *
 */
function add_custom_notification_component( $component_names = array() ) {
    // Force $component_names to be an array.
    if ( ! is_array( $component_names ) ) {
        $component_names = array();
    }
    // Add 'custom' component to registered components array.
    array_push( $component_names, 'custom' );
    // Return component's with 'custom' appended.
    return $component_names;
}
add_filter( 'bp_notifications_get_registered_components', 'add_custom_notification_component' );

function custom_format_buddypress_notifications( $action, $item_id, $secondary_item_id, $total_items, $format = 'string' ) {
 
    // New custom notifications
    if ( 'new_post' === $action ) {
        
        $custom_title   = get_the_title( $item_id );
        $custom_link    = get_the_permalink( $item_id );
        $custom_text    = get_the_title( $item_id );
 
        // WordPress Toolbar
        if ( 'string' === $format ) {
            $return = apply_filters( 'custom_filter', '<a href="' . esc_url( $custom_link ) . '" title="' . esc_attr( $custom_title ) . '">' . esc_html( $custom_text ) . '</a>', $custom_text, $custom_link );
 
        // Deprecated BuddyBar
        } else {
            $return = apply_filters( 'custom_filter', array(
                'text' => $custom_text,
                'link' => $custom_link
            ), $custom_link, (int) $total_items, $custom_text, $custom_title );
        }
        
        return $return;
        
    }
    
}
add_filter( 'bp_notifications_get_notifications_for_user', 'custom_format_buddypress_notifications', 10, 5 );

function adnilaisiswa_published_notification( $post_id, $post ) {
    $author_id  = $post->post_author;
    $siswaid    = get_post_meta($post_id,'siswa',true);
    if ( bp_is_active( 'notifications' ) ) {
        bp_notifications_add_notification(
            array(
                'user_id'          => 19,
                'item_id'          => $post_id,
                'component_name'   => 'custom',
                'component_action' => 'new_post',
                'date_notified'    => bp_core_current_time(),
                'is_new'           => 1,
            )
        );
    }
}
add_action( 'publish_adnilaisiswa', 'adnilaisiswa_published_notification', 10, 2 );