<?php
/**
 * Booking Admin Meta Boxes
 *
 * @package FFP_Photography
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function ffp_add_booking_meta_boxes() {
    add_meta_box(
        'ffp_booking_details',
        __( 'Booking Details', 'ffp-photography' ),
        'ffp_booking_details_cb',
        'ffp_booking',
        'normal',
        'high'
    );
    add_meta_box(
        'ffp_booking_status',
        __( 'Booking Status', 'ffp-photography' ),
        'ffp_booking_status_cb',
        'ffp_booking',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ffp_add_booking_meta_boxes' );

function ffp_booking_details_cb( $post ) {
    $fields = array(
        '_ffp_name'       => 'Client Name',
        '_ffp_email'      => 'Email',
        '_ffp_phone'      => 'Phone',
        '_ffp_service'    => 'Service',
        '_ffp_package'    => 'Package',
        '_ffp_event_date' => 'Event Date',
        '_ffp_event_type' => 'Event Type',
        '_ffp_location'   => 'Location',
        '_ffp_guests'     => 'Guest Count',
        '_ffp_how_found'  => 'How They Found Us',
        '_ffp_submitted'  => 'Submitted At',
        '_ffp_message'    => 'Message',
    );
    echo '<table class="form-table">';
    foreach ( $fields as $key => $label ) {
        $value = get_post_meta( $post->ID, $key, true );
        if ( empty( $value ) ) continue;
        echo '<tr><th style="width:140px">' . esc_html( $label ) . '</th>';
        echo '<td>' . ( $key === '_ffp_email'
            ? '<a href="mailto:' . esc_attr( $value ) . '">' . esc_html( $value ) . '</a>'
            : nl2br( esc_html( $value ) ) ) . '</td></tr>';
    }
    echo '</table>';
}

function ffp_booking_status_cb( $post ) {
    $status = get_post_meta( $post->ID, '_ffp_status', true ) ?: 'pending';
    wp_nonce_field( 'ffp_booking_status_nonce', 'ffp_booking_status_nonce_field' );
    ?>
    <label for="ffp_booking_status" style="display:block;margin-bottom:6px;font-weight:600"><?php _e( 'Status', 'ffp-photography' ); ?></label>
    <select name="ffp_booking_status" id="ffp_booking_status" style="width:100%">
        <?php
        $statuses = array( 'pending', 'confirmed', 'completed', 'cancelled' );
        foreach ( $statuses as $s ) {
            printf( '<option value="%1$s" %2$s>%3$s</option>',
                esc_attr( $s ),
                selected( $status, $s, false ),
                esc_html( ucfirst( $s ) )
            );
        }
        ?>
    </select>
    <?php
}

function ffp_save_booking_meta( $post_id ) {
    if ( ! isset( $_POST['ffp_booking_status_nonce_field'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['ffp_booking_status_nonce_field'], 'ffp_booking_status_nonce' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['ffp_booking_status'] ) ) {
        $allowed = array( 'pending', 'confirmed', 'completed', 'cancelled' );
        $status  = sanitize_text_field( $_POST['ffp_booking_status'] );
        if ( in_array( $status, $allowed, true ) ) {
            update_post_meta( $post_id, '_ffp_status', $status );
        }
    }
}
add_action( 'save_post_ffp_booking', 'ffp_save_booking_meta' );
