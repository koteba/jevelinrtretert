<?php
/**
 * Post format - Standard
 */

if( !isset( $style ) ) :
	$style = jevelin_post_option( get_queried_object_id(), 'page-blog-style' );
endif;
/* Layout for masonry style */
if ( $style == 'masonry' || $style == 'masonry masonry-shadow' ) :
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?> <?php Jevelin_Schema::blog(); ?>>
		<div class="post-container">
			<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>

			<div class="post-meta-thumb">
				<?php
				$ratio = 0;

				if( jevelin_option('lazy_loading') == 'enabled' ) :
					$attachment_id = get_post_thumbnail_id( get_the_ID() );
					$image_ratio = 'large';

					if( $attachment_id ) :
						$image_media = wp_get_attachment_metadata( $attachment_id );

						if( $image_ratio ) :
							$image_width = ( isset( $image_media['sizes'][$image_ratio]['width'] ) ) ? $image_media['sizes'][$image_ratio]['width'] : 0;
							$image_height = ( isset( $image_media['sizes'][$image_ratio]['height'] ) ) ? $image_media['sizes'][$image_ratio]['height'] : 0;
						endif;
						if( !isset( $image_width ) || !$image_width ) :
							$image_width = ( isset( $image_media['width'] ) ) ? $image_media['width'] : 0;
							$image_height = ( isset( $image_media['height'] ) ) ? $image_media['height'] : 0;
						endif;

						if( $image_width && $image_height ) :
							$ratio = ( $image_height / $image_width ) * 100;
						endif;
					endif;
				?>
				<?php endif; ?>

				<?php if( $ratio ) : ?>

					<div class="ratio-container" style="padding-top: <?php echo esc_attr( $ratio ); ?>%;">
						<div class="ratio-content">
							<img class="sh-image-url lazy" data-src="<?php echo jevelin_get_thumb( get_the_ID(), 'large' ); ?>" alt="" />
						</div>
					</div>

				<?php else : ?>
					<?php echo the_post_thumbnail( 'large' ); ?>
				<?php endif; ?>

				<?php echo jevelin_blog_overlay( jevelin_get_thumb( get_the_ID() ) ); ?>
			</div>

			<div class="post-content-container">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
					<h2 itemprop="headline">
						<?php jevelin_sticky_post(); ?>
						<?php the_title(); ?>
					</h2>
				</a>

				<div class="post-meta post-meta-one">
					<?php jevelin_meta_one(); ?>
				</div>

				<div class="post-content" itemprop="text">
					<?php the_excerpt(); ?>
				</div>

				<div class="post-meta post-meta-two">
					<?php jevelin_meta_two(); ?>
				</div>
			</div>

		</div>
	</article>


