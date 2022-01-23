<?php
/**
 * Footer
 */
wp_reset_postdata();
$footer_template = ( jevelin_option( 'footer_template' ) != 'default' ) ? jevelin_option( 'footer_template' ) : 'default';
$footer_template_id = intval( str_replace( 'footer-', '', $footer_template ) );

$post_footer_template = jevelin_post_option( jevelin_page_id(), 'footer_template', 'default' );
$post_footer_template_id = intval( str_replace( 'footer-', '', $post_footer_template ) );
if( $post_footer_template_id > 0 ) :
	$footer_template = $footer_template_id = $post_footer_template_id;
endif;


if( is_singular( 'fw-portfolio' ) ) :
	$page_layout = jevelin_option( 'portfolio_single_page_layout', 'default' );
elseif( jevelin_post_option( jevelin_page_id(), 'page_layout', 'default' ) != 'global_default' ) :
	$page_layout = jevelin_post_option( jevelin_page_id(), 'page_layout', 'default' );
else :
	$page_layout = jevelin_option( 'page_layout', 'default' );
endif;
?>

	<?php if( $page_layout != 'full' ) : ?>
		</div>
	<?php endif; ?>
	</div>

		<?php if( !in_array( get_post_type( get_the_ID() ), array( 'shufflehound_header', 'shufflehound_footer' ) ) ) : ?>
			<?php if( is_numeric( $footer_template ) && get_post_status( $footer_template ) == 'publish' ) :
				if( function_exists( 'pll_get_post' ) && pll_get_post( $footer_template ) > 0 ) :
					$footer_template = pll_get_post( $footer_template );
				endif;
			?>

				<footer class="sh-footer-template" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
					<div class="container">
						<?php if( current_user_can( 'manage_options' ) ) : ?>
							<a target="_blank" href="<?php echo admin_url( 'post.php?vc_action=vc_inline&post_id='.intval( $footer_template_id ).'&post_type=shufflehound_footer' ); ?>" class="sh-header-builder-edit">
								<i class="ti-pencil"></i>
								<?php esc_html_e( 'Edit Footer', 'jevelin' ); ?>
							</a>
						<?php endif; ?>
						<?php
							/* Footer Builder Output */
							if( class_exists( 'Vc_Manager' ) ) :
								ob_start();

								Vc_Manager::getInstance()->vc()->addShortcodesCustomCss( $footer_template );
								$footer_css = ob_get_contents();
								ob_end_clean();

								if( $footer_css ) :
									echo $footer_css;
								else :
									$footer_custom_css = get_post_meta( $footer_template, '_wpb_shortcodes_custom_css', true );
							        if( !empty( $footer_custom_css ) ) :
							            echo '<style type="text/css">';
							            echo $footer_custom_css;
							            echo '</style>';
							        endif;
								endif;

							    $the_post = get_post( $footer_template );
								echo do_shortcode( $the_post->post_content );
							endif;
						?>
					</div>
				</footer>

			<?php else : ?>

				<footer class="sh-footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
					<?php if( jevelin_footer_enabled() == 'on' ) : ?>

						<div class="sh-footer-widgets">
							<div class="container">
								<div class="sh-footer-columns">
									<?php
										/* Show theme footer widgets */
										if( is_active_sidebar( 'footer-widgets' ) ) :
											dynamic_sidebar( 'footer-widgets' );
										elseif( is_active_sidebar( 'footer_widgets' ) ) :
											dynamic_sidebar( 'footer_widgets' );
										endif;
									?>
								</div>
							</div>
						</div>

					<?php endif; ?>
					<?php
						if( jevelin_copyrights_enabled() == 'on' ) :
							/* Inlcude theme copyrights bar */
							get_template_part('inc/templates/copyrights' );
						endif;
					?>
				</footer>

			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>


<?php if( function_exists( 'wc_get_cart_url' ) ) : ?>
	<div class="sh-notifications"></div>
	<div class="sh-notification-item-example">
		<strong class="sh-notification-item-name"></strong> <?php echo esc_attr__( 'has been added to the cart.', 'jevelin' ); ?>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
			<strong>
				 <?php echo esc_attr__( 'View Cart', 'jevelin' ); ?>
			</strong>
		</a>
		<span class="sh-notification-item-close">
			<i class="ti-close"></i>
		</span>
	</div>
<?php endif; ?>


<?php wp_footer(); ?>

</body>
</html>
