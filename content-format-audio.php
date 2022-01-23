<?php
/**
 * Post format - Audio
 */
$style = !isset( $style ) ? jevelin_post_option( get_queried_object_id(), 'page-blog-style' ) : $style;
$audio_url  = jevelin_post_option( get_the_ID(), 'post-audio' );
$audio_file = jevelin_post_option( get_the_ID(), 'post-audio-file' );
$audio_file_url = ( isset( $audio_file['url'] ) && $audio_file['url'] ) ? $audio_file['url'] : '';
$audio_content = '';

$rand_id = jevelin_rand( 10 );
if( $audio_url ) :
	$audio_content = '
	<div class="post-meta-video">
		<div class="ratio-container">
			<div class="ratio-content">
				' . ( wp_oembed_get( $audio_url ) ) . '
			</div>
		</div>
	</div>';
elseif( $audio_file_url ) :
	$audio_content = '
	<audio id="post-player-'.esc_attr( $rand_id ).'">
		<source src="'. esc_url( $audio_file_url ) .'" type="audio/mp3" />
	</audio>
	<script type="text/javascript">
		const player_'.esc_attr( $rand_id ).' = new Plyr(\'#post-player-'.esc_attr( $rand_id ).'\', { \'settings\': [] });
	</script>';
endif;


/* Layout for masonry style */
if ( $style == 'masonry' || $style == 'masonry masonry-shadow' ) :
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?> <?php Jevelin_Schema::blog(); ?>>
		<div class="post-container">
			<?php jevelin_popover( jevelin_post_option( get_the_ID(), 'post-popover' ) ); ?>

			<?php echo ( $audio_content ); ?>

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

			<?php echo ( $audio_content ); ?>

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

			<?php echo ( $audio_content ); ?>

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
						<?php echo ( $audio_content ); ?>

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

				<?php echo ( $audio_content ); ?>

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

			<?php if( $audio_content ) : ?>
				<div class="post-left-side">

					<?php echo ( $audio_content ); ?>

				</div>
			<?php endif; ?>
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

			<?php if( !is_single() ) : ?>
				<?php echo ( $audio_content ); ?>
			<?php else : ?>
				<?php if( $audio_url ) : ?>
					<div class="post-meta-video">
						<div class="ratio-container">
							<div class="ratio-content">
								<?php echo wp_oembed_get( $audio_url ); ?>
							</div>
						</div>
					</div>

				<?php elseif( $audio_file_url ) : ?>

					<audio id="post-player">
					    <source src="<?php echo ( $audio_file_url ); ?>" type="audio/mp3" />
					</audio>
					<script type="text/javascript">
						jQuery(document).ready(function ($) {
							const player = new Plyr('#post-player', { 'settings': [] });
						});
					</script>

				<?php endif; ?>
			<?php endif; ?>

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
