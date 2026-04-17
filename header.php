<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kabeer_Ali_AAlvi
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-page="home">

  <!-- Navbar -->
  <nav class="navbar">
    <div class="navbar__inner">
      <a href="<?php echo home_url(); ?>" class="navbar__logo">dev<span>folio</span></a>
      <ul class="navbar__links">
        <?php
		
			wp_nav_menu( [
				'theme_location' => 'primary_menu',
				'container' => false,
				'items_wrap' => '%3$s',
        // 'fallback_cb'    => false,
			] )
		
		?>
	  	<!-- <li class="nav-hide"><a href="#features">Features</a></li>
        <li class="nav-hide"><a href="#how">How it works</a></li>
        <li><a href="login.html">Log in</a></li> -->

        <li><a href="register.html" class="btn btn--primary">Get started</a></li>

      </ul>
    </div>
  </nav>