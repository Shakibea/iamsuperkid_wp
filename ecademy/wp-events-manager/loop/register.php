<?php
/**
 * The Template for displaying register button in single event page.
 *
 * Override this template by copying it to ecademy/wp-events-manager/loop/register.php
 *
 * @author        EnvyTheme, leehld
 * @package       WP-Events-Manager/Template
 * @version       2.1.7
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( wpems_get_option( 'allow_register_event' ) == 'no' ) {
	return;
}

$event           = new WPEMS_Event( get_the_ID() );
$user_reg        = $event->booked_quantity( get_current_user_id() );
$date_start      = $event->__get( 'date_start' ) ? date( 'Ymd', strtotime( $event->__get( 'date_start' ) ) ) : '';
$time_start      = $event->__get( 'time_start' ) ? date( 'Hi', strtotime( $event->__get( 'time_start' ) ) ) : '';
$date_end        = $event->__get( 'date_end' ) ? date( 'Ymd', strtotime( $event->__get( 'date_end' ) ) ) : '';
$time_end        = $event->__get( 'time_end' ) ? date( 'Hi', strtotime( $event->__get( 'time_end' ) ) ) : '';
$g_calendar_link = 'https://www.google.com/calendar/event?action=TEMPLATE&text=' . urlencode( $event->get_title() );
$g_calendar_link .= '&dates=' . $date_start . ( $time_start ? 'T' . $time_start : '' ) . '/' . $date_end . ( $time_end ? 'T' . $time_end : '' );
$g_calendar_link .= '&details=' . urlencode( $event->post->post_content );
$g_calendar_link .= '&location=' . urlencode( $event->__get( 'location' ) );
$g_calendar_link .= '&trp=false&sprop=' . urlencode( get_permalink( $event->ID ) );
$g_calendar_link .= '&sprop=name:' . urlencode( get_option( 'blogname' ) );
$time_zone       = get_option( 'timezone_string' ) ? get_option( 'timezone_string' ) : 'UTC';
$g_calendar_link .= '&ctz=' . urlencode( $time_zone );

$can_register = true;
if ( absint( $event->qty ) == 0 || get_post_meta( get_the_ID(), 'tp_event_status', true ) === 'expired' ) {
	$can_register = false;
}
?>

<div class="entry-register">

	<ul class="entry-event-info">
		<li class="meta-price">
			<span class="meta-label">
                <i class='bx bx-money' ></i>
				<?php esc_html_e( 'ফি:', 'ecademy' ); ?>
			</span>
			<span
				class="meta-value">
				<span
					class="event-price"><?php printf( '%s', $event->is_free() ? esc_html__( 'ফ্রী', 'ecademy' ) : wpems_format_price( $event->get_price() ) ) ?></span>
			</span>
		</li>
		<li class="total">
			<span class="meta-label">
                <i class='bx bx-user-plus' ></i>
				<?php esc_html_e( 'Total Slot:', 'ecademy' ); ?>
			</span>
			<span class="meta-value"><?php echo esc_html( absint( $event->qty ) ); ?></span>
		</li>
		<li class="booking_slot">
			<span class="meta-label">
                <i class='bx bxs-lock' ></i>
				<?php esc_html_e( 'মোট জমা:', 'ecademy' ); ?>
			</span>
			<span class="meta-value"><?php echo do_shortcode("[wpmudev_forminator_entries_count form_id='3663']"); ?></span>
		</li>
	</ul>
	<!--  -->
	<?php if ( $can_register ): ?>
					<a class="default-btn"
			href="https://www.iamsuperkid.com/event-submission-form"><i class="flaticon-user"></i><?php esc_html_e( 'জমা করো', 'ecademy' ); ?><span></span></a>
			<br>
			<hr>
			<a class="default-btn" style="background-color: #4CAF50 !important;"
			href="https://www.iamsuperkid.com/event-gallery"><?php esc_html_e( 'জমা কৃত সকল ছবি', 'ecademy' ); ?><span></span></a>
			<?php else: ?>
		<p class="tp-event-notice error"><?php echo esc_html__( 'জমা দেয়ার সময় শেষ', 'ecademy' ); ?></p>
		<br>
		<hr>
		<a class="default-btn" style="background-color: #4CAF50 !important;"
			href="https://www.iamsuperkid.com/event-gallery"><?php esc_html_e( 'জমা কৃত সকল ছবি', 'ecademy' ); ?><span></span></a>
		<br>
		<hr>
		<a class="default-btn" style="background-color: #4CAF50 !important;"
			href="https://www.iamsuperkid.com/event-winner"><?php esc_html_e( 'বিজয়ীদের নাম', 'ecademy' ); ?><span></span></a>
	<?php endif; ?>
	<!--  -->
</div>
