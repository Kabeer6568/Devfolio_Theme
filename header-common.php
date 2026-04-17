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

  <nav class="navbar">
    <div class="navbar__inner">
      <a href="<?php echo home_url() ?>" class="navbar__logo">dev<span>folio</span></a>
      <ul class="navbar__links">
        <li><a href="<?php echo home_url('/register') ?>" class="btn btn--outline btn--sm">View portfolio ↗</a></li>
        <li>
          <div style="width:28px; height:28px; border-radius:50%; background:var(--text); display:flex; align-items:center; justify-content:center; color:#fff; font-family:var(--font-mono); font-size:0.7rem; cursor:pointer;">
            <?php echo ucfirst(substr(wp_get_current_user()->display_name , 0 , 1)) ?>
          </div>
        </li>
      </ul>
    </div>
  </nav>