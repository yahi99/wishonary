<?php
/**
 * Photo View Loop
 * This file sets up the structure for the photo view events loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/pro/photo/loop.php
 *
 * @version 4.4.2
 * @package TribeEventsCalendar
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// @codingStandardsIgnoreStart
global $more;
$more = false;
// @codingStandardsIgnoreEnd ?>

<div class="tribe-events-loop tribe-clearfix" id="tribe-events-photo-events">
	<div class="tribe-events-photo-grid-sizer">
		<!-- .tribe-events-photo-grid-sizer empty element, only used for element sizing -->
	</div>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php do_action( 'tribe_events_inside_before_loop' ); ?>

		<!-- Event  -->
		<div id="post-<?php the_ID(); ?>" class="<?php tribe_events_event_classes(); ?> <?php if ( has_post_thumbnail() ) : ?>has-post-thumbnail<?php endif; ?>">
			<?php tribe_get_template_part( 'pro/photo/single', 'event' ); ?>
		</div>

		<?php do_action( 'tribe_events_inside_after_loop' ); ?>
	<?php endwhile; ?>
	<div class="tribe-events-photo-gutter-sizer">
		<!-- .tribe-events-photo-gutter-sizer empty element, only used for element sizing -->
	</div>
</div><!-- .tribe-events-loop -->
