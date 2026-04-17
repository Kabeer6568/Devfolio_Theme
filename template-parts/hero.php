
  
  
  <!-- Hero -->
  <section class="home-hero">
    <div class="container">
      <p class="home-hero__eyebrow"><?php the_field('sub_title'); ?></p>
      <h1 class="home-hero__title">
        <?php the_field('hero_title'); ?>
      </h1>
      <p class="home-hero__sub">
        <?php the_field('small_description'); ?>
      </p>
      <div class="home-hero__cta">
        <a href="<?php the_field('hero_button_1'); ?>" class="btn btn--primary"><?php the_field('hero_button_1_title'); ?></a>
        <a href="<?php the_field('hero_button_2'); ?>" class="btn btn--outline"><?php the_field('hero_button_2_title'); ?></a>
      </div>
    </div>
  </section>