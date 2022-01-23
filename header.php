<?php
/**
 * Header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<?php if( jevelin_option('responsive_layout') ) : ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php endif; ?>

	<?php
	/* Callback for older WordPress versions */
	if( !function_exists( 'has_site_icon' ) || ! has_site_icon() ) : ?>
		<?php if( jevelin_option_image('favicon') ) : ?>
			<link rel="icon" type="image/png" href="<?php echo jevelin_option_image('favicon'); ?>">
		<?php endif; ?>
	<?php endif; ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	do_action( 'jevelin_after_body' );

	/* Get Titlebar options */
	if( jevelin_framework() == 'redux' ) :
		$titlebar_style_val2 = jevelin_post_option( jevelin_page_id(), 'header_style' );
	else :
		$titlebar_style_val = jevelin_post_option( jevelin_page_id(), 'header_style' );
		$titlebar_style_val2 = ( isset( $titlebar_style_val['header_style'] ) ) ? esc_attr($titlebar_style_val['header_style']) : 'default';
	endif;

	/* Inlcude page loader HTML */
	get_template_part('inc/templates/page_loader' );

	/* Header popup search */
	if( jevelin_option( 'header_search_style', 'style1' ) != 'style1' ) :
		get_template_part('inc/headers/header-search');
	endif;