<?php
	/* Layout for Masonry version 2 */
	elseif( $style == 'masonry masonry2' || $style == 'grid masonry2' ) :
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?> <?php Jevelin_Schema::blog(); ?>>
		<div class="post-container">
			<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>

			<div class="post-meta-thumb">
				<?php
				$ratio = 0;

				if( jevelin_option('lazy_loading') == 'enabled' ) :
					$attachment_id = get_post_thumbnail_id( get_the_ID() );
					$image_ratio = 'large';

					if( $attachment_id ) :
						$image_media = wp_get_attachment_metadata( $attachment_id );

						if( $image_ratio ) :
							$image_width = ( isset( $image_media['sizes'][$image_ratio]['width'] ) ) ? $image_media['sizes'][$image_ratio]['width'] : 0;
							$image_height = ( isset( $image_media['sizes'][$image_ratio]['height'] ) ) ? $image_media['sizes'][$image_ratio]['height'] : 0;
						endif;
						if( !isset( $image_width ) || !$image_width ) :
							$image_width = ( isset( $image_media['width'] ) ) ? $image_media['width'] : 0;
							$image_height = ( isset( $image_media['height'] ) ) ? $image_media['height'] : 0;
						endif;

						if( $image_width && $image_height ) :
							$ratio = ( $image_height / $image_width ) * 100;
						endif;
					endif;
				endif;


				if( $style == 'grid masonry2' ) :
					$ratio = 56;
					$image_ratio = 'jevelin-landscape-large';
				endif;
				?>

				<?php if( $ratio ) : ?>

					<div class="ratio-container" style="padding-top: <?php echo esc_attr( $ratio ); ?>%;">
						<div class="ratio-content">
							<img class="sh-image-url lazy" data-src="<?php echo jevelin_get_thumb( get_the_ID(), $image_ratio ); ?>" alt="" />
						</div>
					</div>

				<?php else : ?>
					<?php echo the_post_thumbnail( 'large' ); ?>
				<?php endif; ?>

				<?php echo jevelin_blog_overlay( jevelin_get_thumb( get_the_ID() ) ); ?>
			</div>

			<div class="post-content-container">

				<div class="post-meta post-meta-one">
					<?php jevelin_meta_one(); ?>
				</div>

				<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
					<h2 itemprop="headline">
						<?php jevelin_sticky_post(); ?>
						<?php the_title(); ?>
					</h2>
				</a>

				<div class="post-content" itemprop="text">
					<?php if( jevelin_option( 'post_desc', 45 ) == 45 ) : ?>
						<?php echo wp_trim_words( get_the_excerpt() , '17' ); ?>
					<?php else : ?>
						<?php echo wp_trim_words( get_the_excerpt() , esc_attr( jevelin_option( 'post_desc', 45 ) ) ); ?>
					<?php endif; ?>
				</div>

				<div class="post-meta post-meta-two">
					<?php jevelin_meta_two( 0, 'icon icon-bubble' ); ?>
				</div>
			</div>

		</div>
	</article>


<?php
	/* Layout for grid style */
	elseif( $style == 'grid' ) :
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?> <?php Jevelin_Schema::blog(); ?>>
		<div class="post-container">
			<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>

			<div class="post-meta-thumb">
				<?php echo the_post_thumbnail( 'jevelin-landscape-large' ); ?>
				<?php echo jevelin_blog_overlay( jevelin_get_thumb( get_the_ID() ) ); ?>
			</div>

			<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
				<h2 itemprop="headline">
					<?php jevelin_sticky_post(); ?>
					<?php the_title(); ?>
				</h2>
			</a>

			<div class="post-meta post-meta-one">
				<?php jevelin_meta_one(); ?>
			</div>

			<div class="post-content" itemprop="text">
				<?php the_excerpt(); ?>
			</div>

			<div class="post-meta post-meta-two">
				<?php jevelin_meta_two(); ?>
			</div>

		</div>
	</article>


<?php
	/* Layout for mix style */
	elseif ( $style == 'mix masonry2' ) :
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?> <?php Jevelin_Schema::blog(); ?>>
		<div class="post-container">

			<div class="row">
				<div class="col-md-6 post-column-left">

					<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>
					<div class="post-meta-thumb">
						<?php echo jevelin_image_ratio( get_the_ID(), 'large' ); ?>
						<?php echo jevelin_blog_overlay( jevelin_get_thumb( get_the_ID() ) ); ?>
					</div>

				</div>
				<div class="col-md-6 post-column-right">

					<div class="post-content-container">
						<div class="">
							<div class="post-meta post-meta-one">
								<?php jevelin_meta_one(); ?>
							</div>

							<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
								<h2 itemprop="headline">
									<?php jevelin_sticky_post(); ?>
									<?php the_title(); ?>
								</h2>
							</a>

							<div class="post-content" itemprop="text">
								<?php
								$excerpt = preg_replace( '#<script(.*?)>(.*?)</script>#is', '', get_the_excerpt() );
								if( jevelin_option( 'post_desc', 45 ) == 45 ) : ?>
									<?php echo wp_trim_words( $excerpt, '17' ); ?>
								<?php else : ?>
									<?php echo wp_trim_words( $excerpt, esc_attr( jevelin_option( 'post_desc', 45 ) ) ); ?>
								<?php endif; ?>
							</div>

							<div class="post-meta post-meta-two">
								<?php jevelin_meta_two( 0, 'icon icon-bubble' ); ?>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
	</article>


