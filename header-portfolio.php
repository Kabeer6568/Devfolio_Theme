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
<body data-page="portfolio">

  <!-- Minimal portfolio navbar -->
  <nav class="navbar">
    <div class="navbar__inner">
      <span class="navbar__logo">dev<span>folio</span></span>
      <ul class="navbar__links">
        <li><a href="<?php echo home_url('/my-projects'); ?>">Projects</a></li>
        <li><a href="<?php echo home_url('/my-skills'); ?>">Skills</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="<?php echo home_url('/register'); ?>" class="btn btn--outline btn--sm">Build yours</a></li>
      </ul>
    </div>
  </nav>