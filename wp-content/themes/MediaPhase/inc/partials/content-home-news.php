<?php
/**
 * The template part for displaying latest news section on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mediaphase
 */

$display_latest_news = get_theme_mod( 'mediaphase_latest_news_show', 'yes' );
if ( $display_latest_news === 'yes' ) :
?>
<div id="news">
	<div class="wrap">
		<div class="featuretitle"><h2><?php echo get_theme_mod( 'mediaphase_latest_news_title' ); ?></h2></div>
		<p class="newsintro"><?php echo get_theme_mod( 'mediaphase_latest_news_text' ); ?></p>

		<div id="newsposts">

			<?php
			global $query_string;
			query_posts( preg_replace( '/pagename=[a-zA-Z0-9-_]/', '', $query_string ) . '&post_type=post&post_status=publish&posts_per_page=' . get_theme_mod( 'mediaphase_latest_news_item_limit', 3 ) );
			while ( have_posts() ) :
				the_post();
			?>

			<div class="newspost">

				<a href="<?php the_permalink();?>">
					<div class="newsoverlay"> 
    					<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'mediaphase-frontpage-news', array( 'class' => 'newsimage' ) );
								} else { ?>
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/default.gif" alt="<?php the_title(); ?>" />
						<?php } ?>
						<div class="newsimagebody">
							<i class="fa fa-chevron-right"></i>
						</div>
					</div>
				</a>
				<p class="newscategory">
					<?php
					$categories = get_the_category();
					if ( !empty( $categories ) ) {
						foreach ( $categories as $index => $category ) {
							echo '<a href="' . esc_url( home_url() . '/?cat=' . $category->term_id ) . '">' . $category->name . '</a>' . ( $index !== count( $categories ) - 1 ? ', ' : '' );
						}
					}
					?>
				</p>

				<h3 class="newstitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="newsauthor"><?php _e( 'Posted By', 'mediaphase' );?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="authorname"><?php the_author(); ?></a></p>
				<span class="newstext"><?php the_excerpt(); ?></span>
				<ul class="newsmeta">
					<li class="newscomments"><i class="fa fa-comments-o"></i> 
							<?php comments_popup_link( __( '0 Comments', 'mediaphase' ), __( '1 Comment', 'mediaphase' ), __( '% Comments', 'mediaphase' ) ); ?>
						</li>
					<li class="newstime"><i class="fa fa-clock-o"></i> <?php mediaphase_posted_ago( get_the_date( 'c' ), get_permalink() ); ?></li>
				</ul>
			</div><!-- End .newspost -->

			<?php endwhile; ?>

		</div><!-- End #newsposts -->

	</div><!-- End #wrap -->
</div><!-- End #news -->
<?php endif;