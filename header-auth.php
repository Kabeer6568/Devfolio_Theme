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

<body data-page="">

  <div class="auth-wrapper">

    <!-- Minimal top bar -->
    <nav class="navbar">
      <div class="navbar__inner">
        <a href="<?php echo home_url() ?>" class="navbar__logo">dev<span>folio</span></a>
        <ul class="navbar__links">

        <?php   
        
        if (is_page('login')) : ?>
          <li><a href="<?php echo home_url('/register') ?>">Don't have an account? <strong>Sign up</strong></a></li>
        <?php        
        
        elseif(is_page('register')) : ?>
              <li><a href="<?php echo home_url('/login') ?>">Already have an account? <strong>Log in</strong></a></li>
        <?php 
        
        endif;
        ?>
          
          
        </ul>
      </div>
    </nav>