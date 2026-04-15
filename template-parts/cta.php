 <!-- CTA Banner -->
  <section style="padding: 4rem 0; border-top: 1px solid var(--border); background: var(--text);">
    <div class="container" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 2rem;">
      <div>
        <h2 style="font-size: 1.5rem; color: #fff; margin-bottom: 0.5rem;"><?php the_field('cta_title'); ?></h2>
        <p style="color: rgba(255,255,255,0.5); font-size: 0.9rem;"><?php the_field('cta_description'); ?></p>
      </div>
      <a href="<?php the_field('cta_button_link'); ?>" class="btn" style="background: #fff; color: var(--text); border-color: #fff; font-size: 0.875rem; padding: 0.7rem 1.5rem;">
        <?php the_field('cta_button_text'); ?>
      </a>
    </div>
  </section>
