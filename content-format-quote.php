<?php
/**
 * Post format - Quote
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


			<div class="post-with-background">
				<div class="post-meta-icon">
					<i class="ti-quote-left"></i>
				</div>
				<div class="post-quote-and-link">
					<a href="<?php echo esc_url( get_permalink() ); ?>">
						<?php if( jevelin_post_option( get_the_ID(), 'post-quote' ) ) :
							echo jevelin_post_option( get_the_ID(), 'post-quote' );
						else :
							echo get_the_title();
						endif; ?>
					</a>
					<span class="post-quote-and-link-details">
						<?php echo jevelin_post_option( get_the_ID(), 'post-quote-author' ); ?>
					</span>
				</div>

				<div class="sh-columns">
					<div class="post-meta">
						<a href="<?php echo esc_url( get_permalink() ); ?>#comments" class="post-meta-comments">
							<i class="icon-speech"></i>
							<?php echo get_comments_number( '0', '1', '%' ); ?>
						</a>
					</div>
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

			<div class="post-content-container">
				<div class="post-with-background2">
					<div class="post-meta-icon2">
						<i class="ti-quote-left"></i>
					</div>
					<div class="post-quote-and-link2">
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<?php if( jevelin_post_option( get_the_ID(), 'post-quote' ) ) :
								echo jevelin_post_option( get_the_ID(), 'post-quote' );
							else :
								echo get_the_title();
							endif; ?>
						</a>
					</div>
					<div class="post-quote-and-link-details2">
						<?php echo jevelin_post_option( get_the_ID(), 'post-quote-author' ); ?>
					</div>
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

			<div class="ratio-container">
				<div class="ratio-content">
					<div class="post-with-background sh-table">
						<div class="sh-table-cell">

							<a class="mini-post-title" href="<?php echo esc_url( get_permalink() ); ?>">
								<?php echo jevelin_post_option( get_the_ID(), 'post-quote' ); ?>
							</a>
							<span class="mini-post-description" href="<?php echo esc_url( jevelin_post_option( get_the_ID(), 'post-url' ) ); ?>" target="_blank">
								<i class="ti-quote-left"></i> <?php echo jevelin_post_option( get_the_ID(), 'post-quote-author' ); ?>
							</span>

						</div>
					</div>
				</div>
			</div>

			<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
				<h2 itemprop="headline"><?php the_title(); ?></h2>
			</a>

			<div class="post-meta post-meta-one">
				<?php jevelin_meta_one(); ?>
			</div>

			<?php if( get_the_excerpt() ) : ?>
				<div class="post-content" itemprop="text">
					<?php the_excerpt(); ?>
				</div>
			<?php endif; ?>

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
						<div>

							<div class="post-meta-icon2">
								<i class="ti-quote-left"></i>
							</div>

							<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
								<h2 itemprop="headline">
									<?php if( jevelin_post_option( get_the_ID(), 'post-quote' ) ) :
										echo jevelin_post_option( get_the_ID(), 'post-quote' );
									else :
										echo get_the_title();
									endif; ?>
								</h2>
							</a>

							<?php if( jevelin_post_option( get_the_ID(), 'post-quote-author' ) ) : ?>
								<div class="post-content" itemprop="text">
									<?php echo jevelin_post_option( get_the_ID(), 'post-quote-author' ); ?>
								</div>
							<?php endif; ?>

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
	/* Layout for standard medium and small styles */
	elseif( $style == 'medium' || $style == 'small' ) :
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?> <?php Jevelin_Schema::blog(); ?>>
		<div class="post-container sh-group">
			<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>
			<div class="post-left-side">

				<div class="post-with-background">
					<div class="post-meta-icon">
						<i class="ti-quote-left"></i>
					</div>
					<div class="post-quote-and-link">
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<?php echo jevelin_post_option( get_the_ID(), 'post-quote' ); ?>
						</a>
						<span class="post-quote-and-link-details">
							<?php echo jevelin_post_option( get_the_ID(), 'post-quote-author' ); ?>
						</span>
					</div>
				</div>

			</div>
			<div class="post-right-side">

				<a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title">
					<h2 itemprop="headline"><?php the_title(); ?></h2>
				</a>

				<div class="post-meta post-meta-one">
					<?php jevelin_meta_one(); ?>
				</div>

				<?php if( get_the_excerpt() ) : ?>
					<div class="post-content" itemprop="text">
						<?php the_excerpt(); ?>
					</div>
				<?php endif; ?>

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

			<?php if( jevelin_post_option( get_the_ID(), 'post-quote' ) ) : ?>
				<div class="post-with-background">
					<div class="post-meta-icon">
						<i class="ti-quote-left"></i>
					</div>
					<div class="post-quote-and-link">
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<?php echo jevelin_post_option( get_the_ID(), 'post-quote' ); ?>
						</a>
						<span class="post-quote-and-link-details">
							<?php echo jevelin_post_option( get_the_ID(), 'post-quote-author' ); ?>
						</span>
					</div>

					<div class="sh-columns">
						<div class="post-meta">
							<a href="<?php echo esc_url( get_permalink() ); ?>#comments" class="post-meta-comments">
								<i class="icon-speech"></i>
								<?php echo get_comments_number( '0', '1', '%' ); ?>
							</a>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php if( is_single() ) : ?>
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
			<?php endif; ?>

		</div>
	</article>

<?php endif; ?>
