<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-55937490-2%22%3E"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-55937490-2');
</script>
</head>

<body <?php body_class(); ?>>
	<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>	

<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->

		<header class="navbar navbar-expand-md navbar-dark">

				

		<?php if ( 'container' == $container ) : ?>
			<div class="container">
		<?php endif; ?>

					<!-- Your site title as branding in the menu -->
					<?php /* if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>


					<?php } else {
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
						echo '<a class="logo" rel="home" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" itemprop="url">';
						echo '<img width="338" class="logo" src="' . $image[0] . '" alt="return to home page">';
						echo '</a>';
					}  */ ?><!-- end custom logo -->

				

				<!--
				<form class="form-inline my-2 my-lg-0 mr-3" action="<?php echo home_url( '/' ); ?>" role="search">
			      <div class="input-group">
                      <label for="search" class="">Search</label>
                      <input type="text" class="form-control search-text" name="search" placeholder="Search" id="search">
                      <div class="input-group-append">
                        <button class="btn" type="submit" aria-label="search button" <?php echo get_search_query() ?>>
                          <i class="fa fa-search search-icn"></i>
                        </button>
                      </div>
                    </div>
			    </form>
					-->
			   
			    			<!--
                <a class="btn demo-btn" href="<?php echo get_site_url(null, '/schedule-demo/'); ?>">
                	Request a demo         
                </a>
								-->
								<!--
								<a class="btn demo-btn" href="<?php echo get_site_url(null, '/free-scan/'); ?>">
                	Free Scan        
                </a>
              	-->
				
			<?php if ( 'container' == $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>

		</header><!-- .site-navigation -->
<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" class="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

		
	<div class="container-fluid">
	

		<nav class="navbar navbar-expand-sm" role="navigation">

			<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>


					<?php } else {
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
						echo '<a class="logo" rel="home" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" itemprop="url">';
						echo '<img width="338" class="logo" src="' . $image[0] . '" alt="return to home page">';
						echo '</a>';
					}   ?><!-- end custom logo -->
			<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				); ?>

				<form class="form-inline my-2 my-lg-0 mr-3 asx-search-form" action="<?php echo home_url( '/' ); ?>" role="search">
			      <div class="input-group">
                      <label for="search" class="">Search</label>
                      <input type="text" class="form-control search-text" name="search" placeholder="Search" id="search">
                      <div class="input-group-append">
                        <button class="btn" type="submit" aria-label="search button" <?php echo get_search_query() ?>>
                          <i class="fa fa-search search-icn"></i>
                        </button>

                        <button class="navbar-toggler ml-3" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
					<svg viewBox="0 0 100 60" width="20" height="20">
    <rect width="100" height="5" fill="white" rx="8"></rect>
    <rect y="30" width="100" fill="white" height="5" rx="8"></rect>
    <rect y="60" width="100" fill="white" height="5" rx="8"></rect>
</svg>
				</button>
                      </div>
                    </div>
			    </form>


			    
		</nav>	

		
			</div><!-- .container -->

	</div><!-- #wrapper-navbar end -->