?>

	<?php
		if( jevelin_header_right() ) :
			/* Inlcude right header HTML */
			get_template_part('inc/headers/header-right-1' );
		endif;
	?>

	<div id="page-container" class="<?php echo jevelin_header_page_container(); ?>">
		<?php
			do_action( 'jevelin_after_page_container' );

			/* Inlcude page notice HTML */
			get_template_part('inc/templates/notice' );

			/* Inlcude breadcrumbs HTML, if bottom titlebar style */
			if( $titlebar_style_val2 == 'bottom_titlebar' ) :
				get_template_part('inc/templates/titlebar' );
			endif;

			// Header Template
			$header_builder_id = 0;
			$header_page_template = ( jevelin_post_option( jevelin_page_id(), 'header_layout', 'default' ) != 'default' ) ? jevelin_post_option( jevelin_page_id(), 'header_layout', 'default' ) : 'default';
			$header_page_template_id = intval( str_replace( 'header-', '', $header_page_template ) );

			// Post Settings
			if( $header_page_template != 'default' && $header_page_template_id > 0 ) :
				if( is_numeric( strpos( $header_page_template, 'header-' ) ) && get_post_status( $header_page_template_id ) == 'publish' ) :
					$header_builder_id = $header_page_template_id;
				endif;

			// Theme Settings
			else :
				$header_template = ( jevelin_option( 'header_layout' ) != '1' ) ? jevelin_option( 'header_layout' ) : '1';
				$header_template_id = intval( str_replace( 'header-', '', $header_template ) );

				if( $header_template != 'default' && is_numeric( strpos( $header_template, 'header-' ) ) && $header_template_id && get_post_status( $header_template_id ) == 'publish' ) :
					$header_builder_id = $header_template_id;
				endif;
			endif;

			// Final check
			if( $header_builder_id > 0 && get_post_type( $header_builder_id ) != 'shufflehound_header' ) :
				$header_builder_id = '';
			endif;
		?>


		<?php if( !in_array( get_post_type( get_the_ID() ), array( 'shufflehound_header', 'shufflehound_footer' ) ) ) : ?>
			<?php if( jevelin_post_option( jevelin_page_id(), 'header', 'on' ) != 'off' ) : ?>
				<?php if( $header_builder_id > 0 ) : ?>

					<div class="sh-header-template" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
						<?php if( current_user_can( 'manage_options' ) ) : ?>
		                    <a target="_blank" href="<?php echo admin_url( 'post.php?vc_action=vc_inline&post_id='.intval( $header_builder_id ).'&post_type=shufflehound_header' ); ?>" class="sh-header-builder-edit">
		                        <i class="ti-pencil"></i>
		                        <?php esc_html_e( 'Edit Header', 'jevelin' ); ?>
		                    </a>
		                <?php endif;
							if( class_exists( 'Vc_Manager' ) ) :
								Vc_Manager::getInstance()->vc()->addShortcodesCustomCss( $header_builder_id );

								if( function_exists( 'pll_get_post' ) && pll_get_post( $header_builder_id ) > 0 ) :
									$header_builder_id = pll_get_post( $header_builder_id );
								endif;
								
							    $the_post = get_post( $header_builder_id );
							    echo do_shortcode( $the_post->post_content );
							endif;
						?>
					</div>

				<?php else : ?>

					<div role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
						<header class="primary-mobile<?php echo jevelin_header_mobile_style(); ?>">
							<?php /* Inlcude mobile header */
								get_template_part('inc/headers/header-mobile' );
							?>
						</header>
						<header class="primary-desktop<?php echo jevelin_header_desktop_style(); ?>">
							<?php /* Inlcude desktop header */
								get_template_part('inc/headers/header-'.jevelin_header_layout() );
							?>
						</header>
					</div>

				<?php endif; ?>
			<?php endif; ?>

			<?php
				/* Inlcude breadcrumbs HTML, if not bottom titlebar style */
				if( $titlebar_style_val2 != 'bottom_titlebar' ) :
					get_template_part('inc/templates/titlebar' );
				endif;

				/* Include WooCommerce Progres Indicator */
				if( class_exists( 'woocommerce' ) ) :
					get_template_part('inc/templates/woocommerce-progress' );
				endif;
			?>
		<?php endif; ?>


		<?php
			if( is_search() ) {
				$class = ' sh-page-layout-default';
			} else if( jevelin_post_option( jevelin_page_id(), 'page_layout', 'default' ) != 'full' ) {
				$class = ' sh-page-layout-default';
			} else if( jevelin_post_option( jevelin_page_id(), 'page_layout', 'default' ) == 'full' ) {
				$class = ' sh-page-layout-full';
			}

			if( !is_singular( 'fw-portfolio' ) ) :
				if( !is_search() && ( jevelin_post_option( jevelin_page_id(), 'page_layout', 'default' ) == 'default' ||
				   ( jevelin_post_option( jevelin_page_id(), 'page_layout', 'default' ) == 'global_default' && jevelin_option( 'global_page_layout' ) == 'default' ) ) ) :
					$post = get_post();
					if( $post && preg_match( '/vc_row/', $post->post_content ) ) :
					    $class = '';
					endif;
				endif;
			endif;
		?>


        <?php /* Unyson Builder Empty Space Preview */
		/*if( current_user_can('administrator') &&
        function_exists( 'fw_ext_page_builder_is_builder_post' ) && fw_ext_page_builder_is_builder_post( jevelin_page_id() ) ) : ?>
            <span class="sh-unyson-frontend-test" style="opacity: 0;" title="Toogle page builder empty spaces visually">
                <i class="icon icon-eye"></i>
            </span>
	    <?php endif;*/ ?>


			<div id="wrapper">
				<?php /* Option to show blog page editor content above blog */
				wp_reset_postdata();
				if( jevelin_post_option( jevelin_page_id(), 'page_blog_editor', 'off' ) == 'on' ) : ?>
					<?php if( function_exists( 'fw_ext_page_builder_is_builder_post' ) && fw_ext_page_builder_is_builder_post( jevelin_page_id() ) ) : ?>
						<div class="blog-editor-content-container blog-fw-editor-content-container">
							<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
						</div>
					<?php elseif( get_the_content( jevelin_page_id() ) ) : ?>
						<div class="blog-editor-content-container">
							<div class="container">
								<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>


				<div class="content-container<?php echo esc_attr( $class ); ?>">
				<?php
				if( is_singular( 'fw-portfolio' ) ) :
					$page_layout = jevelin_option( 'portfolio_single_page_layout', 'default' );
				elseif( jevelin_post_option( jevelin_page_id(), 'page_layout', 'default' ) != 'global_default' ) :
					$page_layout = jevelin_post_option( jevelin_page_id(), 'page_layout', 'default' );
				else :
					$page_layout = jevelin_option( 'global_page_layout', 'default' );
				endif;

				if( $page_layout != 'full' ) : ?>
					<div class="container entry-content">
				<?php endif; ?>

				<?php
					/* Inlcude white borders option HTML */
					get_template_part('inc/templates/white_borders' );
				?>
