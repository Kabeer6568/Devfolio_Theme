<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kabeer_Ali_AAlvi
 */

?>

 <!-- Footer -->
  <footer style="border-top: 1px solid var(--border); padding: 1.5rem 0;">
    <div class="container" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
      <span class="text-mono text-faint" style="font-size: 0.8rem;">devfolio © <?php echo date('Y'); ?></span>
      <div style="display: flex; gap: 1.5rem;">
        <a href="#" class="text-sm text-faint">Privacy</a>
        <a href="#" class="text-sm text-faint">Terms</a>
        <a href="#" class="text-sm text-faint">Contact</a>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>