<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jamie_Blomerus_Portfolio
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,  user-scalable=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<meta name="author" content="<?php get_bloginfo('name') ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<noscript><h2 class="js-warning">It seems like you have JavaScript disabled. This site requires JavaScript to work properly. Please enable JavaScript in your browser settings.</h2></noscript>
<div id="page" class="site">
	<? if (!is_front_page()): ?>
		<header class="smallheader">
			<p><a href="<?php echo get_home_url(); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to home</a></p>
		</header>
	<? else: ?>
	<header data-anchor="home" class="home section">
		<p class="open-source"><a href="https://github.com/jamieblomerus/portfolio" title="This site is open source under GPLv3.">Source code</a></p>
		<div class="row">
			<div class="container">
				<div class="site-branding">
					<?php
					the_custom_logo();

					$namesplit = explode(" ", get_bloginfo( 'name' ));
					?>
					<h1 class="site-title"><span class="fname"><?php echo $namesplit[0] ?></span><br><span class="lname"><?php echo $namesplit[1] ?></span></h1>
					<?php
					$portfolio_description = get_bloginfo( 'description', 'display' );
					if ( $portfolio_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $portfolio_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->
			</div>
			<div class="container">
				<div class="image-container">
					<?php
					//Get image
					$image = esc_url(get_theme_mod('profile_image'));
					if (empty($image)) {
						$image = get_template_directory_uri() . '/assets/images/profile.webp';
					}
					?>
					<img src="<?php echo $image ?>" alt="">
				</div>
			</div>
		</div>
		<p class="scroll">Scroll down<br><i class="fa fa-chevron-down"></i></p>
	</header><!-- #masthead -->
	<? endif; ?>