<?php
	/* Layout for minimalistic style */
	elseif( $style == 'minimalistic' ) :
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?> <?php Jevelin_Schema::blog(); ?>>
		<div class="post-container">
			<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>

			<div class="post-meta-thumb">
				<?php echo the_post_thumbnail( 'post-thumbnails' ); ?>
				<?php echo jevelin_blog_overlay( jevelin_get_thumb( get_the_ID() ) ); ?>
			</div>

			<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
				<h2 itemprop="headline">
					<?php jevelin_sticky_post(); ?>
					<?php the_title(); ?>
				</h2>
			</a>

			<div class="post-meta post-meta-two">
				<?php jevelin_meta_two(); ?>
			</div>

			<div class="post-content" itemprop="text">
				<?php the_excerpt(); ?>
			</div>

			<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="post-readmore sh-default-color sh-columns">
				<div><?php _e( 'Read more', 'jevelin' ); ?></div>
				<div><i class="ti-angle-right"></i></div>
			</a>

		</div>
	</article>


<?php
	/* Layout for standard medium and small styles */
	elseif( $style == 'medium' || $style == 'small' ) :
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?> <?php Jevelin_Schema::blog(); ?>>
		<div class="post-container sh-group">
			<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>

			<div class="post-left-side">

				<div class="post-meta-thumb">
					<?php echo the_post_thumbnail(); ?>
					<?php echo jevelin_blog_overlay( jevelin_get_thumb( get_the_ID() ) ); ?>
				</div>

			</div>
			<div class="post-right-side">

				<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
					<h2 itemprop="headline">
						<?php jevelin_sticky_post(); ?>
						<?php the_title(); ?>
					</h2>
				</a>

				<div class="post-meta post-meta-one">
					<?php jevelin_meta_one(); ?>
				</div>

				<div class="post-content" itemprop="text">
					<?php the_excerpt(); ?>
				</div>

				<div class="post-meta post-meta-two">
					<?php jevelin_meta_two(); ?>
				</div>

			</div>
		</div>
	</article>

<?php
	/* Layout for standard large and single post style */
	else :

		if( !is_single() ) :
			$show_link = 1;
		else :
			$show_link = 0;
		endif;
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item post-item-single'); ?>>
		<div class="post-container">
			<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>

			<?php if( jevelin_post_option( get_the_ID(), 'hide-image', false ) == false && jevelin_get_thumb( get_the_ID() ) ) : ?>
				<div class="post-meta-thumb">
					<?php echo the_post_thumbnail( 'jevelin-landscape-large' ); ?>

					<?php
						if( is_single() && jevelin_option( 'post_main_image_lightbiox', 'on' ) == 'off' ) :
							//
						else :
							echo jevelin_blog_overlay( jevelin_get_thumb( get_the_ID() ), $show_link, 1 );
						endif;
					?>
				</div>

				<?php if( jevelin_post_option( get_the_ID(), 'post-copyrights' ) ) : ?>
					<div class="post-copyrights">
						<?php echo ( jevelin_post_option( get_the_ID(), 'post-copyrights' ) ); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
				<?php if( !is_single() ) : ?>
					<h2 itemprop="headline"><?php the_title(); ?></h2>
				<?php else : ?>
					<h1 itemprop="headline"><?php the_title(); ?></h1>
				<?php endif; ?>
			</a>

			<div class="post-meta-data sh-columns">
				<div class="post-meta post-meta-one">
					<?php jevelin_meta_one(); ?>
				</div>
				<div class="post-meta post-meta-two">
					<?php jevelin_meta_two(); ?>
				</div>
			</div>

			<div class="post-content" itemprop="text">
				<?php
					if( !is_single() ) :
						the_excerpt();
					else :
						the_content();
					endif;
				?>
			</div>

		</div>
	</article>

<?php endif; ?>
