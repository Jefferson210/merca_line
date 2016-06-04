<?php

/**
 * Extend Recent Posts Widget
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */
Class Mediaphase_Recent_Posts_Widget extends WP_Widget_Recent_Posts
{
	function widget( $args, $instance )
	{
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Posts', 'mediaphase' ) : $instance['title'], $instance, $this->id_base );
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		if ( empty( $instance['number'] ) || !$number = absint( $instance['number'] ) )
			$number = 10;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ( $r->have_posts() ) :

			echo $args['before_widget'];
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			?>
			<ul>
				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>">
							<?php
							get_the_title() ? the_title() : the_ID();
							if ( $show_date ) :
								echo ' <span class="post-date">' . get_the_date() . '</span>';
							endif;
							?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php echo $args['after_widget'];

			wp_reset_postdata();

		endif;
	}
}

function mediaphase_recent_widget_register()
{
	unregister_widget( 'WP_Widget_Recent_Posts' );
	register_widget( 'Mediaphase_Recent_Posts_Widget' );
}

add_action( 'widgets_init', 'mediaphase_recent_widget_register' );