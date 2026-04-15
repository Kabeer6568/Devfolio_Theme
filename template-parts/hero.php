
  <body <?php body_class(); ?> data-page="home">

  <!-- Navbar -->
  <nav class="navbar">
    <div class="navbar__inner">
      <a href="<?php echo home_url(); ?>" class="navbar__logo">dev<span>folio</span></a>
      <ul class="navbar__links">
        <li class="nav-hide"><a href="#features">Features</a></li>
        <li class="nav-hide"><a href="#how">How it works</a></li>
        <li><a href="login.html">Log in</a></li>
        <li><a href="register.html" class="btn btn--primary">Get started</a></li>
      </ul>
    </div>
  </nav>
  
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