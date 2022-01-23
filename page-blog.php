<?php
/* Template Name: Blog */
get_header();
wp_reset_postdata();
$content = get_the_content();

if( jevelin_page_layout() == 'sidebar-right' || jevelin_page_layout() == 'sidebar-left' ) :
	$layout_sidebar = esc_attr( jevelin_page_layout() );
endif;


$cat_att = 'category__in';
$categories_query = array();
$get_page_blog_category = jevelin_post_option( get_the_ID(), 'page_blog_category' );
if( is_array( $get_page_blog_category ) && count( $get_page_blog_category ) > 0 ) :
	$categories_query = $get_page_blog_category;
elseif( $get_page_blog_category ) :
	$categories_query = explode( ',', $get_page_blog_category );
	$cat_att = 'category_name';
endif;

$categories_tabs = $categories_query;
if( !count( $categories_tabs ) ) :
	$categories_tabs = get_terms( array(
	    'taxonomy' => 'category',
	    'hide_empty' => false,
		'fields' => 'ids'
	));
endif;

$post_per_page = ( get_option( 'posts_per_page' ) ) ? get_option( 'posts_per_page' ) : 12;
$post_per_page = ( jevelin_option( 'blog-items' ) > 0 ) ? intval( jevelin_option( 'blog-items' ) ) : $post_per_page;
$post_per_page = ( jevelin_post_option( get_the_ID(), 'page_blog_posts_per_page' ) != 'default' ) ? intval( jevelin_post_option( get_the_ID(), 'page_blog_posts_per_page' )) : $post_per_page;

$pagination_type = jevelin_post_option( get_the_ID(), 'page_blog_pagination_type', 'default' );
$this_category = ( isset($_GET['category']) && $_GET['category'] ) ? esc_attr($_GET['category']) : '';

$style = jevelin_post_option( get_the_ID(), 'page-blog-style', 'masonry masonry-shadow' );
set_query_var( 'style', $style );
?>

<?php if( jevelin_post_option( get_the_ID(), 'page_blog_categories_tab' ) == 'on' ) : ?>
	<div class="sh-filter-blog sh-filter-container sh-portfolio-filter-style3 sh-portfolio-filter-style4">
		<div class="sh-filter">
			<span class="sh-filter-item<?php echo ( !$this_category ) ? ' active' : ''; ?>">
				<a href="<?php echo esc_url( get_the_permalink() )?>" class="sh-filter-item-content">
					<?php esc_attr_e( 'All', 'jevelin' ); ?>
				</a>
			</span>

			<?php foreach( $categories_tabs as $category_id ) :
				if( $category_id > 0 ) :
					$category = get_term_by( 'id', $category_id, 'category' );
				else :
					$category = get_term_by( 'slug', $category_id, 'category' );
				endif;

				if( !empty( $category->count ) && $category->count > 0 ) : ?>

				<span class="sh-filter-item<?php echo ( $this_category == $category->slug ) ? ' active' : ''; ?>">
					<a href="<?php echo esc_url( add_query_arg( 'category', esc_attr( $category->slug ), get_the_permalink() ) ); ?>" class="sh-filter-item-content">
						<?php echo esc_attr( $category->name ); ?>
					</a>
				</span>

			<?php endif; endforeach; ?>
		</div>
	</div>
<?php endif; ?>

	<?php if( get_page_template_slug() != 'page-blog.php' ) : ?>
		<?php echo ( do_shortcode( $content ) ); ?>
	<?php else : ?>
		<div id="content" class="<?php if( isset($layout_sidebar) && $layout_sidebar ) : ?>content-with-<?php echo esc_attr( $layout_sidebar ); endif; ?> blog-page-list">
			<div class="sh-group blog-list blog-style-<?php echo esc_attr( $style ); ?>">
				<?php
					if( is_front_page() ) {
						$page = (get_query_var('page')) ? get_query_var('page') : 1;
					} else {
						$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
					}

					$cat_var = $categories_query;
					if( $cat_att == 'category_name' && is_array( $cat_var ) ) :
						$cat_var = implode( ',', $cat_var );
					endif;

					if( $this_category ) {
						$cat_att = 'category_name';
						$cat_var = esc_attr( $this_category );
					}

					$blog_posts = new WP_Query( array(
						'post_type' => 'post',
						'paged' => $page,
						$cat_att => $cat_var,
						'posts_per_page' => $post_per_page,
					));
					if( $blog_posts->have_posts() ) :

						while ( $blog_posts->have_posts() ) : $blog_posts->the_post();

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

			<?php if( $pagination_type == 'default' ) :
				jevelin_pagination( $blog_posts );
			elseif( ( $pagination_type == 'button' || $pagination_type == 'infinite' ) &&
			isset( $blog_posts->found_posts ) && $blog_posts->found_posts > $post_per_page ) :

			if( $this_category ) :
				$get_this_category = get_category_by_slug( $this_category );
				$load_more_category = [ $get_this_category->term_id ];
			else :
				$load_more_category = $categories_query;
			endif;
			?>

				<div class="sh-load-more<?php echo ( $pagination_type == 'infinite' ) ? ' infinite' : ''; ?>"
				data-categories="<?php echo implode( ',', $load_more_category ); ?>"
				data-post-style="<?php echo jevelin_post_option( get_queried_object_id(), 'page-blog-style' ); ?>"
				data-posts-per-page="<?php echo esc_attr( $post_per_page ); ?>"
				data-paged="2"
				data-id="blog-page-list">
					<?php
						if( $pagination_type == 'button' ) :
							esc_html_e( 'Load more', 'jevelin' );
						else :
							esc_html_e( 'Loading', 'jevelin' );
						endif;
					?>
				</div>

			<?php endif; ?>

		</div>
		<?php if( isset($layout_sidebar) && $layout_sidebar ) : ?>
			<div id="sidebar" class="<?php echo esc_attr( $layout_sidebar ); ?>" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

<?php get_footer(); ?>
