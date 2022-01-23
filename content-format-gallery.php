<?php
/**
 * Post format - Gallery
 */

if( !isset($style) ) :
	$style = jevelin_post_option( get_queried_object_id(), 'page-blog-style' );
endif;

/* Layout for masonry style */
if ( $style == 'masonry' || $style == 'masonry masonry-shadow' ) :
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?> <?php Jevelin_Schema::blog(); ?>>
		<div class="post-container">

			<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>

			<?php
			$gallery = jevelin_post_option( get_the_ID(), 'post-gallery' );
			if( get_the_post_thumbnail() || (is_array($gallery) && count($gallery) > 0)  ) : ?>
				<div class="sh-gallery">
					<?php if( get_the_post_thumbnail() ) : ?>
						<div class="sh-gallery-item">
							<?php echo the_post_thumbnail( 'jevelin-square', array('class' => 'width-full') ); ?>
						</div>
					<?php endif; ?>

					<?php
						if( is_array($gallery) && count($gallery) > 0 ) :
							foreach( $gallery as $image ) : ?>

								<div class="sh-gallery-item">
									<img src="<?php echo jevelin_get_image_size( $image, 'jevelin-square'); ?>" alt="" class="width-full" />
								</div>

							<?php endforeach;
						endif;
					?>
				</div>
			<?php else : ?>
				<div class="post-meta-thumb"></div>
			<?php endif; ?>

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

	if( $style == 'masonry masonry2' ) :
		$ratio = 'jevelin-square';
	else :
		$ratio = 'jevelin-landscape-large';
	endif;
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?> <?php Jevelin_Schema::blog(); ?>>
		<div class="post-container">
			<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>

			<?php
			$gallery = jevelin_post_option( get_the_ID(), 'post-gallery' );
			if( get_the_post_thumbnail() || ( is_array( $gallery ) && count( $gallery ) > 0 )  ) : ?>
				<div class="sh-gallery">
					<?php if( get_the_post_thumbnail() ) : ?>
						<div class="sh-gallery-item">
							<?php echo the_post_thumbnail( $ratio, array('class' => 'width-full' ) ); ?>
						</div>
					<?php endif; ?>

					<?php
						if( is_array( $gallery ) && count( $gallery ) > 0 ) :
							foreach( $gallery as $image ) : ?>

								<div class="sh-gallery-item">
									<img src="<?php echo jevelin_get_image_size( $image, $ratio ); ?>" alt="" class="width-full" />
								</div>

							<?php endforeach;
						endif;
					?>
				</div>
			<?php else : ?>
				<div class="post-meta-thumb"></div>
			<?php endif; ?>

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
			<div class="sh-gallery">
				<?php if( get_the_post_thumbnail() ) : ?>
					<div class="sh-gallery-item">
						<?php echo the_post_thumbnail( 'jevelin-landscape-large', array('class' => 'width-full') ); ?>
					</div>
				<?php endif; ?>

				<?php
					$gallery = jevelin_post_option( get_the_ID(), 'post-gallery' );
					if( count($gallery) > 0 ) :
						foreach( $gallery as $image ) : ?>

							<div class="sh-gallery-item">
								<img src="<?php echo jevelin_get_image_size($image, 'jevelin-landscape-large'); ?>" alt="" class="width-full" />
							</div>

						<?php endforeach;
					endif;
				?>
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
					<div class="sh-gallery">
						<?php if( get_the_post_thumbnail() ) : ?>
							<div class="sh-gallery-item">
								<?php echo jevelin_image_ratio( get_the_ID(), 'large', 1 ); ?>
							</div>
						<?php endif; ?>

						<?php
							$gallery = jevelin_post_option( get_the_ID(), 'post-gallery' );
							if( count($gallery) > 0 ) :
								foreach( $gallery as $image ) : ?>

									<div class="sh-gallery-item">
										<div class="sh-ratio">
											<div class="sh-ratio-container">
												<div class="sh-ratio-content" style="background-image: url(<?php echo jevelin_get_image_size($image, 'jevelin-landscape-large'); ?>);"></div>
											</div>
										</div>
									</div>

								<?php endforeach;
							endif;
						?>
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
			<div class="sh-gallery">
				<?php if( get_the_post_thumbnail() ) : ?>
					<div class="sh-gallery-item">
						<?php echo the_post_thumbnail( 'post-thumbnails', array('class' => 'width-full') ); ?>
					</div>
				<?php endif; ?>

				<?php
					$gallery = jevelin_post_option( get_the_ID(), 'post-gallery' );
					if( count($gallery) > 0 ) :
						foreach( $gallery as $image ) : ?>

							<div class="sh-gallery-item">
								<img src="<?php echo jevelin_get_image_size($image, 'post-thumbnails'); ?>" alt="" class="width-full" />
							</div>

						<?php endforeach;
					endif;
				?>
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
			<div class="post-left-side">

			<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>
			<div class="sh-gallery">
				<?php if( get_the_post_thumbnail() ) : ?>
					<div class="sh-gallery-item">
						<?php echo the_post_thumbnail( 'post-thumbnail', array('class' => 'width-full') ); ?>
					</div>
				<?php endif; ?>

				<?php
					$gallery = jevelin_post_option( get_the_ID(), 'post-gallery' );
					if( count($gallery) > 0 ) :
						foreach( $gallery as $image ) : ?>

							<div class="sh-gallery-item">
								<img src="<?php echo jevelin_get_image_size($image, 'post-thumbnail'); ?>" alt="" class="width-full" />
							</div>

						<?php endforeach;
					endif;
				?>
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
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item post-item-single'); ?>>
		<div class="post-container">

			<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>
			<div class="sh-gallery">
				<?php if( get_the_post_thumbnail() ) : ?>
					<div class="sh-gallery-item">
						<div class="post-meta-thumb">
							<?php echo the_post_thumbnail( 'jevelin-landscape-large', array('class' => 'width-full') ); ?>
							<?php echo jevelin_blog_overlay( jevelin_get_small_thumb(get_post_thumbnail_id(), 'large'), 0, 1 ); ?>
						</div>
					</div>
				<?php endif; ?>

				<?php
					$gallery = jevelin_post_option( get_the_ID(), 'post-gallery' );
					if( is_array($gallery) && count($gallery) > 0 ) :
						foreach( $gallery as $image ) : ?>

							<div class="sh-gallery-item">
								<div class="post-meta-thumb">
									<img src="<?php echo jevelin_get_image_size($image, 'jevelin-landscape-large'); ?>" alt="" class="width-full" />
									<?php echo jevelin_blog_overlay( jevelin_get_image_size($image, 'large'), 0, 1 ); ?>
								</div>
							</div>

						<?php endforeach;
					endif;
				?>
			</div>

			<?php if( jevelin_post_option( get_the_ID(), 'post-copyrights' ) ) : ?>
				<div class="post-copyrights">
					<?php echo ( jevelin_post_option( get_the_ID(), 'post-copyrights' ) ); ?>
				</div>
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

			<?php if( get_the_excerpt() || the_content() ) : ?>
				<div class="post-content" itemprop="text">
					<?php
						if( !is_single() ) :
							the_excerpt();
						else :
							the_content();
						endif;
					?>
				</div>
			<?php endif; ?>

		</div>
	</article>

<?php endif; ?>
