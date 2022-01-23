<?php
/**
 * Author Page
 */

$elements = jevelin_option( 'post_elements' );
set_query_var( 'style', 'masonry masonry-shadow' );
get_header();
?>

	<div id="content" class="content-with-sidebar-right">

		<?php if( ( !jevelin_framework_active() || ( isset($elements['athor_box']) && $elements['athor_box'] == true ) ) && get_the_author_meta( 'description' ) ) : ?>
				<div class="sh-post-author sh-post-author-page sh-table">
					<div class="sh-post-author-avatar sh-table-cell-top">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), '185' ); ?>
					</div>
					<div class="sh-post-author-info sh-table-cell-top">
						<h4><?php the_author(); ?></h4>
						<div><?php the_author_meta( 'description' ); ?></div>
					</div>
				</div>
		<?php endif; ?>

		<div class="sh-group blog-list blog-style-masonry masonry-shadow">

			<?php
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();

						if( get_post_format() ) :
							get_template_part( 'content', 'format-'.get_post_format() );
						else :
							get_template_part( 'content' );
						endif;

					endwhile;
				else :

					get_template_part( 'content', 'none' );

				endif;
			?>
		</div>
		<?php jevelin_pagination(); ?>

	</div>
	<div id="sidebar" class="sidebar-right" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
