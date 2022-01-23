<?php
$style = jevelin_post_option( get_the_ID(), 'page-blog-style', 'masonry masonry-shadow' );
set_query_var( 'style', $style );
get_header();
?>

	<div id="content" class="content-with-sidebar-right">
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
